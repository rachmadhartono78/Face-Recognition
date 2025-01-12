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

 Date: 11/01/2025 19:47:24
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for recorded_videos
-- ----------------------------
DROP TABLE IF EXISTS `recorded_videos`;
CREATE TABLE `recorded_videos`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `file_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `recorded_at` timestamp NULL DEFAULT NULL,
  `duration` int NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of recorded_videos
-- ----------------------------
INSERT INTO `recorded_videos` VALUES (1, 'CCTV - 2 Desember 2024', 'Video rekaman ruangan 1', 'videos/video1.mp4', 'thumbnails/video1.jpg', '2025-01-10 06:37:34', 300, '2025-01-10 06:37:34', '2025-01-10 06:37:34');
INSERT INTO `recorded_videos` VALUES (2, 'CCTV - 1 Desember 2024', 'Deskripsi rekaman kedua.', 'videos/https://youtu.be/HymDXQscD7g?si=qgVMQD8M5oX2hPJt', 'thumbnails/new-thumbnail2.jpg', '2025-01-10 07:05:24', 240, '2025-01-10 07:05:24', '2025-01-10 07:05:24');
INSERT INTO `recorded_videos` VALUES (3, 'CCTV - 3 Desember 2024', 'Deskripsi rekaman kedua.', 'videos/new-video2.mp4', 'thumbnails/new-thumbnail2.jpg', '2025-01-10 07:05:24', 240, '2025-01-10 07:05:24', '2025-01-10 07:05:24');
INSERT INTO `recorded_videos` VALUES (4, 'CCTV - 4 Desember 2024', 'Deskripsi rekaman kedua.', 'videos/new-video2.mp4', 'thumbnails/new-thumbnail2.jpg', '2025-01-10 07:05:24', 240, '2025-01-10 07:05:24', '2025-01-10 07:05:24');

SET FOREIGN_KEY_CHECKS = 1;
