<p align="center">
  <img src="assets/banner.png" alt="Ab.sen Banner">
</p>


<p align="center">
  <a href="#" target="_blank">
    <img src="public/logo.png" width="400" alt="Ab.sen Logo">
  </a>
</p>

<p align="center">
  <a href="#"><img src="https://img.shields.io/badge/Laravel-11.x-red?logo=laravel" alt="Laravel"></a>
  <a href="#"><img src="https://img.shields.io/badge/PHP-8.x-blue?logo=php" alt="PHP"></a>
  <a href="#"><img src="https://img.shields.io/badge/Bootstrap-5-purple?logo=bootstrap" alt="Bootstrap"></a>
  <a href="#"><img src="https://img.shields.io/badge/License-MIT-green" alt="License"></a>
</p>

<h2 align="center">📌 Ab.sen — Aplikasi Presensi Online Berbasis Website</h2>

<p align="center">
  Presensi kapan saja, di mana saja, dengan verifikasi wajah dan video untuk kehadiran yang lebih autentik.
</p>

---

## 📖 Tentang Ab.sen
**Ab.sen** adalah aplikasi presensi online berbasis **PHP, Laravel, dan Bootstrap** yang dilengkapi dengan **verifikasi foto wajah dan perekaman video minimal tiga detik** untuk memastikan keaslian data kehadiran.  
Dengan desain responsif, sistem keamanan yang kuat, dan penyimpanan data terpusat, Ab.sen memudahkan proses absensi di instansi, sekolah, atau perusahaan **kapan saja dan di mana saja**.

---

## ✨ Fitur Utama
- 📸 **Verifikasi Wajah** dengan unggah foto & video minimal 3 detik.  
- 🌐 **Akses Web** dari perangkat apa saja yang terhubung internet.  
- 📊 **Laporan Kehadiran** otomatis & riwayat presensi.  
- 🔒 **Keamanan Data** dengan enkripsi & kontrol akses.  
- 🖥 **Antarmuka Responsif** menggunakan Bootstrap 5.  
- ⚡ **Integrasi Fleksibel** dengan sistem manajemen SDM.  

---

## 🛠️ Teknologi yang Digunakan
- **Backend:** PHP 8.x, Laravel 11.x  
- **Frontend:** Bootstrap 5, Blade Templating  
- **Database:** MySQL / MariaDB  
- **Keamanan:** Enkripsi data, kontrol hak akses  
- **Hosting:** Web-based (tidak memerlukan perangkat khusus)  

---

## 📊 Diagram Sistem

### DFD Level 0
<p align="center">
  <img src="public/assets/dfd.png" alt="DFD Ab.sen">
</p>

---

### Flowchart User
<p align="center">
  <img src="public/assets/flowchart_user.png" alt="Flowchart User">
</p>

---

### Flowchart Admin
<p align="center">
  <img src="public/assets/flowchart_admin.png" alt="Flowchart Admin">
</p>

---

### Flowchart Login
<p align="center">
  <img src="public/assets/flowchart_login.png" alt="Flowchart Login">
</p>

---

### ERD (Entity Relationship Diagram)
<p align="center">
  <img src="public/assets/erd.png" alt="ERD Ab.sen">
</p>

---

## 📂 Struktur Database (Ringkas)
| Tabel | Deskripsi |
|-------|-----------|
| **Admin** | Kelola sistem & data kelas |
| **User** | Akses presensi & profil |
| **Kelas** | Data kelas & relasi dengan user |
| **Presensi** | Data kehadiran, foto, video, status |
| **Bergabung** | Relasi user ↔ kelas |

---

## 🚀 Instalasi
```bash
# Clone repository
git clone https://github.com/Marvellbrazil/Ab.sen.git
cd Ab.sen

# Install dependencies
composer install
npm install && npm run dev

# Setup environment
cp .env.example .env
php artisan key:generate

# Konfigurasi database di file .env
php artisan migrate --seed

# Jalankan server
php artisan serve

```

---

### 📲 Hubungi Saya
<p align="center">
  <a href="https://www.instagram.com/akufaisal._/ target="_blank">
    <img src="https://img.shields.io/badge/Instagram-E4405F?style=for-the-badge&logo=instagram&logoColor=white" />
  </a>
  <a href="https://www.linkedin.com/in/marvello-faisal-912132318/" target="_blank">
    <img src="https://img.shields.io/badge/LinkedIn-0A66C2?style=for-the-badge&logo=linkedin&logoColor=white" />
  </a>
</p>
