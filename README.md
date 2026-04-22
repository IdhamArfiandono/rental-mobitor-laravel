# RentMobitor

RentMobitor adalah aplikasi rental kendaraan berbasis Laravel 11 untuk mengelola katalog kendaraan, pemesanan, pembayaran, operasional staff, dan laporan admin dalam satu sistem.

## Fitur Utama

### Public
- Landing page dan katalog kendaraan.
- Detail kendaraan lengkap dengan harga sewa per hari.
- Registrasi dan login dengan Laravel Breeze.

### Pelanggan
- Dashboard pelanggan untuk melihat rental aktif, terkonfirmasi, dan riwayat.
- Membuat pemesanan kendaraan.
- Melihat detail dan membatalkan rental tertentu.
- Mengubah profil akun.

### Staff
- Dashboard operasional harian.
- Melihat rental mulai hari ini, pengembalian hari ini, dan kendaraan maintenance.
- Mengelola status rental, perpanjangan sewa, dan catatan kerusakan.
- Memproses konfirmasi pembayaran dan cetak receipt.
- Memantau status kendaraan.

### Admin
- Dashboard ringkasan bisnis.
- CRUD kendaraan.
- CRUD pengguna.
- Laporan pendapatan, statistik rental, kendaraan populer, dan biaya kerusakan.

## Stack

- PHP 8.2+
- Laravel 11
- Laravel Breeze
- Blade
- MySQL
- Tailwind CSS
- Alpine.js
- Vite

## Role Pengguna

- `admin`
- `staff`
- `pelanggan`

Role access dikontrol lewat middleware `role` sehingga tiap dashboard dan fitur hanya bisa diakses oleh role yang sesuai.

## Seeder Demo

Project ini sudah punya seeder untuk user, kendaraan, rental, pembayaran, dan kerusakan.

### Akun demo
- Admin: `admin@rentalmobitor.com` / `admin123`
- Staff: `staff@rentalmobitor.com` / `staff123`
- Pelanggan: `budi@example.com` / `password`

## Instalasi Lokal

1. Clone repository ini.
2. Install dependency PHP.
3. Install dependency frontend.
4. Copy file environment.
5. Generate app key.
6. Atur koneksi database.
7. Jalankan migration dan seeder.
8. Jalankan server aplikasi.

```bash
composer install
npm install
copy .env.example .env
php artisan key:generate
php artisan migrate --seed
composer run dev
```

Jika tidak memakai `composer run dev`, jalankan servis secara terpisah:

```bash
php artisan serve
npm run dev
```

## Konfigurasi Environment

Sesuaikan `.env` terutama bagian berikut:

```env
APP_NAME="RentMobitor"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=rental_mobitor
DB_USERNAME=root
DB_PASSWORD=
```

Pastikan database `rental_mobitor` sudah dibuat sebelum menjalankan migration.

## Script Penting

- `composer run dev` menjalankan Laravel server, queue listener, log watcher, dan Vite sekaligus.
- `npm run dev` menjalankan Vite untuk asset development.
- `npm run build` build asset production.
- `php artisan test` menjalankan test suite.

## Struktur Singkat

```text
app/
  Http/Controllers/
    Admin/
    Customer/
    Public/
    Staff/
  Models/
database/
  migrations/
  seeders/
resources/
  views/
routes/
  web.php
```

## Modul Data

- `vehicles`: data armada kendaraan.
- `rentals`: transaksi penyewaan.
- `rental_extensions`: perpanjangan durasi sewa.
- `payments`: pembayaran rental.
- `damages`: catatan kerusakan kendaraan.
- `users`: akun dengan role berbeda.

## Catatan Pengembangan

- Routing utama ada di `routes/web.php`.
- Sistem memakai resource controller terpisah per role: `Admin`, `Staff`, `Customer`, dan `Public`.
- Relasi model utama ada di `app/Models`.

## License

Project ini menggunakan lisensi MIT.
