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

 Date: 11/01/2025 09:10:52
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for pegawai
-- ----------------------------
DROP TABLE IF EXISTS `pegawai`;
CREATE TABLE `pegawai`  (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nip` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `gelar_depan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `gelar_belakang` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `kd_jenis_pegawai` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `kd_status_pegawai` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `kd_kelompok_pegawai` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `kd_unit1` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `kd_unit2` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `kd_unit3` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `flag_aktif` int(1) UNSIGNED NULL DEFAULT 1,
  `tgl_input` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_input` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tgl_update` datetime NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_update` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `lokasi_kerja` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `uuid` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `pegawai_1`(`kd_unit2`, `nip`, `nama`) USING BTREE,
  INDEX `pgw_nip_idx`(`nip`) USING BTREE,
  INDEX `pgw_nama_idx`(`nama`) USING BTREE,
  INDEX `pegawai_kd_kelompok_pegawai_IDX`(`kd_kelompok_pegawai`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Triggers structure for table pegawai
-- ----------------------------
DROP TRIGGER IF EXISTS `bi_pegawai`;
delimiter ;;
CREATE TRIGGER `bi_pegawai` BEFORE INSERT ON `pegawai` FOR EACH ROW BEGIN
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
-- Triggers structure for table pegawai
-- ----------------------------
DROP TRIGGER IF EXISTS `ai_pegawai`;
delimiter ;;
CREATE TRIGGER `ai_pegawai` AFTER INSERT ON `pegawai` FOR EACH ROW BEGIN

INSERT INTO dasbor_pegawai.pegawai (id, nip, nama, gelar_depan, gelar_belakang, kd_jenis_pegawai, kd_status_pegawai, kd_kelompok_pegawai, kd_unit1, kd_unit2, kd_unit3, flag_aktif, user_input, tgl_input, user_update, tgl_update, lokasi_kerja, uuid)
VALUES (new.id, new.nip, new.nama, new.gelar_depan, new.gelar_belakang, new.kd_jenis_pegawai, new.kd_status_pegawai, new.kd_kelompok_pegawai, new.kd_unit1, new.kd_unit2, new.kd_unit3, new.flag_aktif, new.user_input, new.tgl_input, new.user_update, new.tgl_update, new.lokasi_kerja, new.uuid);

END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table pegawai
-- ----------------------------
DROP TRIGGER IF EXISTS `au_pegawai`;
delimiter ;;
CREATE TRIGGER `au_pegawai` AFTER UPDATE ON `pegawai` FOR EACH ROW BEGIN
-- 	UPDATE hcm_personal.personal_data_pribadi SET kd_unit = NEW.kd_unit2 WHERE nik_pegawai = OLD.nip;
	
	UPDATE dasbor_pegawai.pegawai SET id=new.id, nip=new.nip, nama=new.nama, gelar_depan=new.gelar_depan, gelar_belakang=new.gelar_belakang, kd_jenis_pegawai=new.kd_jenis_pegawai, kd_status_pegawai=new.kd_status_pegawai, kd_kelompok_pegawai=new.kd_kelompok_pegawai, kd_unit1=new.kd_unit1, kd_unit2=new.kd_unit2, kd_unit3=new.kd_unit3, flag_aktif=new.flag_aktif, user_input=new.user_input, tgl_input=new.tgl_input, user_update=new.user_update, tgl_update=new.tgl_update, lokasi_kerja=new.lokasi_kerja, uuid=new.uuid
	WHERE id=new.id;

END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table pegawai
-- ----------------------------
DROP TRIGGER IF EXISTS `ad_pegawai`;
delimiter ;;
CREATE TRIGGER `ad_pegawai` AFTER DELETE ON `pegawai` FOR EACH ROW BEGIN

DELETE FROM dasbor_pegawai.pegawai WHERE id=old.id;

END
;;
delimiter ;

SET FOREIGN_KEY_CHECKS = 1;
