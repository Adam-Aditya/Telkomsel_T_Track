# Telkomsel T-Track — Logistik & Sirkulasi Aset Internal

Telkomsel T-Track adalah sistem manajemen internal berbasis web yang dirancang untuk memantau, mendistribusikan, dan mengaudit pergerakan perangkat logistik serta infrastruktur jaringan secara real-time. Proyek ini dibangun menggunakan Laravel 12, PHP 8.2, dan Tailwind CSS dengan arsitektur Glassmorphic UI yang mendukung mode gelap (*Dark Mode*) adaptif.

---

## 🛠️ Prasyarat Sistem (Prerequisites)

Sebelum memulai instalasi, pastikan perangkat Anda telah memenuhi spesifikasi berikut:
* PHP >= 8.2 (Sangat direkomendasikan PHP 8.2.12 ke atas)
* Composer >= 2.x
* Node.js & NPM (Untuk kompilasi aset Tailwind)
* MySQL atau MariaDB sebagai basis data eksternal

---

## 📥 Langkah Instalasi (Installation Steps)

Ikuti urutan perintah di bawah ini melalui terminal/command prompt untuk memasang proyek di lingkungan lokal Anda:

### 1. Kloning Repositori & Masuk ke Direktori
```bash
git clone [https://github.com/username/telkomsel-t-track.git](https://github.com/username/telkomsel-t-track.git)
cd telkomsel-t-track

composer install

npm install

Buka file .env yang baru terbentuk menggunakan kode editor, lalu sesuaikan koneksi database:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=telkomsel_t_track
DB_USERNAME=root
DB_PASSWORD=

Generate Application key, migrate, dan jalankan.
php artisan key:generate

php artisan migrate:fresh --seed

php artisan serve

npm run dev

Akun, role, dan password
admin1@gmail.com <br> admin2@gmail.com, admin, admin1234
staff1@gmail.com <br> staff2@gmail.com, staff, staff1234
manager1@gmail.com, manager, manager1234