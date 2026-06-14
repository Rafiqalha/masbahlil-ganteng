<div align="center">
  <br />
    <img src="public/logos/logo-masbahlil.png" alt="MBGBrain Logo" width="300" />
  <br />

  <h1>🚀 MBGBrain Enterprise Platform</h1>
  <p>
    <strong>Sistem Cerdas Bertenaga AI untuk Orkestrasi Program Makan Bergizi Gratis (MBG)</strong>
  </p>
  
  <p>
    <a href="https://laravel.com"><img src="https://img.shields.io/badge/Laravel-11-FF2D20?style=for-the-badge&logo=laravel" alt="Laravel 11"></a>
    <a href="https://vuejs.org"><img src="https://img.shields.io/badge/Vue.js-3.0-4FC08D?style=for-the-badge&logo=vuedotjs" alt="Vue 3"></a>
    <a href="https://inertiajs.com/"><img src="https://img.shields.io/badge/Inertia.js-Modern-9553E9?style=for-the-badge&logo=inertia" alt="Inertia.js"></a>
    <a href="https://tailwindcss.com/"><img src="https://img.shields.io/badge/Tailwind_CSS-3.4-38B2AC?style=for-the-badge&logo=tailwind-css" alt="Tailwind CSS"></a>
    <a href="#"><img src="https://img.shields.io/badge/Enterprise-Ready-2A9D5C?style=for-the-badge&logo=shield" alt="Enterprise Ready"></a>
  </p>
</div>

<hr />

## 🌟 Tinjauan Arsitektur

**MBGBrain** adalah platform manajemen pengadaan *(Procurement Management System)* tingkat korporasi *(enterprise-grade)* yang dirancang khusus untuk memfasilitasi dan mengawasi Program Makan Bergizi Gratis. 

Sistem ini menjembatani Satuan Pelayanan Pendidikan dan Gizi (SPPG) dengan ribuan UMKM/Supplier melalui algoritma pencocokan cerdas, verifikasi dokumen berbasis AI, dan pemantauan distribusi berbasis geolokasi radius (KM).

<br />

## 🎯 Fitur Inti (Core Modules)

<table width="100%">
  <tr>
    <td width="50%" valign="top">
      <h3>🛡️ Sistem Verifikasi Cerdas</h3>
      <p>Otomatisasi pengecekan kepatuhan regulasi (NIB, SIUP, Sertifikat Halal) dengan alur persetujuan admin (Admin Approval Workflow) untuk memastikan integritas supplier UMKM.</p>
    </td>
    <td width="50%" valign="top">
      <h3>⚡ Real-Time Matchmaking</h3>
      <p>Sistem lelang cerdas yang mencocokkan kebutuhan kuantitas, harga batas maksimal, dan radius jarak antara SPPG dan Supplier secara presisi.</p>
    </td>
  </tr>
  <tr>
    <td width="50%" valign="top">
      <h3>🗺️ Geo-Spatial Monitoring</h3>
      <p>Integrasi Leaflet/Maps tingkat lanjut yang memvalidasi radius operasional Supplier terhadap koordinat SPPG untuk efisiensi logistik.</p>
    </td>
    <td width="50%" valign="top">
      <h3>📊 Enterprise Dashboard</h3>
      <p>Panel instrumen komprehensif dengan metrik waktu nyata (KPIs), animasi mulus, dan desain <i>dark mode premium</i>.</p>
    </td>
  </tr>
</table>

<br />

## 🏗️ Standar Infrastruktur

Sistem ini dibangun di atas fondasi teknologi modern *(Monolith SPA)* untuk menjamin keandalan, keamanan, dan pengalaman pengguna (*UX*) yang tanpa jeda.

- **Backend Architecture**: Laravel 11 (PHP 8.2+) dengan pola desain <i>Service Repository</i>.
- **Frontend Engine**: Vue 3 + <i>Composition API</i>, dikompilasi super cepat menggunakan Vite.
- **State & Routing**: Inertia.js untuk pengalaman SPA (Single Page Application) tanpa REST API <i>overhead</i>.
- **Styling System**: Tailwind CSS dengan <i>Design System</i> Kustom (Warna Hijau MBG & Tipografi Premium).
- **Security**: Proteksi CSRF, Enkripsi Kata Sandi (Bcrypt), Pembatasan Akses berbasis Peran (*Role-based Access Control* dengan Spatie).

<br />

## ⚙️ Persyaratan Instalasi & Eksekusi

```bash
# 1. Kloning repositori korporat ini
git clone https://github.com/Rafiqalha/masbahlil-ganteng.git
cd masbahlil-ganteng

# 2. Pasang dependensi Backend & Frontend
composer install
npm install

# 3. Persiapkan konfigurasi lingkungan (Environment)
cp .env.example .env
php artisan key:generate

# 4. Migrasi Skema Database & Data Awal (Seeder)
php artisan migrate --seed

# 5. Kompilasi Aset Frontend (Real-time Watcher)
npm run dev

# 6. Jalankan Server Layanan (Buka Terminal Baru)
php artisan serve
```

<br />

## 🔒 Privasi & Keamanan (Compliance)

Aplikasi ini mengimplementasikan perlindungan terhadap serangan <i>XSS, SQL Injection</i>, dan <i>CSRF</i> standar industri. Seluruh dokumen rahasia supplier dilindungi secara ketat di dalam infrastruktur <i>Storage Disk</i> terisolasi dan hanya dapat diakses melalui middleware otentikasi.

---

<div align="center">
  <p>Dikembangkan dengan 💚 untuk Masa Depan Gizi Indonesia.</p>
  <p><b>MBGBrain © 2026. Hak Cipta Dilindungi Undang-Undang.</b></p>
</div>
