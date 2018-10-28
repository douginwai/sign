/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : test

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2018-10-28 21:56:46
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `tb_grade`
-- ----------------------------
DROP TABLE IF EXISTS `tb_grade`;
CREATE TABLE `tb_grade` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `grade_name` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_grade
-- ----------------------------
INSERT INTO `tb_grade` VALUES ('1', '一年级');
INSERT INTO `tb_grade` VALUES ('2', '二年级');
INSERT INTO `tb_grade` VALUES ('3', '三年级');
INSERT INTO `tb_grade` VALUES ('4', '四年级');
INSERT INTO `tb_grade` VALUES ('5', '五年级');
INSERT INTO `tb_grade` VALUES ('6', '六年级');
