/*
 Navicat Premium Data Transfer

 Source Server         : chanpan_server
 Source Server Type    : MySQL
 Source Server Version : 50725
 Source Host           : 66.42.49.97:3306
 Source Schema         : mimt

 Target Server Type    : MySQL
 Target Server Version : 50725
 File Encoding         : 65001

 Date: 14/12/2019 13:07:07
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for auth_assignment
-- ----------------------------
DROP TABLE IF EXISTS `auth_assignment`;
CREATE TABLE `auth_assignment`  (
  `item_name` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`, `user_id`) USING BTREE,
  INDEX `auth_assignment_user_id_idx`(`user_id`) USING BTREE,
  CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of auth_assignment
-- ----------------------------
INSERT INTO `auth_assignment` VALUES ('admin', '1', 1535696400);
INSERT INTO `auth_assignment` VALUES ('user', '3', 1576048294);
INSERT INTO `auth_assignment` VALUES ('user', '4', 1576157623);

-- ----------------------------
-- Table structure for auth_item
-- ----------------------------
DROP TABLE IF EXISTS `auth_item`;
CREATE TABLE `auth_item`  (
  `name` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`) USING BTREE,
  INDEX `rule_name`(`rule_name`) USING BTREE,
  INDEX `idx-auth_item-type`(`type`) USING BTREE,
  CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of auth_item
-- ----------------------------
INSERT INTO `auth_item` VALUES ('/accounts/*', 2, NULL, NULL, NULL, 1575377744, 1575377744);
INSERT INTO `auth_item` VALUES ('/admin/*', 2, NULL, NULL, NULL, 1535696373, 1535696373);
INSERT INTO `auth_item` VALUES ('/booking/*', 2, NULL, NULL, NULL, 1575780802, 1575780802);
INSERT INTO `auth_item` VALUES ('/categorys/*', 2, NULL, NULL, NULL, 1575435479, 1575435479);
INSERT INTO `auth_item` VALUES ('/core/*', 2, NULL, NULL, NULL, 1535699352, 1535699352);
INSERT INTO `auth_item` VALUES ('/debug/*', 2, NULL, NULL, NULL, 1562222244, 1562222244);
INSERT INTO `auth_item` VALUES ('/gii/*', 2, NULL, NULL, NULL, 1535706951, 1535706951);
INSERT INTO `auth_item` VALUES ('/icons/*', 2, NULL, NULL, NULL, 1575438554, 1575438554);
INSERT INTO `auth_item` VALUES ('/images/*', 2, NULL, NULL, NULL, 1575439794, 1575439794);
INSERT INTO `auth_item` VALUES ('/informations/*', 2, NULL, NULL, NULL, 1562299552, 1562299552);
INSERT INTO `auth_item` VALUES ('/money/*', 2, NULL, NULL, NULL, 1575441725, 1575441725);
INSERT INTO `auth_item` VALUES ('/options/*', 2, NULL, NULL, NULL, 1562243863, 1562243863);
INSERT INTO `auth_item` VALUES ('/products/*', 2, NULL, NULL, NULL, 1575705658, 1575705658);
INSERT INTO `auth_item` VALUES ('/products/shippings/*', 2, NULL, NULL, NULL, 1575710954, 1575710954);
INSERT INTO `auth_item` VALUES ('/site/*', 2, NULL, NULL, NULL, 1562245386, 1562245386);
INSERT INTO `auth_item` VALUES ('/skin/*', 2, NULL, NULL, NULL, 1563731318, 1563731318);
INSERT INTO `auth_item` VALUES ('/user/*', 2, NULL, NULL, NULL, 1535697098, 1535697098);
INSERT INTO `auth_item` VALUES ('/user/registration/register', 2, NULL, NULL, NULL, 1562221007, 1562221007);
INSERT INTO `auth_item` VALUES ('/user/security/logout', 2, NULL, NULL, NULL, 1562227469, 1562227469);
INSERT INTO `auth_item` VALUES ('/user/settings/account', 2, NULL, NULL, NULL, 1562226761, 1562226761);
INSERT INTO `auth_item` VALUES ('/user/settings/profile', 2, NULL, NULL, NULL, 1562226734, 1562226734);
INSERT INTO `auth_item` VALUES ('/uses/*', 2, NULL, NULL, NULL, 1575439554, 1575439554);
INSERT INTO `auth_item` VALUES ('admin', 1, 'Admin', NULL, NULL, 1535696302, 1535696302);
INSERT INTO `auth_item` VALUES ('edit_about', 1, 'Edit About', NULL, NULL, 1575914854, 1575914854);
INSERT INTO `auth_item` VALUES ('edit_contact', 1, 'Edit Contact', NULL, NULL, 1575915025, 1575915025);
INSERT INTO `auth_item` VALUES ('user', 1, 'User', NULL, NULL, 1535696315, 1535696315);

-- ----------------------------
-- Table structure for auth_item_child
-- ----------------------------
DROP TABLE IF EXISTS `auth_item_child`;
CREATE TABLE `auth_item_child`  (
  `parent` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`, `child`) USING BTREE,
  INDEX `child`(`child`) USING BTREE,
  CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of auth_item_child
-- ----------------------------
INSERT INTO `auth_item_child` VALUES ('admin', '/accounts/*');
INSERT INTO `auth_item_child` VALUES ('admin', '/admin/*');
INSERT INTO `auth_item_child` VALUES ('admin', '/booking/*');
INSERT INTO `auth_item_child` VALUES ('admin', '/categorys/*');
INSERT INTO `auth_item_child` VALUES ('admin', '/core/*');
INSERT INTO `auth_item_child` VALUES ('admin', '/debug/*');
INSERT INTO `auth_item_child` VALUES ('admin', '/gii/*');
INSERT INTO `auth_item_child` VALUES ('admin', '/icons/*');
INSERT INTO `auth_item_child` VALUES ('admin', '/images/*');
INSERT INTO `auth_item_child` VALUES ('admin', '/informations/*');
INSERT INTO `auth_item_child` VALUES ('admin', '/money/*');
INSERT INTO `auth_item_child` VALUES ('admin', '/options/*');
INSERT INTO `auth_item_child` VALUES ('admin', '/products/*');
INSERT INTO `auth_item_child` VALUES ('admin', '/products/shippings/*');
INSERT INTO `auth_item_child` VALUES ('admin', '/site/*');
INSERT INTO `auth_item_child` VALUES ('user', '/site/*');
INSERT INTO `auth_item_child` VALUES ('admin', '/skin/*');
INSERT INTO `auth_item_child` VALUES ('admin', '/user/*');
INSERT INTO `auth_item_child` VALUES ('user', '/user/security/logout');
INSERT INTO `auth_item_child` VALUES ('user', '/user/settings/account');
INSERT INTO `auth_item_child` VALUES ('user', '/user/settings/profile');
INSERT INTO `auth_item_child` VALUES ('admin', '/uses/*');
INSERT INTO `auth_item_child` VALUES ('admin', 'edit_about');
INSERT INTO `auth_item_child` VALUES ('admin', 'edit_contact');

-- ----------------------------
-- Table structure for auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `auth_rule`;
CREATE TABLE `auth_rule`  (
  `name` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for banks
-- ----------------------------
DROP TABLE IF EXISTS `banks`;
CREATE TABLE `banks`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'ชื่อธนาคาร',
  `detail` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `rstat` int(1) DEFAULT NULL COMMENT 'สถานะ',
  `create_by` bigint(20) DEFAULT NULL COMMENT 'สร้างโดย',
  `create_date` datetime(0) DEFAULT NULL COMMENT 'สร้างเมื่อ',
  `update_by` bigint(20) DEFAULT NULL COMMENT 'แก้ไขโดย',
  `update_date` datetime(0) DEFAULT NULL COMMENT 'แก้ไขเมื่อ',
  `order` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for booking
-- ----------------------------
DROP TABLE IF EXISTS `booking`;
CREATE TABLE `booking`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'ชื่ออบรม',
  `date` date DEFAULT NULL COMMENT 'วันที่',
  `time` time(0) DEFAULT NULL COMMENT 'เวลา',
  `rstat` int(1) DEFAULT NULL COMMENT 'สถานะ',
  `create_by` bigint(20) DEFAULT NULL COMMENT 'สร้างโดย',
  `create_date` datetime(0) DEFAULT NULL COMMENT 'สร้างเมื่อ',
  `update_by` bigint(20) DEFAULT NULL COMMENT 'แก้ไขโดย',
  `update_date` datetime(0) DEFAULT NULL COMMENT 'แก้ไขเมื่อ',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of booking
-- ----------------------------
INSERT INTO `booking` VALUES (1, 'งานอบรมปลูกพืชไร้ดิน', '2019-12-21', '09:00:00', 1, 1, '2019-12-08 11:44:47', 1, '2019-12-10 12:55:39');
INSERT INTO `booking` VALUES (2, 'งานอบรมแปรรูปผลิตภัณฑ์การเกษตร', '2019-12-29', '09:00:00', 1, 1, '2019-12-10 12:58:12', NULL, NULL);

-- ----------------------------
-- Table structure for carts
-- ----------------------------
DROP TABLE IF EXISTS `carts`;
CREATE TABLE `carts`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pro_id` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `price` decimal(10, 2) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `rstat` int(1) DEFAULT NULL COMMENT 'สถานะ',
  `create_by` bigint(20) DEFAULT NULL COMMENT 'สร้างโดย',
  `create_date` datetime(0) DEFAULT NULL COMMENT 'สร้างเมื่อ',
  `update_by` bigint(20) DEFAULT NULL COMMENT 'แก้ไขโดย',
  `update_date` datetime(0) DEFAULT NULL COMMENT 'แก้ไขเมื่อ',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 24 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of carts
-- ----------------------------
INSERT INTO `carts` VALUES (19, '1575778814025569100', 10, 1450.00, 1, 3, 1, '2019-12-10 00:36:15', NULL, NULL);

-- ----------------------------
-- Table structure for categorys
-- ----------------------------
DROP TABLE IF EXISTS `categorys`;
CREATE TABLE `categorys`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัส',
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'หมวดหมู่',
  `rstat` int(1) DEFAULT NULL COMMENT 'สถานะ',
  `create_by` bigint(20) DEFAULT NULL COMMENT 'สร้างโดย',
  `create_date` datetime(0) DEFAULT NULL COMMENT 'สร้างเมื่อ',
  `update_by` bigint(20) DEFAULT NULL COMMENT 'แก้ไขโดย',
  `update_date` datetime(0) DEFAULT NULL COMMENT 'แก้ไขเมื่อ',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of categorys
-- ----------------------------
INSERT INTO `categorys` VALUES (1, 'เสื้อผ้าแฟชั่น', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `categorys` VALUES (2, 'เสื้อผ้าแฟชั่น', 3, 1, '2019-12-07 15:14:07', 1, '2019-12-08 11:07:48');
INSERT INTO `categorys` VALUES (3, 'Macbook', 3, 1, '2019-12-07 15:48:11', 1, '2019-12-08 11:07:52');
INSERT INTO `categorys` VALUES (4, 'อาหารแปรรูป', 1, 1, '2019-12-08 11:09:11', NULL, NULL);
INSERT INTO `categorys` VALUES (5, 'ผลิตภัณฑ์เสริมความงาม', 1, 1, '2019-12-08 11:09:39', 1, '2019-12-08 11:10:12');
INSERT INTO `categorys` VALUES (6, 'อุปกรณ์ทำการเกษตร', 1, 1, '2019-12-08 11:11:00', NULL, NULL);

-- ----------------------------
-- Table structure for core_options
-- ----------------------------
DROP TABLE IF EXISTS `core_options`;
CREATE TABLE `core_options`  (
  `option_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `option_label` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `option_value` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  PRIMARY KEY (`option_name`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of core_options
-- ----------------------------
INSERT INTO `core_options` VALUES ('backend_url', 'Backend Url', 'backend.dconhub.com');
INSERT INTO `core_options` VALUES ('brand_file_type', 'File Upload Brand', '[\"jpg\",\"jpeg\",\"png\",\"gif\"]');
INSERT INTO `core_options` VALUES ('brand_types', 'DropDown Brand', '{ \"1\": \"หมวดหมู่หลัก\", \"2\": \"หมวดหมู่ย่อย\"}');
INSERT INTO `core_options` VALUES ('category_types', 'DropDown Brand', '{ \"1\": \"หมวดสินค้าหลัก\", \"2\": \"หมวดสินค้าย่อย\"}');
INSERT INTO `core_options` VALUES ('cn_brand', 'แบรนด์บริษัท', 'บจก. ดํารงค์พานิช คอนสตรัคชั่น');
INSERT INTO `core_options` VALUES ('cn_brand_address', 'ที่อยู่บริษัท', '92 หมู่ที่ 21 ต.หัวขวาง อ.โกสุมพิสัย จ.มหาสารคาม');
INSERT INTO `core_options` VALUES ('cn_brand_address2', 'เบอร์โทรศัพท์', '043761599');
INSERT INTO `core_options` VALUES ('cn_condition', 'เงื่อนไขการสั่งซื้อ', 'ราคาวัสดุ เป็นราคารับหน้าโรงงาน ยังไม่รวมค่าขนส่ง\r\nกรณีเงื่อนไขส่งฟรี เมื่อดำเนินการกรอกที่อยู่จัดส่งแล้ว ทางเจ้าหน้าที่จะติดต่อกลับไปเพื่อแก้ไขราคาค่าขนส่งให้\r\nค่าขนส่งที่ระบบคำนวณอัตโนมัติให้หลังการใส่ที่อยู่ เป็นเพียงการประมาณการเท่านั้น ทางบริษัทขอสงวนสิทธิ์เปลี่ยนแปลงโดยไม่แจ้งให้ทราบล่วงหน้า');
INSERT INTO `core_options` VALUES ('doc_logo', 'Logo ในเอกสาร', 'https://bn1305files.storage.live.com/y4mvIe7_8afjHcCPf92XY_ODuQyQIaWa7gwItZHjNssnJZmDHTZPkjOnevua_1-qNw9FscoPXhNaWZAv4_xvHmTHIIxa4WugMKDIKzbL33loI7prfRlW9lfh-snk7On8wAnprjG1DE35fZh84TrQ33FwCd4indq55Viz49R-xh5wnAQxxJ7nDcydDEPuKqJfFByJBlbtyX-6L22bnUdwcdb6A/IMG_0199.JPG?psid=1&width=2016&height=1309');
INSERT INTO `core_options` VALUES ('how_to_pay', 'วิธีการสั่งซื้อ', '<h1>ตัวอย่างวิธีการสั่งซื้อ</h1><h2><img alt=\"\" src=\"https://storage.dconhub.com/images/5c49d10bd366c.png\" class=\"fr-fic fr-dii\" data-id=\"5c49d10bd366c.png\"><img alt=\"\" src=\"https://storage.dconhub.com/images/5c49d10e0cb8e.png\" class=\"fr-fic fr-dii\" data-id=\"5c49d10e0cb8e.png\"><img alt=\"\" src=\"https://storage.dconhub.com/images/5c49d10cb7b4e.png\" class=\"fr-fic fr-dii\" data-id=\"5c49d10cb7b4e.png\"><img alt=\"\" src=\"https://storage.dconhub.com/images/5c49d10b01855.png\" class=\"fr-fic fr-dii\" data-id=\"5c49d10b01855.png\"></h2><h2>วิธีการสั่งซื้อสินค้า</h2><p>ขั้นตอนการทำรายการสั่งซื้อ<br>ติดต่อสอบถามเพิ่มเติม กรุณาติดต่อ customer service center โทร&nbsp;<strong>02-308-4666</strong> หรือ&nbsp;<a href=\"mailto:ccare@cmart.co.th\" title=\"\">ccare@cmart.co.th</a></p><h3>1. เลือกสินค้าของคุณ</h3><p>คุณสามารถเลือกสินค้าที่คุณต้องการสั่งซื้อโดยการคลิกที่ปุ่ม&nbsp;<strong>&ldquo;หยิบใส่ตะกร้า&rdquo;</strong> หรือ หากคุณต้องการเลือกสินค้าเก็บไว้และชำระเงินภายหลัง ให้คลิกที่ปุ่ม &ldquo;เพิ่มรายการที่ชอบ&rdquo; ซึ่ง ณ ที่นี้ คุณต้องทำการเข้าสู่ระบบก่อน เพื่อที่ระบบจะได้บันทึกสินค้าไว้ใน &ldquo;สินค้าที่สนใจ&rdquo;</p><h3>2. ตรวจสอบหรือแก้ไขรายการสินค้า</h3><p>คุณสามารถทำการตรวจสอบหรือแก้ไขรายการสินค้าที่คุณต้องการสั่งซื้อได้ในหน้า&nbsp;<strong>&ldquo;ตะกร้าของฉัน&quot;</strong> หลังจากนั้นคลิกที่ปุ่ม &ldquo;สั่งซื้อสินค้า&rdquo; เพื่อดำเนินการ การสั่งซื้อสินค้า</p><h3>3. เลือกทำรายการสั่งซื้อสินค้า</h3><p>คุณสามารถเลือกได้ดังนี้<br><br><strong>ทำรายการโดยไม่เป็นสมาชิก:</strong> กรอกข้อมูลการเรียกเก็บเงิน และข้อมูลการจัดส่งสินค้าของคุณ โดยไม่ได้เป็นสมาชิกของ&nbsp;<a href=\"https://www.cmart.co.th/\" title=\"\"><strong>cmart.co.th</strong></a><br><br><strong>ลูกค้าใหม่:</strong> สำหรับการสั่งซื้อครั้งแรก เพียงกรอกข้อมูลการเรียกชำระเงิน และข้อมูลการจัดส่งสินค้าของคุณ โดยเป็นสมาชิกกับ&nbsp;<a href=\"https://www.cmart.co.th/\" title=\"\"><strong>cmart.co.th</strong></a> เพื่อให้ง่ายต่อการสั่งซื้อครั้งต่อไป และสะดวกต่อการติดตามการสั่งซื้อ นอกจากนี้ คุณยังสามารถสั่งซื้อสินค้าโดยเข้าสู่ระบบผ่านทางบัญชี Facebook ของคุณได้ง่ายๆ ทั้งนี้จะได้รับจดหมายข่าวสารและโปรโมชั่นที่ดีที่สุดที่เรามอบให้<br><br><strong>ลูกค้าเก่า:</strong> สำหรับลูกค้าที่เป็นสมาชิกกับ CMART ทำรายการสั่งซื้อผ่านระบบได้ง่ายๆ เพียงแค่เข้าสู่ระบบ โดยกรอกอีเมลและรหัสผ่าน และทำรายการสั่งซื้อโดยไม่ต้องกรอกข้อมูลอื่นๆเพิ่มเติม<br><br></p><h3>4. เลือกวิธีการจัดส่งสินค้า</h3><p>CMART มีตัวเลือกในการจัดส่ง 2 แบบ คือ ส่งแบบด่วน (<strong>Express</strong>) และ ส่งแบบธรรมดา (<strong>Standard</strong>) สำหรับแต่ละวิธีการจัดส่ง จะมีการคำนวณระยะทาง และน้ำหนักของสินค้า จากการยืนยันการสั่งซื้อของคุณ (คุณสามารถอ่านรายละเอียดเพิ่มเติมได้ที่หน้า&nbsp;<a href=\"https://www.cmart.co.th/shipping-policy\">&ldquo;วิธีการจัดส่งสินค้า&rdquo;</a>)</p><h3>5. เลือกวิธีการชำระเงิน</h3><p>คุณสามารถเลือกวิธีการชำระเงินได้หลากหลายวิธี เช่น เก็บเงินปลายทาง บัตรเครดิต/บัตรเดบิต ผ่านทางเคาน์เตอร์เซอร์วิส หรือผ่านทางระบบออนไลน์ ซึ่งมีบริษัท 2C2P เป็น<br>ผู้ดูแลระบบรักษาความปลอดภัย (คุณสามารถอ่านรายละเอียดเพิ่มเติมได้ที่หน้า&nbsp;<a href=\"https://www.cmart.co.th/payment-method\">&ldquo;ช่องทางการชำระเงิน&rdquo;</a>)<br>หากคุณมีรหัสคูปองส่วนลด คุณสามารถนำรหัสส่วนลดระบุในช่อง&nbsp;<strong>&ldquo;ใส่รหัสส่วนลด ถ้ามี&rdquo;</strong> และคลิก&nbsp;<strong>&ldquo;ใช้ส่วนลด&rdquo;<br></strong>และเมื่อคุณพร้อมทำการชำระเงินและสั่งซื้อสินค้า ให้คลิกที่ปุ่ม&nbsp;<strong>&ldquo;ซื้อสินค้า&rdquo;</strong></p><p>&nbsp;</p><h3>6. ยืนยันคำสั่งซื้อสินค้าทางอีเมล</h3><p>เมื่อคุณได้ทำรายการสั่งซื้อสินค้าเรียบร้อยแล้ว<br>คุณจะได้รับอีเมลเพื่อยืนยันคำสั่งซื้อสินค้าของคุณ วิธีการชำระเงินแบบ เรียกเก็บเงินปลายทาง ชำระเงินที่จุดรับสินค้า (Cash on Pick up Point)<br>กรุณาคลิกที่ &ldquo;ลิงค์ยืนยันคำสั่งซื้อ&rdquo; ตามลิงค์ที่แนบมาในอีเมลดังกล่าว<br>ภายใน 24 ชม. หากคุณไม่ดำเนินการ ภายในเวลาที่กำหนด<br>คำสั่งซื้อของคุณ จะถูกยกเลิกโดยอัตโนมัติ&nbsp;</p>');
INSERT INTO `core_options` VALUES ('logo', 'Logo', 'https://storage.dconhub.com/images/dconhub.png');
INSERT INTO `core_options` VALUES ('logo_text', 'Logo Text', 'https://storage.dconhub.com/images/logo_bg.JPG');
INSERT INTO `core_options` VALUES ('order_text_start', ' รหัสตัวหนังสือของใบเสนอราคา', 'QT');
INSERT INTO `core_options` VALUES ('order_txt', 'Order Text', 'BS');
INSERT INTO `core_options` VALUES ('page_about', 'About', '<p>เกี่ยวกับเรา นกน้อยทำรังแต่พอตัว</p><table style=\"width: 100%;\"><tbody><tr><td style=\"width: 50.0000%;\"><div style=\"text-align: center;\"><img src=\"https://storage.dconhub.com/images/5c2f5300dfbbe.jpg\" style=\"width: 300px;\" class=\"fr-fic fr-dib\" data-id=\"5c2f5300dfbbe.jpg\"></div></td><td style=\"width: 50.0000%;\"><span class=\"fr-video fr-fvc fr-dvb fr-draggable\" contenteditable=\"false\" draggable=\"true\"><iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/-vqdW4IMTnE\" frameborder=\"0\" allowfullscreen=\"\" class=\"fr-draggable\"></iframe></span></td></tr></tbody></table><p>เราขาย <a href=\"http://www.shera.com/\" rel=\"noopener noreferrer\" target=\"_blank\">เฌอร่า</a> และ</p><p><br></p><p><span class=\"fr-emoticon fr-deletable fr-emoticon-img\" style=\"background: url(https://cdnjs.cloudflare.com/ajax/libs/emojione/2.0.1/assets/svg/1f623.svg);\">&nbsp;</span>&nbsp;</p><p><img src=\"https://storage.dconhub.com/images/5c2f54745480c.gif\" style=\"width: 300px;\" class=\"fr-fic fr-fil fr-rounded fr-dii\" data-id=\"5c2f54745480c.gif\">refd</p><p>sdsadsadsadsadsadsadsad</p><p>sadsadsadsadsadsadsadsadsa</p><p>sadsadsadsadsasdsadsadasdasd</p><p>refd</p><p>sdsadsadsadsadsadsadsad</p><p>sadsadsadsadsadsadsadsadsa</p><p>sadsadsadsadsasdsadsadasdasd</p><p>refd</p><p>sdsadsadsadsadsadsadsad</p><p>sadsadsadsadsadsadsadsadsa</p><p>sadsadsadsadsasdsadsadasdasd</p><p>refd</p><p>sdsadsadsadsadsadsadsad</p><p>sadsadsadsadsadsadsadsadsa</p><p>sadsadsadsadsasdsadsadasdasd</p><p><span class=\"fr-video fr-fvc fr-dvb fr-draggable\" contenteditable=\"false\" draggable=\"true\"><iframe width=\"640\" height=\"360\" src=\"https://www.youtube.com/embed/-vqdW4IMTnE?wmode=opaque\" frameborder=\"0\" allowfullscreen=\"\" class=\"fr-draggable\"></iframe></span>&nbsp;</p>');
INSERT INTO `core_options` VALUES ('page_contact', 'Contact', '<p>ติดต่อเรา เราคือใครเอ๋ย ให้ทาย</p><h3><span class=\"fr-video fr-fvc fr-dvb fr-draggable\" contenteditable=\"false\" draggable=\"true\">\r\n');

-- ----------------------------
-- Table structure for file_storage_item
-- ----------------------------
DROP TABLE IF EXISTS `file_storage_item`;
CREATE TABLE `file_storage_item`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `component` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `base_url` varchar(1024) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `path` varchar(1024) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `upload_ip` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 118 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of file_storage_item
-- ----------------------------
INSERT INTO `file_storage_item` VALUES (106, 'fileStorage', 'http://shop.local/source', '1/HfSgZ0jHjBR0T5af6q5XkXKWyeyEuz7O.png', 'image/png', 3556, 'HfSgZ0jHjBR0T5af6q5XkXKWyeyEuz7O', '::1', 1535699641);
INSERT INTO `file_storage_item` VALUES (107, 'fileStorage', 'http://storage.shop.local/source', '1/OuRcwvxrOLzLzvWR5QBNn6No1vd-2yf5.png', 'image/png', 4679, 'OuRcwvxrOLzLzvWR5QBNn6No1vd-2yf5', '::1', 1535700807);
INSERT INTO `file_storage_item` VALUES (110, 'fileStorage', 'http://storage.exomethai.local/source', '1/FxbtooSVWmIcxSAvrkcYtZACnNSDvlk1.jpg', 'image/jpeg', 210392, 'FxbtooSVWmIcxSAvrkcYtZACnNSDvlk1', '::1', 1562218782);
INSERT INTO `file_storage_item` VALUES (112, 'fileStorage', 'http://storage.exomethai.local/source', '1/8lHe0DJg_oKoIiMUdS06fwasOkLe2lGx.jpg', 'image/jpeg', 223823, '8lHe0DJg_oKoIiMUdS06fwasOkLe2lGx', '::1', 1562230810);
INSERT INTO `file_storage_item` VALUES (113, 'fileStorage', 'http://storage.exomethai.local/source', '1/uCfEs_a84t96Ot6OqYGKGGhHo-ZQAixe.jpg', 'image/jpeg', 176544, 'uCfEs_a84t96Ot6OqYGKGGhHo-ZQAixe', '::1', 1563730622);
INSERT INTO `file_storage_item` VALUES (117, 'fileStorage', 'https://storage.mimt.bloodcloud.online/source', '1/OlNez71GSO2Kck562UseihMzxlliaiL5.png', 'image/png', 48794, 'OlNez71GSO2Kck562UseihMzxlliaiL5', '223.206.217.177', 1576033057);

-- ----------------------------
-- Table structure for images
-- ----------------------------
DROP TABLE IF EXISTS `images`;
CREATE TABLE `images`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci COMMENT 'icon',
  `create_by` bigint(20) DEFAULT NULL COMMENT 'สร้างโดย',
  `create_date` datetime(0) DEFAULT NULL COMMENT 'สร้างเมื่อ',
  `type` int(11) DEFAULT NULL COMMENT 'ประเภท',
  `ref_id` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'รหัสสินค้า',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for informations
-- ----------------------------
DROP TABLE IF EXISTS `informations`;
CREATE TABLE `informations`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'ไตเติ้ล',
  `detail` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'รายละเอียด',
  `image` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'รูปขนาดย่อย',
  `rstat` int(1) DEFAULT NULL COMMENT 'สถานะ',
  `create_by` bigint(20) DEFAULT NULL COMMENT 'สร้างโดย',
  `create_date` datetime(0) DEFAULT NULL COMMENT 'สร้างเมื่อ',
  `update_by` bigint(20) DEFAULT NULL COMMENT 'แก้ไขโดย',
  `update_date` datetime(0) DEFAULT NULL COMMENT 'แก้ไขเมื่อ',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for members
-- ----------------------------
DROP TABLE IF EXISTS `members`;
CREATE TABLE `members`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'ชื่อ',
  `lname` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'นามสกุล',
  `tel` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'เบอร์โทรศัพท์',
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'ที่อยู่',
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'อีเมล์',
  `booking_type` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'ประเภทการอบรม',
  `rstat` int(1) DEFAULT NULL COMMENT 'สถานะ',
  `create_by` bigint(20) DEFAULT NULL COMMENT 'สร้างโดย',
  `create_date` datetime(0) DEFAULT NULL COMMENT 'สร้างเมื่อ',
  `update_by` bigint(20) DEFAULT NULL COMMENT 'แก้ไขโดย',
  `update_date` datetime(0) DEFAULT NULL COMMENT 'แก้ไขเมื่อ',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of members
-- ----------------------------
INSERT INTO `members` VALUES (1, 'Nuttaphon', 'Chanpan', '0650859480', '22 ม.5 ถนนแจ้งสนิท, หินตั้ง', 'chanpan.nuttaphon1993@gmail.com', '1', 3, 1, '2019-12-08 11:59:46', NULL, '2019-12-12 20:12:01');
INSERT INTO `members` VALUES (2, 'จรินพร', 'แสงจำปี', '0953046095', '64 หมู่ 9 บ้านป่าม่วง ต.คำบ่อ', 'chanpan.nuttaphon1993@gmail.com', '2', 1, NULL, '2019-12-11 14:08:49', NULL, NULL);

-- ----------------------------
-- Table structure for menu
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `route` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `data` blob,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `parent`(`parent`) USING BTREE,
  CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `menu` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for migration
-- ----------------------------
DROP TABLE IF EXISTS `migration`;
CREATE TABLE `migration`  (
  `version` varchar(180) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migration
-- ----------------------------
INSERT INTO `migration` VALUES ('m000000_000000_base', 1535696053);
INSERT INTO `migration` VALUES ('m140209_132017_init', 1535696058);
INSERT INTO `migration` VALUES ('m140403_174025_create_account_table', 1535696059);
INSERT INTO `migration` VALUES ('m140504_113157_update_tables', 1535696063);
INSERT INTO `migration` VALUES ('m140504_130429_create_token_table', 1535696064);
INSERT INTO `migration` VALUES ('m140830_171933_fix_ip_field', 1535696065);
INSERT INTO `migration` VALUES ('m140830_172703_change_account_table_name', 1535696065);
INSERT INTO `migration` VALUES ('m141222_110026_update_ip_field', 1535696065);
INSERT INTO `migration` VALUES ('m141222_135246_alter_username_length', 1535696066);
INSERT INTO `migration` VALUES ('m150614_103145_update_social_account_table', 1535696068);
INSERT INTO `migration` VALUES ('m150623_212711_fix_username_notnull', 1535696068);
INSERT INTO `migration` VALUES ('m151218_234654_add_timezone_to_profile', 1535696069);
INSERT INTO `migration` VALUES ('m160929_103127_add_last_login_at_to_user_table', 1535696069);
INSERT INTO `migration` VALUES ('m140602_111327_create_menu_table', 1535696117);
INSERT INTO `migration` VALUES ('m160312_050000_create_user', 1535696117);
INSERT INTO `migration` VALUES ('m140506_102106_rbac_init', 1535696133);
INSERT INTO `migration` VALUES ('m170907_052038_rbac_add_index_on_auth_assignment_user_id', 1535696133);

-- ----------------------------
-- Table structure for options
-- ----------------------------
DROP TABLE IF EXISTS `options`;
CREATE TABLE `options`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `label` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'Label',
  `value` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci COMMENT 'Value',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of options
-- ----------------------------
INSERT INTO `options` VALUES (1, 'about', '<div class=\"box box-primary\"><div class=\"box-body\"><p>เกี่ยวกับเรา</p></div></div>');
INSERT INTO `options` VALUES (2, 'contact', '<p>ติดต่อเรา</p>');
INSERT INTO `options` VALUES (3, 'initial_name_app', 'greenshop');
INSERT INTO `options` VALUES (4, 'name_app', 'greenshop');
INSERT INTO `options` VALUES (5, 'storageUrl', 'https://storage.mimt.bloodcloud.online');
INSERT INTO `options` VALUES (6, 'home', 'Home');
INSERT INTO `options` VALUES (7, 'footer', 'Footer');
INSERT INTO `options` VALUES (9, 'skin', 'skin-yellow-light');
INSERT INTO `options` VALUES (10, 'main_url', 'http://bloodcloud.local');
INSERT INTO `options` VALUES (11, 'email_recover', '<p style=\"text-align: center;\"><img src=\"https://storage.work.ncrc.in.th/ezform/editor-upload/5b54254a2bd06.png\" width=\"187\" height=\"188\" style=\"width: 187px; height: 188px;\"></p><p><span style=\"font-family: &quot;Times New Roman&quot;;\"><span style=\"font-size: 18px;\">We have received a request to reset the password for your account on nCRC website. Please click the link below to complete your password reset.</span></span></p><p><span style=\"font-family: &quot;Times New Roman&quot;;\"><span style=\"font-size: 18px;\"><a href=\"{url}\" target=\"_blank\" data-saferedirecturl=\"https://www.google.com/url?hl=th&q={url}&source=gmail&ust=1528358149116000&usg=AFQjCNEJ_aJ0_88pPTbPcStiPV_HIVk_Sg\">{url}</a></span></span></p><p><span style=\"font-family: &quot;Times New Roman&quot;;\"><span style=\"font-size: 18px;\">If you cannot click the link, please try pasting the text into your browser.</span></span></p><p><span style=\"font-family: &quot;Times New Roman&quot;;\"><span style=\"font-size: 18px;\"><br></span></span></p><p><span style=\"font-family: &quot;Times New Roman&quot;;\"><span style=\"font-size: 18px;\">If you did not make this request, you can ignore this email.</span></span></p>');
INSERT INTO `options` VALUES (12, 'email', 'chanpan.nuttaphon1993@gmail.com');

-- ----------------------------
-- Table structure for order_details
-- ----------------------------
DROP TABLE IF EXISTS `order_details`;
CREATE TABLE `order_details`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `pro_id` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` decimal(10, 2) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `totalPrice` decimal(10, 2) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 25 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of order_details
-- ----------------------------
INSERT INTO `order_details` VALUES (7, 'OD-08122019022556', '1575709433098940200', 200.00, 4, 800.00);
INSERT INTO `order_details` VALUES (8, 'OD-08122019023106', '1575710368053503300', 22900.00, 1, 36900.00);
INSERT INTO `order_details` VALUES (9, 'OD-08122019023106', '1575709433098940200', 22900.00, 1, 200.00);
INSERT INTO `order_details` VALUES (10, 'OD-08122019023106', '1575709525035545000', 22900.00, 1, 22900.00);
INSERT INTO `order_details` VALUES (11, 'OD-08122019023723', '1575709843005486100', 18900.00, 1, 18900.00);
INSERT INTO `order_details` VALUES (12, 'OD-08122019023754', '1575710368053503300', 36900.00, 1, 36900.00);
INSERT INTO `order_details` VALUES (13, 'OD-08122019031417', '1575709433098940200', 200.00, 2, 400.00);
INSERT INTO `order_details` VALUES (14, 'OD-08122019031820', '1575709843005486100', 18900.00, 1, 18900.00);
INSERT INTO `order_details` VALUES (15, 'OD-08122019032207', '1575709433098940200', 200.00, 5, 1000.00);
INSERT INTO `order_details` VALUES (16, 'OD-08122019032207', '1575709843005486100', 200.00, 1, 18900.00);
INSERT INTO `order_details` VALUES (17, 'OD-08122019032207', '1575710368053503300', 200.00, 1, 36900.00);
INSERT INTO `order_details` VALUES (18, 'OD-08122019032207', '1575709433098940200', 200.00, 1, 200.00);
INSERT INTO `order_details` VALUES (19, 'OD-08122019032355', '1575710368053503300', 36900.00, 1, 36900.00);
INSERT INTO `order_details` VALUES (20, 'OD-09122019173850', '1575778946073072900', 160.00, 2, 320.00);
INSERT INTO `order_details` VALUES (21, 'OD-10122019003759', '1575777651000951600', 210.00, 1, 210.00);
INSERT INTO `order_details` VALUES (22, 'OD-10122019114752', '1575777651000951600', 210.00, 2, 420.00);
INSERT INTO `order_details` VALUES (23, 'OD-12122019203512', '1575778946073072900', 160.00, 1, 160.00);
INSERT INTO `order_details` VALUES (24, 'OD-13122019114104', '1575777651000951600', 210.00, 1, 210.00);

-- ----------------------------
-- Table structure for orders
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders`  (
  `order_id` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'รหัสการสั่งซื้อ',
  `status` int(11) DEFAULT NULL COMMENT 'สถานะ',
  `total` decimal(10, 2) DEFAULT NULL COMMENT 'จำนวนเงิน',
  `rstat` int(1) DEFAULT NULL COMMENT 'สถานะ',
  `create_by` bigint(20) DEFAULT NULL COMMENT 'สร้างโดย',
  `create_date` datetime(0) DEFAULT NULL COMMENT 'สร้างเมื่อ',
  `update_by` bigint(20) DEFAULT NULL COMMENT 'แก้ไขโดย',
  `update_date` datetime(0) DEFAULT NULL COMMENT 'แก้ไขเมื่อ',
  PRIMARY KEY (`order_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of orders
-- ----------------------------
INSERT INTO `orders` VALUES ('OD-08122019022556', 1, 800.00, 1, 1, '2019-12-08 02:25:56', NULL, NULL);
INSERT INTO `orders` VALUES ('OD-08122019023106', 1, 60000.00, 1, 1, '2019-12-08 02:31:06', NULL, NULL);
INSERT INTO `orders` VALUES ('OD-08122019023723', 1, 18900.00, 1, 1, '2019-12-08 02:37:23', NULL, NULL);
INSERT INTO `orders` VALUES ('OD-08122019023754', 1, 36900.00, 1, 1, '2019-12-08 02:37:54', NULL, NULL);
INSERT INTO `orders` VALUES ('OD-08122019031417', 1, 400.00, 1, 1, '2019-12-08 03:14:17', NULL, NULL);
INSERT INTO `orders` VALUES ('OD-08122019031820', 1, 18900.00, 1, 1, '2019-12-08 03:18:20', NULL, NULL);
INSERT INTO `orders` VALUES ('OD-08122019032207', 1, 57000.00, 1, 1, '2019-12-08 03:22:07', NULL, NULL);
INSERT INTO `orders` VALUES ('OD-08122019032355', 1, 36900.00, 1, 1, '2019-12-08 03:23:55', NULL, NULL);
INSERT INTO `orders` VALUES ('OD-09122019173850', 1, 320.00, 1, 1, '2019-12-09 17:38:50', NULL, NULL);
INSERT INTO `orders` VALUES ('OD-10122019003759', 1, 210.00, 1, 1, '2019-12-10 00:37:59', NULL, NULL);
INSERT INTO `orders` VALUES ('OD-10122019114752', 3, 420.00, 1, 1, '2019-12-10 11:47:52', 1, '2019-12-11 09:39:48');
INSERT INTO `orders` VALUES ('OD-12122019203512', 1, 160.00, 1, 4, '2019-12-12 20:35:12', NULL, NULL);
INSERT INTO `orders` VALUES ('OD-13122019114104', 1, 210.00, 1, 4, '2019-12-13 11:41:04', NULL, NULL);

-- ----------------------------
-- Table structure for payment
-- ----------------------------
DROP TABLE IF EXISTS `payment`;
CREATE TABLE `payment`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัส',
  `order_id` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'รหัสสั่งซ์้อ',
  `price` decimal(10, 2) DEFAULT NULL COMMENT 'ยอดโอน',
  `image` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'หลักฐานการโอน',
  `note` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci COMMENT 'หมายเหตุ',
  `rstat` int(1) DEFAULT NULL COMMENT 'สถานะ',
  `create_by` bigint(20) DEFAULT NULL COMMENT 'สร้างโดย',
  `create_date` datetime(0) DEFAULT NULL COMMENT 'สร้างเมื่อ',
  `update_by` bigint(20) DEFAULT NULL COMMENT 'แก้ไขโดย',
  `update_date` datetime(0) DEFAULT NULL COMMENT 'แก้ไขเมื่อ',
  `date` datetime(0) NOT NULL COMMENT 'วันที่โอน',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of payment
-- ----------------------------
INSERT INTO `payment` VALUES (1, 'OD-10122019003759', 100.00, '1575913129058549900.jpeg', 'eeee', 1, 1, '2019-12-10 00:38:49', NULL, NULL, '2019-12-10 00:00:00');

-- ----------------------------
-- Table structure for payments
-- ----------------------------
DROP TABLE IF EXISTS `payments`;
CREATE TABLE `payments`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัส',
  `order_id` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'รหัสสั่งซ์้อ',
  `price` decimal(10, 2) DEFAULT NULL COMMENT 'ยอดโอน',
  `image` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'หลักฐานการโอน',
  `note` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci COMMENT 'หมายเหตุ',
  `rstat` int(1) DEFAULT NULL COMMENT 'สถานะ',
  `create_by` bigint(20) DEFAULT NULL COMMENT 'สร้างโดย',
  `create_date` datetime(0) DEFAULT NULL COMMENT 'สร้างเมื่อ',
  `update_by` bigint(20) DEFAULT NULL COMMENT 'แก้ไขโดย',
  `update_date` datetime(0) DEFAULT NULL COMMENT 'แก้ไขเมื่อ',
  `date` datetime(0) DEFAULT NULL COMMENT 'วันที่โอน',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of payments
-- ----------------------------
INSERT INTO `payments` VALUES (3, 'OD-09122019181844', 200.00, '1575906554034053700.jpg', 'demo', 3, 1, '2019-12-09 22:49:14', NULL, NULL, '2019-12-09 00:00:00');
INSERT INTO `payments` VALUES (4, 'OD-09122019181844', 200.00, '1575912392024147900.jpg', 'demo', 1, 1, '2019-12-10 00:26:32', NULL, NULL, '2019-12-10 00:00:00');
INSERT INTO `payments` VALUES (5, 'OD-09122019181844', 2000.00, '1575912664017986000.jpg', 'Demo', 3, 1, '2019-12-10 00:31:04', NULL, NULL, '2019-12-10 00:00:00');
INSERT INTO `payments` VALUES (6, 'OD-09122019181844', 2000.00, '1575916871096867300.jpg', '1', 3, 1, '2019-12-10 01:41:11', NULL, NULL, '2019-12-30 00:00:00');
INSERT INTO `payments` VALUES (7, 'OD-09122019181844', 300.00, '1575916954091420700.jpg', 'dfs', 3, 1, '2019-12-10 01:42:34', NULL, NULL, '2019-12-12 00:00:00');
INSERT INTO `payments` VALUES (8, 'OD-09122019181844', 2000.00, '1575917025078258600.jpg', 'sdf', 3, 1, '2019-12-10 01:43:45', NULL, NULL, '2019-12-26 00:00:00');
INSERT INTO `payments` VALUES (9, 'OD-09122019181844', 300.00, '1575917190036452500.jpg', 'ก', 3, 1, '2019-12-10 01:46:30', NULL, NULL, '2019-12-07 00:00:00');
INSERT INTO `payments` VALUES (10, 'OD-10122019034309', 2000.00, '1575924305078985800.jpg', 'asdfghjk', 1, 1, '2019-12-10 03:45:05', NULL, NULL, '2019-12-10 00:00:00');
INSERT INTO `payments` VALUES (11, 'OD-10122019040952', 200.00, '1575925814081914000.jpg', 'zxcv', 1, 1, '2019-12-10 04:10:14', NULL, NULL, '2019-12-10 00:00:00');
INSERT INTO `payments` VALUES (12, 'OD-10122019114752', 2000.00, '1575953420020892700.jpg', 'ทดสอบระบบนะครับ', 1, 1, '2019-12-10 11:50:20', NULL, NULL, '2019-12-10 00:00:00');

-- ----------------------------
-- Table structure for products
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products`  (
  `id` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'ชื่อสินค้า',
  `detail` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci COMMENT 'รายละเอียดสินค้า',
  `price` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'ราคา',
  `rstat` int(1) DEFAULT NULL COMMENT 'สถานะ',
  `create_by` bigint(20) DEFAULT NULL COMMENT 'สร้างโดย',
  `create_date` datetime(0) DEFAULT NULL COMMENT 'สร้างเมื่อ',
  `update_by` bigint(20) DEFAULT NULL COMMENT 'แก้ไขโดย',
  `update_date` datetime(0) DEFAULT NULL COMMENT 'แก้ไขเมื่อ',
  `image` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'รูปภาพหน้าสินค้า',
  `order` int(11) DEFAULT NULL COMMENT 'ลำดับที่',
  `category` int(11) DEFAULT NULL COMMENT 'หมวดหมู่',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of products
-- ----------------------------
INSERT INTO `products` VALUES ('100001', 'Macbook', 'sf', '200', 3, 1, '2019-12-07 15:39:58', 1, '2019-12-07 15:51:02', '', 1, 3);
INSERT INTO `products` VALUES ('1575709433098940200', 'เคสใสใสสำหรับ Macbook Air 13.3 11 Mac Pro 13 15 นิ้ว A 1932 A 2159', '<p>10 size available,please select the correct size&nbsp;</p><p>1：For Macbook Air 11 (A1465/A1370)&nbsp;</p><p>2: For Macbook 12 (A1534)&nbsp;</p><p>3: For Macbook Air 13 (A1466/A1369）</p><p>&nbsp;4：For Macbook Pro Retina 13 (A1502/A1425)&nbsp;</p><p>5: For Old Macbook Pro 13 (A1278)&nbsp;</p><p>6: For New Macbook Pro 13 with Touch bar (A1706/A1989/A2159)&nbsp;</p><p>7: For New Macbook Pro 13 without touch bar (A1708)&nbsp;</p><p>8: For Pro Retina 15 (A1398)&nbsp;</p><p>9: For New Macbook Pro 15 with Touch bar (A1707/A1990)&nbsp;</p><p>10: For New Macbook Air Retina 13 2018 2019 Release (A1932)&nbsp;</p><p>1.Without cut out design, but Apple logo can shine through the case， It will be brighter when your laptop lit on.&nbsp;</p><p>2.Exquisite finish plastic hard shell case protects your MacBook from scrapes and scratches.&nbsp;</p><p>3.The Redlai case allows access to all plugs and drives, plug your charger, cable or headset without removing the case.&nbsp;</p><p>4. Every computer monitor picture will have chromatic aberration，The color shall be subject to receiving。&nbsp;</p><p>5.This product is sold exclusively by Redlai. Package includes: 1*Laptop cover(top and bottom ) + 1*keyboard cover+ 1*dust plug</p>', '200', 3, 1, '2019-12-07 16:03:53', 1, '2019-12-08 11:18:14', '1575718080012380500.jpg', 10, NULL);
INSERT INTO `products` VALUES ('1575709525035545000', 'Macbook Pro 13 Retina 2014 i5-2.6Ghz SSD128GB RAM8GB คีย์เรืองแสง', '<p>- CPU : Intel Core i5 2.6 GHz.&nbsp;</p><p>- RAM : 8 GB DDR3 1600MHz.&nbsp;</p><p>- Hard Disk Drive : SSD 128GB</p><p>&nbsp;- Graphics Card : Intel Iris 5100 - 1GB&nbsp;</p><p>- Display : 13.3-inch Retina LED (2560 x 1600)&nbsp;</p><p>- Web Camera : Facetime HD</p><p>&nbsp;- Wireless : Wi-Fi 802.11ac ความเร็ว 1500 Mbps&nbsp;</p><p>- Bluetooth : 4.0 + EDR</p><p>&nbsp;- Port : 2X USB 3.0, 2X Thunderbolt2 , HDMI , SDXD Card</p><p>&nbsp;- Keyboard : Thai-Eng / Baklite&nbsp;</p><p>- Weight : 1.57 KG. สินค้าสภาพมีรอยบ้าง Cycle Count : 150 Full Charge 5731 ตัวเครื่อง+แบ็ท+สายชาร์จ คีย์บอร์ด Eng/Thai เรืองแสง ราคาพิเศษ 22,900</p>', '22900', 3, 1, '2019-12-07 16:05:25', 1, '2019-12-08 11:18:18', '1575718316070978900.jpg', 20, NULL);
INSERT INTO `products` VALUES ('1575709843005486100', '(Ph237) Macbook Pro Retina 13นิ้ว ปี2015 มือ2 สภาพสวย', '<p>18,900</p>', '18900', 3, 1, '2019-12-07 16:10:43', 1, '2019-12-08 11:18:22', '1575718326090342900.jpg', 30, NULL);
INSERT INTO `products` VALUES ('1575710368053503300', 'Apple MacBook Pro 13.3 i5/2.3GHZ/8GB/128GB/SPACE GRAY-THA', '<p>คุณสมบัติสินค้า&nbsp;</p><p>● Screen Size : 13.3 inch (diagonal)&nbsp;</p><p>● Processor : 2.3GHz dual-core Intel Core i5, Turbo Boost up to 3.6GHz&nbsp;</p><p>● Display : Retina display&nbsp;</p><p>● Memory : 8 GB of 2133MHz LPDDR3 onboard memory&nbsp;</p><p>● Storage : 128 GB SSD&nbsp;</p><p>● Graphics : Intel Iris Plus Graphics 640&nbsp;</p><p>● Camera : 720p FaceTime HD camera&nbsp;</p><p>● AudioStereo : speakers&nbsp;</p><p>● Connection Ports : Two Thunderbolt 3 (USB-C) ports</p><p>&nbsp;● Wireless : 802.11ac Wi-Fi wireless networking; IEEE 802.11a/b/g/n compatible / Bluetooth 4.2&nbsp;</p><p>● Security : N/A&nbsp;</p><p>● Color : Space Gray&nbsp;</p><p>● Battery Life : Up to 10 hours wireless web, Up to 10 hours iTunes movie playback, Up to 30 days of standby time&nbsp;</p><p>● Dimensions W x D x H : 30.41 x 21.24 x 1.49 cm.&nbsp;</p><p>● Weight : 1.37 Kg.</p><p>&nbsp;● Warranty : 1 Year&nbsp;</p><p>● Option : Backlit Keyboard (Thai) / Users Guide (Thai)&nbsp;</p><p>● Operating System : macOS Sierra</p>', '36900', 3, 1, '2019-12-07 16:19:28', 1, '2019-12-08 11:18:27', '1575718337072322200.jpg', 40, NULL);
INSERT INTO `products` VALUES ('1575777651000951600', 'เมล็ดเจียออแกนิค', '<p>เป็นผลิตภัณฑ์ออร์แกนิค 100% ปราศจากสารกำจัดศัตรูพืช, ปลอดกูลเตน (gluten-free),ไม่มีการตัดแต่งทางพันธุกรรม (GMO-free)&nbsp;</p><p>&nbsp;เมล็ดเจียเป็นขุมพลังที่ให้พลังงานแก่ร่างกายในปริมาณที่สูงและยังอุดมไปด้วยไฟเบอร์, โอเมก้า 3, โปรตีน, สารต้านอนุมูลอิสระ,วิตามินและเกลือแร่ &nbsp;การรับประทานอย่างสม่ำเสมอจะช่วยให้เรามีสุขภาพที่ดีขึ้น อาทิ ช่วยให้ผิวมีสุขภาพดี, ชะลอริ้วรอย, ช่วยบำรุงหัวใจและระบบขับถ่าย,&nbsp;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</p>', '210', 1, 1, '2019-12-08 11:00:51', 1, '2019-12-08 11:10:27', '1575777651000972200.jpg', 1, 4);
INSERT INTO `products` VALUES ('1575778814025569100', 'ข้าวกระเทียมเห็ดหอม', '<p>หอมกรุ่นกลิ่นกระเทียม เคล้าความหวานของเห็ดหอมและแครอท ให้ทั้งคุณค่าและรสชาติ เหมาะที่จะทานกับอาหารหลากหลายเมนู </p>', '145', 1, 1, '2019-12-08 11:20:14', NULL, NULL, '1575778814025586000.png', 1, 4);
INSERT INTO `products` VALUES ('1575778946073072900', 'ข้าวกล้องหอมมะลิ มาบุญครอง', '<p>ข้าวกล้องหอมมะลิอินทรีย์เป็นข้าวที่มีคุณค่าสารอาหารสูง<br>มีประโยชน์ต่อร่างกาย ดีต่อสุขภาพ เนื่องจากยังมีจมูกข้าว และรำข้าวติดอยู่ ในข้าวกล้อง<br>การย่อยเส้นใยอาหารใช้เวลานาน ทำให้น้ำตาลในแป้งของข้าวกล้องถูกปล่อยออกมามาสม่ำเสมอไม่เร็วเกินไป<br>ส่งผลให้ระดับน้ำตาลในเลือดคงที่ ทำให้ไม่รู้สึกอยากกินของหวาน หิวช้า<br>เหมาะสมกับผู้ต้องการควบคุมน้ำหนัก มีวิตามินบี1 และบี2 ช่วยเผาผลาญอาหาร<br>ช่วยให้การย่อยและการขับถ่ายดีขึ้น ทำให้ระบบประสาททำงานได้ดี </p>', '160', 1, 1, '2019-12-08 11:22:26', NULL, NULL, '1575778946073089400.jpg', 3, 4);
INSERT INTO `products` VALUES ('1575779012044876500', 'น้ำมันมะพร้าวชนิดแคปซูล', '<p>ผลิตจากมะพร้าวพันธุ์ดีจากเขตภาคใต้ของประเทศไทย ด้วยกรรมวิธีการสกัดเย็นที่ได้มาตรฐานของเนื้อมะพร้าวและเยื่อหุ้มกะลา ซึ่งทำให้ได้น้ำมันมะพร้าวสีเหลืองทอง มีกลิ่นหอมละมุน รับประทานง่าย อุดมไปด้วยคุณประโยชน์ของน้ำมันมะพร้าว จากกรดลอริคที่จะถูกทำให้เป็นโมโนลอรินเมื่อเข้าสู่ร่างกาย โดยมีคุณสมบัติในการฆ่าเชื้อโรคได้ </p>', '230', 1, 1, '2019-12-08 11:23:32', NULL, NULL, '1575779012044894700.jpg', 4, 5);
INSERT INTO `products` VALUES ('1575779092080364500', ' ข้าวธัญพืชมาบุญครอง พลัส', '<p>ข้าวธัญพืช<br>ข้าวหอมมะลิแดง มีสารต้านอนุมูลอิสระ มีกากใยสูง ซึ่งช่วยระบบขับถ่ายของร่างกาย<br>งาดำ ช่วยลดคอเลสเตอรอล ป้องกันหลอดเลือดแข็งตัวและโรคหัวใจ บำรุงผม ผิว และระบบประสาท<br>เมล็ดทานตะวัน มีคุณค่าทางโภชนาการสูง ทั้งโปรตีน ธาตุเหล็ก แคลเซียม ฟอสฟอรัส วิตามินA วิตามินB2 วิตามินD วิตามินE สูงมาก และวิตามินK<br>เมล็ดฟักทอง และ เนื้อฟักทอง มีธาติเหล็กและฟอสฟอรัสลดการเกิดนิ่วในกระเพาะปัสสาวะ สามารถขับพยาธิ </p>', '75', 1, 1, '2019-12-08 11:24:52', NULL, NULL, '1575779092080379300.png', 5, NULL);
INSERT INTO `products` VALUES ('1575779171022058800', 'Nuova Fima เกจวัดแรงดัน หน้าปัด 2.1/2 นิ้ว ', '<p>Nuova Fima เกจวัดแรงดัน หน้าปัด 2.1/2 นิ้ว เกลียวออกล่าง 1/4 นิ้ว ( ตัวเรือนสแตนเลส เกลียวทองเหลือง ) - สินค้าใหม่ 100% - ร้านค้านี้สามารถออกใบกำกับภาษีได้ - ตัวเรือนสแตนเลส 2.1/2 นิ้ว (63 mm) - เกลียวออกล่าง ทองเหลือง 1/4 นิ้ว - ใช้วัดแรงดันทั่วไป<br><br></p>', '350', 1, 1, '2019-12-08 11:26:11', NULL, NULL, '1575779171022074600.jpg', 6, 6);
INSERT INTO `products` VALUES ('1575779250070787400', 'สแลนกรองแสง เกรด A  ทอหนาพิเศษ สแลน หน้ากว้าง 2 เมตร ', '<p>ชนิดหนาพิเศษทอ 3 เข็ม ขนาดหน้ากว้าง 2 เมตร 50% 60% 80% สีดำ ใช้บังแดด ปลูกเห็ด โรงเรือนปลูกผัก ผลไม้ ▪ คลุมล้อมรั้วเลี้ยงสัตว์ ฟาร์มกุ้ง บ่อเลี้ยงปลา ▪ หลังคากันแดด ลานจอดรถ ดาดฟ้า ▪ คลุมส่วนต่างๆของบ้านที่ต้องการความร่มรื่น </p>', '75', 1, 1, '2019-12-08 11:27:30', NULL, NULL, '1575779250070812500.jpg', 7, 6);

-- ----------------------------
-- Table structure for profile
-- ----------------------------
DROP TABLE IF EXISTS `profile`;
CREATE TABLE `profile`  (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `public_email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `gravatar_email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `gravatar_id` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `location` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `bio` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `timezone` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `firstname` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastname` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `tel` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `avatar_path` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `avatar_base_url` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `sitecode` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`user_id`) USING BTREE,
  CONSTRAINT `profile_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of profile
-- ----------------------------
INSERT INTO `profile` VALUES (1, 'nuttaphon chanpan', 'ccc@gmail.com', 'chanpan.nuttaphon1993@gmail.com', 'd70f6226ff8caba303baede9f0892c0e', '', '', '15/04/1998', NULL, 'Admin', '123', '0264456562', '1/OlNez71GSO2Kck562UseihMzxlliaiL5.png', 'https://storage.mimt.bloodcloud.online/source', '10000');
INSERT INTO `profile` VALUES (3, 'User User', 'chanpan.nuttaphon@gmail.com', 'chanpan.nuttaphon@gmail.com', '926eec8d6926f51c37aedd9b3faa3702', NULL, NULL, NULL, NULL, 'User', 'User', ' ', NULL, NULL, '00');
INSERT INTO `profile` VALUES (4, 'rrr ggg', 'ddoooir@gmail.com', 'ddoooir@gmail.com', '31b04e2c69fc2f57ee5a8977e839c6a0', NULL, NULL, NULL, NULL, 'rrr', 'ggg', ' ', NULL, NULL, '00');

-- ----------------------------
-- Table structure for shippings
-- ----------------------------
DROP TABLE IF EXISTS `shippings`;
CREATE TABLE `shippings`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัส',
  `user_id` bigint(20) DEFAULT NULL COMMENT 'รหัสผู้ใช้',
  `default` int(11) DEFAULT NULL COMMENT 'ใช้งาน',
  `address` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci COMMENT 'ที่อยู่',
  `rstat` int(1) DEFAULT NULL COMMENT 'สถานะ',
  `create_by` bigint(20) DEFAULT NULL COMMENT 'สร้างโดย',
  `create_date` datetime(0) DEFAULT NULL COMMENT 'สร้างเมื่อ',
  `update_by` bigint(20) DEFAULT NULL COMMENT 'แก้ไขโดย',
  `update_date` datetime(0) DEFAULT NULL COMMENT 'แก้ไขเมื่อ',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of shippings
-- ----------------------------
INSERT INTO `shippings` VALUES (2, 1, 1, '22 ม.5 ต.หินตั้ง อ.บ้านไผ่ จ.ขอนแก่น 40110', 3, 1, '2019-12-07 16:35:03', NULL, NULL);
INSERT INTO `shippings` VALUES (3, 1, 2, 'xxx', 3, 1, '2019-12-07 16:37:02', NULL, NULL);
INSERT INTO `shippings` VALUES (4, 1, 1, 'กำ', 1, 1, '2019-12-10 04:15:19', NULL, NULL);

-- ----------------------------
-- Table structure for sitecode
-- ----------------------------
DROP TABLE IF EXISTS `sitecode`;
CREATE TABLE `sitecode`  (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Sitecode',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for skin
-- ----------------------------
DROP TABLE IF EXISTS `skin`;
CREATE TABLE `skin`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `value` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `default` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of skin
-- ----------------------------
INSERT INTO `skin` VALUES (1, 'Blue', 'skin-blue', NULL);
INSERT INTO `skin` VALUES (2, 'Black', 'skin-black', NULL);
INSERT INTO `skin` VALUES (3, 'Purple', 'skin-purple', NULL);
INSERT INTO `skin` VALUES (4, 'Green', 'skin-green', NULL);
INSERT INTO `skin` VALUES (5, 'Red', 'skin-red', NULL);
INSERT INTO `skin` VALUES (6, 'Yellow', 'skin-yellow', NULL);
INSERT INTO `skin` VALUES (7, 'Blue Light', 'skin-blue-light', NULL);
INSERT INTO `skin` VALUES (8, 'Black Light', 'skin-black-light', NULL);
INSERT INTO `skin` VALUES (9, 'Purple Light', 'skin-purple-light', NULL);
INSERT INTO `skin` VALUES (10, 'Green Light', 'skin-green-light', NULL);
INSERT INTO `skin` VALUES (11, 'Red Light', 'skin-red-light', NULL);
INSERT INTO `skin` VALUES (12, 'Yellow Light', 'skin-yellow-light', 1);

-- ----------------------------
-- Table structure for social_account
-- ----------------------------
DROP TABLE IF EXISTS `social_account`;
CREATE TABLE `social_account`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `provider` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `client_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `data` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `code` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `account_unique`(`provider`, `client_id`) USING BTREE,
  UNIQUE INDEX `account_unique_code`(`code`) USING BTREE,
  INDEX `fk_user_account`(`user_id`) USING BTREE,
  CONSTRAINT `social_account_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for speciment
-- ----------------------------
DROP TABLE IF EXISTS `speciment`;
CREATE TABLE `speciment`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'speciment',
  `create_by` int(11) DEFAULT NULL COMMENT 'สร้างโดย',
  `create_date` datetime(0) DEFAULT NULL COMMENT 'สร้างเมื่อ',
  `update_by` int(11) DEFAULT NULL COMMENT 'แก้ไขโดย',
  `update_date` datetime(0) DEFAULT NULL COMMENT 'แก้ไขเมื่อ',
  `sitecode` int(11) DEFAULT NULL COMMENT 'หน่วยงาน',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1025 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of speciment
-- ----------------------------
INSERT INTO `speciment` VALUES (1013, 'EDTA Blood 2 ml', 1, '2019-11-21 23:43:38', NULL, NULL, 10000);
INSERT INTO `speciment` VALUES (1014, 'ปัสสาวะ', 1, '2019-11-21 23:44:35', NULL, NULL, 10000);
INSERT INTO `speciment` VALUES (1015, 'น้ำลาย', 1, '2019-11-21 23:44:41', NULL, NULL, 10000);
INSERT INTO `speciment` VALUES (1016, 'อุจจาระ', 1, '2019-11-21 23:44:49', NULL, NULL, 10000);
INSERT INTO `speciment` VALUES (1017, 'Pap smear', 1, '2019-11-21 23:44:54', NULL, NULL, 10000);
INSERT INTO `speciment` VALUES (1018, 'Serum 2 ml', 1, '2019-11-21 23:45:00', NULL, NULL, 10000);
INSERT INTO `speciment` VALUES (1019, 'NaF Blood 2 ml', 1, '2019-11-21 23:45:08', NULL, NULL, 10000);
INSERT INTO `speciment` VALUES (1020, 'ชิ้นเนื้อ', 1, '2019-11-21 23:45:15', NULL, NULL, 10000);
INSERT INTO `speciment` VALUES (1021, 'Cyto', 1, '2019-11-21 23:45:25', NULL, NULL, 10000);
INSERT INTO `speciment` VALUES (1022, 'Chest XRay', 1, '2019-11-21 23:45:31', NULL, NULL, 10000);
INSERT INTO `speciment` VALUES (1023, 'Ultrasound', 1, '2019-11-21 23:45:36', NULL, NULL, 10000);
INSERT INTO `speciment` VALUES (1024, 'DF', 1, '2019-11-21 23:46:14', NULL, NULL, 10000);

-- ----------------------------
-- Table structure for token
-- ----------------------------
DROP TABLE IF EXISTS `token`;
CREATE TABLE `token`  (
  `user_id` int(11) NOT NULL,
  `code` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) NOT NULL,
  `type` smallint(6) NOT NULL,
  UNIQUE INDEX `token_unique`(`user_id`, `code`, `type`) USING BTREE,
  CONSTRAINT `token_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of token
-- ----------------------------
INSERT INTO `token` VALUES (1, 'I8mXoW29SaCipTdwM9JPD3L4oNF0pzZw', 1575913463, 1);

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `confirmed_at` int(11) DEFAULT NULL,
  `unconfirmed_email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `blocked_at` int(11) DEFAULT NULL,
  `registration_ip` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `flags` int(11) NOT NULL DEFAULT 0,
  `last_login_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `user_unique_username`(`username`) USING BTREE,
  UNIQUE INDEX `user_unique_email`(`email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (1, 'admin', 'chanpan.nuttaphon1993@gmail.com', '$2y$12$W6E0yUB2VhZ8YEdU./eYKO0dH9PJRvOhA7qiW6LgALkMRhPvHUqQS', 'KSwmb0yFT6Jf14f82pSAnAedCN44uzAQ', 1535696234, NULL, NULL, '::1', 1535696234, 1535696234, 0, 1576047615);
INSERT INTO `user` VALUES (3, 'user1', 'chanpan.nuttaphon@gmail.com', '$2y$12$xI6RBnKDbCOncpMQLVuyhO/wAg35X/KtqLo8q0hieHlnSjrtBxHGu', 'JH7SjyBwTWFw5iYcZeoQJdzNDovQdohh', 1576048293, NULL, NULL, '223.206.217.177', 1576048294, 1576048294, 0, NULL);
INSERT INTO `user` VALUES (4, 'fff', 'ddoooir@gmail.com', '$2y$12$6Qbs70Ylv0TpQJKSBrAkbeDotGYhKHnMlKD0oVSp9aEgIKNqrftLC', 'P8ML-2e4LYa0bcbzXgOCpiTKHiHC4alp', 1576157623, NULL, NULL, '115.87.234.172', 1576157623, 1576157623, 0, 1576212048);

SET FOREIGN_KEY_CHECKS = 1;
