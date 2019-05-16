/*
 Navicat Premium Data Transfer

 Source Server         : PHPMYADMIN
 Source Server Type    : MySQL
 Source Server Version : 100137
 Source Host           : localhost:3306
 Source Schema         : catatan

 Target Server Type    : MySQL
 Target Server Version : 100137
 File Encoding         : 65001

 Date: 16/05/2019 13:27:33
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for catatan
-- ----------------------------
DROP TABLE IF EXISTS `catatan`;
CREATE TABLE `catatan`  (
  `catatan_id` int(11) NOT NULL AUTO_INCREMENT,
  `catatan_judul` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `catatan_isi` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `catatan_tersimpan` date NULL DEFAULT NULL,
  `catatan_terupdate` date NULL DEFAULT NULL,
  PRIMARY KEY (`catatan_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 35 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of catatan
-- ----------------------------
INSERT INTO `catatan` VALUES (29, 'Admin Monitoring PC', 'Masukkan Password Dibawah\r\nPassword Rsuiiadmin', '2019-05-15', '2019-05-15');
INSERT INTO `catatan` VALUES (32, 'Wifi Dokter', 'Password : dokterrsuii1', '2019-05-15', NULL);
INSERT INTO `catatan` VALUES (33, 'VNC', 'password : rsuii', '2019-05-15', NULL);
INSERT INTO `catatan` VALUES (34, 'Router', 'URL : 192.168.50:88\r\nPass rsuii', '2019-05-16', NULL);

-- ----------------------------
-- Table structure for ipaddress
-- ----------------------------
DROP TABLE IF EXISTS `ipaddress`;
CREATE TABLE `ipaddress`  (
  `ipaddress_id` int(11) NOT NULL AUTO_INCREMENT,
  `ipaddress_alias` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ipaddress_ip` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ipaddress_catatan` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `ipaddress_tersimpan` date NULL DEFAULT NULL,
  `ipaddress_terupdate` date NULL DEFAULT NULL,
  PRIMARY KEY (`ipaddress_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of ipaddress
-- ----------------------------
INSERT INTO `ipaddress` VALUES (5, 'gateway basment', '192.168.50.1', 'gateway', '2019-05-15', NULL);
INSERT INTO `ipaddress` VALUES (7, 'anjungan lobi', '192.168.50.102', '-', '2019-05-15', '2019-05-16');
INSERT INTO `ipaddress` VALUES (8, 'anjungan radiologi', '192.168.50.100', '-', '2019-05-15', NULL);
INSERT INTO `ipaddress` VALUES (9, 'TV Farmasi', '192.168.51.65', 'Sering Mati', '2019-05-16', NULL);
INSERT INTO `ipaddress` VALUES (10, 'TV KASIR FARMASI', '192.168.51.66', 'Sering Mati', '2019-05-16', NULL);

-- ----------------------------
-- Table structure for printer
-- ----------------------------
DROP TABLE IF EXISTS `printer`;
CREATE TABLE `printer`  (
  `printer_id` int(11) NOT NULL AUTO_INCREMENT,
  `printer_tipe` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `printer_lokasi` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `printer_tersimpan` date NULL DEFAULT NULL,
  `printer_ttd` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `printer_catatan` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `printer_terupdate` date NULL DEFAULT NULL,
  PRIMARY KEY (`printer_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of printer
-- ----------------------------
INSERT INTO `printer` VALUES (1, 'LBP6030', 'Admisi Rajal', '2019-05-16', '', '-', NULL);

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_nama` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `user_username` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `user_password` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `user_level` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `user_icon` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  PRIMARY KEY (`user_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (1, 'duwi', 'admin', 'admin', '1', 'duwi.jpg');

SET FOREIGN_KEY_CHECKS = 1;
