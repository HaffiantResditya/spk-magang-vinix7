# Product Requirements Document (PRD)
**Sistem Pendukung Keputusan (SPK) Rekomendasi Penempatan Divisi Magang**
**Studi Kasus:** PT Vinix Seven Aurum (VINIX7) - Batch 5

## 1. Pendahuluan
### 1.1 Latar Belakang
PT Vinix Seven Aurum menyediakan 14 pilihan divisi magang spesifik di bidang IT dan Bisnis pada Program Magang & Studi Independen Batch 5. Banyak pelamar (mahasiswa dan umum) yang kesulitan memilih divisi yang tepat sesuai dengan keahlian mereka. Untuk menyelesaikan masalah ini, dibangun sebuah SPK berbasis *web* yang berfungsi sebagai "Kompas Karir". Sistem ini ditujukan *secara eksklusif* bagi pelamar yang belum mengetahui arah kompetensinya, mewajibkan mereka melewati tes asesmen untuk mendapatkan rekomendasi berbasis data sebelum mengirimkan lamaran final.

### 1.2 Tujuan
Membangun SPK menggunakan algoritma *Simple Additive Weighting* (SAW) yang mengotomatisasi pemetaan kompetensi pelamar ke dalam 14 divisi, mempermudah HRD dalam mengambil keputusan seleksi, dan memberikan kepastian status pelamar melalui portal mandiri.

---

## 2. Pedoman UI/UX (Integrasi Tema vinix7.id)
Desain antarmuka akan mengadaptasi identitas visual dari situs resmi perusahaan (vinix7.id) untuk menjaga konsistensi *branding* *enterprise*:
*   **Warna Utama (Primary - Brand):** **Deep Navy / Royal Blue** (Kode Tailwind: `blue-900` / `blue-800`). Digunakan untuk *header*, *sidebar*, tombol utama, dan elemen yang membutuhkan *trust* (kepercayaan) dan profesionalisme teknologi.
*   **Warna Aksen (Secondary - Aurum):** **Gold / Kuning Emas** (Kode Tailwind: `yellow-500` / `amber-500`). Merujuk pada nama "Aurum" dan visi "Indonesia Emas". Digunakan untuk *highlight* Top 3 Rekomendasi SAW, *badge* status, dan elemen *Call to Action* (CTA).
*   **Warna Latar (Background):** **Off-White / Slate 50** (Kode Tailwind: `slate-50`). Memberikan kesan *clean*, luas, dan fokus pada pembacaan kuesioner.
*   **Tipografi:** Menggunakan *font* Sans-Serif modern dan *clean* seperti **Inter** atau **Poppins** (merepresentasikan inovasi dan edukasi).
*   **Komponen UI:** Menggunakan *card-based layout* dengan *shadow* yang lembut (Tailwind `shadow-md`), ujung elemen sedikit membulat (`rounded-lg`), dan animasi *smooth* saat berpindah soal kuesioner (menggunakan Livewire).

---

## 3. Alur Pengguna (User Journey)
### 3.1 Aktor: Pelamar (Mahasiswa / Umum)
1.  **Registrasi & Login (Wajib):** Pelamar membuat akun (Nama, Email, Password). Ini diperlukan agar pelamar bisa kembali masuk untuk mengecek status lamaran.
2.  **Isi Biodata:** Melengkapi profil (Status: Mahasiswa/Umum, Asal Instansi/Universitas, No. WhatsApp).
3.  **Self-Assessment (Kuesioner):** Menjawab 18 pertanyaan (mewakili kriteria C1-C7) menggunakan skala nilai (20 - 100). Didesain dengan *Multi-step form*.
4.  **Hasil Analisis SAW:** Sistem menampilkan **Top 3 Divisi** dengan persentase kecocokan tertinggi. Dihiasi dengan warna *Gold/Aurum* untuk menonjolkan rekomendasi.
5.  **Finalisasi:** Pelamar memilih salah satu dari Top 3 tersebut, mengunggah *file* CV (PDF), lalu menekan tombol *Submit*.
6.  **Cek Status:** Pelamar dapat login kapan saja untuk melihat *badge* status lamarannya (Pending, Diterima, atau Ditolak).

### 3.2 Aktor: Admin HRD
1.  **Dashboard Utama:** Melihat statistik analitik (Total pelamar SPK, divisi paling sering direkomendasikan, grafik pelamar Mahasiswa vs Umum).
2.  **Review Pelamar:** Melihat tabel daftar pelamar. Membuka detail pelamar untuk melihat skor mentah 18 kuesioner dan persentase hasil SAW.
3.  **Eksekusi (Approval System):** Menentukan nasib pelamar:
    *   *Approve:* Diterima di divisi pilihan pelamar.
    *   *Reassign:* Diterima, tapi dipindah ke rekomendasi SAW urutan ke-2 atau ke-3 (atas pertimbangan kuota/wawancara HRD).
    *   *Reject:* Ditolak.

### 3.3 Aktor: Super Admin
1.  **Manajemen Master Data:** Mengelola 14 Data Divisi, 7 Kriteria Inti (C1-C7), dan 18 Pertanyaan Kuesioner.
2.  **Manajemen Bobot (W):** Mengatur *Weighting Matrix* algoritma SAW (14 x 7 = 98 bobot).

---

## 4. Logika Sistem Algoritma SAW
1.  **Alternatif (A):** 14 Divisi Magang (Open Roles Batch 5):
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
2.  **Kriteria (C):** C1(Web/UIUX), C2(AI/Python), C3(Data/SQL), C4(Cyber), C5(Manajemen IT), C6(Komunikasi/SDM), C7(Keuangan).
3.  **Sifat Kriteria:** Seluruh kriteria bernilai **Benefit** (Semakin tinggi nilai jawaban pelamar, semakin baik).
4.  **Tahapan Komputasi *Backend*:**
    *   Menarik nilai input kuesioner pelamar (Matriks Keputusan *X*).
    *   Melakukan Normalisasi (Matriks *R*). Karena semua kriteria *Benefit*, rumusnya adalah *Nilai Input / Nilai Maksimal*.
    *   Melakukan perkalian Matriks *R* dengan Bobot *W* milik masing-masing divisi.
    *   Menjumlahkan hasil kali untuk mendapatkan Nilai Preferensi (*V*).
    *   Mengurutkan Nilai *V* secara *Descending* dan mengambil 3 teratas (Top 3).

---

## 5. Struktur Database (Skema Tabel)
Sistem menggunakan MySQL dengan struktur tabel inti sebagai berikut:
1.  `users`: id, name, email, password, role (applicant, hrd, superadmin).
2.  `applicant_profiles`: id, user_id, type (mahasiswa/umum), institution, phone, cv_path.
3.  `divisions`: id, name, description. *(Berisi 14 row data).*
4.  `criteria`: id, code (C1-C7), name, type (benefit).
5.  `questions`: id, criteria_id, question_text. *(Berisi 18 row data).*
6.  `matrix_weights`: id, division_id, criteria_id, weight_percentage. *(Berisi 14 x 7 = 98 row data bobot).*
7.  `applicant_answers`: id, user_id, question_id, score_value.
8.  `saw_results`: id, user_id, division_id, final_score, rank.
9.  `applications`: id, user_id, selected_division_id, approved_division_id, status (pending, approved, rejected, reassigned), hrd_notes.

---

## 6. Arsitektur Folder (Laravel 12 & Livewire)
```text
spk-vinix-magang/
├── app/
│   ├── Http/Controllers/
│   │   ├── AuthController.php          # Logika Login/Registrasi
│   │   ├── HrdController.php           # Logika Dashboard HRD
│   │   └── SuperAdminController.php    # Logika Kelola Master Data & Bobot
│   ├── Livewire/
│   │   └── Applicant/
│   │       ├── QuestionnaireForm.php   # Logika Form Kuesioner Multi-step
│   │       └── SawResultBoard.php      # Logika Tampilan & Pilih Top 3
│   ├── Services/
│   │   └── SawCalculationService.php   # "Otak" perhitungan Matematika SAW
├── database/
│   ├── migrations/                     # File skema database (poin 5)
│   └── seeders/                        # File Seeder (Role, 14 Divisi, 7 Kriteria, Bobot)
├── resources/
│   ├── css/app.css                     # Konfigurasi Tailwind (Warna Vinix)
│   ├── views/
│   │   ├── layouts/
│   │   │   ├── app.blade.php           # Base Layout (Warna latar slate-50)
│   │   │   └── navigation.blade.php    # Navbar & Sidebar (Warna Navy Blue)
│   │   ├── livewire/applicant/         # View untuk Multi-step form
│   │   ├── dashboard/                  # View Dashboard HRD & Super Admin
```