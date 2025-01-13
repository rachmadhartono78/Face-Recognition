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

 Date: 13/01/2025 14:35:44
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for presensi_harian_pegawai
-- ----------------------------
DROP TABLE IF EXISTS `presensi_harian_pegawai`;
CREATE TABLE `presensi_harian_pegawai`  (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `pengguna_id` bigint UNSIGNED NOT NULL,
  `nip` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `jam_masuk` time NOT NULL,
  `jam_pulang` time NOT NULL,
  `total_jam` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `total_menit` int NULL DEFAULT NULL,
  `working_hours` decimal(10, 2) NULL DEFAULT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `pengguna_id`(`pengguna_id` ASC) USING BTREE,
  INDEX `nip`(`nip` ASC) USING BTREE,
  CONSTRAINT `presensi_harian_pegawai_ibfk_1` FOREIGN KEY (`pengguna_id`) REFERENCES `pengguna` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `presensi_harian_pegawai_ibfk_2` FOREIGN KEY (`nip`) REFERENCES `pengguna` (`nip`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 21 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of presensi_harian_pegawai
-- ----------------------------
INSERT INTO `presensi_harian_pegawai` VALUES (1, 1, '221232615', '2025-01-10', '09:00:00', '16:30:00', '8 jam 30 menit', 510, 8.50, NULL, '2025-01-12 22:32:03', '2025-01-12 16:20:11');
INSERT INTO `presensi_harian_pegawai` VALUES (2, 2, '221232616', '2025-01-10', '08:10:00', '16:50:00', '8 jam 40 menit', 520, 8.67, 'Tepat Waktu', '2025-01-12 22:32:03', '2025-01-12 22:32:03');
INSERT INTO `presensi_harian_pegawai` VALUES (3, 3, '221232617', '2025-01-10', '08:05:00', '16:45:00', '8 jam 40 menit', 520, 8.67, 'Tepat Waktu', '2025-01-12 22:32:03', '2025-01-12 22:32:03');
INSERT INTO `presensi_harian_pegawai` VALUES (4, 4, '221232618', '2025-01-10', '08:15:00', '17:00:00', '8 jam 45 menit', 525, 8.75, 'Datang Tepat', '2025-01-12 22:32:03', '2025-01-12 22:32:03');
INSERT INTO `presensi_harian_pegawai` VALUES (5, 5, '221232619', '2025-01-10', '07:50:00', '16:20:00', '8 jam 30 menit', 510, 8.50, 'Datang Awal', '2025-01-12 22:32:03', '2025-01-12 22:32:03');
INSERT INTO `presensi_harian_pegawai` VALUES (6, 6, '221232620', '2025-01-10', '08:30:00', '17:00:00', '8 jam 30 menit', 510, 8.50, 'Terlambat', '2025-01-12 22:32:03', '2025-01-12 22:32:03');
INSERT INTO `presensi_harian_pegawai` VALUES (7, 7, '221232621', '2025-01-10', '08:20:00', '16:40:00', '8 jam 20 menit', 500, 8.33, 'Terlambat', '2025-01-12 22:32:03', '2025-01-12 22:32:03');
INSERT INTO `presensi_harian_pegawai` VALUES (8, 8, '221232622', '2025-01-10', '08:05:00', '16:45:00', '8 jam 40 menit', 520, 8.67, 'Tepat Waktu', '2025-01-12 22:32:03', '2025-01-12 22:32:03');
INSERT INTO `presensi_harian_pegawai` VALUES (9, 9, '221232623', '2025-01-10', '07:45:00', '16:00:00', '8 jam 15 menit', 495, 8.25, 'Datang Awal', '2025-01-12 22:32:03', '2025-01-12 22:32:03');
INSERT INTO `presensi_harian_pegawai` VALUES (10, 10, '221232624', '2025-01-10', '08:00:00', '16:30:00', '8 jam 30 menit', 510, 8.50, 'Datang Tepat', '2025-01-12 22:32:03', '2025-01-12 22:32:03');
INSERT INTO `presensi_harian_pegawai` VALUES (11, 11, '221232625', '2025-01-10', '08:10:00', '17:00:00', '8 jam 50 menit', 530, 8.83, 'Datang Tepat', '2025-01-12 22:32:03', '2025-01-12 22:32:03');
INSERT INTO `presensi_harian_pegawai` VALUES (12, 12, '221232626', '2025-01-10', '08:05:00', '16:45:00', '8 jam 40 menit', 520, 8.67, 'Tepat Waktu', '2025-01-12 22:32:03', '2025-01-12 22:32:03');
INSERT INTO `presensi_harian_pegawai` VALUES (13, 13, '221232627', '2025-01-10', '08:15:00', '16:50:00', '8 jam 35 menit', 515, 8.58, 'Terlambat', '2025-01-12 22:32:03', '2025-01-12 22:32:03');
INSERT INTO `presensi_harian_pegawai` VALUES (14, 14, '221232628', '2025-01-10', '08:30:00', '16:30:00', '8 jam', 480, 8.00, 'Terlambat', '2025-01-12 22:32:03', '2025-01-12 22:32:03');
INSERT INTO `presensi_harian_pegawai` VALUES (15, 15, '221232629', '2025-01-10', '08:00:00', '16:30:00', '8 jam 30 menit', 510, 8.50, 'Datang Tepat', '2025-01-12 22:32:03', '2025-01-12 22:32:03');
INSERT INTO `presensi_harian_pegawai` VALUES (16, 16, '221232630', '2025-01-10', '08:10:00', '17:00:00', '8 jam 50 menit', 530, 8.83, 'Tepat Waktu', '2025-01-12 22:32:03', '2025-01-12 22:32:03');
INSERT INTO `presensi_harian_pegawai` VALUES (17, 17, '221232631', '2025-01-10', '08:00:00', '16:30:00', '8 jam 30 menit', 510, 8.50, 'Datang Tepat', '2025-01-12 22:32:03', '2025-01-12 22:32:03');
INSERT INTO `presensi_harian_pegawai` VALUES (18, 18, '221232632', '2025-01-10', '08:05:00', '16:45:00', '8 jam 40 menit', 520, 8.67, 'Datang Tepat', '2025-01-12 22:32:03', '2025-01-12 22:32:03');
INSERT INTO `presensi_harian_pegawai` VALUES (19, 19, '221232633', '2025-01-10', '08:15:00', '17:00:00', '8 jam 45 menit', 525, 8.75, 'Datang Tepat', '2025-01-12 22:32:03', '2025-01-12 22:32:03');
INSERT INTO `presensi_harian_pegawai` VALUES (20, 20, '221232634', '2025-01-10', '08:30:00', '16:45:00', '8 jam 15 menit', 495, 8.25, 'Terlambat', '2025-01-12 22:32:03', '2025-01-12 22:32:03');

SET FOREIGN_KEY_CHECKS = 1;
