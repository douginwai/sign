/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : test

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2018-10-28 21:56:42
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `tb_class`
-- ----------------------------
DROP TABLE IF EXISTS `tb_class`;
CREATE TABLE `tb_class` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `class_name` varchar(20) DEFAULT NULL,
  `grade_id` int(8) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_class
-- ----------------------------
INSERT INTO `tb_class` VALUES ('1', '1班', '1');
INSERT INTO `tb_class` VALUES ('2', '2班', '1');
INSERT INTO `tb_class` VALUES ('3', '3班', '1');
INSERT INTO `tb_class` VALUES ('4', '1班', '2');
INSERT INTO `tb_class` VALUES ('5', '2班', '2');
