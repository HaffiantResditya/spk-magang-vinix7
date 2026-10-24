<?php

namespace Database\Seeders;

use App\Models\Criterion;
use Illuminate\Database\Seeder;

class CriterionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $criteria = [
            [
                'code' => 'C1',
                'name' => 'Web & UI/UX Design',
                'type' => 'benefit',
            ],
            [
                'code' => 'C2',
                'name' => 'Artificial Intelligence & Python',
                'type' => 'benefit',
            ],
            [
                'code' => 'C3',
                'name' => 'Database & Data Analytics',
                'type' => 'benefit',
            ],
            [
                'code' => 'C4',
                'name' => 'Cybersecurity & Infrastructure',
                'type' => 'benefit',
            ],
            [
                'code' => 'C5',
                'name' => 'IT Management & Quality Assurance',
                'type' => 'benefit',
            ],
            [
                'code' => 'C6',
                'name' => 'Communication, HR & Marketing',
                'type' => 'benefit',
            ],
            [
                'code' => 'C7',
                'name' => 'Financial Analysis & Accounting',
                'type' => 'benefit',
            ],
        ];

        foreach ($criteria as $item) {
            Criterion::updateOrCreate(
                ['code' => $item['code']],
                ['name' => $item['name'], 'type' => $item['type']]
            );
        }
    }
}
