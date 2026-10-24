<?php

namespace Database\Seeders;

use App\Models\Division;
use Illuminate\Database\Seeder;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $divisions = [
            [
                'id' => 1,
                'name' => 'Software Development (Web & Fullstack)',
                'description' => 'Fokus pada pengembangan aplikasi web skala enterprise, arsitektur backend API, dan integrasi frontend modern.',
            ],
            [
                'id' => 2,
                'name' => 'UI/UX Design & Product Research',
                'description' => 'Merancang pengalaman pengguna prima, arsitektur informasi, wireframing, dan visual prototype berbasis design system.',
            ],
            [
                'id' => 3,
                'name' => 'Mobile App Development',
                'description' => 'Membangun aplikasi mobile cross-platform (Flutter/React Native) dan native dengan performa tinggi.',
            ],
            [
                'id' => 4,
                'name' => 'Artificial Intelligence & Machine Learning',
                'description' => 'Mengembangkan model komputasi cerdas, NLP, computer vision, serta integrasi teknologi agen AI mutakhir.',
            ],
            [
                'id' => 5,
                'name' => 'Data Science & Big Data Analytics',
                'description' => 'Analisis data mendalam, pemodelan prediktif statistik, dan eksplorasi dataset skala masif untuk pengambilan keputusan.',
            ],
            [
                'id' => 6,
                'name' => 'Data Analyst & Business Intelligence',
                'description' => 'Merancang dashboard analitik interaktif, pelaporan metrik KPI bisnis, dan kueri data relasional strategis.',
            ],
            [
                'id' => 7,
                'name' => 'Cybersecurity & Penetration Testing',
                'description' => 'Mengamankan infrastruktur TI, melakukan uji penetrasi sistem, audit celah keamanan, dan mitigasi ancaman siber.',
            ],
            [
                'id' => 8,
                'name' => 'Digital Forensics & Incident Response',
                'description' => 'Investigasi insiden keamanan digital, pemulihan artefak data digital, dan analisis bukti forensik siber.',
            ],
            [
                'id' => 9,
                'name' => 'Cloud Infrastructure & DevOps',
                'description' => 'Otomasi CI/CD, pengelolaan server cloud, containerization (Docker/K8s), dan pemeliharaan uptime server produksi.',
            ],
            [
                'id' => 10,
                'name' => 'IT Quality Assurance & Software Testing',
                'description' => 'Memastikan kualitas rilis perangkat lunak melalui pengujian fungsional otomatis/manual dan validasi user requirements.',
            ],
            [
                'id' => 11,
                'name' => 'Tech Project Management Specialist',
                'description' => 'Memimpin tata kelola siklus proyek IT dengan kerangka kerja Agile/Scrum, manajemen timeline, dan koordinasi antar dev.',
            ],
            [
                'id' => 12,
                'name' => 'IT Business Analyst',
                'description' => 'Menerjemahkan kebutuhan bisnis klien menjadi spesifikasi teknis (BRD/SRS) yang siap diimplementasikan oleh tim developer.',
            ],
            [
                'id' => 13,
                'name' => 'Digital Marketing & Growth Strategy',
                'description' => 'Merancang kampanye pemasaran digital multi-channel, SEO/SEM, funnel conversion, dan pertumbuhan akuisisi user.',
            ],
            [
                'id' => 14,
                'name' => 'Junior Brand Designer & Creative Content',
                'description' => 'Menciptakan aset visual grafis, identitas visual brand, konten promosi kreatif, dan materi publikasi multimedia.',
            ],
            [
                'id' => 15,
                'name' => 'Social Media Specialist & Micro Influencer',
                'description' => 'Mengelola engagement komunitas daring, konten sosial media interaktif, dan kolaborasi aktivasi brand perusahaan.',
            ],
            [
                'id' => 16,
                'name' => 'Human Resources & Talent Acquisition',
                'description' => 'Mengelola proses rekrutmen talenta, talent mapping, onboarding magang, dan pengembangan budaya kerja organisasi.',
            ],
            [
                'id' => 17,
                'name' => 'Public Relations & International Partnership',
                'description' => 'Membangun komunikasi eksternal korporat, relasi media, kerja sama kemitraan institusi pendidikan dan stakeholder global.',
            ],
            [
                'id' => 18,
                'name' => 'Asset & Liabilities Management (ALM) / Corporate Valuation',
                'description' => 'Analisis struktur modal permodalan korporasi, mitigasi risiko likuiditas finansial, dan pemodelan valuasi bisnis.',
            ],
            [
                'id' => 19,
                'name' => 'Business Administration, Accounting & Tax',
                'description' => 'Pengelolaan pembukuan keuangan operasional, rekonsiliasi arus kas, administrasi transaksi, dan pelaporan pajak resmi.',
            ],
        ];

        foreach ($divisions as $d) {
            Division::updateOrCreate(
                ['id' => $d['id']],
                [
                    'name' => $d['name'],
                    'description' => $d['description'],
                ]
            );
        }
    }
}
