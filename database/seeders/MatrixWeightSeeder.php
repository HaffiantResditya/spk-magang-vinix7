<?php

namespace Database\Seeders;

use App\Models\Criterion;
use App\Models\Division;
use App\Models\MatrixWeight;
use Illuminate\Database\Seeder;

class MatrixWeightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $criteriaMap = Criterion::pluck('id', 'code'); // ['C1' => 1, 'C2' => 2, ...]

        // 19 divisions weights mapped to [C1, C2, C3, C4, C5, C6, C7] totaling 100% per division
        $divisionWeights = [
            // 1. Software Development (Web & Fullstack)
            1 => ['C1' => 35.0, 'C2' => 10.0, 'C3' => 25.0, 'C4' => 10.0, 'C5' => 10.0, 'C6' => 5.0, 'C7' => 5.0],
            // 2. UI/UX Design & Product Research
            2 => ['C1' => 50.0, 'C2' => 5.0,  'C3' => 5.0,  'C4' => 5.0,  'C5' => 15.0, 'C6' => 15.0, 'C7' => 5.0],
            // 3. Mobile App Development
            3 => ['C1' => 35.0, 'C2' => 10.0, 'C3' => 20.0, 'C4' => 10.0, 'C5' => 15.0, 'C6' => 5.0, 'C7' => 5.0],
            // 4. Artificial Intelligence & Machine Learning
            4 => ['C1' => 10.0, 'C2' => 45.0, 'C3' => 25.0, 'C4' => 5.0,  'C5' => 5.0,  'C6' => 5.0, 'C7' => 5.0],
            // 5. Data Science & Big Data Analytics
            5 => ['C1' => 5.0,  'C2' => 35.0, 'C3' => 40.0, 'C4' => 5.0,  'C5' => 5.0,  'C6' => 5.0, 'C7' => 5.0],
            // 6. Data Analyst & Business Intelligence
            6 => ['C1' => 10.0, 'C2' => 15.0, 'C3' => 45.0, 'C4' => 5.0,  'C5' => 10.0, 'C6' => 10.0, 'C7' => 5.0],
            // 7. Cybersecurity & Penetration Testing
            7 => ['C1' => 5.0,  'C2' => 15.0, 'C3' => 10.0, 'C4' => 50.0, 'C5' => 10.0, 'C6' => 5.0, 'C7' => 5.0],
            // 8. Digital Forensics & Incident Response
            8 => ['C1' => 5.0,  'C2' => 15.0, 'C3' => 15.0, 'C4' => 45.0, 'C5' => 10.0, 'C6' => 5.0, 'C7' => 5.0],
            // 9. Cloud Infrastructure & DevOps
            9 => ['C1' => 15.0, 'C2' => 10.0, 'C3' => 15.0, 'C4' => 35.0, 'C5' => 15.0, 'C6' => 5.0, 'C7' => 5.0],
            // 10. IT Quality Assurance & Software Testing
            10 => ['C1' => 20.0, 'C2' => 10.0, 'C3' => 10.0, 'C4' => 10.0, 'C5' => 40.0, 'C6' => 5.0, 'C7' => 5.0],
            // 11. Tech Project Management Specialist
            11 => ['C1' => 15.0, 'C2' => 5.0,  'C3' => 10.0, 'C4' => 5.0,  'C5' => 40.0, 'C6' => 20.0, 'C7' => 5.0],
            // 12. IT Business Analyst
            12 => ['C1' => 15.0, 'C2' => 5.0,  'C3' => 20.0, 'C4' => 5.0,  'C5' => 35.0, 'C6' => 15.0, 'C7' => 5.0],
            // 13. Digital Marketing & Growth Strategy
            13 => ['C1' => 15.0, 'C2' => 5.0,  'C3' => 15.0, 'C4' => 5.0,  'C5' => 10.0, 'C6' => 45.0, 'C7' => 5.0],
            // 14. Junior Brand Designer & Creative Content
            14 => ['C1' => 35.0, 'C2' => 5.0,  'C3' => 5.0,  'C4' => 5.0,  'C5' => 10.0, 'C6' => 35.0, 'C7' => 5.0],
            // 15. Social Media Specialist & Micro Influencer
            15 => ['C1' => 15.0, 'C2' => 5.0,  'C3' => 10.0, 'C4' => 5.0,  'C5' => 10.0, 'C6' => 50.0, 'C7' => 5.0],
            // 16. Human Resources & Talent Acquisition
            16 => ['C1' => 5.0,  'C2' => 5.0,  'C3' => 10.0, 'C4' => 5.0,  'C5' => 20.0, 'C6' => 50.0, 'C7' => 5.0],
            // 17. Public Relations & International Partnership
            17 => ['C1' => 5.0,  'C2' => 5.0,  'C3' => 5.0,  'C4' => 5.0,  'C5' => 15.0, 'C6' => 55.0, 'C7' => 10.0],
            // 18. Asset & Liabilities Management (ALM) / Corporate Valuation
            18 => ['C1' => 5.0,  'C2' => 10.0, 'C3' => 20.0, 'C4' => 5.0,  'C5' => 10.0, 'C6' => 10.0, 'C7' => 40.0],
            // 19. Business Administration, Accounting & Tax
            19 => ['C1' => 5.0,  'C2' => 5.0,  'C3' => 20.0, 'C4' => 5.0,  'C5' => 10.0, 'C6' => 10.0, 'C7' => 45.0],
        ];

        foreach ($divisionWeights as $divisionId => $criteriaWeights) {
            foreach ($criteriaWeights as $code => $weight) {
                if (isset($criteriaMap[$code])) {
                    MatrixWeight::updateOrCreate(
                        [
                            'division_id' => $divisionId,
                            'criteria_id' => $criteriaMap[$code],
                        ],
                        [
                            'weight_percentage' => $weight,
                        ]
                    );
                }
            }
        }
    }
}
