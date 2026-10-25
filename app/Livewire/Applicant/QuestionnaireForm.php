<?php

namespace App\Livewire\Applicant;

use App\Models\ApplicantAnswer;
use App\Models\Criterion;
use App\Models\Question;
use App\Services\SawCalculationService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class QuestionnaireForm extends Component
{
    public int $currentStep = 1;
    public int $totalSteps = 7;
    public array $answers = [];
    public array $criteriaList = [];
    public ?string $errorMessage = null;

    public function mount(): void
    {
        $user = Auth::user();

        // Load existing answers if any (NO default values, completely blank if not yet answered)
        $savedAnswers = ApplicantAnswer::where('user_id', $user->id)
            ->pluck('score_value', 'question_id')
            ->toArray();

        foreach ($savedAnswers as $qId => $val) {
            $this->answers[(int) $qId] = (int) $val;
            $this->answers[(string) $qId] = (int) $val;
        }

        // Preload criteria codes
        $this->criteriaList = Criterion::with('questions')->orderBy('id')->get()->toArray();
        $this->totalSteps = count($this->criteriaList);
    }

    public function setAnswer(int $questionId, int $value): void
    {
        $this->answers[$questionId] = $value;
        $this->answers[(string) $questionId] = $value;
        $this->saveCurrentAnswer($questionId, $value);

        $this->checkStepCompleted();
    }

    protected function saveCurrentAnswer(int $questionId, int $value): void
    {
        ApplicantAnswer::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'question_id' => $questionId,
            ],
            [
                'score_value' => $value,
            ]
        );
    }

    protected function validateCurrentStep(): bool
    {
        $this->errorMessage = null;

        $criterion = Criterion::with('questions')->orderBy('id')->skip($this->currentStep - 1)->first();
        if (!$criterion) {
            return true;
        }

        $unanswered = [];
        foreach ($criterion->questions as $q) {
            $val = $this->answers[$q->id] ?? ($this->answers[(string) $q->id] ?? null);
            if ($val === null || $val === '') {
                $unanswered[] = $q->order_num;
            }
        }

        if (count($unanswered) > 0) {
            $this->errorMessage = 'Pertanyaan No. ' . implode(', ', $unanswered) . ' wajib diisi sebelum Anda dapat melanjutkan ke langkah berikutnya.';
            return false;
        }

        return true;
    }

    protected function checkStepCompleted(): void
    {
        $criterion = Criterion::with('questions')->orderBy('id')->skip($this->currentStep - 1)->first();
        if ($criterion) {
            $unanswered = false;
            foreach ($criterion->questions as $q) {
                $val = $this->answers[$q->id] ?? ($this->answers[(string) $q->id] ?? null);
                if ($val === null || $val === '') {
                    $unanswered = true;
                    break;
                }
            }
            if (!$unanswered) {
                $this->errorMessage = null;
            }
        }
    }

    public function nextStep(): void
    {
        if (!$this->validateCurrentStep()) {
            return;
        }

        $this->saveStepAnswers();

        if ($this->currentStep < $this->totalSteps) {
            $this->currentStep++;
            $this->errorMessage = null;
        } else {
            $this->finishAssessment();
        }
    }

    public function prevStep(): void
    {
        $this->saveStepAnswers();

        if ($this->currentStep > 1) {
            $this->currentStep--;
            $this->errorMessage = null;
        }
    }

    public function goToStep(int $step): void
    {
        if ($step >= 1 && $step <= $this->totalSteps) {
            // If jumping forward, validate current step questions first
            if ($step > $this->currentStep && !$this->validateCurrentStep()) {
                return;
            }

            $this->saveStepAnswers();
            $this->currentStep = $step;
            $this->errorMessage = null;
        }
    }

    protected function saveStepAnswers(): void
    {
        $userId = Auth::id();
        foreach ($this->answers as $qId => $val) {
            if ($val !== null && $val !== '') {
                ApplicantAnswer::updateOrCreate(
                    [
                        'user_id' => $userId,
                        'question_id' => (int) $qId,
                    ],
                    [
                        'score_value' => (int) $val,
                    ]
                );
            }
        }
    }

    public function finishAssessment(): void
    {
        // Global validation: ensure all 18 questions are answered
        $allQuestions = Question::all();
        $missing = [];
        foreach ($allQuestions as $q) {
            $val = $this->answers[$q->id] ?? ($this->answers[(string) $q->id] ?? null);
            if ($val === null || $val === '') {
                $missing[] = $q;
            }
        }

        if (count($missing) > 0) {
            $firstMissing = $missing[0];
            $criteriaIds = Criterion::orderBy('id')->pluck('id')->toArray();
            $idx = array_search($firstMissing->criteria_id, $criteriaIds);
            if ($idx !== false) {
                $this->currentStep = $idx + 1;
            }
            $this->errorMessage = 'Terdapat pertanyaan yang belum dijawab (Pertanyaan No. ' . $firstMissing->order_num . '). Semua pertanyaan wajib diisi!';
            return;
        }

        $this->saveStepAnswers();

        // Execute SAW calculation
        $sawService = app(SawCalculationService::class);
        $sawService->calculate(Auth::user());

        session()->flash('success', 'Asesmen kompetensi berhasil diselesaikan! Berikut hasil rekomendasi divisi terbaik Anda.');
        $this->redirect(route('applicant.results'), navigate: true);
    }

    public function render()
    {
        $criterion = Criterion::with('questions')->orderBy('id')->skip($this->currentStep - 1)->first();
        $progress = round(($this->currentStep / max($this->totalSteps, 1)) * 100);

        return view('livewire.applicant.questionnaire-form', [
            'criterion' => $criterion,
            'progress' => $progress,
        ]);
    }
}
