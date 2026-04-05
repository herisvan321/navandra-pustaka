# Panduan Admin Nevandra Pustaka Nusantara

## Arsitektur
Aplikasi ini menggunakan pola **Service/Repository** untuk memisahkan logika bisnis dari kontroler.

- **Model**: Definisi data Elloquent.
- **Repository**: Berlokasi di `app/Repositories`. Digunakan untuk interaksi database langsung.
- **Service**: Berlokasi di `app/Services`. Berisi logika bisnis utama yang memproses data sebelum dikirim ke repository atau setelah diambil dari repository.
- **Controller**: Berlokasi di `app/Http/Controllers/Admin`. Hanya bertugas menangani input/output (request/response).
- **Form Request**: Berlokasi di `app/Http/Requests/Admin`. Digunakan untuk validasi input menggunakan `Validator::make`.

## Fitur Gambar
Seluruh unggahan gambar akan dikonversi menjadi format **WebP** untuk optimasi kecepatan akses.

## Tema
Dukungan **Dark Mode** sudah terintegrasi dan tersimpan di `localStorage` agar tetap konsisten saat berpindah halaman.

## Perintah Penting
- `php artisan test`: Menjalankan seluruh unit test.
- `php artisan migrate`: Menjalankan migrasi database terbaru.
