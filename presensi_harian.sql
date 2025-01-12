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

 Date: 12/01/2025 22:14:34
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for presensi_harian
-- ----------------------------
DROP TABLE IF EXISTS `presensi_harian`;
CREATE TABLE `presensi_harian`  (
  `id` bigint NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of presensi_harian
-- ----------------------------
INSERT INTO `presensi_harian` VALUES (1, '091002120', '2025-01-09', '07:34:21', '16:05:44', '8 jam 31 menit', 511, 8.52, 'Datang Awal', '2025-01-10 03:34:39', '2025-01-10 03:34:39');
INSERT INTO `presensi_harian` VALUES (2, '091002121', '2025-01-08', '07:48:21', '16:07:10', '8 jam 18 menit', 498, 8.30, 'Tepat Waktu', '2025-01-10 03:34:39', '2025-01-10 03:34:39');

SET FOREIGN_KEY_CHECKS = 1;
