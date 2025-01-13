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

 Date: 13/01/2025 15:09:49
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for laporan_kedisiplinan
-- ----------------------------
DROP TABLE IF EXISTS `laporan_kedisiplinan`;
CREATE TABLE `laporan_kedisiplinan`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `pengguna_id` bigint UNSIGNED NOT NULL,
  `nip` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jam_kerja` decimal(10, 2) NOT NULL,
  `total_kehadiran` int NOT NULL,
  `tepat_waktu` int NOT NULL,
  `terlambat` int NOT NULL,
  `tidak_hadir` int NOT NULL,
  `durasi_tidak_terlihat` int NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `pengguna_id`(`pengguna_id` ASC) USING BTREE,
  INDEX `nip`(`nip` ASC) USING BTREE,
  CONSTRAINT `laporan_kedisiplinan_ibfk_1` FOREIGN KEY (`pengguna_id`) REFERENCES `pengguna` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `laporan_kedisiplinan_ibfk_2` FOREIGN KEY (`nip`) REFERENCES `pengguna` (`nip`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 32 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
