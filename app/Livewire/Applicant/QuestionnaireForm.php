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

    public function mount(): void
    {
        $user = Auth::user();

        // Load existing answers if any
        $savedAnswers = ApplicantAnswer::where('user_id', $user->id)
            ->pluck('score_value', 'question_id')
            ->toArray();

        // Preload questions and defaults
        $questions = Question::all();
        foreach ($questions as $q) {
            $this->answers[$q->id] = $savedAnswers[$q->id] ?? 60; // default 60 (Cukup)
        }

        // Preload criteria codes
        $this->criteriaList = Criterion::with('questions')->orderBy('id')->get()->toArray();
        $this->totalSteps = count($this->criteriaList);
    }

    public function setAnswer(int $questionId, int $value): void
    {
        $this->answers[$questionId] = $value;
        $this->saveCurrentAnswer($questionId, $value);
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

    public function nextStep(): void
    {
        $this->saveStepAnswers();

        if ($this->currentStep < $this->totalSteps) {
            $this->currentStep++;
        } else {
            $this->finishAssessment();
        }
    }

    public function prevStep(): void
    {
        $this->saveStepAnswers();

        if ($this->currentStep > 1) {
            $this->currentStep--;
        }
    }

    public function goToStep(int $step): void
    {
        if ($step >= 1 && $step <= $this->totalSteps) {
            $this->saveStepAnswers();
            $this->currentStep = $step;
        }
    }

    protected function saveStepAnswers(): void
    {
        $userId = Auth::id();
        foreach ($this->answers as $qId => $val) {
            ApplicantAnswer::updateOrCreate(
                [
                    'user_id' => $userId,
                    'question_id' => $qId,
                ],
                [
                    'score_value' => (int) $val,
                ]
            );
        }
    }

    public function finishAssessment(): void
    {
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
