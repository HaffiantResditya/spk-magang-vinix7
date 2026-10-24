<?php

namespace Database\Seeders;

use App\Models\Criterion;
use App\Models\Question;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $c1 = Criterion::where('code', 'C1')->first();
        $c2 = Criterion::where('code', 'C2')->first();
        $c3 = Criterion::where('code', 'C3')->first();
        $c4 = Criterion::where('code', 'C4')->first();
        $c5 = Criterion::where('code', 'C5')->first();
        $c6 = Criterion::where('code', 'C6')->first();
        $c7 = Criterion::where('code', 'C7')->first();

        $questions = [
            // C1: Web & UI/UX Design (3 questions)
            [
                'criteria_id' => $c1->id,
                'order_num' => 1,
                'question_text' => 'Sejauh mana penguasaan Anda dalam teknologi web front-end/fullstack (HTML5, modern CSS, JavaScript/TypeScript, dan framework web)?',
            ],
            [
                'criteria_id' => $c1->id,
                'order_num' => 2,
                'question_text' => 'Kemampuan Anda dalam riset pengguna, wireframing, dan perancangan antarmuka pengguna interaktif (UI/UX) menggunakan tools seperti Figma?',
            ],
            [
                'criteria_id' => $c1->id,
                'order_num' => 3,
                'question_text' => 'Pemahaman Anda mengenai prinsip Responsive Web Design, aksesibilitas, animasi mikro, dan optimasi performa tampilan web?',
            ],

            // C2: AI & Python (3 questions)
            [
                'criteria_id' => $c2->id,
                'order_num' => 4,
                'question_text' => 'Kemahiran Anda dalam pemrograman Python untuk pengolahan logika data, scripting otomatisasi, atau backend development?',
            ],
            [
                'criteria_id' => $c2->id,
                'order_num' => 5,
                'question_text' => 'Tingkat pemahaman Anda terkait konsep Machine Learning, Deep Learning, atau pemanfaatan Large Language Model (LLM) & AI APIs?',
            ],
            [
                'criteria_id' => $c2->id,
                'order_num' => 6,
                'question_text' => 'Pengalaman Anda menggunakan ekosistem library AI/Data Science (Scikit-learn, PyTorch, TensorFlow, HuggingFace, atau OpenCV)?',
            ],

            // C3: Database & Data Analytics (3 questions)
            [
                'criteria_id' => $c3->id,
                'order_num' => 7,
                'question_text' => 'Kemampuan Anda menulis query SQL tingkat menengah hingga lanjut (JOIN, indexing, subquery, CTE, dan agregasi data)?',
            ],
            [
                'criteria_id' => $c3->id,
                'order_num' => 8,
                'question_text' => 'Keahlian Anda dalam visualisasi data dan penyusunan dashboard analitik bisnis (Power BI, Tableau, Looker Studio, atau Metabase)?',
            ],
            [
                'criteria_id' => $c3->id,
                'order_num' => 9,
                'question_text' => 'Pemahaman mengenai pipeline data, proses ETL (Extract-Transform-Load), data cleaning, dan pemodelan database relasional?',
            ],

            // C4: Cybersecurity & Infrastructure (2 questions)
            [
                'criteria_id' => $c4->id,
                'order_num' => 10,
                'question_text' => 'Pemahaman Anda terkait konsep keamanan jaringan, enkripsi, autentikasi aman, proteksi server, dan mitigasi serangan cyber?',
            ],
            [
                'criteria_id' => $c4->id,
                'order_num' => 11,
                'question_text' => 'Pengetahuan Anda dalam pengujian kerentanan (Penetration Testing), audit keamanan sistem, forensik digital, atau deployment Cloud/DevOps?',
            ],

            // C5: IT Management & QA (3 questions)
            [
                'criteria_id' => $c5->id,
                'order_num' => 12,
                'question_text' => 'Pengalaman Anda mengimplementasikan metodologi manajemen proyek perangkat lunak (Agile, Scrum, sprint planning, Jira/Trello)?',
            ],
            [
                'criteria_id' => $c5->id,
                'order_num' => 13,
                'question_text' => 'Kemampuan Anda menyusun dokumentasi teknis sistem, Business Requirement Document (BRD), user stories, dan flowchart proses bisnis?',
            ],
            [
                'criteria_id' => $c5->id,
                'order_num' => 14,
                'question_text' => 'Pemahaman Anda tentang Quality Assurance (QA), pengujian software (unit test, manual testing, test case scenario, bug tracking)?',
            ],

            // C6: Communication, HR & Marketing (2 questions)
            [
                'criteria_id' => $c6->id,
                'order_num' => 15,
                'question_text' => 'Keterampilan komunikasi verbal/tulisan, negosiasi, presentasi di depan audiens, serta pengelolaan hubungan antartim atau rekrutmen SDM?',
            ],
            [
                'criteria_id' => $c6->id,
                'order_num' => 16,
                'question_text' => 'Pengalaman Anda dalam strategi pemasaran digital, pembuatan konten kreatif, pengelolaan media sosial, atau kampanye branding publik?',
            ],

            // C7: Financial Analysis & Accounting (2 questions)
            [
                'criteria_id' => $c7->id,
                'order_num' => 17,
                'question_text' => 'Tingkat pemahaman Anda terkait pencatatan akuntansi, jurnal umum, rekonsiliasi kas, dan kepatuhan perpajakan perusahaan?',
            ],
            [
                'criteria_id' => $c7->id,
                'order_num' => 18,
                'question_text' => 'Keahlian dalam analisis laporan keuangan, perancangan model anggaran (financial modeling), valuasi aset atau manajemen risiko permodalan?',
            ],
        ];

        foreach ($questions as $q) {
            Question::updateOrCreate(
                ['order_num' => $q['order_num']],
                [
                    'criteria_id' => $q['criteria_id'],
                    'question_text' => $q['question_text'],
                ]
            );
        }
    }
}
