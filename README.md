# Projek Laravel Capstone-project-BK

Selamat datang di projek Laravel Capstone-project-BK! Ikuti langkah-langkah di bawah untuk menjalankannya.

## Instalasi

1. Clone repository:

    ```bash
    git clone https://github.com/Caesardi11/capsproject_bk_online_appointment.git
    ```

2. Instal dependensi menggunakan Composer:

    ```bash
    composer install
    ```

3. Salin file `.env.example` menjadi `.env`:

    ```bash
    copy .env.example .env
    ```

4. Import file SQL yang ada ke dalam database.

5. Edit file `.env` ganti nama database yang ada didalamnya.

6. Generate kunci aplikasi:

    ```bash
    php artisan key:generate
    ```

7. Jalankan server pengembangan:

    ```bash
    php artisan serve
    ```

8. Buka web browser dan kunjungi.

## Login to the app:

| role   | email                | password        |
| ------ | -------------------- | --------------- |
| Admin  | admin@gmail.com      | admin@gmail.com |
| Doctor | dokterbudi@gmail.com | 123             |
| Pasien | ahmad@gmail.com      | 123             |

## Database

Database yang digunakan yaitu `capsproject_bk`

## Langkah Tambahan

-   Anda mungkin perlu mengonfigurasi pengaturan lainnya di file `.env` berdasarkan kebutuhan proyek Anda.

-   Jelajahi dan sesuaikan projek sesuai kebutuhan Anda!

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>
