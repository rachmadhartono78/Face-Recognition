/*
 Navicat Premium Dump SQL

 Source Server         : db-pxc-production (node)
 Source Server Type    : MySQL
 Source Server Version : 50739 (5.7.39-42-57-log)
 Source Host           : localhost:3306
 Source Schema         : presensi

 Target Server Type    : MySQL
 Target Server Version : 50739 (5.7.39-42-57-log)
 File Encoding         : 65001

 Date: 16/01/2025 21:45:52
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for pengaturan
-- ----------------------------
DROP TABLE IF EXISTS `pengaturan`;
CREATE TABLE `pengaturan`  (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kd_pengaturan` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `isi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `user_input` varchar(9) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'system',
  `tgl_input` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_update` varchar(9) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tgl_update` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `flag_aktif` int(1) UNSIGNED NOT NULL DEFAULT 1,
  `uuid` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `pengaturan_un_kd`(`kd_pengaturan`) USING BTREE,
  UNIQUE INDEX `pengaturan_un_uuid`(`uuid`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pengaturan
-- ----------------------------
INSERT INTO `pengaturan` VALUES (819296139858541410, 'TEP', '31', 'pengaturan treshold edit presensi', 'rachmad', '2022-06-13 11:47:00', 'sigit', '2022-06-16 09:15:15', 1, 'dbf93667-d217-11ea-8c77-7eb0d4a3c7d0');
INSERT INTO `pengaturan` VALUES (819296139858541419, 'IULP', '<p class=\"text-justify\">Dalam upaya pencegahan penyebaran COVID-19, dengan ini kami informasikan bahwa pencatatan jadwal kehadiran kerja tenaga kependidikan di lingkungan UII akan dilakukan melalui UII Presensi (tidak menggunakan mesin fingerprint).</p>', 'inactive user landing page', 'system', '2020-07-30 10:50:50', 'system', '2020-07-30 10:50:50', 1, 'dbf93667-d217-11ea-8c77-7eb0d4a3c7a0');
INSERT INTO `pengaturan` VALUES (819296139862056991, 'PTRES', '15', 'batas waktu normal presensi', 'haris', '2020-08-12 14:28:32', 'haris', '2022-06-15 14:15:54', 1, '6d1cac69-dc6d-11ea-8c77-7eb0d4a3c7a0');
INSERT INTO `pengaturan` VALUES (819296139862056992, 'UIILAPOR', '0', 'status untuk menampilkan form uii lapor (1 | 0)', 'duwi', '2022-02-17 08:01:34', 'duwi', '2022-02-21 21:23:26', 1, 'abf93667-d217-11ea-8c77-7eb0d4a3c7a0');
INSERT INTO `pengaturan` VALUES (819296139862056993, 'BWLA', '30', 'batas waktu lembur awal', 'rachmad', '2022-03-23 08:00:00', 'rachmad', '2022-03-23 08:26:05', 1, '6d1cac69-dc6d-11ea-8c77-7eb0d4a3c7a3');
INSERT INTO `pengaturan` VALUES (819296139862056994, 'BWTP', '0.0167', 'batas waktu terlambat presensi', 'rachmad', '2022-03-23 08:23:00', 'rachmad', '2022-03-23 08:23:00', 1, '6d1cac69-dc6d-11ea-8c77-7eb0d4a3c7a1');
INSERT INTO `pengaturan` VALUES (819296139862056995, 'BWPA', '0.0167', 'batas waktu pulang awal', 'rachmad', '2022-03-23 08:23:00', 'rachmad', '2022-03-23 08:23:00', 1, '6d1cac69-dc6d-11ea-8c77-7eb0d4a3c7a2');
INSERT INTO `pengaturan` VALUES (819296139862056998, 'BWLAW', '30', 'batas waktu lembur akhir waktu', 'rachmad', '2022-03-23 08:23:00', 'rachmad', '2022-03-23 08:23:00', 1, '6d1cac69-dc6d-11ea-8c77-7eb0d4a3c7a4');
INSERT INTO `pengaturan` VALUES (819296139862355818, 'FVLOC', '1', 'flag validasi lokasi', 'haris', '2020-09-10 13:19:40', 'haris', '2020-09-21 13:52:14', 1, '9c382512-f32d-11ea-8c77-7eb0d4a3c7a0');
INSERT INTO `pengaturan` VALUES (3702412248739284069, 'SKEMA', 'SKEMA_WFO', '(SKEMA_WFH | SKEMA_WFO) Pilihan skema proses bisnis presensi online ', 'system', '2022-02-15 08:56:56', 'sigit', '2022-04-05 02:25:00', 1, '8e41f297-8e02-11ec-be09-525400d1af29');
INSERT INTO `pengaturan` VALUES (6439708639274991616, 'FVIP', '0', 'flag validasi ip UII', 'system', '2020-03-23 09:32:42', 'system', '2020-04-19 14:01:38', 1, '92a90229-6cae-11ea-bc45-506b8d38d8e2');
INSERT INTO `pengaturan` VALUES (13645438419173981134, 'LPVPN1', '<p class=\"text-justify\">Dalam upaya pencegahan penyebaran COVID-19, dengan ini kami informasikan bahwa pencatatan jadwal kehadiran kerja tenaga kependidikan di lingkungan UII akan dilakukan melalui UII Presensi (tidak menggunakan mesin fingerprint).</p><p><strong>Pastikan anda menggunakan UII Connect atau menggunakan VPN UII.</strong><br>Panduan penggunaan VPN UII dapat diakses melalui<a href=\"https://uii.id/vpn\" target=\"_blank\">https://uii.id/vpn</a></p><p><strong>Presensi masuk dan pulang hanya bisa dilakukan sekali dalam sehari.</strong></p>', 'landing page vpn true', 'system', '2020-03-31 13:21:55', 'system', '2020-04-01 13:18:26', 1, 'eb3557d1-7317-11ea-9da4-506b8d2f0e5e');
INSERT INTO `pengaturan` VALUES (13645438419173989928, 'LPVPN0', '<p class=\"text-justify\">Dalam upaya pencegahan penyebaran COVID-19, dengan ini kami informasikan bahwa pencatatan jadwal kehadiran kerja tenaga kependidikan di lingkungan UII akan dilakukan melalui UII Presensi (tidak menggunakan mesin fingerprint).</p><p><strong>Presensi masuk dan pulang hanya bisa dilakukan sekali dalam sehari.</strong></p>', 'landing page vpn false', 'system', '2020-04-01 13:17:17', 'system', '2020-04-01 13:17:17', 1, '6feff339-73e0-11ea-9da4-506b8d2f0e5e');

-- ----------------------------
-- Triggers structure for table pengaturan
-- ----------------------------
DROP TRIGGER IF EXISTS `bi_pengaturan`;
delimiter ;;
CREATE TRIGGER `bi_pengaturan` BEFORE INSERT ON `pengaturan` FOR EACH ROW BEGIN
	IF new.uuid = '' THEN
	SET new.uuid = UUID();
END IF;

IF new.id = 0 THEN
	set new.id = UUID_SHORT();
END IF;

END
;;
delimiter ;

SET FOREIGN_KEY_CHECKS = 1;
