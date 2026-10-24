<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Criterion;
use App\Models\Division;
use App\Models\Question;
use App\Models\SawResult;
use App\Services\SawCalculationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ApplicantController extends Controller
{
    /**
     * Applicant status portal and dashboard.
     */
    public function dashboard(): View
    {
        $user = Auth::user();
        $user->load(['profile', 'application.selectedDivision', 'application.approvedDivision']);

        $totalQuestions = Question::count();
        $answeredCount = $user->answers()->count();
        $hasCompletedAssessment = $totalQuestions > 0 && ($answeredCount >= $totalQuestions);

        $topRecommendations = $user->sawResults()->where('rank', '<=', 3)->with('division')->get();
        $application = $user->application;

        return view('dashboard.applicant.index', compact(
            'user',
            'totalQuestions',
            'answeredCount',
            'hasCompletedAssessment',
            'topRecommendations',
            'application'
        ));
    }

    /**
     * Profile update view & action.
     */
    public function profile(): View
    {
        $user = Auth::user();
        $user->load('profile');
        return view('dashboard.applicant.profile', compact('user'));
    }

    public function updateProfile(Request $request): RedirectResponse
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:mahasiswa,umum',
            'institution' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
        ]);

        $user->update(['name' => $request->name]);

        $user->profile()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'type' => $request->type,
                'institution' => $request->institution,
                'phone' => $request->phone,
            ]
        );

        return back()->with('success', 'Profil biodata berhasil diperbarui.');
    }

    /**
     * Assessment Questionnaire Page (Multi-step Livewire form).
     */
    public function assessment(): View|RedirectResponse
    {
        $user = Auth::user();

        // If applicant has already submitted application, redirect to dashboard or results
        if ($user->application && $user->application->status !== 'pending') {
            return redirect()->route('applicant.dashboard')
                ->with('info', 'Lamaran Anda telah diproses oleh HRD.');
        }

        return view('dashboard.applicant.assessment');
    }

    /**
     * SAW Recommendation Results & Final Submission Page.
     */
    public function results(SawCalculationService $sawService): View|RedirectResponse
    {
        $user = Auth::user();

        $totalQuestions = Question::count();
        $answeredCount = $user->answers()->count();

        if ($answeredCount < $totalQuestions) {
            return redirect()->route('applicant.assessment')
                ->with('warning', 'Harap lengkapi seluruh kuesioner terlebih dahulu untuk melihat hasil rekomendasi.');
        }

        $sawData = $sawService->calculate($user);
        $user->load(['profile', 'application.selectedDivision']);

        return view('dashboard.applicant.results', compact('sawData', 'user'));
    }

    /**
     * Finalize Application: choose division, upload CV, submit.
     */
    public function submitApplication(Request $request): RedirectResponse
    {
        $user = Auth::user();

        $request->validate([
            'selected_division_id' => 'required|exists:divisions,id',
            'cv_file' => 'required|file|mimes:pdf|max:5120', // max 5MB PDF
        ]);

        // Upload CV
        $path = $request->file('cv_file')->store('cv_uploads', 'public');

        $user->profile()->updateOrCreate(
            ['user_id' => $user->id],
            ['cv_path' => $path]
        );

        Application::updateOrCreate(
            ['user_id' => $user->id],
            [
                'selected_division_id' => $request->selected_division_id,
                'status' => 'pending',
            ]
        );

        return redirect()->route('applicant.dashboard')
            ->with('success', 'Lamaran berhasil dikirimkan ke HRD PT Vinix Seven Aurum! Pantau status Anda di portal ini.');
    }
}
