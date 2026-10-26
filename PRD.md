# Product Requirements Document (PRD)
**Sistem Pendukung Keputusan (SPK) Rekomendasi Penempatan Divisi Magang**  
**Studi Kasus:** PT Vinix Seven Aurum (VINIX7)

---

## 1. Pendahuluan

### 1.1 Latar Belakang
PT Vinix Seven Aurum menyediakan 14 pilihan divisi magang spesifik di bidang Teknologi Informasi dan Bisnis pada Program Magang & Studi Independen. Banyak pelamar (baik mahasiswa maupun umum) menghadapi dilema dan ketidakpastian dalam menentukan divisi yang paling relevan dengan minat dan kemampuan teknis mereka. 

Untuk mengatasi kendala ini, dibangun Sistem Pendukung Keputusan (SPK) berbasis *web* yang berfungsi sebagai **"Kompas Karir"**. Sistem ini memandu pelamar melewati serangkaian asesmen kompetensi terukur untuk menghasilkan rekomendasi divisi berbasis data sebelum mengirimkan berkas lamaran resmi kepada HRD.

### 1.2 Tujuan
1. Mengotomatisasi pemetaan kompetensi pelamar ke dalam 14 divisi menggunakan algoritma **Simple Additive Weighting (SAW)**.
2. Memfasilitasi HRD dalam meninjau data analitik pelamar dan mengeksekusi keputusan rekrutmen secara transparan.
3. Memberikan pengalaman portal mandiri bagi pelamar untuk memantau status lamaran secara *real-time*.
4. Mengimplementasikan infrastruktur cloud modern (*Serverless Database*, *Cloud Document Storage*, dan *Serverless Deployment*) yang skalabel dan efisien.

---

## 2. Pedoman Desain & UI/UX (Identitas vinix7.id)

Antarmuka aplikasi mengadopsi standar identitas visual *enterprise* dari situs resmi perusahaan [vinix7.id](https://vinix7.id/):
*   **Warna Utama (*Primary - Navy*):** **`#1e3a8a`** (`blue-900` / `blue-800`). Mewakili kepercayaan (*trust*), kestabilan, dan profesionalisme teknologi informasi. Digunakan pada navbar, sidebar, header, dan tombol utama.
*   **Warna Aksen (*Secondary - Aurum*):** **`#eab308`** (`yellow-500` / `amber-500`). Merujuk pada nama "Aurum" dan visi "Indonesia Emas". Digunakan khusus untuk menonjolkan Top 3 Rekomendasi SAW, badge status, dan elemen *Call to Action* (CTA).
*   **Warna Latar (*Background*):** **`#f8fafc`** (`slate-50`). Memberikan kesan bersih, luas, dan nyaman di mata saat membaca instrumen kuesioner.
*   **Tipografi:** Font Sans-Serif modern (**Inter**).
*   **Mikro-Interaksi & Feedback:**
    *   *Password Visibility Toggle:* Ikon mata interaktif untuk melihat/menyembunyikan kata sandi pada halaman login dan registrasi.
    *   *SweetAlert2:* Modal dialog profesional untuk konfirmasi pengiriman lamaran, penghapusan data master, eksekusi keputusan HRD, konfirmasi logout, dan notifikasi kegagalan autentikasi (*Autentikasi Gagal*).

---

## 3. Alur Pengguna (User Journey)

### 3.1 Aktor: Pelamar (Mahasiswa / Umum)
1.  **Registrasi & Login (Wajib):** Mendaftarkan akun dengan nama, email, dan kata sandi yang aman.
2.  **Lengkapi Biodata:** Mengisi profil dengan kategori pelamar (Mahasiswa atau Umum), nama perguruan tinggi/instansi asal, dan nomor WhatsApp aktif. Formulir menyediakan petunjuk dinamis sesuai kategori yang dipilih.
3.  **Self-Assessment (Kuesioner Livewire):** Menjawab 18 pertanyaan kompetensi (mencakup kriteria C1–C7) dengan skala nilai bertingkat (20–100) melalui formulir multi-langkah (*multi-step*) tanpa *reload* halaman.
4.  **Hasil Analisis SAW:** Sistem menampilkan **Top 3 Divisi Rekomendasi** dengan persentase kecocokan tertinggi berbalut aksen emas (*Aurum*).
5.  **Finalisasi Lamaran & Unggah CV:** Pelamar memilih salah satu dari divisi yang direkomendasikan, mengunggah dokumen CV dalam format PDF (otomatis disimpan ke **Cloudinary**), lalu mengirimkan lamaran.
6.  **Pemantauan Status:** Pelamar dapat login kembali sewaktu-waktu untuk melihat status berkas (Pending, Diterima, Ditolak, atau Dialihkan).

### 3.2 Aktor: Admin HRD
1.  **Dashboard Analitik:** Memantau rekapitulasi data pelamar, distribusi divisi yang diminati, serta rasio pelamar Mahasiswa vs Umum.
2.  **Review Detail Pelamar:** Meninjau lembar jawaban mentah 18 kuesioner, hasil komputasi SAW, serta mengakses berkas CV pelamar langsung melalui tautan Cloudinary HTTPS.
3.  **Approval System (Eksekusi Keputusan):**
    *   *Approve:* Menerima pelamar pada divisi pilihannya.
    *   *Reassign:* Mengalihkan penerimaan pelamar ke rekomendasi peringkat ke-2 atau ke-3 berdasarkan evaluasi HRD atau kuota divisi.
    *   *Reject:* Menolak lamaran.

### 3.3 Aktor: Super Admin
1.  **Manajemen Master Data:** Mengelola 14 Data Divisi, 7 Kriteria Inti, dan 18 Pertanyaan Kuesioner.
2.  **Manajemen Bobot (W):** Mengatur persentase matriks pembobotan algoritma SAW (14 divisi x 7 kriteria = 98 relasi bobot) secara dinamis tanpa perlu mengubah kode sumber aplikasi.

---

## 4. Logika Sistem Algoritma SAW

1.  **Alternatif ($A_i$):** 14 Divisi Magang:
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

2.  **Kriteria ($C_j$):**
    *   $C_1$: Web, Frontend & UI/UX Design
    *   $C_2$: Artificial Intelligence, Machine Learning & Python Programming
    *   $C_3$: Data Analytics, Business Intelligence & SQL
    *   $C_4$: Cyber Security, Ethical Hacking & Digital Forensics
    *   $C_5$: IT Project Management & Software Architecture
    *   $C_6$: Digital Marketing, Public Relations & Human Resources
    *   $C_7$: Financial Modeling & Market Investment Analysis

3.  **Sifat Kriteria:** Seluruh kriteria bertipe **Benefit** (semakin tinggi skor asesmen pelamar, semakin tinggi kesesuaian nilai).

4.  **Tahapan Komputasi:**
    *   Membentuk Matriks Keputusan $X$ dari akumulasi jawaban pelamar per kriteria.
    *   Normalisasi Matriks $R$:
        $$r_{ij} = \frac{x_{ij}}{\max_i(x_{ij})}$$
    *   Perkalian Matriks Terbobot:
        $$V_i = \sum_{j=1}^{n} w_j \cdot r_{ij}$$
    *   Perangkingan nilai preferensi $V_i$ secara *descending* untuk menentukan 3 divisi peringkat teratas (*Top 3*).

---

## 5. Struktur Database & Model Data

Aplikasi menggunakan database **TiDB Cloud (Serverless MySQL)** dengan koneksi TLS/SSL:
1.  `users`: id, name, email, password, role (`applicant`, `hrd`, `superadmin`), remember_token, timestamps.
2.  `applicant_profiles`: id, user_id, type (`mahasiswa`, `umum`), institution, phone, cv_path, timestamps. Dilengkapi accessor `cv_url` untuk tautan HTTPS Cloudinary.
3.  `divisions`: id, name, description, timestamps. *(14 baris data)*
4.  `criteria`: id, code ($C_1 - C_7$), name, type (`benefit`), timestamps.
5.  `questions`: id, criteria_id, question_text, timestamps. *(18 baris data instrumen)*
6.  `matrix_weights`: id, division_id, criteria_id, weight_percentage, timestamps. *(98 baris data bobot)*
7.  `applicant_answers`: id, user_id, question_id, score_value, timestamps.
8.  `saw_results`: id, user_id, division_id, final_score, rank, timestamps.
9.  `applications`: id, user_id, selected_division_id, approved_division_id, status (`pending`, `approved`, `rejected`, `reassigned`), hrd_notes, timestamps.

---

## 6. Infrastruktur & Cloud Architecture

```
                  ┌───────────────────────────────┐
                  │        Pengguna / Web         │
                  └───────────────┬───────────────┘
                                  │ HTTPS
                                  ▼
      ┌────────────────────────────────────────────────────────┐
      │                   Aplikasi Laravel 12                  │
      │        (Vercel Serverless / Docker Container)          │
      └──────────────┬─────────────────────────┬───────────────┘
                     │ TLS/SSL (Port 4000)     │ HTTPS REST API
                     ▼                         ▼
         ┌───────────────────────┐ ┌───────────────────────┐
         │      TiDB Cloud       │ │       Cloudinary      │
         │  (Serverless MySQL)   │ │ (Media & Document CV) │
         └───────────────────────┘ └───────────────────────┘
```

1.  **Database Layer:** **TiDB Cloud (Serverless MySQL)** pada AWS Region `ap-southeast-1` (Singapore) dengan verifikasi sertifikat SSL CA (`storage/tidb-ca.pem`).
2.  **Storage Layer:** **Cloudinary Cloud Storage** dengan penataan folder terisolasi (`spk-magang-vinix7/cvs`) untuk menjaga pemisahan berkas antar proyek.
3.  **Deployment Layer:**
    *   **Vercel:** Menggunakan serverless PHP runtime (`vercel-php`) dengan konfigurasi `vercel.json` dan routing `/tmp`.
    *   **Docker:** Menggunakan `Dockerfile` multi-stage berbasis Nginx + PHP-FPM untuk platform container (Render / Railway / VPS).

---

## 7. Penjaminan Kualitas (Quality Assurance)

Sistem telah diuji secara otomatis melalui **PHPUnit Test Suite**:
*   **Total Pengujian:** 35 Tests
*   **Total Assertions:** 95 Assertions
*   **Status:** **100% Passed**
*   **Cakupan Uji:** Autentikasi, otorisasi peran (RBAC), integritas kalkulasi algoritma SAW, penanganan berkas Cloudinary, dan stabilitas seeding master data.