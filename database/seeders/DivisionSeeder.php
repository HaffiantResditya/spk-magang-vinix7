<?php

namespace Database\Seeders;

use App\Models\Division;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

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
                'name' => 'Human Resource (SDM) Analyst',
                'description' => 'Mengelola analitik rekrutmen talenta, talent mapping, evaluasi performa kerja, dan pengembangan budaya organisasi.',
            ],
            [
                'id' => 2,
                'name' => 'Python Data Science Engineer',
                'description' => 'Eksplorasi dataset besar, rekayasa fitur data, pemodelan statistik, dan implementasi algoritma prediktif berbasis Python.',
            ],
            [
                'id' => 3,
                'name' => 'Data Analyst',
                'description' => 'Menganalisis tren data operasional bisnis, menyusun visualisasi dashboard interaktif, dan kueri data SQL strategis.',
            ],
            [
                'id' => 4,
                'name' => 'Python Machine Learning & AI Engineer',
                'description' => 'Membangun arsitektur model komputasi cerdas, deep learning, NLP, computer vision, serta integrasi API AI modern.',
            ],
            [
                'id' => 5,
                'name' => 'Web & UIUX Developer',
                'description' => 'Merancang antarmuka pengguna interaktif (UI/UX di Figma) dan mengembangkan aplikasi web front-end/fullstack modern responsif.',
            ],
            [
                'id' => 6,
                'name' => 'Social Media & Digital Marketing Strategist',
                'description' => 'Merancang strategi funnel pemasaran digital, viral content, manajemen media sosial interaktif, dan engagement komunitas.',
            ],
            [
                'id' => 7,
                'name' => 'Tech Project Management Specialist',
                'description' => 'Memimpin tata kelola siklus proyek TI dengan metodologi Agile/Scrum, pengelolaan timeline, sprint backlog, dan koordinasi tim teknis.',
            ],
            [
                'id' => 8,
                'name' => 'Digital Public Relations & Communication Specialist',
                'description' => 'Membangun komunikasi eksternal korporat, press release, relasi media, kerja sama kemitraan strategis, dan reputasi brand.',
            ],
            [
                'id' => 9,
                'name' => 'Ethical Hacker',
                'description' => 'Melakukan uji penetrasi (penetration testing), simulasi serangan keamanan siber, dan pengujian celah kerentanan aplikasi/jaringan.',
            ],
            [
                'id' => 10,
                'name' => 'Bisnis Digital Analyst',
                'description' => 'Menerjemahkan kebutuhan bisnis menjadi spesifikasi sistem digital (BRD/SRS), analisis proses bisnis, dan strategi produk digital.',
            ],
            [
                'id' => 11,
                'name' => 'Cybersecurity Engineer',
                'description' => 'Mengamankan infrastruktur server, arsitektur proteksi firewall, konfigurasi enkripsi data, dan pemantauan ancaman keamanan.',
            ],
            [
                'id' => 12,
                'name' => 'Investment & Financial Market Analyst',
                'description' => 'Menganalisis instrumen pasar keuangan, valuasi bisnis korporat, pemodelan finansial (financial modeling), dan manajemen risiko investasi.',
            ],
            [
                'id' => 13,
                'name' => 'Business Administration Intelligence Analyst (Power BI & Excel)',
                'description' => 'Pengolahan data administrasi bisnis, pemodelan spreadsheet Excel tingkat lanjut, dan perancangan laporan visual Power BI korporat.',
            ],
            [
                'id' => 14,
                'name' => 'Cybercrime & Forensic Investigator',
                'description' => 'Investigasi kejahatan siber, analisis bukti forensik digital, incident response, dan pemulihan artefak data digital.',
            ],
        ];

        // Ensure clean state for 14 divisions without foreign key error
        Schema::disableForeignKeyConstraints();
        Division::truncate();
        Schema::enableForeignKeyConstraints();

        foreach ($divisions as $d) {
            Division::create([
                'id' => $d['id'],
                'name' => $d['name'],
                'description' => $d['description'],
            ]);
        }
    }
}
