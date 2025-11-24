-- ============================================
-- Query untuk Membuat Tabel Landing Page Management
-- ============================================

-- 1. Tabel: landing_page_settings
-- Menyimpan pengaturan landing page (background, kontak, about, dll)
CREATE TABLE IF NOT EXISTS `landing_page_settings` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL,
  `value` longtext DEFAULT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'text',
  `label` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `landing_page_settings_key_unique` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 2. Tabel: menu_unggulan
-- Menyimpan menu unggulan (2 menu featured)
CREATE TABLE IF NOT EXISTS `menu_unggulan` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `gambar` longtext DEFAULT NULL,
  `urutan` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- Query untuk SQLite (jika menggunakan SQLite)
-- ============================================

/*
-- 1. Tabel: landing_page_settings (SQLite)
CREATE TABLE IF NOT EXISTS `landing_page_settings` (
  `id` INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
  `key` VARCHAR(255) NOT NULL UNIQUE,
  `value` TEXT DEFAULT NULL,
  `type` VARCHAR(255) NOT NULL DEFAULT 'text',
  `label` VARCHAR(255) DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT NULL,
  `updated_at` TIMESTAMP DEFAULT NULL
);

-- 2. Tabel: menu_unggulan (SQLite)
CREATE TABLE IF NOT EXISTS `menu_unggulan` (
  `id` INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
  `nama` VARCHAR(255) NOT NULL,
  `deskripsi` TEXT NOT NULL,
  `gambar` TEXT DEFAULT NULL,
  `urutan` INTEGER NOT NULL DEFAULT 1,
  `created_at` TIMESTAMP DEFAULT NULL,
  `updated_at` TIMESTAMP DEFAULT NULL
);
*/







