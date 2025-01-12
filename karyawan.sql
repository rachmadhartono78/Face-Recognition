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

 Date: 12/01/2025 21:01:20
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for karyawan
-- ----------------------------
DROP TABLE IF EXISTS `karyawan`;
CREATE TABLE `karyawan`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_karyawan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `jabatan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `tempat_lahir` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `tanggal_lahir` date NULL DEFAULT NULL,
  `nomor_hp` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 21 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of karyawan
-- ----------------------------
INSERT INTO `karyawan` VALUES (1, 'Rachmad Hartono', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `karyawan` VALUES (2, 'Johan Yulian Tri Wastono', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `karyawan` VALUES (3, 'Febrian Aji Kusuma', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `karyawan` VALUES (4, 'Muhammad Farrij Rifa\'i', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `karyawan` VALUES (5, 'Muhammad Zen Gamal Husain', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `karyawan` VALUES (6, 'Linda Agustina', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `karyawan` VALUES (7, 'Ahmad Pahang Nugroho Utomo', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `karyawan` VALUES (8, 'Muhammad Syaifu Dahri', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `karyawan` VALUES (9, 'Pandu Bangun Asmoro', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `karyawan` VALUES (10, 'Hanafi Nur Rokhim', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `karyawan` VALUES (11, 'Duwi Haryanto', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `karyawan` VALUES (12, 'Dhenta Ulung Wisesa', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `karyawan` VALUES (13, 'Galindra Setya Kumoro Jati', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `karyawan` VALUES (14, 'Muhammad Abdi Humanika', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `karyawan` VALUES (15, 'Ghofar Nugroho', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `karyawan` VALUES (16, 'Agus Setiawan', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `karyawan` VALUES (17, 'Dian Sigit', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `karyawan` VALUES (18, 'Ferdiyansyah', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `karyawan` VALUES (19, 'Citra Anisa', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `karyawan` VALUES (20, 'Maharani Putri Sayekti', NULL, NULL, NULL, NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;
