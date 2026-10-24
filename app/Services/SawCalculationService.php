<?php

namespace App\Services;

use App\Models\ApplicantAnswer;
use App\Models\Criterion;
use App\Models\Division;
use App\Models\MatrixWeight;
use App\Models\SawResult;
use App\Models\User;
use Illuminate\Support\Collection;

class SawCalculationService
{
    /**
     * Compute SAW recommendation for a given user.
     *
     * @param User|int $user
     * @return array
     */
    public function calculate(User|int $user): array
    {
        $userId = $user instanceof User ? $user->id : $user;

        // 1. Fetch criteria and applicant answers
        $criteria = Criterion::with('questions')->get();
        $answers = ApplicantAnswer::where('user_id', $userId)
            ->pluck('score_value', 'question_id')
            ->toArray();

        // 2. Form decision vector X for each criterion (Average score of questions under criterion)
        $criteriaScores = [];
        $normalizedMatrix = []; // R matrix (Benefit criteria: X_j / Max_X_j, where Max is 100)
        $maxScale = 100.0;

        foreach ($criteria as $criterion) {
            $questionIds = $criterion->questions->pluck('id')->toArray();
            $scores = [];
            foreach ($questionIds as $qId) {
                if (isset($answers[$qId])) {
                    $scores[] = (float) $answers[$qId];
                }
            }

            // If no answers yet, default to minimum baseline (20.0)
            $avgScore = count($scores) > 0 ? (array_sum($scores) / count($scores)) : 20.0;
            $criteriaScores[$criterion->code] = round($avgScore, 2);

            // Normalization: R = Score / Max (all criteria are Benefit)
            $normalizedMatrix[$criterion->code] = round($avgScore / $maxScale, 4);
        }

        // 3. Fetch divisions and matrix weights
        $divisions = Division::with('matrixWeights.criterion')->get();

        $scores = [];

        foreach ($divisions as $division) {
            $totalScore = 0.0;
            $weightsBreakdown = [];

            foreach ($division->matrixWeights as $mw) {
                $cCode = $mw->criterion->code ?? null;
                if (!$cCode) continue;

                $rValue = $normalizedMatrix[$cCode] ?? 0.0;
                $weightPct = (float) $mw->weight_percentage; // e.g. 35.0 (%)
                $weightFraction = $weightPct / 100.0;       // e.g. 0.35

                $contribution = $weightFraction * ($rValue * 100.0); // contribution to 100% scale
                $totalScore += $contribution;

                $weightsBreakdown[$cCode] = [
                    'weight' => $weightPct,
                    'raw_score' => $criteriaScores[$cCode] ?? 0,
                    'r_value' => $rValue,
                    'contribution' => round($contribution, 2),
                ];
            }

            $finalScore = round($totalScore, 2); // percentage score (e.g. 84.75%)

            $scores[] = [
                'division_id' => $division->id,
                'division_name' => $division->name,
                'division_description' => $division->description,
                'final_score' => $finalScore,
                'breakdown' => $weightsBreakdown,
            ];
        }

        // 4. Rank descending by final_score
        usort($scores, function ($a, $b) {
            return $b['final_score'] <=> $a['final_score'];
        });

        // Assign ranks and save to saw_results table
        $rankedResults = [];
        foreach ($scores as $index => $item) {
            $rank = $index + 1;
            $item['rank'] = $rank;
            $rankedResults[] = $item;

            SawResult::updateOrCreate(
                [
                    'user_id' => $userId,
                    'division_id' => $item['division_id'],
                ],
                [
                    'final_score' => $item['final_score'],
                    'rank' => $rank,
                ]
            );
        }

        $top3 = array_slice($rankedResults, 0, 3);

        return [
            'criteria_scores' => $criteriaScores,
            'normalized_matrix' => $normalizedMatrix,
            'all_results' => $rankedResults,
            'top3' => $top3,
        ];
    }
}
