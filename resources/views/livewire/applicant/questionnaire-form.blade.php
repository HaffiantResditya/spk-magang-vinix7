<div class="max-w-4xl mx-auto space-y-6">
    <!-- Header Card -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200/80 p-6 sm:p-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 border-b border-slate-100 pb-5">
            <div>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-blue-50 text-vinix-navy border border-blue-200">
                    <svg class="w-3.5 h-3.5 mr-1.5 text-vinix-aurum" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                    </svg>
                    Self-Assessment Kompas Karir
                </span>
                <h1 class="text-2xl font-bold text-slate-900 mt-2">Kuesioner Kompetensi Pelamar</h1>
                <p class="text-sm text-slate-500 mt-1">Langkah {{ $currentStep }} dari {{ $totalSteps }}: {{ $criterion->name ?? '' }} ({{ $criterion->code ?? '' }})</p>
            </div>
            <div class="text-right">
                <span class="text-2xl font-extrabold text-vinix-navy">{{ $progress }}%</span>
                <span class="text-xs text-slate-400 block">Progres Langkah</span>
            </div>
        </div>

        <!-- Progress Bar -->
        <div class="w-full bg-slate-100 rounded-full h-2.5 mt-4 overflow-hidden">
            <div class="bg-gradient-to-r from-vinix-navy to-vinix-aurum h-2.5 rounded-full transition-all duration-500 ease-out" style="width: {{ $progress }}%"></div>
        </div>

        <!-- Step Pills Indicator -->
        <div class="grid grid-cols-7 gap-2 mt-5">
            @foreach($criteriaList as $idx => $crit)
                @php
                    $stepNum = $idx + 1;
                    $isStepActive = ($currentStep === $stepNum);
                    
                    // Check if all questions in this criterion are answered
                    $critQuestions = $crit['questions'] ?? [];
                    $isStepComplete = false;
                    if (count($critQuestions) > 0) {
                        $isStepComplete = true;
                        foreach ($critQuestions as $cq) {
                            $cVal = $answers[$cq['id']] ?? ($answers[(string)$cq['id']] ?? null);
                            if ($cVal === null || $cVal === '') {
                                $isStepComplete = false;
                                break;
                            }
                        }
                    }
                @endphp
                <button type="button"
                    wire:click="goToStep({{ $stepNum }})"
                    wire:key="step-pill-{{ $crit['id'] ?? $stepNum }}"
                    class="py-2 px-1 text-center rounded-lg text-xs font-semibold transition-all duration-200 {{ $isStepActive ? 'bg-vinix-navy text-white shadow-sm ring-2 ring-vinix-aurum/40' : ($isStepComplete ? 'bg-emerald-50 text-emerald-800 border border-emerald-200 hover:bg-emerald-100' : 'bg-slate-50 text-slate-400 hover:bg-slate-100') }}">
                    <div class="flex items-center justify-center space-x-1">
                        <span class="block text-[10px] uppercase font-bold">{{ $crit['code'] }}</span>
                        @if($isStepComplete && !$isStepActive)
                            <svg class="w-3 h-3 text-emerald-600 inline" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        @endif
                    </div>
                    <span class="hidden md:inline text-[11px] truncate block">{{ Str::limit($crit['name'], 12) }}</span>
                </button>
            @endforeach
        </div>
    </div>

    <!-- Questions Form Card -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200/80 p-6 sm:p-8 space-y-6">
        <!-- Error Alert Banner -->
        @if($errorMessage)
            <div class="flex items-start p-4 rounded-xl bg-rose-50 border border-rose-300 text-rose-900 text-sm shadow-sm space-x-3 transition-all">
                <div class="w-8 h-8 rounded-lg bg-rose-100 flex items-center justify-center text-rose-700 flex-shrink-0 mt-0.5">
                    <svg class="w-5 h-5 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <div>
                    <p class="font-bold text-rose-900">Perhatian: Pertanyaan Belum Lengkap</p>
                    <p class="text-xs text-rose-700 mt-0.5 leading-relaxed">{{ $errorMessage }}</p>
                </div>
            </div>
        @endif

        <div class="flex items-center space-x-3 bg-amber-50/60 border border-amber-200/60 rounded-xl p-4">
            <div class="w-9 h-9 rounded-lg bg-vinix-aurum/20 flex items-center justify-center text-amber-700 flex-shrink-0">
                <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <p class="text-xs sm:text-sm text-amber-900 leading-relaxed">
                Pilihlah skala penilaian (20 - 100) yang paling mencerminkan kemampuan riil Anda saat ini. Seluruh pertanyaan <strong>wajib diisi</strong> sebelum dapat melanjutkan ke langkah berikutnya.
            </p>
        </div>

        <div class="space-y-6 divide-y divide-slate-100">
            @foreach($criterion->questions as $qIndex => $question)
                @php
                    $currentVal = isset($answers[$question->id]) ? (int) $answers[$question->id] : (isset($answers[(string) $question->id]) ? (int) $answers[(string) $question->id] : null);
                    $isAnswered = ($currentVal !== null);
                    $isMissing = ($errorMessage && !$isAnswered);
                @endphp

                <div class="pt-6 first:pt-0 space-y-4 p-4 rounded-2xl transition-all duration-200 {{ $isMissing ? 'bg-rose-50/50 border-2 border-rose-400 ring-2 ring-rose-200' : ($isAnswered ? 'bg-slate-50/30' : '') }}" wire:key="question-card-{{ $question->id }}">
                    <div class="flex items-start justify-between gap-3">
                        <div class="flex items-start space-x-3">
                            <span class="flex-shrink-0 w-7 h-7 rounded-full {{ $isAnswered ? 'bg-vinix-navy' : 'bg-slate-300' }} text-white text-xs font-bold flex items-center justify-center mt-0.5">
                                {{ $question->order_num }}
                            </span>
                            <div>
                                <h3 class="text-base font-semibold text-slate-800 leading-snug">
                                    {{ $question->question_text }}
                                </h3>
                                <p class="text-xs text-slate-400 mt-1">Kriteria: {{ $criterion->name }} ({{ $criterion->code }})</p>
                            </div>
                        </div>
                        <div class="flex-shrink-0">
                            @if($isAnswered)
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                    <svg class="w-3.5 h-3.5 mr-1 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                    Terisi (Skor {{ $currentVal }})
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold {{ $isMissing ? 'bg-rose-100 text-rose-700 border border-rose-300 animate-pulse' : 'bg-slate-100 text-slate-500 border border-slate-200' }}">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $isMissing ? 'bg-rose-500' : 'bg-slate-400' }} mr-1.5"></span>
                                    Wajib Diisi
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Scale Selector Options (Default Blank: None selected if not yet answered) -->
                    <div class="grid grid-cols-2 sm:grid-cols-5 gap-2.5 pt-2">
                        @php
                            $options = [
                                20 => ['label' => 'Sangat Kurang', 'desc' => 'Pemula / Belum Tahu', 'color' => 'slate'],
                                40 => ['label' => 'Kurang', 'desc' => 'Dasar / Perlu Bimbingan', 'color' => 'blue'],
                                60 => ['label' => 'Cukup', 'desc' => 'Menengah / Cukup Bisa', 'color' => 'indigo'],
                                80 => ['label' => 'Baik', 'desc' => 'Mahir / Terbiasa Mandiri', 'color' => 'sky'],
                                100 => ['label' => 'Sangat Baik', 'desc' => 'Ahli / Berpengalaman', 'color' => 'amber'],
                            ];
                        @endphp

                        @foreach($options as $val => $meta)
                            <button type="button"
                                wire:click="setAnswer({{ $question->id }}, {{ $val }})"
                                wire:key="q-{{ $question->id }}-val-{{ $val }}"
                                class="text-left relative flex flex-col p-3 rounded-xl border cursor-pointer transition-all duration-200 {{ $currentVal === (int) $val ? 'bg-blue-50/90 border-vinix-navy ring-2 ring-vinix-navy/20 shadow-sm' : 'bg-slate-50/50 border-slate-200 hover:border-slate-300 hover:bg-slate-50' }}">
                                <div class="flex items-center justify-between mb-1.5 w-full">
                                    <span class="text-xs font-extrabold {{ $currentVal === (int) $val ? 'text-vinix-navy' : 'text-slate-700' }}">
                                        Skor {{ $val }}
                                    </span>
                                    <span class="w-4 h-4 rounded-full border flex items-center justify-center {{ $currentVal === (int) $val ? 'border-vinix-navy bg-vinix-navy' : 'border-slate-300 bg-white' }}">
                                        @if($currentVal === (int) $val)
                                            <span class="w-1.5 h-1.5 rounded-full bg-white"></span>
                                        @endif
                                    </span>
                                </div>
                                <span class="text-xs font-semibold text-slate-800">{{ $meta['label'] }}</span>
                                <span class="text-[11px] text-slate-400 mt-0.5 leading-tight">{{ $meta['desc'] }}</span>
                            </button>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Navigation Buttons -->
        <div class="flex items-center justify-between pt-6 border-t border-slate-100">
            <button type="button"
                wire:click="prevStep"
                {{ $currentStep === 1 ? 'disabled' : '' }}
                class="inline-flex items-center px-5 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 {{ $currentStep === 1 ? 'text-slate-300 bg-slate-50 cursor-not-allowed' : 'text-slate-700 bg-slate-100 hover:bg-slate-200 active:scale-95' }}">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Sebelumnya
            </button>

            @if($currentStep < $totalSteps)
                <button type="button"
                    wire:click="nextStep"
                    class="inline-flex items-center px-6 py-2.5 rounded-xl text-sm font-semibold text-white bg-vinix-navy hover:bg-blue-900 active:scale-95 shadow-md shadow-vinix-navy/20 transition-all duration-200">
                    Langkah Selanjutnya
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            @else
                <button type="button"
                    wire:click="finishAssessment"
                    class="inline-flex items-center px-7 py-2.5 rounded-xl text-sm font-bold text-slate-900 bg-gradient-to-r from-vinix-aurum to-amber-400 hover:from-amber-400 hover:to-amber-500 active:scale-95 shadow-lg shadow-amber-500/25 transition-all duration-200">
                    <svg class="w-4 h-4 mr-2 text-slate-900" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    Selesaikan & Lihat Rekomendasi SAW
                </button>
            @endif
        </div>
    </div>
</div>
