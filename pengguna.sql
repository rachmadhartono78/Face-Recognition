/*
 Navicat Premium Dump SQL

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 100432 (10.4.32-MariaDB)
 Source Host           : localhost:3306
 Source Schema         : employee_discipline_monitoring

 Target Server Type    : MySQL
 Target Server Version : 100432 (10.4.32-MariaDB)
 File Encoding         : 65001

 Date: 12/01/2025 22:14:56
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for pengguna
-- ----------------------------
DROP TABLE IF EXISTS `pengguna`;
CREATE TABLE `pengguna` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nip` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_presensi` ENUM('Administrasi', 'Dosen tetap', 'Dosen kontrak', 'Tenaga pendukung') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_kerja` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` LONGBLOB DEFAULT NULL,
  `flag_aktif` TINYINT(1) DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `uniq_nip` (`nip` ASC) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of pengguna
-- ----------------------------
INSERT INTO `pengguna` VALUES (1, '221232615', 'Rachmad Hartono', 'Administrasi', 'Badan Sistem Informasi', NULL, 1);
INSERT INTO `pengguna` VALUES (2, '221232616', 'Johan Yulian Tri Wastono', 'Administrasi', 'Badan Sistem Informasi', NULL, 1);
INSERT INTO `pengguna` VALUES (3, '221232617', 'Febrian Aji Kusuma', 'Administrasi', 'Badan Sistem Informasi', NULL, 1);
INSERT INTO `pengguna` VALUES (4, '221232618', 'Muhammad Farrij Rifa\'i', 'Administrasi', 'Badan Sistem Informasi', NULL, 1);
INSERT INTO `pengguna` VALUES (5, '221232619', 'Muhammad Zen Gamal Husain', 'Administrasi', 'Badan Sistem Informasi', NULL, 1);
INSERT INTO `pengguna` VALUES (6, '221232620', 'Linda Agustina', 'Administrasi', 'Badan Sistem Informasi', NULL, 1);
INSERT INTO `pengguna` VALUES (7, '221232621', 'Ahmad Pahang Nugroho Utomo', 'Administrasi', 'Badan Sistem Informasi', NULL, 1);
INSERT INTO `pengguna` VALUES (8, '221232622', 'Muhammad Syaifu Dahri', 'Administrasi', 'Badan Sistem Informasi', NULL, 1);
INSERT INTO `pengguna` VALUES (9, '221232623', 'Pandu Bangun Asmoro', 'Administrasi', 'Badan Sistem Informasi', NULL, 1);
INSERT INTO `pengguna` VALUES (10, '221232624', 'Hanafi Nur Rokhim', 'Administrasi', 'Badan Sistem Informasi', NULL, 1);
INSERT INTO `pengguna` VALUES (11, '221232625', 'Duwi Haryanto', 'Administrasi', 'Badan Sistem Informasi', NULL, 1);
INSERT INTO `pengguna` VALUES (12, '221232626', 'Dhenta Ulung Wisesa', 'Administrasi', 'Badan Sistem Informasi', NULL, 1);
INSERT INTO `pengguna` VALUES (13, '221232627', 'Galindra Setya Kumoro Jati', 'Administrasi', 'Badan Sistem Informasi', NULL, 1);
INSERT INTO `pengguna` VALUES (14, '221232628', 'Muhammad Abdi Humanika', 'Administrasi', 'Badan Sistem Informasi', NULL, 1);
INSERT INTO `pengguna` VALUES (15, '221232629', 'Ghofar Nugroho', 'Administrasi', 'Badan Sistem Informasi', NULL, 1);
INSERT INTO `pengguna` VALUES (16, '221232630', 'Agus Setiawan', 'Administrasi', 'Badan Sistem Informasi', NULL, 1);
INSERT INTO `pengguna` VALUES (17, '221232631', 'Dian Sigit', 'Administrasi', 'Badan Sistem Informasi', NULL, 1);
INSERT INTO `pengguna` VALUES (18, '221232632', 'Ferdiyansyah', 'Administrasi', 'Badan Sistem Informasi', NULL, 1);
INSERT INTO `pengguna` VALUES (19, '221232633', 'Citra Anisa', 'Administrasi', 'Badan Sistem Informasi', NULL, 1);
INSERT INTO `pengguna` VALUES (20, '221232634', 'Maharani Putri Sayekti', 'Administrasi', 'Badan Sistem Informasi', NULL, 1);

SET FOREIGN_KEY_CHECKS = 1;
