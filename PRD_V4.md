# MBGBrain — Product Requirements Document (PRD) v4.0

**Platform Pemadanan Supplier UMKM dan SPPG untuk Program Makan Bergizi Gratis (MBG)**

---

## Daftar Isi

1. [Product Overview](#1-product-overview)
2. [Problem Statement](#2-problem-statement)
3. [Goals & Success Metrics](#3-goals--success-metrics)
4. [Stakeholder & User Roles](#4-stakeholder--user-roles)
5. [Business Rules](#5-business-rules)
6. [User Journey & Alur Sistem](#6-user-journey--alur-sistem)
7. [Functional Requirements](#7-functional-requirements)
8. [Non-Functional Requirements](#8-non-functional-requirements)
9. [Matching Algorithm](#9-matching-algorithm)
10. [Maps Integration](#10-maps-integration)
11. [Database Design (ERD & Schema)](#11-database-design-erd--schema)
12. [API Design](#12-api-design)
13. [Technology Stack](#13-technology-stack)
14. [Security Requirements](#14-security-requirements)
15. [Struktur Proyek](#15-struktur-proyek)
16. [Error Handling & Validasi](#16-error-handling--validasi)
17. [Future Enhancements](#17-future-enhancements)

---

## 1. Product Overview

| Atribut | Detail |
|---|---|
| **Nama Produk** | MBGBrain |
| **Versi PRD** | 4.0 |
| **Tipe Produk** | Web-Based Information System |
| **Kategori** | Supplier Matching Platform |
| **Target Pengguna** | Supplier UMKM, SPPG, Administrator, Public/Guest |
| **Platform** | Web (Responsive) |
| **Bahasa** | Indonesia |

### 1.1 Deskripsi Produk

MBGBrain adalah platform digital berbasis web yang menghubungkan **Supplier UMKM** dengan **Satuan Pelayanan Pemenuhan Gizi (SPPG)** dalam ekosistem **Program Makan Bergizi Gratis (MBG)**. Platform ini menyediakan proses registrasi terstruktur, verifikasi dokumen legalitas, pencarian dan pemeringkatan supplier berbasis algoritma SAW (Simple Additive Weighting), serta pengelolaan alur kerja sama antara kedua pihak secara digital dan terdokumentasi.

### 1.2 Konteks Program MBG

Program Makan Bergizi Gratis adalah program pemerintah yang menyediakan makanan bergizi untuk segmen masyarakat tertentu. SPPG adalah unit pelaksana yang membutuhkan pasokan bahan makanan atau produk jadi dari supplier lokal. MBGBrain hadir sebagai jembatan digital antara SPPG yang membutuhkan supplier dan UMKM yang ingin berkontribusi dalam program tersebut.

---

## 2. Problem Statement

### 2.1 Pain Points Saat Ini

**Dari sisi SPPG:**
- Proses pencarian supplier dilakukan secara manual (telepon, kunjungan langsung, rekomendasi mulut ke mulut)
- Tidak ada mekanisme untuk memverifikasi legalitas supplier secara sistematis
- Sulit menemukan supplier terdekat yang memiliki kapasitas produksi sesuai kebutuhan
- Tidak ada sistem rekomendasi berbasis data historis kerja sama
- Proses negosiasi dan persetujuan kerja sama tidak terdokumentasi

**Dari sisi Supplier UMKM:**
- Tidak ada platform resmi untuk mendaftarkan diri sebagai supplier MBG
- Informasi syarat dan proses menjadi supplier tidak mudah diakses
- Tidak ada visibilitas terhadap SPPG yang membutuhkan produk mereka
- Tidak ada riwayat kerja sama yang dapat menjadi portofolio digital

**Dari sisi Administrator:**
- Tidak ada basis data supplier terpusat yang terverifikasi
- Proses verifikasi dokumen dilakukan secara manual dan tidak efisien
- Tidak ada monitoring ekosistem supplier-SPPG secara real-time

### 2.2 Dampak Permasalahan

- Waktu pengadaan bahan makanan menjadi lama
- Risiko penggunaan supplier tidak terlegitimasi
- UMKM potensial tidak mendapat akses ke program MBG
- Transparansi proses pengadaan rendah

---

## 3. Goals & Success Metrics

### 3.1 Business Goals

| Kode | Goal | Deskripsi |
|---|---|---|
| BG-01 | Percepatan Pengadaan | Mempersingkat waktu pencarian supplier dari rata-rata beberapa hari menjadi di bawah 1 jam |
| BG-02 | Inklusivitas UMKM | Mempermudah UMKM dari berbagai daerah untuk mendaftar dan bergabung dalam ekosistem MBG |
| BG-03 | Transparansi | Seluruh proses dari registrasi, verifikasi, matching, hingga kerja sama tercatat digital |
| BG-04 | Kualitas Supplier | Memastikan hanya supplier terverifikasi yang dapat berpartisipasi dalam matching |

### 3.2 System Goals

| Kode | Goal | Deskripsi |
|---|---|---|
| SG-01 | Database Terpusat | Menyediakan database supplier terverifikasi yang dapat diakses oleh seluruh SPPG |
| SG-02 | Pencarian Berbasis Lokasi | Supplier ditemukan berdasarkan kedekatan geografis dengan SPPG menggunakan koordinat GPS |
| SG-03 | Pemeringkatan Objektif | Algoritma SAW menghasilkan ranking supplier berdasarkan 4 kriteria terbobot |
| SG-04 | Manajemen Kerja Sama | Alur permintaan, penerimaan, dan penolakan kerja sama dikelola sepenuhnya dalam sistem |

### 3.3 Success Metrics (KPI)

| Metrik | Target Awal (3 bulan) |
|---|---|
| Jumlah supplier terdaftar | ≥ 100 supplier |
| Jumlah supplier terverifikasi | ≥ 60% dari yang terdaftar |
| Waktu rata-rata proses matching | ≤ 5 menit |
| Jumlah kerja sama terbentuk | ≥ 50 partnerships |
| Tingkat respons supplier terhadap permintaan | ≥ 70% |

---

## 4. Stakeholder & User Roles

### 4.1 Deskripsi Peran

#### 4.1.1 Guest (Pengguna Publik)

Pengguna yang belum memiliki akun. Dapat menjelajah informasi publik di platform.

**Hak Akses:**
- Melihat halaman utama (homepage)
- Membaca informasi tentang program MBG
- Membaca informasi tentang sistem MBGBrain
- Melihat syarat dan ketentuan menjadi supplier
- Membaca FAQ
- Mengakses halaman registrasi (untuk Supplier dan SPPG)

**Batasan:**
- Tidak dapat melihat data supplier atau SPPG
- Tidak dapat melakukan matching
- Tidak dapat mengakses dashboard apapun

---

#### 4.1.2 Supplier (UMKM)

Pelaku usaha mikro, kecil, dan menengah yang ingin memasok produk ke SPPG.

**Hak Akses:**
- Login dan logout
- Mengelola profil usaha (nama, alamat, deskripsi, kategori produk, kapasitas harian)
- Menentukan lokasi usaha di peta
- Mengunggah, memperbarui, dan menghapus dokumen legalitas
- Melihat status verifikasi akun dan dokumen
- Menerima notifikasi permintaan kerja sama dari SPPG
- Menanggapi permintaan kerja sama (terima / tolak)
- Melihat riwayat kerja sama
- Melihat notifikasi sistem

**Batasan:**
- Tidak dapat langsung menghubungi SPPG tanpa melalui sistem
- Tidak dapat mengubah status verifikasi sendiri
- Tidak dapat melihat data supplier lain

---

#### 4.1.3 SPPG (Satuan Pelayanan Pemenuhan Gizi)

Unit pelaksana program MBG yang membutuhkan pasokan dari supplier.

**Hak Akses:**
- Login dan logout
- Mengelola profil SPPG (nama, alamat, koordinat lokasi, penanggung jawab, nomor telepon)
- Membuat dan mengelola kebutuhan pengadaan (kategori produk, jumlah, satuan, radius pencarian)
- Menjalankan proses matching supplier berdasarkan kebutuhan yang dibuat
- Melihat hasil ranking supplier dari proses matching
- Melihat detail profil supplier yang muncul dalam hasil matching
- Mengirim permintaan kerja sama ke supplier terpilih
- Melihat status respons dari supplier
- Melihat riwayat kerja sama
- Menerima notifikasi dari sistem

**Batasan:**
- Tidak dapat mengirim permintaan kerja sama sebelum akun berstatus APPROVED
- Tidak dapat mengakses data supplier di luar konteks matching

---

#### 4.1.4 Administrator

Pengelola sistem dengan akses penuh untuk verifikasi dan monitoring.

**Hak Akses:**
- Login dan logout
- Melihat daftar seluruh supplier yang terdaftar beserta statusnya
- Melihat detail dokumen yang diunggah supplier
- Mengubah status verifikasi supplier (APPROVED / REJECTED) beserta catatan alasan
- Melihat daftar seluruh SPPG yang terdaftar beserta statusnya
- Mengubah status verifikasi SPPG (APPROVED / REJECTED)
- Mengelola pengguna (aktivasi/nonaktivasi akun)
- Melihat log aktivitas sistem
- Melihat dashboard monitoring (statistik jumlah supplier, SPPG, matching, kerja sama)

**Batasan:**
- Tidak dapat melakukan matching atas nama SPPG
- Tidak dapat mengubah data profil supplier atau SPPG secara langsung

---

### 4.2 Matriks Hak Akses

| Fitur | Guest | Supplier | SPPG | Admin |
|---|---|---|---|---|
| Lihat Homepage | ✅ | ✅ | ✅ | ✅ |
| Registrasi | ✅ | — | — | — |
| Login | — | ✅ | ✅ | ✅ |
| Kelola Profil | — | ✅ | ✅ | — |
| Upload Dokumen | — | ✅ | — | — |
| Verifikasi Supplier | — | — | — | ✅ |
| Verifikasi SPPG | — | — | — | ✅ |
| Buat Kebutuhan Pengadaan | — | — | ✅ | — |
| Jalankan Matching | — | — | ✅ | — |
| Kirim Permintaan Kerja Sama | — | — | ✅ | — |
| Terima / Tolak Kerja Sama | — | ✅ | — | — |
| Monitoring Dashboard | — | — | — | ✅ |

---

## 5. Business Rules

| Kode | Rule | Deskripsi Detail |
|---|---|---|
| BR-01 | Kewajiban Dokumen | Supplier wajib mengunggah minimal satu dokumen legalitas (NIB atau SIUP atau dokumen setara) sebelum akun dapat diajukan untuk diverifikasi. Sistem tidak akan mengaktifkan tombol "Ajukan Verifikasi" jika belum ada dokumen yang diunggah. |
| BR-02 | Syarat Matching Supplier | Supplier hanya dapat muncul dalam hasil matching apabila status verifikasi akun adalah APPROVED. Supplier dengan status PENDING, REJECTED, atau akun tidak aktif tidak akan diikutkan dalam proses matching. |
| BR-03 | Syarat Kirim Permintaan | SPPG hanya dapat mengirimkan permintaan kerja sama apabila status akun SPPG adalah APPROVED. |
| BR-04 | Filter Kategori Produk | Proses matching hanya mempertimbangkan supplier yang kategori produknya sesuai dengan kategori yang dibutuhkan dalam pengadaan. Supplier dengan kategori yang tidak relevan tidak akan diikutkan meskipun memiliki skor tinggi di kriteria lain. |
| BR-05 | Filter Kapasitas Produksi | Supplier yang kapasitas produksi hariannya lebih kecil dari jumlah kebutuhan harian SPPG dalam pengadaan akan memiliki skor kapasitas rendah dan tidak akan diprioritaskan, namun tetap ditampilkan dengan label peringatan kapasitas. |
| BR-06 | Dokumentasi Kerja Sama | Seluruh aktivitas kerja sama (pengiriman permintaan, penerimaan, penolakan) wajib tercatat di tabel `partnerships` beserta timestamp dan status. Tidak ada kerja sama yang boleh dilakukan di luar sistem. |
| BR-07 | Satu Permintaan Aktif | SPPG hanya dapat memiliki satu permintaan kerja sama aktif per supplier untuk satu kebutuhan pengadaan yang sama. Sistem menolak duplikasi permintaan. |
| BR-08 | Masa Berlaku Permintaan | Permintaan kerja sama yang tidak direspons supplier dalam 7 hari kalender secara otomatis berubah status menjadi EXPIRED. Diimplementasikan via Laravel Scheduler. |
| BR-09 | Riwayat Tidak Dapat Dihapus | Data riwayat matching dan kerja sama tidak dapat dihapus oleh pengguna manapun, termasuk admin. Hanya dapat di-archive. |

---

## 6. User Journey & Alur Sistem

### 6.1 Alur Supplier (End-to-End)

```
[1] Registrasi Akun
  └── Supplier mengisi form registrasi:
        nama lengkap, email, password, nama usaha, kategori produk
  └── Sistem membuat akun dengan status: PENDING
  └── Email konfirmasi dikirim via Laravel Mail (future)

[2] Lengkapi Profil Usaha
  └── Login ke dashboard
  └── Supplier mengisi:
        - Nama usaha, deskripsi, alamat lengkap
        - Menentukan lokasi di peta (klik atau cari alamat)
        - Sistem menyimpan latitude & longitude
        - Kapasitas produksi harian + satuan
        - Kategori produk

[3] Upload Dokumen Legalitas
  └── Supplier mengunggah dokumen:
        - Nomor Induk Berusaha (NIB) — wajib
        - SIUP (opsional)
        - Sertifikat halal (opsional)
        - Dokumen lain yang relevan
  └── Sistem menyimpan file ke Storage (local disk / S3-compatible)
  └── Status dokumen: PENDING

[4] Ajukan Verifikasi
  └── Setelah profil lengkap dan minimal 1 dokumen terunggah
  └── Supplier menekan tombol "Ajukan Verifikasi"
  └── Status akun: PENDING_REVIEW
  └── Notifikasi dikirim ke Admin

[5] Proses Verifikasi (oleh Admin)
  └── Admin membuka daftar supplier pending
  └── Admin mengecek kelengkapan data dan validitas dokumen
  └── Admin memilih: APPROVE atau REJECT (dengan catatan alasan jika reject)
  └── Notifikasi dikirim ke Supplier

[6a] Jika APPROVED → Supplier Aktif
  └── Supplier muncul dalam hasil matching
  └── Dapat menerima permintaan kerja sama dari SPPG

[6b] Jika REJECTED
  └── Supplier menerima notifikasi beserta alasan penolakan
  └── Supplier dapat memperbaiki dokumen dan mengajukan ulang

[7] Merespons Permintaan Kerja Sama
  └── Supplier menerima notifikasi permintaan dari SPPG
  └── Supplier melihat detail kebutuhan SPPG
  └── Supplier memilih: TERIMA atau TOLAK
  └── Jika terima → status partnership: ACTIVE
  └── Jika tolak → supplier mengisi alasan penolakan (opsional)
```

---

### 6.2 Alur SPPG (End-to-End)

```
[1] Registrasi & Login
  └── SPPG mendaftar: nama SPPG, alamat, penanggung jawab, telepon
  └── Admin memverifikasi akun SPPG
  └── Setelah APPROVED → SPPG dapat login

[2] Lengkapi Profil
  └── SPPG mengisi profil lengkap
  └── Menentukan lokasi SPPG di peta
  └── Simpan latitude & longitude

[3] Buat Kebutuhan Pengadaan
  └── SPPG membuat procurement request baru:
        - Kategori produk yang dibutuhkan
        - Jumlah kebutuhan harian + satuan
        - Radius pencarian supplier (dalam km)
  └── Status kebutuhan: OPEN

[4] Jalankan Proses Matching
  └── SPPG menekan tombol "Cari Supplier"
  └── Sistem melakukan:
        a. Filter supplier: status=APPROVED, kategori sesuai, dalam radius
        b. Hitung jarak (Haversine formula) antara lokasi SPPG dan setiap supplier
        c. Normalisasi skor setiap kriteria
        d. Hitung final score dengan SAW
        e. Urutkan supplier berdasarkan skor tertinggi
  └── Sistem menyimpan hasil ke tabel matching_results
  └── Halaman hasil matching ditampilkan

[5] Lihat Ranking Supplier
  └── SPPG melihat daftar supplier terurut berdasarkan skor
  └── Setiap kartu supplier menampilkan:
        - Nama usaha, lokasi, jarak
        - Kapasitas produksi
        - Skor matching (total dan per kriteria)
        - Jumlah kerja sama sebelumnya
  └── SPPG dapat klik detail supplier untuk info lengkap

[6] Kirim Permintaan Kerja Sama
  └── SPPG memilih supplier dari hasil matching
  └── SPPG menekan "Kirim Permintaan"
  └── Sistem membuat record di tabel partnerships dengan status: PENDING
  └── Notifikasi dikirim ke supplier
  └── SPPG menunggu respons

[7] Monitoring Status
  └── SPPG memantau status permintaan di halaman "Kerja Sama"
  └── Status: PENDING / ACTIVE / REJECTED / EXPIRED
```

---

### 6.3 Alur Admin

```
[1] Login ke Dashboard Admin

[2] Verifikasi Supplier
  └── Lihat daftar supplier dengan status PENDING_REVIEW
  └── Buka detail: cek profil, lokasi, dan seluruh dokumen yang diunggah
  └── Preview file dokumen
  └── Pilih APPROVE atau REJECT
  └── Jika REJECT: isi kolom alasan penolakan
  └── Simpan → status supplier berubah → notifikasi dikirim

[3] Verifikasi SPPG
  └── Alur sama dengan verifikasi supplier

[4] Kelola Pengguna
  └── Lihat semua user (supplier + SPPG + admin)
  └── Aktifkan / nonaktifkan akun

[5] Monitoring
  └── Dashboard dengan statistik:
        - Total supplier terdaftar / terverifikasi / ditolak
        - Total SPPG terdaftar / terverifikasi
        - Total matching yang dijalankan
        - Total kerja sama aktif
```

---

## 7. Functional Requirements

### 7.1 Modul Homepage (Publik)

| ID | Fitur | Deskripsi |
|---|---|---|
| HM-01 | Hero Section | Tampilan utama dengan tagline, deskripsi singkat MBGBrain, dan CTA tombol Daftar Supplier dan Login |
| HM-02 | Informasi MBG | Penjelasan tentang Program Makan Bergizi Gratis: latar belakang, tujuan, dan bagaimana supplier bisa terlibat |
| HM-03 | Cara Menjadi Supplier | Step-by-step visual tentang proses: Daftar → Lengkapi Profil → Upload Dokumen → Verifikasi → Aktif |
| HM-04 | Persyaratan Supplier | Daftar dokumen yang wajib dan opsional disiapkan calon supplier |
| HM-05 | FAQ | Pertanyaan umum dengan jawaban yang dapat di-expand (accordion) |
| HM-06 | Footer | Link navigasi, informasi kontak, dan link ke halaman registrasi |

---

### 7.2 Modul Autentikasi

| ID | Fitur | Deskripsi |
|---|---|---|
| AUTH-01 | Registrasi Supplier | Form: nama lengkap, email, password, konfirmasi password, nama usaha, kategori produk utama. Validasi: email unik, password minimum 8 karakter. |
| AUTH-02 | Registrasi SPPG | Form: nama SPPG, email, password, nama penanggung jawab, nomor telepon. Validasi: email unik, format telepon valid. |
| AUTH-03 | Login | Form: email dan password. Autentikasi via Laravel Sanctum (token-based untuk SPA). JWT disimpan di cookie httpOnly. Redirect ke dashboard sesuai role. |
| AUTH-04 | Logout | Revoke token aktif via Sanctum. Redirect ke halaman login. |
| AUTH-05 | Proteksi Route | Seluruh halaman dashboard dilindungi middleware `auth:sanctum`. Pengguna yang belum login diredirect ke halaman login. |
| AUTH-06 | Role Guard | Setiap halaman hanya dapat diakses oleh role yang sesuai via middleware `role:admin|supplier|sppg`. Akses tidak sah diredirect ke 403. |

---

### 7.3 Modul Supplier

| ID | Fitur | Deskripsi |
|---|---|---|
| SUP-01 | Dashboard Supplier | Halaman utama setelah login. Menampilkan: status verifikasi, ringkasan dokumen, notifikasi terbaru, dan shortcut ke fitur utama. |
| SUP-02 | Edit Profil Usaha | Form edit: nama usaha, alamat, deskripsi usaha, kategori produk, kapasitas produksi harian, satuan kapasitas. |
| SUP-03 | Kelola Lokasi | Komponen peta interaktif (Leaflet.js via CDN atau npm). Supplier dapat mencari alamat atau klik langsung pada peta. Koordinat (latitude, longitude) disimpan otomatis. |
| SUP-04 | Upload Dokumen | Upload file (PDF, JPG, PNG, maks 5MB per file). Tipe dokumen: NIB, SIUP, Sertifikat Halal, Dokumen Lain. Disimpan via Laravel Storage (local/S3). |
| SUP-05 | Lihat Status Verifikasi | Halaman yang menampilkan status akun (PENDING / PENDING_REVIEW / APPROVED / REJECTED) beserta catatan dari admin jika REJECTED. |
| SUP-06 | Daftar Permintaan Kerja Sama | Menampilkan semua permintaan kerja sama yang masuk dari SPPG, diurutkan berdasarkan tanggal terbaru. |
| SUP-07 | Detail Permintaan | Menampilkan detail permintaan: nama SPPG, lokasi, kebutuhan, tanggal permintaan. |
| SUP-08 | Respons Kerja Sama | Tombol Terima dan Tolak pada setiap permintaan berstatus PENDING. Jika tolak, tersedia kolom alasan (opsional). |
| SUP-09 | Riwayat Kerja Sama | Daftar seluruh kerja sama (aktif, ditolak, expired) dengan filter dan sort. |

---

### 7.4 Modul SPPG

| ID | Fitur | Deskripsi |
|---|---|---|
| SPPG-01 | Dashboard SPPG | Halaman utama setelah login. Menampilkan: status akun, ringkasan pengadaan aktif, kerja sama aktif, dan notifikasi. |
| SPPG-02 | Edit Profil | Form edit: nama SPPG, alamat, nama penanggung jawab, nomor telepon. |
| SPPG-03 | Kelola Lokasi | Komponen peta interaktif untuk menentukan lokasi SPPG. |
| SPPG-04 | Buat Kebutuhan Pengadaan | Form: kategori produk, jumlah kebutuhan, satuan (kg/porsi/liter/dll), radius pencarian (km). |
| SPPG-05 | Daftar Kebutuhan | List seluruh kebutuhan pengadaan yang pernah dibuat beserta statusnya (OPEN, IN_PROGRESS, CLOSED). |
| SPPG-06 | Jalankan Matching | Tombol "Cari Supplier" pada detail kebutuhan pengadaan. Memicu eksekusi algoritma matching di backend. |
| SPPG-07 | Hasil Matching | Halaman hasil: daftar supplier terurut berdasarkan skor, dengan kartu informasi per supplier. Setiap kartu memiliki tombol "Lihat Detail" dan "Kirim Permintaan". |
| SPPG-08 | Detail Supplier | Halaman profil lengkap supplier: nama, lokasi (peta), deskripsi, kapasitas, dokumen terverifikasi, riwayat kerja sama. |
| SPPG-09 | Kirim Permintaan Kerja Sama | Konfirmasi pengiriman permintaan ke supplier yang dipilih. Sistem mencatat ke DB dan mengirim notifikasi. |
| SPPG-10 | Monitor Status Kerja Sama | Daftar semua permintaan kerja sama yang telah dikirim beserta statusnya. |

---

### 7.5 Modul Admin

| ID | Fitur | Deskripsi |
|---|---|---|
| ADM-01 | Dashboard Admin | Ringkasan statistik sistem: total supplier, SPPG, matching, kerja sama, breakdown berdasarkan status. |
| ADM-02 | Daftar Supplier | Tabel dengan filter (status verifikasi, kategori, tanggal daftar) dan search by nama/email. |
| ADM-03 | Detail & Verifikasi Supplier | Halaman detail supplier: profil lengkap, lokasi di peta, dan daftar dokumen yang dapat dibuka/preview. Tombol APPROVE dan REJECT dengan field alasan. |
| ADM-04 | Daftar SPPG | Tabel dengan filter dan search. |
| ADM-05 | Detail & Verifikasi SPPG | Halaman detail SPPG dengan tombol APPROVE dan REJECT. |
| ADM-06 | Kelola Pengguna | Tabel semua user. Dapat mengaktifkan/menonaktifkan akun (is_active toggle). |
| ADM-07 | Log Aktivitas | Riwayat aksi admin (siapa, aksi apa, kapan, terhadap siapa). Implementasi via Laravel Activity Log (spatie/laravel-activitylog). |

---

### 7.6 Modul Notifikasi

| ID | Fitur | Deskripsi |
|---|---|---|
| NOT-01 | Notifikasi In-App | Bell icon di navbar dengan badge jumlah notifikasi belum dibaca. Dropdown menampilkan 5 notifikasi terbaru. |
| NOT-02 | Halaman Notifikasi | Daftar semua notifikasi dengan status read/unread. Klik notifikasi → tandai sebagai dibaca → redirect ke halaman terkait. |
| NOT-03 | Trigger Notifikasi | Notifikasi dibuat otomatis via Laravel Notifications pada event: (a) supplier diverifikasi, (b) SPPG diverifikasi, (c) permintaan kerja sama masuk, (d) kerja sama diterima, (e) kerja sama ditolak, (f) permintaan expired. |

---

## 8. Non-Functional Requirements

| Kode | Kategori | Requirement |
|---|---|---|
| NFR-01 | Performance | Halaman utama dan dashboard harus load dalam ≤ 3 detik pada koneksi 4G |
| NFR-02 | Performance | Proses matching untuk ≤ 500 supplier harus selesai dalam ≤ 10 detik |
| NFR-03 | Scalability | Sistem harus mampu menangani 1000 concurrent users |
| NFR-04 | Availability | Uptime target ≥ 99.5% per bulan |
| NFR-05 | Responsiveness | UI harus responsive dan dapat digunakan di perangkat desktop (1280px+), tablet (768px), dan mobile (375px+) |
| NFR-06 | Accessibility | Mendukung navigasi keyboard dan memiliki alt text pada semua gambar |
| NFR-07 | Data Integrity | Semua perubahan data sensitif (verifikasi, status kerja sama) harus atomic dan transaksional via Laravel DB::transaction() |
| NFR-08 | File Storage | Ukuran maksimum file per upload: 5 MB. Format yang diterima: PDF, JPG, JPEG, PNG |
| NFR-09 | Browser Support | Mendukung Chrome 90+, Firefox 88+, Safari 14+, Edge 90+ |

---

## 9. Matching Algorithm

### 9.1 Overview

Algoritma matching menggunakan metode **SAW (Simple Additive Weighting)**, yaitu metode pengambilan keputusan multi-kriteria yang menghitung skor akhir sebagai jumlah terbobot dari skor tiap kriteria yang telah dinormalisasi.

### 9.2 Input Algoritma

| Parameter | Sumber |
|---|---|
| Lokasi SPPG (lat, lng) | Profil SPPG |
| Kategori produk yang dibutuhkan | Kebutuhan pengadaan |
| Jumlah kebutuhan harian | Kebutuhan pengadaan |
| Radius pencarian (km) | Kebutuhan pengadaan |

### 9.3 Tahap Filter (Pre-Matching)

Sebelum algoritma SAW dijalankan, sistem melakukan filter:

1. **Filter Status:** `status_verifikasi = 'APPROVED'` dan `is_active = 1`
2. **Filter Kategori:** `kategori_produk` supplier harus cocok dengan kategori kebutuhan pengadaan
3. **Filter Radius:** Jarak antara lokasi SPPG dan supplier ≤ radius yang ditentukan (dihitung dengan Haversine)

### 9.4 Kriteria Penilaian

#### Kriteria 1: Jarak (Bobot 40%)

Menggunakan **Formula Haversine** untuk menghitung jarak lingkaran besar antara dua titik koordinat di bumi:

```
a = sin²(Δlat/2) + cos(lat1) × cos(lat2) × sin²(Δlng/2)
c = 2 × atan2(√a, √(1−a))
d = R × c   (R = 6371 km)
```

Normalisasi skor jarak (benefit: semakin dekat semakin baik, sehingga dibalik):

```
distance_score = 1 - (d_i / d_max)
```

Di mana `d_i` adalah jarak supplier ke SPPG, dan `d_max` adalah jarak terjauh di antara semua kandidat.

#### Kriteria 2: Kapasitas Produksi (Bobot 30%)

```
capacity_score = cap_i / cap_max
```

Di mana `cap_i` adalah kapasitas harian supplier, dan `cap_max` adalah kapasitas terbesar di antara semua kandidat.

#### Kriteria 3: Kelengkapan Dokumen (Bobot 20%)

| Kondisi | Skor |
|---|---|
| Hanya memiliki NIB terverifikasi | 0.50 |
| NIB + 1 dokumen tambahan terverifikasi | 0.75 |
| NIB + 2 atau lebih dokumen tambahan terverifikasi | 1.00 |

#### Kriteria 4: Riwayat Kerja Sama (Bobot 10%)

```
history_score = min(jumlah_kerjasama_aktif_selesai / 10, 1.0)
```

Normalisasi ke maksimum 10 kerja sama (skor penuh = 10 atau lebih kerja sama berhasil).

### 9.5 Formula Final (SAW)

```
Vi = (0.40 × distance_score) + (0.30 × capacity_score) + (0.20 × document_score) + (0.10 × history_score)
```

Supplier diurutkan berdasarkan nilai `Vi` dari tertinggi ke terendah.

### 9.6 Output Algoritma

Untuk setiap supplier kandidat, sistem menyimpan ke tabel `matching_results`:
- `distance_km` — jarak aktual dalam kilometer
- `distance_score` — skor jarak ternormalisasi (0.00 – 1.00)
- `capacity_score` — skor kapasitas ternormalisasi (0.00 – 1.00)
- `document_score` — skor kelengkapan dokumen (0.50 / 0.75 / 1.00)
- `history_score` — skor riwayat kerja sama (0.00 – 1.00)
- `total_score` — skor akhir SAW (0.00 – 1.00)
- `ranking` — peringkat berdasarkan total_score

---

## 10. Maps Integration

### 10.1 Library dan Provider

| Komponen | Teknologi |
|---|---|
| Library | Leaflet.js (via @vue-leaflet/vue-leaflet untuk Inertia/Vue) |
| Tile Provider | OpenStreetMap |
| Geocoding | Nominatim API (OpenStreetMap) |
| Reverse Geocoding | Nominatim API |

### 10.2 Alur Penentuan Lokasi

```
[Input alamat teks]
        ↓
[Geocoding via Nominatim API (fetch dari frontend)]
        ↓
[Koordinat (lat, lng) ditemukan]
        ↓
[Peta berpindah ke koordinat tersebut]
        ↓
[Marker muncul di titik lokasi]
        ↓
[Pengguna dapat menggeser marker untuk presisi lebih baik]
        ↓
[Koordinat final dikirim ke backend via form Inertia]
        ↓
[Disimpan ke kolom latitude & longitude di database]
```

### 10.3 Komponen Peta

**LocationPicker** (digunakan pada form profil Supplier dan SPPG):
- Input teks untuk mencari alamat
- Peta interaktif dengan zoom level default 13
- Marker yang dapat di-drag
- Menampilkan koordinat aktual saat marker bergerak
- Tombol "Gunakan Lokasi Saya" (browser geolocation API)

**SupplierMap** (digunakan pada halaman hasil matching SPPG):
- Menampilkan semua supplier hasil matching sebagai marker
- Marker SPPG dengan ikon berbeda
- Popup per marker menampilkan nama, jarak, dan skor
- Radius pencarian ditampilkan sebagai circle overlay

### 10.4 Data yang Disimpan

```sql
latitude   DECIMAL(10, 8)   -- contoh: -7.25177350
longitude  DECIMAL(11, 8)   -- contoh: 112.73178680
```

---

## 11. Database Design (ERD & Schema)

### 11.1 Gambaran Relasi Antar Tabel

```
users (1) ──────────── (1) suppliers
users (1) ──────────── (1) sppg
suppliers (1) ────────── (N) supplier_documents
sppg (1) ────────────── (N) procurement_requests
procurement_requests (1) ── (N) matching_results
procurement_requests (1) ── (N) partnerships
suppliers (1) ─────────── (N) matching_results
suppliers (1) ─────────── (N) partnerships
users (1) ────────────── (N) notifications
```

---

### 11.2 Tabel: `users`

| Kolom | Tipe Data | Constraint | Keterangan |
|---|---|---|---|
| `id` | CHAR(36) | PRIMARY KEY, DEFAULT (UUID()) | Identifier unik pengguna |
| `name` | VARCHAR(150) | NOT NULL | Nama lengkap pengguna |
| `email` | VARCHAR(255) | NOT NULL, UNIQUE | Email untuk login |
| `password` | VARCHAR(255) | NOT NULL | Hash password menggunakan bcrypt (Laravel Hash facade) |
| `role` | ENUM('supplier','sppg','admin') | NOT NULL | Peran pengguna dalam sistem |
| `is_active` | TINYINT(1) | NOT NULL, DEFAULT 1 | Status aktif akun |
| `remember_token` | VARCHAR(100) | NULL | Token untuk remember me (Laravel standard) |
| `created_at` | DATETIME | NULL | Waktu akun dibuat (diisi otomatis Eloquent) |
| `updated_at` | DATETIME | NULL | Waktu terakhir data diperbarui (diisi otomatis Eloquent) |

**Index:**
- `idx_users_email` ON `email`
- `idx_users_role` ON `role`

---

### 11.3 Tabel: `suppliers`

| Kolom | Tipe Data | Constraint | Keterangan |
|---|---|---|---|
| `id` | CHAR(36) | PRIMARY KEY, DEFAULT (UUID()) | Identifier unik supplier |
| `user_id` | CHAR(36) | NOT NULL, FOREIGN KEY → users(id) ON DELETE CASCADE, UNIQUE | Relasi ke tabel users (1:1) |
| `nama_usaha` | VARCHAR(200) | NOT NULL | Nama usaha/brand UMKM |
| `alamat` | TEXT | NOT NULL | Alamat lengkap usaha |
| `latitude` | DECIMAL(10,8) | NULL | Koordinat lintang lokasi usaha |
| `longitude` | DECIMAL(11,8) | NULL | Koordinat bujur lokasi usaha |
| `kategori_produk` | VARCHAR(100) | NOT NULL | Kategori utama produk |
| `kapasitas_harian` | DECIMAL(10,2) | NOT NULL, DEFAULT 0 | Kapasitas produksi per hari |
| `satuan_kapasitas` | VARCHAR(50) | NOT NULL, DEFAULT 'kg' | Satuan kapasitas |
| `deskripsi` | TEXT | NULL | Deskripsi usaha dan produk |
| `status_verifikasi` | ENUM('PENDING','PENDING_REVIEW','APPROVED','REJECTED') | NOT NULL, DEFAULT 'PENDING' | Status verifikasi supplier |
| `catatan_verifikasi` | TEXT | NULL | Catatan dari admin saat reject |
| `verified_at` | DATETIME | NULL | Waktu verifikasi diberikan |
| `verified_by` | CHAR(36) | NULL, FOREIGN KEY → users(id) ON DELETE SET NULL | Admin yang melakukan verifikasi |
| `created_at` | DATETIME | NULL | Waktu data dibuat |
| `updated_at` | DATETIME | NULL | Waktu terakhir data diperbarui |

**Index:**
- `idx_suppliers_status` ON `status_verifikasi`
- `idx_suppliers_kategori` ON `kategori_produk`
- `idx_suppliers_location` ON `latitude, longitude`

---

### 11.4 Tabel: `supplier_documents`

| Kolom | Tipe Data | Constraint | Keterangan |
|---|---|---|---|
| `id` | CHAR(36) | PRIMARY KEY, DEFAULT (UUID()) | Identifier unik dokumen |
| `supplier_id` | CHAR(36) | NOT NULL, FOREIGN KEY → suppliers(id) ON DELETE CASCADE | Relasi ke supplier pemilik dokumen |
| `document_type` | ENUM('NIB','SIUP','SERTIFIKAT_HALAL','LAINNYA') | NOT NULL | Jenis dokumen |
| `document_name` | VARCHAR(255) | NOT NULL | Nama file asli saat diupload |
| `file_path` | TEXT | NOT NULL | Path file di Laravel Storage |
| `file_size_bytes` | INT | NULL | Ukuran file dalam bytes |
| `mime_type` | VARCHAR(100) | NULL | MIME type file |
| `verification_status` | ENUM('PENDING','VERIFIED','REJECTED') | NOT NULL, DEFAULT 'PENDING' | Status verifikasi dokumen |
| `catatan_dokumen` | TEXT | NULL | Catatan admin terkait dokumen |
| `uploaded_at` | DATETIME | NOT NULL, DEFAULT CURRENT_TIMESTAMP | Waktu dokumen diunggah |
| `verified_at` | DATETIME | NULL | Waktu dokumen diverifikasi |

**Index:**
- `idx_supplier_documents_supplier` ON `supplier_id`
- `idx_supplier_documents_status` ON `verification_status`

---

### 11.5 Tabel: `sppg`

| Kolom | Tipe Data | Constraint | Keterangan |
|---|---|---|---|
| `id` | CHAR(36) | PRIMARY KEY, DEFAULT (UUID()) | Identifier unik SPPG |
| `user_id` | CHAR(36) | NOT NULL, FOREIGN KEY → users(id) ON DELETE CASCADE, UNIQUE | Relasi ke tabel users (1:1) |
| `nama_sppg` | VARCHAR(200) | NOT NULL | Nama resmi unit SPPG |
| `alamat` | TEXT | NOT NULL | Alamat lengkap SPPG |
| `latitude` | DECIMAL(10,8) | NULL | Koordinat lintang lokasi SPPG |
| `longitude` | DECIMAL(11,8) | NULL | Koordinat bujur lokasi SPPG |
| `penanggung_jawab` | VARCHAR(150) | NOT NULL | Nama penanggung jawab SPPG |
| `nomor_telepon` | VARCHAR(20) | NOT NULL | Nomor telepon aktif SPPG |
| `status_verifikasi` | ENUM('PENDING','APPROVED','REJECTED') | NOT NULL, DEFAULT 'PENDING' | Status verifikasi SPPG |
| `catatan_verifikasi` | TEXT | NULL | Catatan dari admin |
| `verified_at` | DATETIME | NULL | Waktu verifikasi |
| `verified_by` | CHAR(36) | NULL, FOREIGN KEY → users(id) ON DELETE SET NULL | Admin yang memverifikasi |
| `created_at` | DATETIME | NULL | Waktu data dibuat |
| `updated_at` | DATETIME | NULL | Waktu terakhir data diperbarui |

**Index:**
- `idx_sppg_status` ON `status_verifikasi`

---

### 11.6 Tabel: `procurement_requests`

| Kolom | Tipe Data | Constraint | Keterangan |
|---|---|---|---|
| `id` | CHAR(36) | PRIMARY KEY, DEFAULT (UUID()) | Identifier unik kebutuhan pengadaan |
| `sppg_id` | CHAR(36) | NOT NULL, FOREIGN KEY → sppg(id) ON DELETE CASCADE | Relasi ke SPPG pembuat |
| `kategori_produk` | VARCHAR(100) | NOT NULL | Kategori produk yang dibutuhkan |
| `jumlah_kebutuhan` | DECIMAL(10,2) | NOT NULL | Jumlah kebutuhan harian |
| `satuan` | VARCHAR(50) | NOT NULL | Satuan kebutuhan |
| `radius_km` | DECIMAL(6,2) | NOT NULL, DEFAULT 50 | Radius pencarian supplier (km) |
| `deskripsi_kebutuhan` | TEXT | NULL | Deskripsi tambahan terkait kebutuhan |
| `status` | ENUM('OPEN','IN_PROGRESS','CLOSED') | NOT NULL, DEFAULT 'OPEN' | Status kebutuhan pengadaan |
| `created_at` | DATETIME | NULL | Waktu kebutuhan dibuat |
| `updated_at` | DATETIME | NULL | Waktu terakhir diperbarui |

**Index:**
- `idx_procurement_sppg` ON `sppg_id`
- `idx_procurement_status` ON `status`
- `idx_procurement_kategori` ON `kategori_produk`

---

### 11.7 Tabel: `matching_results`

| Kolom | Tipe Data | Constraint | Keterangan |
|---|---|---|---|
| `id` | CHAR(36) | PRIMARY KEY, DEFAULT (UUID()) | Identifier unik hasil matching |
| `procurement_request_id` | CHAR(36) | NOT NULL, FOREIGN KEY → procurement_requests(id) ON DELETE CASCADE | Relasi ke kebutuhan pengadaan |
| `supplier_id` | CHAR(36) | NOT NULL, FOREIGN KEY → suppliers(id) ON DELETE CASCADE | Relasi ke supplier kandidat |
| `distance_km` | DECIMAL(8,3) | NOT NULL | Jarak aktual dalam kilometer |
| `distance_score` | DECIMAL(5,4) | NOT NULL | Skor jarak ternormalisasi (0.0000 – 1.0000) |
| `capacity_score` | DECIMAL(5,4) | NOT NULL | Skor kapasitas ternormalisasi (0.0000 – 1.0000) |
| `document_score` | DECIMAL(5,4) | NOT NULL | Skor kelengkapan dokumen (0.5000 / 0.7500 / 1.0000) |
| `history_score` | DECIMAL(5,4) | NOT NULL | Skor riwayat kerja sama (0.0000 – 1.0000) |
| `total_score` | DECIMAL(5,4) | NOT NULL | Skor akhir SAW (0.0000 – 1.0000) |
| `ranking` | INT | NOT NULL | Peringkat (1 = terbaik) |
| `created_at` | DATETIME | NULL | Waktu matching dijalankan |
| `updated_at` | DATETIME | NULL | — |

**Constraint:**
- `UNIQUE (procurement_request_id, supplier_id)` — satu supplier hanya muncul sekali per request

**Index:**
- `idx_matching_request` ON `procurement_request_id`
- `idx_matching_score` ON `procurement_request_id, total_score`

---

### 11.8 Tabel: `partnerships`

| Kolom | Tipe Data | Constraint | Keterangan |
|---|---|---|---|
| `id` | CHAR(36) | PRIMARY KEY, DEFAULT (UUID()) | Identifier unik kerja sama |
| `procurement_request_id` | CHAR(36) | NOT NULL, FOREIGN KEY → procurement_requests(id) | Relasi ke kebutuhan pengadaan |
| `supplier_id` | CHAR(36) | NOT NULL, FOREIGN KEY → suppliers(id) | Relasi ke supplier |
| `status` | ENUM('PENDING','ACTIVE','REJECTED','EXPIRED') | NOT NULL, DEFAULT 'PENDING' | Status kerja sama |
| `catatan_penolakan` | TEXT | NULL | Alasan penolakan dari supplier (jika ditolak) |
| `requested_at` | DATETIME | NOT NULL, DEFAULT CURRENT_TIMESTAMP | Waktu permintaan dikirim |
| `responded_at` | DATETIME | NULL | Waktu supplier merespons |
| `expired_at` | DATETIME | NULL | Waktu kadaluarsa (jika EXPIRED) |
| `created_at` | DATETIME | NULL | — |
| `updated_at` | DATETIME | NULL | — |

**Constraint:**
- `UNIQUE (procurement_request_id, supplier_id)` — mencegah duplikasi permintaan

**Index:**
- `idx_partnerships_request` ON `procurement_request_id`
- `idx_partnerships_supplier` ON `supplier_id`
- `idx_partnerships_status` ON `status`

---

### 11.9 Tabel: `notifications`

| Kolom | Tipe Data | Constraint | Keterangan |
|---|---|---|---|
| `id` | CHAR(36) | PRIMARY KEY | UUID diisi oleh Laravel Notifications |
| `type` | VARCHAR(255) | NOT NULL | Fully qualified class name notification Laravel |
| `notifiable_type` | VARCHAR(255) | NOT NULL | Model yang menerima notifikasi ('App\\Models\\User') |
| `notifiable_id` | CHAR(36) | NOT NULL | ID penerima notifikasi |
| `data` | JSON | NOT NULL | Payload notifikasi (title, message, type, reference_id, dll) |
| `read_at` | DATETIME | NULL | Waktu dibaca (NULL = belum dibaca) |
| `created_at` | DATETIME | NULL | Waktu notifikasi dibuat |
| `updated_at` | DATETIME | NULL | — |

> **Catatan:** Tabel `notifications` menggunakan schema bawaan Laravel Database Notifications (`php artisan notifications:table`). Tidak perlu dibuat manual — gunakan migration yang disediakan Laravel.

**Index:**
- `idx_notifications_notifiable` ON `notifiable_type, notifiable_id`
- `idx_notifications_read` ON `notifiable_id, read_at`

---

### 11.10 Tabel: `personal_access_tokens` (Laravel Sanctum)

Dikelola sepenuhnya oleh Laravel Sanctum via `php artisan vendor:publish`. Menyimpan token API untuk autentikasi SPA.

---

## 12. API Design

### 12.1 Konvensi Umum

- **Base URL:** `https://api.mbgbrain.id/api/v1`
- **Format Response:** JSON
- **Autentikasi:** Laravel Sanctum — Bearer Token di header `Authorization` atau cookie `sanctum` (untuk SPA)
- **HTTP Status Codes:**
  - `200 OK` — Request berhasil
  - `201 Created` — Data berhasil dibuat
  - `400 Bad Request` — Input tidak valid
  - `401 Unauthorized` — Token tidak ada atau tidak valid
  - `403 Forbidden` — Token valid tapi tidak memiliki izin
  - `404 Not Found` — Data tidak ditemukan
  - `409 Conflict` — Duplikasi data
  - `422 Unprocessable Entity` — Validasi Laravel gagal
  - `500 Internal Server Error` — Error di sisi server

**Format Response Standar:**
```json
{
  "success": true,
  "message": "Deskripsi pesan",
  "data": { },
  "meta": {
    "current_page": 1,
    "per_page": 20,
    "total": 100,
    "last_page": 5
  }
}
```

**Format Error Standar:**
```json
{
  "success": false,
  "message": "Deskripsi error",
  "errors": {
    "email": ["Email sudah terdaftar"],
    "password": ["Password minimal 8 karakter"]
  }
}
```

---

### 12.2 Authentication Endpoints

**POST /api/v1/auth/register-supplier**

Request Body:
```json
{
  "name": "Budi Santoso",
  "email": "budi@example.com",
  "password": "Password123!",
  "password_confirmation": "Password123!",
  "nama_usaha": "UD Maju Bersama",
  "kategori_produk": "sayuran"
}
```

Response 201:
```json
{
  "success": true,
  "message": "Registrasi berhasil. Silakan lengkapi profil usaha Anda.",
  "data": {
    "id": "uuid-...",
    "email": "budi@example.com",
    "role": "supplier"
  }
}
```

---

**POST /api/v1/auth/register-sppg**

Request Body:
```json
{
  "name": "Siti Rahayu",
  "email": "sppg.nganjuk@example.com",
  "password": "Password123!",
  "password_confirmation": "Password123!",
  "nama_sppg": "SPPG Kecamatan Nganjuk",
  "penanggung_jawab": "Siti Rahayu",
  "nomor_telepon": "08123456789"
}
```

---

**POST /api/v1/auth/login**

Request Body:
```json
{
  "email": "budi@example.com",
  "password": "Password123!"
}
```

Response 200:
```json
{
  "success": true,
  "message": "Login berhasil",
  "data": {
    "access_token": "1|laravel_sanctum_token_here",
    "token_type": "Bearer",
    "user": {
      "id": "uuid-...",
      "name": "Budi Santoso",
      "email": "budi@example.com",
      "role": "supplier"
    }
  }
}
```

---

**POST /api/v1/auth/logout**

Header: `Authorization: Bearer {token}`
Response 200: `{ "success": true, "message": "Logout berhasil" }`

---

### 12.3 Supplier Endpoints

**GET /api/v1/supplier/profile** — Auth (role: supplier)
Response: Data profil supplier beserta status verifikasi.

**PUT /api/v1/supplier/profile** — Auth (role: supplier)

**POST /api/v1/supplier/documents** — Auth (role: supplier), multipart/form-data

**DELETE /api/v1/supplier/documents/{id}** — Auth (role: supplier)

**POST /api/v1/supplier/request-verification** — Auth (role: supplier)

**GET /api/v1/supplier/partnerships** — Auth (role: supplier)

**PATCH /api/v1/supplier/partnerships/{id}/accept** — Auth (role: supplier)

**PATCH /api/v1/supplier/partnerships/{id}/reject** — Auth (role: supplier)

---

### 12.4 SPPG Endpoints

**GET /api/v1/sppg/profile** — Auth (role: sppg)

**PUT /api/v1/sppg/profile** — Auth (role: sppg)

**POST /api/v1/sppg/procurement** — Auth (role: sppg, status: APPROVED)

**GET /api/v1/sppg/procurement** — Auth (role: sppg), query: `?status=OPEN&page=1`

**GET /api/v1/sppg/procurement/{id}** — Auth (role: sppg)

**PATCH /api/v1/sppg/procurement/{id}/close** — Auth (role: sppg)

**GET /api/v1/sppg/partnerships** — Auth (role: sppg)

---

### 12.5 Matching Endpoints

**POST /api/v1/matching/run** — Auth (role: sppg, status: APPROVED)

Request Body:
```json
{
  "procurement_request_id": "uuid-procurement-request"
}
```

Response 200:
```json
{
  "success": true,
  "message": "Matching berhasil dijalankan",
  "data": {
    "procurement_request_id": "uuid-...",
    "total_kandidat": 12,
    "hasil": [
      {
        "ranking": 1,
        "supplier_id": "uuid-...",
        "nama_usaha": "UD Segar Alami",
        "alamat": "Jl. Pahlawan No. 5, Nganjuk",
        "distance_km": 3.2,
        "kapasitas_harian": 200,
        "total_score": 0.8752,
        "distance_score": 0.9100,
        "capacity_score": 0.8000,
        "document_score": 1.0000,
        "history_score": 0.3000
      }
    ]
  }
}
```

**GET /api/v1/matching/results/{procurement_request_id}** — Auth (role: sppg)

---

### 12.6 Partnership Endpoints

**POST /api/v1/partnerships** — Auth (role: sppg, status: APPROVED)

Request Body:
```json
{
  "procurement_request_id": "uuid-...",
  "supplier_id": "uuid-..."
}
```

**GET /api/v1/partnerships** — Auth (role: supplier|sppg), query: `?status=PENDING&page=1`

---

### 12.7 Notification Endpoints

**GET /api/v1/notifications** — Auth, query: `?is_read=false&page=1`

**PATCH /api/v1/notifications/{id}/read** — Auth

**PATCH /api/v1/notifications/read-all** — Auth

---

### 12.8 Admin Endpoints

**GET /api/v1/admin/dashboard** — Auth (role: admin)

**GET /api/v1/admin/suppliers** — Auth (role: admin), query: `?status=PENDING_REVIEW&search=budi&page=1`

**GET /api/v1/admin/suppliers/{id}** — Auth (role: admin)

**PATCH /api/v1/admin/suppliers/{id}/approve** — Auth (role: admin)

**PATCH /api/v1/admin/suppliers/{id}/reject** — Auth (role: admin), body: `{ "catatan_verifikasi": "..." }`

**GET /api/v1/admin/sppg** — Auth (role: admin)

**PATCH /api/v1/admin/sppg/{id}/approve** — Auth (role: admin)

**PATCH /api/v1/admin/sppg/{id}/reject** — Auth (role: admin)

**GET /api/v1/admin/users** — Auth (role: admin)

**PATCH /api/v1/admin/users/{id}/toggle-active** — Auth (role: admin)

---

## 13. Technology Stack

### 13.1 Backend (Full-Stack Framework)

| Teknologi | Versi | Fungsi |
|---|---|---|
| **Laravel** | **12.x** | Full-stack PHP framework — routing, middleware, ORM, queue, scheduler, mail, storage |
| **PHP** | **8.3+** | Runtime bahasa pemrograman (required by Laravel 12) |
| **Laravel Sanctum** | **4.x** | Autentikasi SPA / API token via Laravel official package |
| **Laravel Inertia** | **2.x** | Bridge antara Laravel backend dan Vue 3 frontend (server-side routing tanpa REST API terpisah) |
| **Spatie Laravel Permission** | **6.x** | RBAC (Role-Based Access Control) — manajemen role dan permission |
| **Spatie Laravel Activity Log** | **4.x** | Log aktivitas admin otomatis (ADM-07) |
| **Laravel Scheduler** | built-in | Cron job untuk auto-expire partnership (BR-08) via `php artisan schedule:run` |
| **Laravel Queue** | built-in | Async job untuk notifikasi dan proses berat (driver: database atau Redis) |
| **Laravel Storage** | built-in | Manajemen file upload dengan support local disk dan S3-compatible |
| **Laravel Telescope** | **5.x** | Debug & monitoring tool untuk development environment |

---

### 13.2 Frontend

| Teknologi | Versi | Fungsi |
|---|---|---|
| **Vue 3** | **3.5+** | Progressive JavaScript framework — Composition API, `<script setup>` |
| **Inertia.js** | **2.x** | Adapter Vue untuk Laravel Inertia (menggantikan REST API + SPA terpisah) |
| **Tailwind CSS** | **4.x** | Utility-first CSS framework (versi terbaru dengan engine baru, tanpa config file terpisah) |
| **shadcn-vue** | **Latest** | Port komponen shadcn/ui untuk Vue 3 — dibangun di atas Radix Vue + Tailwind CSS |
| **Radix Vue** | **Latest** | Headless UI primitives yang accessible (digunakan oleh shadcn-vue) |
| **@vue-leaflet/vue-leaflet** | **Latest** | Wrapper Vue 3 untuk Leaflet.js — peta interaktif |
| **VeeValidate** | **4.x** | Form validation untuk Vue 3 (terintegrasi dengan Zod) |
| **Zod** | **3.x** | Schema validation yang terintegrasi dengan VeeValidate |
| **Pinia** | **2.x** | State management untuk Vue 3 (menggantikan Vuex) — digunakan untuk auth state & UI state |
| **@tanstack/vue-query** | **5.x** | Server state management untuk fetching, caching, dan sinkronisasi data |
| **Axios** | **1.x** | HTTP client — digunakan untuk pemanggilan API non-Inertia (contoh: geocoding Nominatim) |
| **Lucide Vue Next** | **Latest** | Icon library konsisten untuk Vue 3 |

---

### 13.3 Database

| Teknologi | Versi | Fungsi |
|---|---|---|
| **MySQL** | **8.0+** | Relational database utama — dijalankan lokal |
| **Laravel Eloquent ORM** | built-in | ORM untuk interaksi database — Model, Relationships, Query Builder |
| **Laravel Migrations** | built-in | Manajemen skema database — versi control DDL |
| **Laravel Seeders** | built-in | Seeder data awal (admin account, kategori produk, dll) |

---

### 13.4 File Storage

| Teknologi | Fungsi |
|---|---|
| **Laravel Storage (local disk)** | Penyimpanan file dokumen supplier di server lokal — `storage/app/public` |
| **Symbolic Link** | `php artisan storage:link` untuk mengekspos file ke public URL |
| **(Future) S3-Compatible** | Migrasi ke MinIO / AWS S3 / Cloudflare R2 saat production dengan zero code change |

---

### 13.5 Development Tools

| Teknologi | Versi | Fungsi |
|---|---|---|
| **Vite** | **6.x** | Build tool untuk asset frontend (sudah include di Laravel 12) |
| **Laravel Pint** | **Latest** | Code style fixer (PSR-12) untuk PHP |
| **Pest PHP** | **3.x** | Testing framework modern untuk Laravel (BDD-style) |
| **Laravel Sail** | **Latest** | Docker development environment (opsional, untuk konsistensi environment) |

---

### 13.6 Deployment (Target)

| Layer | Platform |
|---|---|
| **Application** | VPS (Ubuntu 24.04) / Shared Hosting dengan PHP 8.3+ |
| **Web Server** | Nginx + PHP-FPM |
| **Database** | MySQL 8.0 (lokal / managed DB) |
| **File Storage** | Local disk (development) → S3-compatible (production) |
| **Process Manager** | Supervisor (untuk Laravel Queue Worker) |
| **SSL** | Let's Encrypt via Certbot |

---

### 13.7 Catatan Arsitektur — Inertia.js vs REST API Terpisah

MBGBrain v4 menggunakan **Laravel + Inertia.js + Vue 3 sebagai monolith** (bukan decoupled REST API + SPA terpisah seperti v3). Ini berarti:

- Tidak ada Next.js. Vue 3 berjalan sebagai template engine di dalam Laravel.
- Routing tetap menggunakan Laravel Routes (`routes/web.php`), bukan API route terpisah.
- Data dari controller dikirim ke komponen Vue via Inertia **props** — tidak perlu Axios untuk halaman utama.
- Axios tetap digunakan untuk request minor yang tidak perlu page-reload (contoh: geocoding Nominatim, toggle notifikasi read).
- Laravel Sanctum masih dipasang untuk kebutuhan API endpoint tertentu (mobile future, atau integrasi eksternal).
- Autentikasi menggunakan **Laravel session + Sanctum CSRF** untuk SPA mode — bukan token stateless.

---

## 14. Security Requirements

| Kode | Requirement | Implementasi di Laravel 12 |
|---|---|---|
| SEC-01 | Autentikasi | Laravel Sanctum — session-based untuk Inertia SPA, token-based untuk API eksternal. |
| SEC-02 | Hashing Password | `Hash::make()` menggunakan bcrypt dengan cost factor default Laravel (12). Tidak pernah simpan plain text. |
| SEC-03 | RBAC | Spatie Laravel Permission — role `supplier`, `sppg`, `admin` dengan middleware `role:admin` di routes. |
| SEC-04 | Upload Validation | Validasi via Laravel `$request->validate()`: `mimes:pdf,jpg,jpeg,png`, `max:5120` (5MB). File disimpan dengan nama UUID random via `Storage::putFileAs()`. |
| SEC-05 | Rate Limiting | Laravel `throttle` middleware di routes auth: `Route::middleware(['throttle:10,1'])` (10 req/menit per IP). |
| SEC-06 | Input Validation | Semua input divalidasi via Laravel Form Request classes. Eloquent ORM mencegah raw SQL injection. |
| SEC-07 | CORS | Dikonfigurasi via `config/cors.php` — hanya domain frontend yang terdaftar. Untuk Inertia, CORS tidak relevan karena same-origin. |
| SEC-08 | Env Variables | Semua secret di `.env` — tidak pernah di-commit ke repository. Laravel `config()` helper mengakses nilai env. |
| SEC-09 | HTTPS | Nginx dikonfigurasi redirect HTTP → HTTPS. Laravel `APP_URL` dan `ASSET_URL` menggunakan https. |
| SEC-10 | CSRF Protection | Laravel CSRF token otomatis di semua form — Inertia handle CSRF header secara transparan. |
| SEC-11 | Mass Assignment Protection | Semua Eloquent model wajib mendefinisikan `$fillable` atau `$guarded`. |

---

## 15. Struktur Proyek

### 15.1 Backend Structure (Laravel 12)

```
├── app/
│   ├── Console/
│   │   └── Commands/
│   │       └── ExpirePartnerships.php      # Artisan command untuk BR-08 auto-expire
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Auth/
│   │   │   │   ├── RegisterController.php
│   │   │   │   └── LoginController.php
│   │   │   ├── Supplier/
│   │   │   │   ├── ProfileController.php
│   │   │   │   ├── DocumentController.php
│   │   │   │   └── PartnershipController.php
│   │   │   ├── Sppg/
│   │   │   │   ├── ProfileController.php
│   │   │   │   ├── ProcurementController.php
│   │   │   │   └── PartnershipController.php
│   │   │   ├── Matching/
│   │   │   │   └── MatchingController.php
│   │   │   ├── Notification/
│   │   │   │   └── NotificationController.php
│   │   │   └── Admin/
│   │   │       ├── DashboardController.php
│   │   │       ├── SupplierVerificationController.php
│   │   │       ├── SppgVerificationController.php
│   │   │       └── UserController.php
│   │   ├── Middleware/
│   │   │   └── CheckRole.php               # Custom middleware cek role
│   │   └── Requests/
│   │       ├── Auth/
│   │       │   ├── RegisterSupplierRequest.php
│   │       │   └── RegisterSppgRequest.php
│   │       ├── Supplier/
│   │       │   ├── UpdateProfileRequest.php
│   │       │   └── UploadDocumentRequest.php
│   │       ├── Sppg/
│   │       │   └── CreateProcurementRequest.php
│   │       └── Admin/
│   │           └── VerificationRequest.php
│   ├── Models/
│   │   ├── User.php
│   │   ├── Supplier.php
│   │   ├── SupplierDocument.php
│   │   ├── Sppg.php
│   │   ├── ProcurementRequest.php
│   │   ├── MatchingResult.php
│   │   ├── Partnership.php
│   │   └── Notification.php                # Model notifikasi (Laravel built-in)
│   ├── Notifications/
│   │   ├── SupplierVerified.php
│   │   ├── SppgVerified.php
│   │   ├── PartnershipRequested.php
│   │   ├── PartnershipAccepted.php
│   │   ├── PartnershipRejected.php
│   │   └── PartnershipExpired.php
│   ├── Services/
│   │   ├── MatchingService.php             # Implementasi algoritma SAW
│   │   ├── HaversineService.php            # Formula perhitungan jarak
│   │   ├── DocumentScoreService.php        # Kalkulasi skor dokumen
│   │   └── StorageService.php             # Abstraksi upload/delete file
│   └── Policies/
│       ├── SupplierPolicy.php
│       ├── SppgPolicy.php
│       └── PartnershipPolicy.php
├── bootstrap/
│   └── app.php                             # Laravel 12 new bootstrap (tidak ada Kernel.php)
├── config/
│   ├── cors.php
│   ├── sanctum.php
│   └── permission.php                      # Spatie permission config
├── database/
│   ├── migrations/
│   │   ├── 2024_01_01_000001_create_users_table.php
│   │   ├── 2024_01_01_000002_create_suppliers_table.php
│   │   ├── 2024_01_01_000003_create_supplier_documents_table.php
│   │   ├── 2024_01_01_000004_create_sppg_table.php
│   │   ├── 2024_01_01_000005_create_procurement_requests_table.php
│   │   ├── 2024_01_01_000006_create_matching_results_table.php
│   │   ├── 2024_01_01_000007_create_partnerships_table.php
│   │   └── 2024_01_01_000008_create_notifications_table.php
│   └── seeders/
│       ├── DatabaseSeeder.php
│       └── AdminSeeder.php
├── routes/
│   ├── web.php                             # Route utama (Inertia pages)
│   ├── api.php                             # Route API (Sanctum token, future use)
│   └── auth.php                            # Route autentikasi
└── resources/
    ├── js/
    │   ├── app.js                          # Entry point Vue + Inertia
    │   ├── Pages/
    │   │   ├── Home/
    │   │   │   └── Index.vue               # Homepage publik
    │   │   ├── Auth/
    │   │   │   ├── Login.vue
    │   │   │   ├── RegisterSupplier.vue
    │   │   │   └── RegisterSppg.vue
    │   │   ├── Supplier/
    │   │   │   ├── Dashboard.vue
    │   │   │   ├── Profile.vue
    │   │   │   ├── Documents.vue
    │   │   │   └── Partnerships.vue
    │   │   ├── Sppg/
    │   │   │   ├── Dashboard.vue
    │   │   │   ├── Profile.vue
    │   │   │   ├── Procurement/
    │   │   │   │   ├── Index.vue
    │   │   │   │   ├── Create.vue
    │   │   │   │   ├── Show.vue
    │   │   │   │   └── Matching.vue        # Halaman hasil matching + peta
    │   │   │   └── Partnerships.vue
    │   │   └── Admin/
    │   │       ├── Dashboard.vue
    │   │       ├── Suppliers/
    │   │       │   ├── Index.vue
    │   │       │   └── Show.vue
    │   │       ├── Sppg/
    │   │       │   ├── Index.vue
    │   │       │   └── Show.vue
    │   │       └── Users/
    │   │           └── Index.vue
    │   ├── Components/
    │   │   ├── Layout/
    │   │   │   ├── AppLayout.vue           # Layout utama dengan sidebar + topbar
    │   │   │   ├── Sidebar.vue
    │   │   │   ├── Topbar.vue
    │   │   │   └── GuestLayout.vue         # Layout untuk halaman publik
    │   │   ├── Maps/
    │   │   │   ├── LocationPicker.vue      # Peta interaktif input lokasi
    │   │   │   └── SupplierMap.vue         # Peta hasil matching
    │   │   ├── Notifications/
    │   │   │   ├── NotificationBell.vue
    │   │   │   └── NotificationList.vue
    │   │   └── Common/
    │   │       ├── StatusBadge.vue
    │   │       ├── ScoreBar.vue
    │   │       ├── KpiCard.vue
    │   │       ├── DataTable.vue
    │   │       ├── EmptyState.vue
    │   │       └── ConfirmDialog.vue
    │   ├── Composables/
    │   │   ├── useAuth.js                  # Composable autentikasi
    │   │   ├── useNotifications.js
    │   │   ├── useMatching.js
    │   │   └── useGeocoding.js             # Nominatim geocoding
    │   └── Stores/
    │       ├── auth.js                     # Pinia store untuk auth state
    │       └── notification.js             # Pinia store untuk notifikasi
    ├── css/
    │   └── app.css                         # Tailwind CSS 4 import
    └── views/
        └── app.blade.php                   # Root Blade template untuk Inertia
```

---

### 15.2 Scheduler & Queue

```php
// routes/console.php (Laravel 12 — menggantikan Kernel.php untuk schedule)
Schedule::command('partnerships:expire')->hourly();
```

```php
// app/Console/Commands/ExpirePartnerships.php
// Menjalankan UPDATE partnerships SET status='EXPIRED'
// WHERE status='PENDING' AND requested_at < NOW() - INTERVAL 7 DAY
```

---

## 16. Error Handling & Validasi

### 16.1 Validasi Form (Frontend — VeeValidate + Zod)

| Field | Aturan Validasi |
|---|---|
| Email | Format email valid, maks 255 karakter |
| Password | Minimal 8 karakter, mengandung huruf besar, huruf kecil, dan angka |
| Nomor Telepon | Hanya angka, diawali 08 atau +62, 10-13 digit |
| Kapasitas Harian | Angka positif, lebih dari 0 |
| Radius Pencarian | Antara 1 km sampai 500 km |
| Jumlah Kebutuhan | Angka positif, lebih dari 0 |
| File Upload | Maks 5MB, ekstensi: pdf / jpg / jpeg / png |

### 16.2 Validasi Backend (Laravel Form Request)

Seluruh input divalidasi via Laravel Form Request classes sebelum mencapai controller. Error dikembalikan otomatis dalam format JSON 422 oleh Laravel.

### 16.3 Global Exception Handler

Laravel 12 menggunakan `bootstrap/app.php` untuk mendaftarkan exception handler:

```php
->withExceptions(function (Exceptions $exceptions) {
    $exceptions->render(function (ValidationException $e, Request $request) {
        return response()->json([
            'success' => false,
            'message' => 'Validasi gagal',
            'errors' => $e->errors(),
        ], 422);
    });
})
```

### 16.4 HTTP Status Code yang Digunakan

| Skenario | Status Code |
|---|---|
| Email sudah terdaftar saat registrasi | 409 Conflict |
| Login dengan kredensial salah | 401 Unauthorized |
| Akses endpoint role tidak sesuai | 403 Forbidden |
| Data tidak ditemukan | 404 Not Found |
| Supplier belum upload dokumen tapi ajukan verifikasi | 400 Bad Request |
| Duplikasi permintaan kerja sama ke supplier yang sama | 409 Conflict |
| Validasi Laravel gagal | 422 Unprocessable Entity |

---

## 17. Future Enhancements

| Prioritas | Fitur | Deskripsi |
|---|---|---|
| High | AI Assistant (Gemini / OpenAI) | Chatbot berbasis API AI untuk membantu supplier mengisi profil dan menjawab pertanyaan umum — implementasi via Laravel HTTP Client ke AI API |
| High | Email Notification | Notifikasi via email untuk event penting menggunakan Laravel Mail + Mailtrap (dev) / SMTP production |
| Medium | Supplier Rating System | Sistem penilaian berbintang dari SPPG terhadap supplier setelah kerja sama selesai, yang juga mempengaruhi skor matching |
| Medium | Analytics Dashboard | Dashboard dengan grafik menggunakan Chart.js via Vue: pertumbuhan supplier per bulan, distribusi geografis, kategori produk terpopuler |
| Medium | WhatsApp Notification | Notifikasi via WhatsApp Business API (Fonnte / Wablas) sebagai alternatif email — terintegrasi via Laravel Notification channel |
| Low | Mobile Application | REST API endpoint (sudah disiapkan di `routes/api.php`) untuk dikonsumsi aplikasi Flutter/React Native di masa depan |
| Low | Multi-region Support | Dukungan pengelolaan data per wilayah/provinsi dengan admin regional |
| Low | Export Data | Fitur export ke Excel/PDF menggunakan package `maatwebsite/excel` dan `barryvdh/laravel-dompdf` |
| Low | Real-time Notification | Upgrade notifikasi ke real-time via Laravel Broadcasting + Pusher / Laravel Reverb (self-hosted WebSocket) |

---

*Dokumen ini merupakan living document yang akan diperbarui seiring perkembangan produk.*

*PRD MBGBrain v4.0 — Terakhir diperbarui: Juni 2026*
*Perubahan dari v3: Migrasi total tech stack ke Laravel 12 (monolith Inertia), Vue 3, Tailwind CSS 4, shadcn-vue, MySQL lokal. Eliminasi FastAPI, Next.js, Python, Supabase, PostgreSQL.*