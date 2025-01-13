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

 Date: 13/01/2025 14:31:01
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for laporan_kedisiplinan
-- ----------------------------
DROP TABLE IF EXISTS `laporan_kedisiplinan`;
CREATE TABLE `laporan_kedisiplinan`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_karyawan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `NIP` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jam_kerja` int NOT NULL,
  `total_kehadiran` int NOT NULL,
  `tepat_waktu` int NOT NULL,
  `terlambat` int NOT NULL,
  `tidak_hadir` int NOT NULL,
  `efektivitas` decimal(5, 2) NOT NULL,
  `kinerja` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of laporan_kedisiplinan
-- ----------------------------
INSERT INTO `laporan_kedisiplinan` VALUES (1, 'Budi Santoso', '1982041701', 'Manager', 160, 22, 20, 2, 0, 95.00, 'Sangat Baik');
INSERT INTO `laporan_kedisiplinan` VALUES (2, 'Siti Aisyah', '1986091203', 'Staff HRD', 160, 22, 21, 1, 0, 98.00, 'Baik');
INSERT INTO `laporan_kedisiplinan` VALUES (3, 'Ahmad Zaki', '1992030101', 'Staff IT', 160, 22, 18, 3, 1, 90.00, 'Cukup Baik');
INSERT INTO `laporan_kedisiplinan` VALUES (4, 'Diana Puspita', '1995120902', 'Supervisor', 160, 22, 20, 2, 0, 92.50, 'Baik');
INSERT INTO `laporan_kedisiplinan` VALUES (5, 'Rina Oktaviani', '1988111503', 'Staff Keuangan', 160, 22, 20, 1, 1, 93.00, 'Baik');

SET FOREIGN_KEY_CHECKS = 1;
