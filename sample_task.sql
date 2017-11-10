/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50614
Source Host           : 127.0.0.1:3306
Source Database       : yumamia_task

Target Server Type    : MYSQL
Target Server Version : 50614
File Encoding         : 65001

Date: 2017-02-04 06:24:22
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for employees
-- ----------------------------
DROP TABLE IF EXISTS `employees`;
CREATE TABLE `employees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `lat` float(10,6) DEFAULT NULL,
  `lng` float(10,6) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of employees
-- ----------------------------
INSERT INTO `employees` VALUES ('1', 'Ahmed', '29.966833', '31.256346', 'Street 10, Ezbet Nafie, El-Basatin, Cairo Governorate, Egypt', 'public/employees_images/1486115287.jpg');
INSERT INTO `employees` VALUES ('2', 'Mohamed', '30.044132', '31.272583', '41 El-Soultan Ahmed, El-Gamaleya, Qism El-Gamaleya, Cairo Governorate, Egypt', 'public/employees_images/1486178042.jpg');
INSERT INTO `employees` VALUES ('3', 'Test', '30.107924', '31.302658', '9-13 Abd El-Rahman Nasr Ext, Al Amireyah Ash Shamaleyah, El-Zaytoun, Cairo Governorate, Egypt', 'public/employees_images/1486181860.jpg');
INSERT INTO `employees` VALUES ('4', 'Test 2', '30.104252', '31.301868', 'Al Mataria St, Al Amireyah Ash Shamaleyah, El-Zaytoun, Cairo Governorate, Egypt', 'public/employees_images/1486182094.jpg');
