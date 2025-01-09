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

 Date: 09/01/2025 22:36:59
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for presensi_harian
-- ----------------------------
DROP TABLE IF EXISTS `presensi_harian`;
CREATE TABLE `presensi_harian`  (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nip` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tanggal` date NULL DEFAULT NULL,
  `jam_masuk` time NULL DEFAULT NULL,
  `jam_pulang` time NULL DEFAULT NULL,
  `status` int(2) NULL DEFAULT NULL,
  `poin` float NULL DEFAULT NULL,
  `total_jam` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `total_menit` int(100) NULL DEFAULT NULL,
  `user_input` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tanggal_input` timestamp NULL DEFAULT NULL,
  `flag_update` tinyint(1) NULL DEFAULT 0,
  `user_update` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tanggal_update` timestamp NULL DEFAULT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `phnipidx`(`tanggal`, `nip`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Triggers structure for table presensi_harian
-- ----------------------------
DROP TRIGGER IF EXISTS `bi_presensi_harian`;
delimiter ;;
CREATE TRIGGER `bi_presensi_harian` BEFORE INSERT ON `presensi_harian` FOR EACH ROW BEGIN
	if new.id is null then
    SET new.id = UUID_SHORT();
	end if;
	if new.uuid is null then
		set new.uuid = uuid();
	end if;
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table presensi_harian
-- ----------------------------
DROP TRIGGER IF EXISTS `ai_presensi_harian`;
delimiter ;;
CREATE TRIGGER `ai_presensi_harian` AFTER INSERT ON `presensi_harian` FOR EACH ROW BEGIN

INSERT INTO dasbor_pegawai.presensi_harian (id, nip, tanggal, jam_masuk, jam_pulang, status, poin, total_jam, total_menit, user_input, tanggal_input, flag_update, user_update, tanggal_update, uuid)
VALUES (new.id, new.nip, new.tanggal, new.jam_masuk, new.jam_pulang, new.status, new.poin, new.total_jam, new.total_menit, new.user_input, new.tanggal_input, new.flag_update, new.user_update, new.tanggal_update, new.uuid);

END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table presensi_harian
-- ----------------------------
DROP TRIGGER IF EXISTS `au_presensi_harian`;
delimiter ;;
CREATE TRIGGER `au_presensi_harian` AFTER UPDATE ON `presensi_harian` FOR EACH ROW BEGIN

UPDATE dasbor_pegawai.presensi_harian SET id=new.id, nip=new.nip, tanggal=new.tanggal, jam_masuk=new.jam_masuk, jam_pulang=new.jam_pulang, status=new.status, poin=new.poin, total_jam=new.total_jam, total_menit=new.total_menit, user_input=new.user_input, tanggal_input=new.tanggal_input, flag_update=new.flag_update, user_update=new.user_update, tanggal_update=new.tanggal_update, uuid=new.uuid
WHERE id=new.id;

END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table presensi_harian
-- ----------------------------
DROP TRIGGER IF EXISTS `ad_presensi_harian`;
delimiter ;;
CREATE TRIGGER `ad_presensi_harian` AFTER DELETE ON `presensi_harian` FOR EACH ROW BEGIN

DELETE FROM dasbor_pegawai.presensi_harian WHERE id=old.id;

END
;;
delimiter ;

SET FOREIGN_KEY_CHECKS = 1;
