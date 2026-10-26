<?php

namespace App\Livewire\Applicant;

use App\Models\Application;
use App\Models\Division;
use App\Models\SawResult;
use App\Services\SawCalculationService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class SawResultBoard extends Component
{
    use WithFileUploads;

    public int $selectedDivisionId = 0;
    public $cvFile = null;
    public bool $showAllDivisions = false;

    public function mount(SawCalculationService $sawService): void
    {
        $user = Auth::user();

        // Run/ensure SAW results are computed
        $results = $sawService->calculate($user);

        // Preselect top 1 division if not already selected
        if (!empty($results['top3'])) {
            $this->selectedDivisionId = $results['top3'][0]['division_id'];
        }

        if ($user->application) {
            $this->selectedDivisionId = $user->application->selected_division_id;
        }
    }

    public function selectDivision(int $divisionId): void
    {
        $this->selectedDivisionId = $divisionId;
    }

    public function toggleAllDivisions(): void
    {
        $this->showAllDivisions = !$this->showAllDivisions;
    }

    public function submitFinalApplication(): void
    {
        $user = Auth::user();

        $rules = [
            'selectedDivisionId' => 'required|exists:divisions,id',
        ];

        // If user already has a cv_path, cvFile is optional, otherwise required
        if (!$user->profile?->cv_path) {
            $rules['cvFile'] = 'required|file|mimes:pdf|max:5120';
        } else {
            $rules['cvFile'] = 'nullable|file|mimes:pdf|max:5120';
        }

        $this->validate($rules, [
            'selectedDivisionId.required' => 'Silakan pilih divisi yang ingin Anda lamar.',
            'cvFile.required' => 'Silakan unggah dokumen CV dalam format PDF.',
            'cvFile.mimes' => 'Format file CV harus berupa dokumen PDF.',
            'cvFile.max' => 'Ukuran file CV maksimal 5 MB.',
        ]);

        if ($this->cvFile) {
            try {
                $cloudinary = app(\App\Services\CloudinaryService::class);
                $path = $cloudinary->uploadCv($this->cvFile, $user->id);
            } catch (\Throwable $e) {
                \Illuminate\Support\Facades\Log::warning('Cloudinary upload failed, falling back to local storage: ' . $e->getMessage());
                $path = $this->cvFile->store('cv_uploads', 'public');
            }

            $user->profile()->updateOrCreate(
                ['user_id' => $user->id],
                ['cv_path' => $path]
            );
        }

        Application::updateOrCreate(
            ['user_id' => $user->id],
            [
                'selected_division_id' => $this->selectedDivisionId,
                'status' => 'pending',
            ]
        );

        session()->flash('success', 'Lamaran Anda berhasil dikirimkan ke HRD PT Vinix Seven Aurum!');
        $this->redirect(route('applicant.dashboard'), navigate: true);
    }

    public function render()
    {
        $user = Auth::user();
        $user->load(['profile', 'application.selectedDivision']);

        $allResults = SawResult::where('user_id', $user->id)
            ->with('division')
            ->orderBy('rank', 'asc')
            ->get();

        $top3 = $allResults->take(3);

        return view('livewire.applicant.saw-result-board', [
            'top3' => $top3,
            'allResults' => $allResults,
            'user' => $user,
        ]);
    }
}
