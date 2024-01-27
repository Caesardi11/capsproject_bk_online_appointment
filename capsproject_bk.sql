-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 27 Jan 2024 pada 07.00
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `capsproject_bk`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `akun`
--

CREATE TABLE `akun` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','dokter','pasien') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `daftar_poli`
--

CREATE TABLE `daftar_poli` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_pasien` int(11) UNSIGNED NOT NULL,
  `id_jadwal` int(11) UNSIGNED DEFAULT NULL,
  `keluhan` text NOT NULL,
  `no_antrian` int(11) UNSIGNED NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `daftar_poli`
--

INSERT INTO `daftar_poli` (`id`, `id_pasien`, `id_jadwal`, `keluhan`, `no_antrian`, `status`) VALUES
(11, 10, NULL, 'Matanya pusing, bibirnya tidak bisa dengar.', 1, 'selesai'),
(15, 7, 6, 'cekcekcek', 1, 'selesai'),
(16, 7, NULL, 'bismillah cek', 2, 'selesai'),
(18, 10, NULL, 'Sakit', 4, 'selesai'),
(19, 16, 6, 'Gigi taring saya keropos, bagaimana caranya agak tidak ngilu saat menghancurkan makanannya?', 2, 'selesai'),
(20, 7, NULL, 'anak saya meriang', 1, 'selesai');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_periksa`
--

CREATE TABLE `detail_periksa` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_periksa` int(11) UNSIGNED NOT NULL,
  `id_obat` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `detail_periksa`
--

INSERT INTO `detail_periksa` (`id`, `id_periksa`, `id_obat`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 2, 3),
(4, 2, 4),
(5, 3, 1),
(6, 3, 4),
(8, 5, 1),
(9, 5, 2),
(10, 5, 3),
(11, 6, 1),
(12, 6, 3),
(13, 6, 4),
(14, 7, 3),
(15, 7, 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokter`
--

CREATE TABLE `dokter` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_akun` int(11) UNSIGNED NOT NULL,
  `id_poli` int(11) UNSIGNED DEFAULT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_hp` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `dokter`
--

INSERT INTO `dokter` (`id`, `id_akun`, `id_poli`, `nama`, `alamat`, `no_hp`) VALUES
(4, 13, 4, 'Dokter Budi', 'Sorong', '8759331'),
(5, 15, 1, 'Dokter Irene', 'Surabaya', '9992817'),
(7, 17, 2, 'Dokter Ani', 'Ternate', '8829876');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal_periksa`
--

CREATE TABLE `jadwal_periksa` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_dokter` int(11) UNSIGNED NOT NULL,
  `hari` enum('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu') NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `aktif` varchar(3) NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `jadwal_periksa`
--

INSERT INTO `jadwal_periksa` (`id`, `id_dokter`, `hari`, `jam_mulai`, `jam_selesai`, `aktif`) VALUES
(6, 7, 'Senin', '15:00:00', '16:00:00', 'no'),
(32, 7, 'Kamis', '13:18:00', '15:18:00', 'yes'),
(33, 4, 'Kamis', '15:23:00', '17:23:00', 'no'),
(34, 4, 'Rabu', '13:23:00', '14:23:00', 'no'),
(35, 4, 'Jumat', '19:25:00', '21:25:00', 'yes'),
(37, 4, 'Sabtu', '15:28:00', '16:28:00', 'no');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `obat`
--

CREATE TABLE `obat` (
  `id` int(11) UNSIGNED NOT NULL,
  `nama_obat` varchar(100) NOT NULL,
  `kemasan` varchar(35) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `obat`
--

INSERT INTO `obat` (`id`, `nama_obat`, `kemasan`, `harga`) VALUES
(1, 'ACT (Artesunate tablet 50 mg + Amodiaquine anhydrida tablet 200 mg)', '2 blister @ 12 tablet / kotak', 44000),
(2, 'ACT (Artesunate tablet 50 mg + Amodiaquine anhydrida tablet 200 mg', '3 blister @ 8 tablet / kotak', 44000),
(3, 'Albendasol suspensi 200 mg/5 ml', 'Ktk 10 btl @ 10 ml', 6000),
(4, 'Albendazol tablet/ tablet kunyah 400 mg', 'ktk 5 x 6 tablet', 16000),
(5, 'Alopurinol tablet 100 mg', 'ktk 10 x 10 tablet', 16000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pasien`
--

CREATE TABLE `pasien` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_akun` int(11) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_ktp` varchar(255) NOT NULL,
  `no_hp` varchar(50) NOT NULL,
  `no_rm` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pasien`
--

INSERT INTO `pasien` (`id`, `id_akun`, `nama`, `alamat`, `no_ktp`, `no_hp`, `no_rm`) VALUES
(7, 4, 'Enembe', 'jalan jalan2', '4444', '51234123', '202312-3'),
(9, 22, 'Suyadi Santoso', 'Bengkulu', '888213618238', '7872811', '202312-2'),
(10, 23, 'Ahmad Ehmedi', 'Madura', '89898128371', '8888213', '202312-3'),
(15, 33, 'Ardi Caesar', 'Semarang', '927107882671', '081248308171', '202401-5'),
(16, 34, 'Deni', 'Semarang', '8872219755191', '085388291321', '202401-5');

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `periksa`
--

CREATE TABLE `periksa` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_daftar_poli` int(11) UNSIGNED NOT NULL,
  `tgl_periksa` datetime NOT NULL,
  `catatan` text NOT NULL,
  `biaya_periksa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `periksa`
--

INSERT INTO `periksa` (`id`, `id_daftar_poli`, `tgl_periksa`, `catatan`, `biaya_periksa`) VALUES
(1, 11, '2024-01-05 15:13:19', 'OK', 194000),
(2, 15, '2024-01-05 21:37:29', 'okeokeoekoke', 216000),
(3, 16, '2024-01-05 22:02:57', 'oke sudah bisa', 210000),
(5, 18, '2024-01-06 13:58:27', 'Oke', 244000),
(6, 19, '2024-01-08 11:06:16', 'Obat yang saya sarankan diminum saja insha allah sembuh.', 216000),
(7, 20, '2024-01-27 09:19:41', 'semoga cepat sembuh', 172000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `poli`
--

CREATE TABLE `poli` (
  `id` int(11) UNSIGNED NOT NULL,
  `nama_poli` varchar(25) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `poli`
--

INSERT INTO `poli` (`id`, `nama_poli`, `keterangan`) VALUES
(1, 'Poli Umum', 'ini adalah poli umum'),
(2, 'Poli Gigi', 'ini adalah poli gigi'),
(4, 'Poli Anak', 'ini adalah poli anak'),
(5, 'Poli Spesialis Paru', 'ini adalah poli spesialis paru'),
(6, 'Poli Gizi', 'ini adalah poli gizi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` enum('admin','dokter','pasien') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(4, 'Enembe', 'dia33@gmail.com', NULL, '$2y$12$xwwgsGBOblIXX22m7CTb5u4duvPU.1B6WWs.mpbShtPQ7ajJgJKv.', NULL, '2023-12-30 03:20:12', '2023-12-30 03:20:12', 'pasien'),
(13, 'Dokter Budi', 'dokterbudi@gmail.com', NULL, '$2y$12$vi0BvLbE/mWK6DDtqs5CdOHmLe39AiZzBt5vPQ1QVTEbBKF4/3fP2', NULL, '2023-12-30 22:22:19', '2024-01-26 19:45:10', 'dokter'),
(15, 'Dokter Irene', 'dokterirene@gmail.com', NULL, '$2y$12$CJkh5sHz8QthWBzVZVlzQO1gdVNqjEpnUWv5cZAhQK37OfEF5.oz2', NULL, '2023-12-30 22:36:47', '2023-12-30 22:36:47', 'dokter'),
(17, 'Dokter Ani', 'dokterani@gmail.com', NULL, '$2y$12$eE9t6rQHN4V/T.x1M0DpAO5AZTKUJWi6KliDGP9IOMJJMjgiZNMl.', NULL, '2023-12-30 23:54:19', '2024-01-07 21:04:20', 'dokter'),
(18, 'admin', 'admin@gmail.com', NULL, '$2y$12$kwxXUhhwowxAq5Rr/jCTLu75mvc2kl9lcE5eoBPCyy.1SKkuDUdrS', NULL, '2023-12-31 00:04:14', '2023-12-31 00:04:14', 'admin'),
(22, 'Suyadi Santoso', 'susan@gmail.com', NULL, '$2y$12$B73LRLS3uKT2cK90EA2BheulxVdVhSySxFjNxtwYZHG1IhXL.kK/O', NULL, '2023-12-31 05:06:10', '2023-12-31 05:06:10', 'pasien'),
(23, 'Ahmad Ehmedi', 'ahmad@gmail.com', NULL, '$2y$12$Dlga1NivwppTRuA1p26z7uVbinFEvE1oUbHowxF3VKiKg62DQ3HJy', NULL, '2023-12-31 05:11:05', '2023-12-31 05:11:05', 'pasien'),
(33, 'Ardi Caesar', 'ardi@gmail.com', NULL, '$2y$12$cyCav9JIMRqsrWfOmveIy.cR/HE3W1hqhgD5vWuQwN8dAQxTi3eRe', NULL, '2024-01-07 20:59:44', '2024-01-07 20:59:44', 'pasien'),
(34, 'Deni', 'deni@gmail.com', NULL, '$2y$12$bbXXhpDwJt2o707Kz1hsruIYuj7aGLeH2tLeSnMON8fOhOe/9Rxgq', NULL, '2024-01-07 21:01:51', '2024-01-07 21:01:51', 'pasien');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `daftar_poli`
--
ALTER TABLE `daftar_poli`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pasien` (`id_pasien`),
  ADD KEY `id_jadwal` (`id_jadwal`);

--
-- Indeks untuk tabel `detail_periksa`
--
ALTER TABLE `detail_periksa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_periksa` (`id_periksa`),
  ADD KEY `id_obat` (`id_obat`);

--
-- Indeks untuk tabel `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_akun` (`id_akun`),
  ADD KEY `id_poli` (`id_poli`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jadwal_periksa`
--
ALTER TABLE `jadwal_periksa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_dokter` (`id_dokter`) USING BTREE;

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_akun` (`id_akun`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `periksa`
--
ALTER TABLE `periksa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_daftar_poli` (`id_daftar_poli`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `poli`
--
ALTER TABLE `poli`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `akun`
--
ALTER TABLE `akun`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `daftar_poli`
--
ALTER TABLE `daftar_poli`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `detail_periksa`
--
ALTER TABLE `detail_periksa`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `dokter`
--
ALTER TABLE `dokter`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jadwal_periksa`
--
ALTER TABLE `jadwal_periksa`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `obat`
--
ALTER TABLE `obat`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `periksa`
--
ALTER TABLE `periksa`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `poli`
--
ALTER TABLE `poli`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `daftar_poli`
--
ALTER TABLE `daftar_poli`
  ADD CONSTRAINT `daftar_poli_ibfk_1` FOREIGN KEY (`id_pasien`) REFERENCES `pasien` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `daftar_poli_ibfk_2` FOREIGN KEY (`id_jadwal`) REFERENCES `jadwal_periksa` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `detail_periksa`
--
ALTER TABLE `detail_periksa`
  ADD CONSTRAINT `detail_periksa_ibfk_1` FOREIGN KEY (`id_periksa`) REFERENCES `periksa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_periksa_ibfk_2` FOREIGN KEY (`id_obat`) REFERENCES `obat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `dokter`
--
ALTER TABLE `dokter`
  ADD CONSTRAINT `dokter_ibfk_1` FOREIGN KEY (`id_poli`) REFERENCES `poli` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `jadwal_periksa`
--
ALTER TABLE `jadwal_periksa`
  ADD CONSTRAINT `jadwal_periksa_ibfk_1` FOREIGN KEY (`id_dokter`) REFERENCES `dokter` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `periksa`
--
ALTER TABLE `periksa`
  ADD CONSTRAINT `periksa_ibfk_1` FOREIGN KEY (`id_daftar_poli`) REFERENCES `daftar_poli` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
