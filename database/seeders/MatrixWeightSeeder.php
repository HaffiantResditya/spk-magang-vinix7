<?php

namespace Database\Seeders;

use App\Models\Criterion;
use App\Models\Division;
use App\Models\MatrixWeight;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class MatrixWeightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $criteriaMap = Criterion::pluck('id', 'code'); // ['C1' => 1, 'C2' => 2, ...]

        // 14 divisions weights mapped to [C1, C2, C3, C4, C5, C6, C7] totaling 100% per division
        $divisionWeights = [
            // 1. Human Resource (SDM) Analyst
            1 => ['C1' => 5.0,  'C2' => 5.0,  'C3' => 10.0, 'C4' => 5.0,  'C5' => 20.0, 'C6' => 50.0, 'C7' => 5.0],
            // 2. Python Data Science Engineer
            2 => ['C1' => 5.0,  'C2' => 40.0, 'C3' => 35.0, 'C4' => 5.0,  'C5' => 5.0,  'C6' => 5.0,  'C7' => 5.0],
            // 3. Data Analyst
            3 => ['C1' => 10.0, 'C2' => 15.0, 'C3' => 45.0, 'C4' => 5.0,  'C5' => 10.0, 'C6' => 10.0, 'C7' => 5.0],
            // 4. Python Machine Learning & AI Engineer
            4 => ['C1' => 10.0, 'C2' => 45.0, 'C3' => 25.0, 'C4' => 5.0,  'C5' => 5.0,  'C6' => 5.0,  'C7' => 5.0],
            // 5. Web & UIUX Developer
            5 => ['C1' => 50.0, 'C2' => 5.0,  'C3' => 15.0, 'C4' => 5.0,  'C5' => 15.0, 'C6' => 5.0,  'C7' => 5.0],
            // 6. Social Media & Digital Marketing Strategist
            6 => ['C1' => 15.0, 'C2' => 5.0,  'C3' => 10.0, 'C4' => 5.0,  'C5' => 10.0, 'C6' => 50.0, 'C7' => 5.0],
            // 7. Tech Project Management Specialist
            7 => ['C1' => 15.0, 'C2' => 5.0,  'C3' => 10.0, 'C4' => 5.0,  'C5' => 40.0, 'C6' => 20.0, 'C7' => 5.0],
            // 8. Digital Public Relations & Communication Specialist
            8 => ['C1' => 5.0,  'C2' => 5.0,  'C3' => 5.0,  'C4' => 5.0,  'C5' => 15.0, 'C6' => 55.0, 'C7' => 10.0],
            // 9. Ethical Hacker
            9 => ['C1' => 5.0,  'C2' => 15.0, 'C3' => 15.0, 'C4' => 50.0, 'C5' => 5.0,  'C6' => 5.0,  'C7' => 5.0],
            // 10. Bisnis Digital Analyst
            10 => ['C1' => 15.0, 'C2' => 5.0,  'C3' => 20.0, 'C4' => 5.0,  'C5' => 35.0, 'C6' => 15.0, 'C7' => 5.0],
            // 11. Cybersecurity Engineer
            11 => ['C1' => 5.0,  'C2' => 10.0, 'C3' => 15.0, 'C4' => 50.0, 'C5' => 10.0, 'C6' => 5.0,  'C7' => 5.0],
            // 12. Investment & Financial Market Analyst
            12 => ['C1' => 5.0,  'C2' => 10.0, 'C3' => 20.0, 'C4' => 5.0,  'C5' => 10.0, 'C6' => 10.0, 'C7' => 40.0],
            // 13. Business Administration Intelligence Analyst (Power BI & Excel)
            13 => ['C1' => 5.0,  'C2' => 5.0,  'C3' => 40.0, 'C4' => 5.0,  'C5' => 15.0, 'C6' => 10.0, 'C7' => 20.0],
            // 14. Cybercrime & Forensic Investigator
            14 => ['C1' => 5.0,  'C2' => 15.0, 'C3' => 15.0, 'C4' => 45.0, 'C5' => 10.0, 'C6' => 5.0,  'C7' => 5.0],
        ];

        Schema::disableForeignKeyConstraints();
        MatrixWeight::truncate();
        Schema::enableForeignKeyConstraints();

        foreach ($divisionWeights as $divisionId => $criteriaWeights) {
            foreach ($criteriaWeights as $code => $weight) {
                if (isset($criteriaMap[$code])) {
                    MatrixWeight::create([
                        'division_id' => $divisionId,
                        'criteria_id' => $criteriaMap[$code],
                        'weight_percentage' => $weight,
                    ]);
                }
            }
        }
    }
}
