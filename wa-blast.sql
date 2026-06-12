-- ============================================================
-- WA BLAST — Desain Database
-- Sistem: Buku Tamu BBPOM Banjarbaru
-- Dibuat : 2026-05-12
-- 
-- CATATAN:
--   Tabel `visitor` dan `kategori` sudah ada di database.
--   Jalankan hanya blok CREATE TABLE yang belum ada.
--   Blok referensi ditandai dengan komentar [SUDAH ADA].
-- ============================================================

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- ============================================================
-- [SUDAH ADA] Tabel `kategori`
-- Menyimpan jenis/kategori tamu (Pengujian, Informasi, Umum)
-- ============================================================
CREATE TABLE IF NOT EXISTS `kategori` (
  `id`          bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama`        varchar(255)        NOT NULL COMMENT 'Nama kategori, mis: Pengujian',
  `keterangan`  varchar(255)        NOT NULL COMMENT 'Deskripsi singkat kategori',
  `created_at`  timestamp           NULL DEFAULT NULL,
  `updated_at`  timestamp           NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
  COMMENT='Master kategori tamu';

-- Data default kategori
INSERT IGNORE INTO `kategori` (`id`, `nama`, `keterangan`, `created_at`, `updated_at`) VALUES
  (1, 'Pengujian',  'Tamu keperluan pengujian sampel', NOW(), NOW()),
  (2, 'Informasi',  'Tamu keperluan layanan informasi', NOW(), NOW()),
  (3, 'Umum',       'Tamu kunjungan umum',              NOW(), NOW());


-- ============================================================
-- [SUDAH ADA] Tabel `visitor`
-- Menyimpan seluruh data tamu buku tamu,
-- termasuk tamu yang ditambahkan manual via WA Blast.
-- ============================================================
CREATE TABLE IF NOT EXISTS `visitor` (
  `id`          bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name`        varchar(255)        NOT NULL                  COMMENT 'Nama lengkap tamu',
  `category`    enum('0','1','2','3') NOT NULL DEFAULT '0'    COMMENT '0=Lainnya, 1=Pengujian, 2=Informasi, 3=Umum',
  `origin`      varchar(255)        NOT NULL DEFAULT ''       COMMENT 'Asal instansi / kota',
  `telp`        varchar(25)         NOT NULL DEFAULT ''       COMMENT 'Nomor HP / WhatsApp',
  `email`       varchar(150)        NULL DEFAULT NULL         COMMENT 'Alamat e-mail',
  `purpose`     text                NOT NULL                  COMMENT 'Tujuan kunjungan',
  `gender`      enum('L','P')       NULL DEFAULT NULL         COMMENT 'L=Laki-laki, P=Perempuan',
  `age`         int(11)             NULL DEFAULT 0            COMMENT 'Usia',
  `school`      varchar(50)         NULL DEFAULT NULL         COMMENT 'Sekolah / universitas',
  `education`   varchar(100)        NULL DEFAULT NULL         COMMENT 'Pendidikan terakhir',
  `work`        varchar(255)        NULL DEFAULT NULL         COMMENT 'Pekerjaan',
  `foto`        longtext            NULL DEFAULT NULL         COMMENT 'Path foto (storage/guest/...)',
  `sign`        longtext            NULL DEFAULT NULL         COMMENT 'Data tanda tangan (base64)',
  `created_at`  timestamp           NULL DEFAULT NULL,
  `updated_at`  timestamp           NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_visitor_category`   (`category`),
  KEY `idx_visitor_telp`       (`telp`),
  KEY `idx_visitor_created_at` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
  COMMENT='Data tamu buku tamu (termasuk tambahan manual WA Blast)';


-- ============================================================
-- [BARU] Tabel `wa_blast_log`
-- Menyimpan riwayat setiap sesi pengiriman WA Blast.
-- Satu baris = satu kali klik tombol "Kirim WA Blast".
-- ============================================================
CREATE TABLE IF NOT EXISTS `wa_blast_log` (
  `id`              bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id`         bigint(20) unsigned NOT NULL               COMMENT 'Admin yang mengirim (FK → users.id)',
  `message_tpl`     text                NOT NULL               COMMENT 'Template pesan yang digunakan saat blast',
  `filter_category` tinyint(3) unsigned NULL DEFAULT NULL      COMMENT 'Filter kategori (NULL = semua)',
  `filter_period`   tinyint(3) unsigned NOT NULL DEFAULT 1     COMMENT 'Filter periode dalam bulan (1/2/3)',
  `total_sent`      int(11) unsigned    NOT NULL DEFAULT 0     COMMENT 'Jumlah penerima yang dikirim',
  `sent_at`         timestamp           NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Waktu pengiriman blast',
  `created_at`      timestamp           NULL DEFAULT NULL,
  `updated_at`      timestamp           NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_wa_blast_log_user`     (`user_id`),
  KEY `idx_wa_blast_log_sent_at`  (`sent_at`),
  CONSTRAINT `fk_wa_blast_log_user`
    FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
  COMMENT='Log sesi pengiriman WA Blast oleh Admin';


-- ============================================================
-- [BARU] Tabel `wa_blast_recipient`
-- Detail penerima per sesi blast.
-- Satu baris = satu tamu yang dikirimkan WA pada sesi tertentu.
-- ============================================================
CREATE TABLE IF NOT EXISTS `wa_blast_recipient` (
  `id`           bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `blast_id`     bigint(20) unsigned NOT NULL               COMMENT 'FK → wa_blast_log.id',
  `visitor_id`   bigint(20) unsigned NOT NULL               COMMENT 'FK → visitor.id',
  `name_snapshot`  varchar(255)      NOT NULL               COMMENT 'Nama tamu saat dikirim (snapshot)',
  `telp_snapshot`  varchar(25)       NOT NULL               COMMENT 'Nomor HP saat dikirim (snapshot)',
  `message_sent`   text             NOT NULL                COMMENT 'Pesan aktual yang dikirim (sudah ganti {nama})',
  `created_at`   timestamp          NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_wa_blast_recipient_blast`   (`blast_id`),
  KEY `idx_wa_blast_recipient_visitor` (`visitor_id`),
  CONSTRAINT `fk_wa_blast_recipient_blast`
    FOREIGN KEY (`blast_id`)   REFERENCES `wa_blast_log` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_wa_blast_recipient_visitor`
    FOREIGN KEY (`visitor_id`) REFERENCES `visitor` (`id`)      ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
  COMMENT='Detail penerima per sesi WA Blast';


-- ============================================================
-- [BARU] Tabel `wa_blast_contact`
-- Kontak eksternal (bukan dari buku tamu) yang disimpan
-- secara permanen untuk keperluan WA Blast berulang.
-- Berbeda dari visitor karena tidak terikat kunjungan.
-- ============================================================
CREATE TABLE IF NOT EXISTS `wa_blast_contact` (
  `id`          bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name`        varchar(255)        NOT NULL               COMMENT 'Nama kontak',
  `origin`      varchar(255)        NULL DEFAULT NULL      COMMENT 'Asal instansi / kota',
  `telp`        varchar(25)         NOT NULL               COMMENT 'Nomor HP / WhatsApp',
  `category`    tinyint(3) unsigned NOT NULL DEFAULT 3     COMMENT '1=Pengujian, 2=Informasi, 3=Umum',
  `is_active`   tinyint(1)          NOT NULL DEFAULT 1     COMMENT '1=Aktif, 0=Nonaktif',
  `note`        varchar(500)        NULL DEFAULT NULL      COMMENT 'Catatan tambahan',
  `added_by`    bigint(20) unsigned NOT NULL               COMMENT 'Admin yang menambahkan (FK → users.id)',
  `created_at`  timestamp           NULL DEFAULT NULL,
  `updated_at`  timestamp           NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_wa_blast_contact_telp`     (`telp`),
  KEY `idx_wa_blast_contact_category` (`category`),
  KEY `idx_wa_blast_contact_active`   (`is_active`),
  CONSTRAINT `fk_wa_blast_contact_user`
    FOREIGN KEY (`added_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
  COMMENT='Kontak permanen untuk WA Blast (tidak terikat kunjungan)';


-- ============================================================
-- Ringkasan Relasi (Entity Relationship)
--
--  users ─────────────────────────────────────┐
--    │                                         │
--    │ 1:N                                     │ 1:N
--    ▼                                         ▼
--  wa_blast_log ──── 1:N ──── wa_blast_recipient    wa_blast_contact
--                                    │ N:1
--                                    ▼
--                                  visitor ──── N:1 ──── kategori
--
-- ============================================================


/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
