# SPK Penempatan Divisi Magang - PT Vinix Seven Aurum

Sistem Pendukung Keputusan (SPK) berbasis *web* yang berfungsi sebagai "Kompas Karir" bagi pelamar magang di PT Vinix Seven Aurum. Sistem ini memetakan kompetensi pelamar ke dalam 14 divisi spesifik menggunakan algoritma **Simple Additive Weighting (SAW)**.

Antarmuka aplikasi ini didesain secara khusus mengikuti identitas visual (UI/UX) *enterprise* dari website resmi [vinix7.id](https://vinix7.id/), mengusung perpaduan warna *Navy Blue* (Profesionalisme IT) dan *Aurum Gold* (Inovasi & Indonesia Emas).

## 🚀 Fitur Utama
*   **Mandatory Authentication:** Sistem portal mandiri dengan registrasi dan login wajib bagi pelamar untuk melacak status lamaran (Diterima/Ditolak).
*   **Interactive Multi-step Form (Livewire):** 18 instrumen pertanyaan *self-assessment* dengan UI/UX transisi yang halus tanpa memuat ulang halaman (*no-reload*).
*   **Real-time SAW Engine:** Perhitungan matriks algoritma SAW yang memproses input pelamar melawan bobot dari 14 divisi secara instan, menghasilkan Top 3 Rekomendasi.
*   **HRD Analytical Dashboard:** Panel manajemen komprehensif bagi HRD untuk meninjau skor mentah pelamar, persentase algoritma, dan melakukan eksekusi final keputusan rekrutmen.
*   **Dynamic Matrix Weights:** Kemampuan eksklusif Super Admin untuk menambah, mengubah, atau menghapus persentase matriks bobot divisi tanpa perlu mengubah kode sumber aplikasi (*hardcode*).

## 👥 14 Pilihan Divisi (Open Roles Batch 5)
1. Human Resource (SDM) Analyst
2. Python Data Science Engineer
3. Data Analyst
4. Python Machine Learning & AI Engineer
5. Web & UIUX Developer
6. Social Media & Digital Marketing Strategist
7. Tech Project Management Specialist
8. Digital Public Relations & Communication Specialist
9. Ethical Hacker
10. Bisnis Digital Analyst
11. Cybersecurity Engineer
12. Investment & Financial Market Analyst
13. Business Administration Intelligence Analyst (Power BI & Excel)
14. Cybercrime & Forensic Investigator

## 🛠️ Tech Stack
*   **Backend Framework:** Laravel 12 (PHP 8.2+)
*   **Dynamic Component:** Livewire 3
*   **Frontend Framework:** Tailwind CSS 3 (Kustomisasi Tema Vinix7)
*   **Database:** MySQL
*   **Authentication:** Laravel Breeze

## 🎨 Panduan Tema (Tailwind Config)
Sistem ini menggunakan palet warna khusus:
```javascript
theme: {
    extend: {
        colors: {
            'vinix-navy': '#1e3a8a', // blue-900
            'vinix-aurum': '#eab308', // yellow-500
            'vinix-bg': '#f8fafc',    // slate-50
        },
        fontFamily: {
            sans: ['Inter', 'sans-serif'],
        }
    }
}
```

## ⚙️ Panduan Instalasi (Development)

1. Clone repositori aplikasi: 
   `git clone https://github.com/HaffiantResditya/spk-magang-vinix7.git`
2. Masuk ke direktori root: 
   `cd spk-magang-vinix7`
3. Install dependensi *backend*: 
   `composer install`
4. Install dependensi *frontend*: 
   `npm install && npm run build`
5. Salin dan sesuaikan konfigurasi *environment*: 
   `cp .env.example .env`
6. Generate App Key Laravel: 
   `php artisan key:generate`
7. Buat database baru di MySQL dan sesuaikan kredensial di file `.env`.
8. **PENTING:** Jalankan migrasi dan seeder untuk menyuntikkan data 14 Divisi, 7 Kriteria, dan Matrix Bobot.
   `php artisan migrate --seed`
9. Jalankan server lokal: 
   `php artisan serve`

## 👥 Hak Akses (Role Seeder Default)
Setelah menjalankan langkah instalasi nomor 8, Anda dapat login menggunakan kredensial bawaan (Gmail):
*   **Super Admin:** `superadmin.vinix7@gmail.com` | Password: `password`
*   **Admin HRD:** `hrd.vinix7@gmail.com` | Password: `password`
*   **Pelamar Test:** `pelamar.vinix7@gmail.com` | Password: `password`
*(Atau gunakan fitur Registrasi pada halaman depan aplikasi).*