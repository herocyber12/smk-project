-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versi server:                 10.4.28-MariaDB - mariadb.org binary distribution
-- OS Server:                    Win64
-- HeidiSQL Versi:               12.6.0.6765
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Membuang struktur basisdata untuk smk-skripsi
CREATE DATABASE IF NOT EXISTS `smk-skripsi` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `smk-skripsi`;

-- membuang struktur untuk table smk-skripsi.absen_guru
CREATE TABLE IF NOT EXISTS `absen_guru` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_absen` varchar(50) NOT NULL,
  `id_guru` bigint(20) unsigned NOT NULL,
  `is_absen` tinyint(1) NOT NULL,
  `tanggal` varchar(25) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `absen_guru_id_guru_foreign` (`id_guru`),
  CONSTRAINT `absen_guru_id_guru_foreign` FOREIGN KEY (`id_guru`) REFERENCES `data_guru` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel smk-skripsi.absen_guru: ~2 rows (lebih kurang)
INSERT INTO `absen_guru` (`id`, `id_absen`, `id_guru`, `is_absen`, `tanggal`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(12, 'ID-S3069654', 1, 0, '2024-06-05', '2024-06-05 08:17:21', '2024-06-05 08:17:21', NULL),
	(13, 'ID-S4211063', 2, 1, '2024-06-05', '2024-06-05 08:17:21', '2024-06-05 09:22:00', NULL);

-- membuang struktur untuk table smk-skripsi.absen_murid
CREATE TABLE IF NOT EXISTS `absen_murid` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode_absen` varchar(50) NOT NULL,
  `id_mapel` bigint(20) unsigned NOT NULL,
  `id_murid` bigint(20) unsigned NOT NULL,
  `is_absen` tinyint(1) NOT NULL,
  `tanggal` varchar(25) NOT NULL,
  `path_foto` varchar(225) DEFAULT NULL,
  `tgl_foto_diambil` varchar(25) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `absen_murid_id_mapel_foreign` (`id_mapel`),
  KEY `absen_murid_id_murid_foreign` (`id_murid`),
  CONSTRAINT `absen_murid_id_mapel_foreign` FOREIGN KEY (`id_mapel`) REFERENCES `mapel` (`id`),
  CONSTRAINT `absen_murid_id_murid_foreign` FOREIGN KEY (`id_murid`) REFERENCES `data_murid` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel smk-skripsi.absen_murid: ~2 rows (lebih kurang)
INSERT INTO `absen_murid` (`id`, `kode_absen`, `id_mapel`, `id_murid`, `is_absen`, `tanggal`, `path_foto`, `tgl_foto_diambil`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(4, 'ID-S6202742', 7, 2, 1, '2024-06-05', NULL, NULL, '2024-06-05 09:23:43', '2024-06-05 09:23:43', NULL),
	(5, 'ID-S1523280', 7, 3, 1, '2024-06-05', NULL, NULL, '2024-06-05 09:23:44', '2024-06-05 09:27:57', NULL);

-- membuang struktur untuk table smk-skripsi.data_guru
CREATE TABLE IF NOT EXISTS `data_guru` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode_guru` varchar(255) NOT NULL,
  `nama` varchar(75) NOT NULL,
  `alamat` varchar(150) DEFAULT NULL,
  `no_hp` varchar(13) DEFAULT NULL,
  `path_foto` varchar(150) DEFAULT NULL,
  `id_user` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `data_guru_kode_guru_unique` (`kode_guru`),
  KEY `data_guru_nama_index` (`nama`),
  KEY `data_guru_id_user_foreign` (`id_user`),
  CONSTRAINT `data_guru_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel smk-skripsi.data_guru: ~2 rows (lebih kurang)
INSERT INTO `data_guru` (`id`, `kode_guru`, `nama`, `alamat`, `no_hp`, `path_foto`, `id_user`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'ID-G35747', 'Admin', NULL, NULL, '/storage/profiles/ArjAoamvBX.png', 2, '2024-05-21 09:22:57', '2024-05-28 19:19:25', NULL),
	(2, 'ID-G89371', 'Yusuf Firmanto, S.Kom', NULL, NULL, NULL, 15, '2024-05-22 20:06:52', '2024-05-22 20:49:09', NULL);

-- membuang struktur untuk table smk-skripsi.data_murid
CREATE TABLE IF NOT EXISTS `data_murid` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode_profile` varchar(50) NOT NULL,
  `nama` varchar(75) NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `no_hp` varchar(50) NOT NULL DEFAULT '',
  `id_kelas` varchar(10) DEFAULT NULL,
  `path_foto` varchar(150) DEFAULT NULL,
  `is_lulus` tinyint(1) DEFAULT NULL,
  `id_user` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `data_murid_kode_profile_unique` (`kode_profile`),
  KEY `data_murid_nama_index` (`nama`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `data_murid_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel smk-skripsi.data_murid: ~2 rows (lebih kurang)
INSERT INTO `data_murid` (`id`, `kode_profile`, `nama`, `alamat`, `no_hp`, `id_kelas`, `path_foto`, `is_lulus`, `id_user`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(2, 'ID-P9877', 'Dimas Fauzi', 'Bumirejo', '085156078295', 'XII B', '/storage/profiles/x9JQ8C3Ukn.png', 0, 3, '2024-05-22 01:50:37', '2024-05-22 01:50:41', NULL),
	(3, 'ID-P9834', 'Ridwan Mulyono', 'Nguter', '085456423456', 'XII G', '/storage/profiles/x9JQ8C3Ukn.png', 0, 35, '2024-05-23 04:57:54', '2024-05-22 22:36:18', NULL);

-- membuang struktur untuk table smk-skripsi.hari
CREATE TABLE IF NOT EXISTS `hari` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `days` varchar(8) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel smk-skripsi.hari: ~6 rows (lebih kurang)
INSERT INTO `hari` (`id`, `days`, `created_at`, `updated_at`) VALUES
	(1, 'Senin', '2024-05-23 09:03:41', '2024-05-23 09:03:42'),
	(2, 'Selasa', '2024-05-23 09:03:52', '2024-05-23 09:03:53'),
	(3, 'Rabu', '2024-05-23 09:03:59', '2024-05-23 09:04:00'),
	(4, 'Kamis', '2024-05-23 09:04:06', '2024-05-23 09:04:07'),
	(5, 'Jumat', '2024-05-23 09:04:14', '2024-05-23 09:04:14'),
	(6, 'Sabtu', '2024-05-23 09:04:20', '2024-05-23 09:04:20');

-- membuang struktur untuk table smk-skripsi.jadwal
CREATE TABLE IF NOT EXISTS `jadwal` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode_jadwal` varchar(50) NOT NULL,
  `id_mapel` bigint(20) unsigned NOT NULL,
  `id_hari` bigint(20) unsigned NOT NULL,
  `id_kelas` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `jadwal_id_mapel_foreign` (`id_mapel`),
  KEY `jadwal_id_hari_foreign` (`id_hari`),
  KEY `jadwal_id_kelas_foreign` (`id_kelas`),
  CONSTRAINT `jadwa_id_kelas_foreign` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id`),
  CONSTRAINT `jadwal_id_hari_foreign` FOREIGN KEY (`id_hari`) REFERENCES `hari` (`id`),
  CONSTRAINT `jadwal_id_mapel_foreign` FOREIGN KEY (`id_mapel`) REFERENCES `mapel` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel smk-skripsi.jadwal: ~0 rows (lebih kurang)
INSERT INTO `jadwal` (`id`, `kode_jadwal`, `id_mapel`, `id_hari`, `id_kelas`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(6, 'ID-JD187963', 7, 1, 5, '2024-06-05 08:08:16', '2024-06-05 08:08:16', NULL);

-- membuang struktur untuk table smk-skripsi.kelas
CREATE TABLE IF NOT EXISTS `kelas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_kelas` varchar(25) DEFAULT NULL,
  `nama_kelas` varchar(25) DEFAULT NULL,
  `id_wali` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kelas_id_kelas_unique` (`id_kelas`),
  KEY `kelas_id_wali_foreign` (`id_wali`),
  CONSTRAINT `kelas_id_wali_foreign` FOREIGN KEY (`id_wali`) REFERENCES `data_guru` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel smk-skripsi.kelas: ~1 rows (lebih kurang)
INSERT INTO `kelas` (`id`, `id_kelas`, `nama_kelas`, `id_wali`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(5, 'ID-K4877', 'X A', 2, '2024-06-05 08:08:06', '2024-06-05 08:08:06', NULL);

-- membuang struktur untuk table smk-skripsi.mapel
CREATE TABLE IF NOT EXISTS `mapel` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama_mapel` varchar(45) NOT NULL,
  `guru_pengapu` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `guru_pengapu` (`guru_pengapu`),
  CONSTRAINT `mapel_guru_pengapu_foreign` FOREIGN KEY (`guru_pengapu`) REFERENCES `data_guru` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel smk-skripsi.mapel: ~0 rows (lebih kurang)
INSERT INTO `mapel` (`id`, `nama_mapel`, `guru_pengapu`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(7, 'Agama', 2, '2024-06-05 08:05:41', '2024-06-05 08:05:41', NULL);

-- membuang struktur untuk table smk-skripsi.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel smk-skripsi.migrations: ~11 rows (lebih kurang)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(6, '2014_10_12_000000_create_users_table', 1),
	(7, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(8, '2024_05_21_082041_data_guru', 1),
	(9, '2024_05_21_082138_kelas', 1),
	(10, '2024_05_21_082139_data_murid', 1),
	(11, '2024_05_21_082211_mapel', 1),
	(12, '2024_05_21_082228_hari', 1),
	(13, '2024_05_21_082240_jadwal', 1),
	(14, '2024_05_21_082250_nilai', 1),
	(15, '2024_05_21_082257_absen_guru', 1),
	(16, '2024_05_21_091900_absen_murid', 1),
	(17, '2024_05_26_152908_ppdb', 2),
	(18, '2024_06_03_163938_transaksi_pendaftaran', 3);

-- membuang struktur untuk table smk-skripsi.nilai
CREATE TABLE IF NOT EXISTS `nilai` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode_nilai` varchar(50) NOT NULL,
  `id_kelas` bigint(20) unsigned NOT NULL,
  `id_murid` bigint(20) unsigned NOT NULL,
  `id_mapel` bigint(20) unsigned NOT NULL,
  `nilai` smallint(6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `nilai_id_kelas_foreign` (`id_kelas`),
  KEY `nilai_id_murid_foreign` (`id_murid`),
  KEY `nilai_id_mapel_foreign` (`id_mapel`),
  CONSTRAINT `nilai_id_kelas_foreign` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id`),
  CONSTRAINT `nilai_id_mapel_foreign` FOREIGN KEY (`id_mapel`) REFERENCES `mapel` (`id`),
  CONSTRAINT `nilai_id_murid_foreign` FOREIGN KEY (`id_murid`) REFERENCES `data_murid` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel smk-skripsi.nilai: ~0 rows (lebih kurang)
INSERT INTO `nilai` (`id`, `kode_nilai`, `id_kelas`, `id_murid`, `id_mapel`, `nilai`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(5, 'ID-N588612', 5, 2, 7, 90, '2024-06-05 08:16:54', '2024-06-05 08:16:54', NULL);

-- membuang struktur untuk table smk-skripsi.pendaftaran
CREATE TABLE IF NOT EXISTS `pendaftaran` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `jalur_pendaftaran` varchar(25) NOT NULL,
  `prodi` varchar(25) NOT NULL,
  `nama_lengkap` varchar(125) NOT NULL,
  `jenis_kelamin` varchar(40) NOT NULL,
  `tempat_lahir` varchar(20) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` text NOT NULL,
  `email` varchar(50) NOT NULL,
  `no_hp` varchar(13) NOT NULL,
  `asal_sekolah` varchar(45) NOT NULL,
  `alamat_asal_sekolah` text NOT NULL,
  `tahun_lulus` year(4) NOT NULL,
  `nama_ayah` varchar(75) NOT NULL,
  `nama_ibu` varchar(75) NOT NULL,
  `alamat_tempat_tinggal_ortu` text NOT NULL,
  `no_hp_ortu` varchar(13) NOT NULL,
  `nama_wali` varchar(75) DEFAULT NULL,
  `alamat_tempat_tinggal_wali` text DEFAULT NULL,
  `no_hp_wali` varchar(13) DEFAULT NULL,
  `info_ppdb` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`info_ppdb`)),
  `kelengkapan_dokumen` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`kelengkapan_dokumen`)),
  `status_penerimaan` varchar(50) DEFAULT '',
  `bukti_tf` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `id_user` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_pendaftaran_users` (`id_user`),
  CONSTRAINT `FK_pendaftaran_users` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel smk-skripsi.pendaftaran: ~1 rows (lebih kurang)
INSERT INTO `pendaftaran` (`id`, `jalur_pendaftaran`, `prodi`, `nama_lengkap`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `email`, `no_hp`, `asal_sekolah`, `alamat_asal_sekolah`, `tahun_lulus`, `nama_ayah`, `nama_ibu`, `alamat_tempat_tinggal_ortu`, `no_hp_ortu`, `nama_wali`, `alamat_tempat_tinggal_wali`, `no_hp_wali`, `info_ppdb`, `kelengkapan_dokumen`, `status_penerimaan`, `bukti_tf`, `created_at`, `updated_at`, `deleted_at`, `id_user`) VALUES
	(30, 'Inden', 'TJKT', 'Krisna Joko Purjianto', 'Laki-Laki', 'Pati', '2001-09-09', 'Bumirejo', 'dev@umbitech.id', '085156078295', 'smk btb', 'Bumirejo', '2020', 'Suprapto', 'Kusnidi', 'Bumirejo', '0851560782672', NULL, NULL, NULL, '["Brosur"]', '["FC Akta Kelahiran","FC Kartu Keluarga","Raport Semester Akhir","SK dari Sekolah","Pas foto 3x4 3 lembar"]', '', NULL, '2024-06-12 22:25:02', '2024-06-12 22:50:13', NULL, 36);

-- membuang struktur untuk table smk-skripsi.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel smk-skripsi.personal_access_tokens: ~0 rows (lebih kurang)

-- membuang struktur untuk table smk-skripsi.transaksi_pendaftaran
CREATE TABLE IF NOT EXISTS `transaksi_pendaftaran` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` varchar(255) NOT NULL,
  `id_pendaftar` bigint(20) unsigned NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `transaksi_pendaftaran_order_id_unique` (`order_id`),
  KEY `transaksi_pendaftaran_id_pendaftar_foreign` (`id_pendaftar`),
  CONSTRAINT `transaksi_pendaftaran_id_pendaftar_foreign` FOREIGN KEY (`id_pendaftar`) REFERENCES `pendaftaran` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel smk-skripsi.transaksi_pendaftaran: ~0 rows (lebih kurang)

-- membuang struktur untuk table smk-skripsi.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` varchar(12) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel smk-skripsi.users: ~4 rows (lebih kurang)
INSERT INTO `users` (`id`, `email`, `password`, `level`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(2, 'admin@gmail.com', '$2y$10$I3ex3UzAImeDOksuRp6sNubbQKsF84fX/1Zal9U5DGmlysMQObWyu', 'Admin', '2024-05-21 09:22:57', '2024-05-27 03:01:26', NULL),
	(3, 'L@gmail.com', '$2y$10$D1lyFW9okYz9Sw30LrorMuQGboG9U1ij8fDH5UyS4la54/3Z2fHlS', 'Murid', '2024-05-22 20:06:52', '2024-05-22 20:49:09', NULL),
	(15, 'herocyber22@gmail.com', '$2y$10$I3ex3UzAImeDOksuRp6sNubbQKsF84fX/1Zal9U5DGmlysMQObWyu', 'Guru', '2024-05-27 06:25:54', '2024-05-27 06:25:55', NULL),
	(35, 'loker@gmail.com', '$2y$10$I3ex3UzAImeDOksuRp6sNubbQKsF84fX/1Zal9U5DGmlysMQObWyu', 'Murid', '2024-06-05 16:27:29', '2024-06-05 16:27:29', NULL),
	(36, 'dev@umbitech.id', '$2y$10$9Ll5v6qqVWoHLWXuC/XS1O1Mspmv2Js54MsOuPlD393UKGSfrjPoe', 'Calon Siswa', '2024-06-12 22:25:02', '2024-06-12 22:25:02', NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
