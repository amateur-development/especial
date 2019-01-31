/*
Navicat MySQL Data Transfer

Source Server         : 127.0.0.1
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : especial

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2019-01-31 15:47:48
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `goods`
-- ----------------------------
DROP TABLE IF EXISTS `goods`;
CREATE TABLE `goods` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `user_id` int(11) unsigned NOT NULL COMMENT '操作者ID',
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '商品标题',
  `cateid_tree` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '商品标签、分类',
  `promotion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '商品卖点，促销语',
  `unit` char(100) COLLATE utf8mb4_unicode_ci DEFAULT '0' COMMENT '商品数量',
  `order_num` int(11) DEFAULT '0' COMMENT '订单成交数',
  `view_num` int(11) unsigned DEFAULT '0' COMMENT '商品浏览量',
  `market_price` decimal(10,2) DEFAULT '0.00' COMMENT '商品市场价格',
  `recent_quotation` decimal(10,2) DEFAULT '0.00' COMMENT '最新价格，报价',
  `status` tinyint(2) DEFAULT '3' COMMENT '商品状态（1正常 2禁用 3待审核 4审核不通过 99删除）',
  `reason` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '审核原因',
  `thumb` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '封面图',
  `album` text COLLATE utf8mb4_unicode_ci COMMENT '相册',
  `remark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '备注',
  `created_at` timestamp NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `updated_at` timestamp NULL DEFAULT '0000-00-00 00:00:00' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='商品表';

-- ----------------------------
-- Records of goods
-- ----------------------------

-- ----------------------------
-- Table structure for `goods_content`
-- ----------------------------
DROP TABLE IF EXISTS `goods_content`;
CREATE TABLE `goods_content` (
  `goods_id` int(11) unsigned NOT NULL COMMENT '商品ID',
  `content` text COLLATE utf8mb4_unicode_ci COMMENT '商品详情',
  PRIMARY KEY (`goods_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='商品详情表';

-- ----------------------------
-- Records of goods_content
-- ----------------------------

-- ----------------------------
-- Table structure for `order`
-- ----------------------------
DROP TABLE IF EXISTS `order`;
CREATE TABLE `order` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `order_sn` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '订单编号',
  `uid` int(11) unsigned NOT NULL COMMENT '购买用户ID',
  `goods_id` int(11) unsigned NOT NULL COMMENT '商品ID',
  `total_price` decimal(12,2) DEFAULT NULL COMMENT '订单金额',
  `recent_quotation` datetime DEFAULT NULL COMMENT '最新报价、价格',
  `over_pay_at` datetime DEFAULT '0000-00-00 00:00:00' COMMENT '支付中，解除订单时间',
  `send_pau_at` datetime DEFAULT '0000-00-00 00:00:00' COMMENT '发起支付时间',
  `pay_at` datetime DEFAULT '0000-00-00 00:00:00' COMMENT '支付成功时间',
  `confirm_at` datetime DEFAULT '0000-00-00 00:00:00' COMMENT '卖家订单确认时间',
  `status` tinyint(2) unsigned DEFAULT NULL COMMENT '1 未支付；2已支付；3 订单未确认；99 订单已关闭',
  `remark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '备注',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of order
-- ----------------------------

-- ----------------------------
-- Table structure for `sys_admin_node`
-- ----------------------------
DROP TABLE IF EXISTS `sys_admin_node`;
CREATE TABLE `sys_admin_node` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `admin_id` int(10) unsigned DEFAULT NULL COMMENT '管理员ID',
  `node_id` int(10) unsigned DEFAULT NULL COMMENT '节点ID',
  `created_at` timestamp NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `updated_at` timestamp NULL DEFAULT '0000-00-00 00:00:00' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='管理员节点权限';

-- ----------------------------
-- Records of sys_admin_node
-- ----------------------------
INSERT INTO `sys_admin_node` VALUES ('1', '1', '1', '2019-01-25 08:24:56', '2019-01-25 08:24:56');
INSERT INTO `sys_admin_node` VALUES ('2', '1', '2', '2019-01-25 08:24:56', '2019-01-25 08:24:56');
INSERT INTO `sys_admin_node` VALUES ('3', '1', '6', '2019-01-25 08:24:56', '2019-01-25 08:24:56');
INSERT INTO `sys_admin_node` VALUES ('4', '1', '7', '2019-01-25 16:32:48', '2019-01-25 16:32:51');

-- ----------------------------
-- Table structure for `sys_node`
-- ----------------------------
DROP TABLE IF EXISTS `sys_node`;
CREATE TABLE `sys_node` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上级ID',
  `icon` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '图标',
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '类目名称',
  `sort` int(10) DEFAULT '0' COMMENT '排序',
  `route` char(225) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '链接地址',
  `is_show` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否在菜单栏展示 1显示，0隐藏',
  `tree` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '树结构',
  `is_dir` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否为目录 1是，0链接',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='后台菜单节点';

-- ----------------------------
-- Records of sys_node
-- ----------------------------
INSERT INTO `sys_node` VALUES ('1', '0', 'icon-settings', '系统管理', '1', 'admin.node.lists', '1', ',1,', '1', '2019-01-22 02:53:09', '2019-01-17 01:38:58');
INSERT INTO `sys_node` VALUES ('3', '2', 'icon-direction', '菜单节点', '1', 'admin.node.lists', '1', ',1,2,', '0', '2019-01-19 09:31:16', '2019-01-17 02:43:34');
INSERT INTO `sys_node` VALUES ('2', '1', 'icon-list', '菜单管理', '1', null, '1', ',1,3,', '1', '2019-01-19 09:30:48', '2019-01-19 01:30:10');
INSERT INTO `sys_node` VALUES ('5', '3', 'icon-emotsmile', '编辑', '1', 'admin.node.edit', '0', ',1,2,5,', '0', '2019-01-22 02:40:43', '2019-01-22 02:40:43');
INSERT INTO `sys_node` VALUES ('6', '0', 'icon-notebook', '商品管理', '1', 'admin.goods.lists', '1', ',6,', '1', '2019-01-25 08:47:35', '2019-01-25 08:01:31');
INSERT INTO `sys_node` VALUES ('7', '6', 'icon-handbag', '商品种类', '1', 'admin.goods.lists', '1', ',6,7,', '0', '2019-01-26 09:17:32', '2019-01-25 08:28:00');

-- ----------------------------
-- Table structure for `sys_users`
-- ----------------------------
DROP TABLE IF EXISTS `sys_users`;
CREATE TABLE `sys_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `username` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '登录名称、账号',
  `password` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '登录密码',
  `plaintext_key` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '明文密码',
  `realname` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '联系电话',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '登录令牌',
  `limit_ip` char(130) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '限制ip',
  `login_ip` char(130) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '上一次登陆ip',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1.正常  2.禁用  99删除',
  `created_at` timestamp NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `updated_at` timestamp NULL DEFAULT '0000-00-00 00:00:00' COMMENT '更新，最近登录时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='管理员表';

-- ----------------------------
-- Records of sys_users
-- ----------------------------
INSERT INTO `sys_users` VALUES ('1', 'admin', '$2y$10$4i4ypXYIzhKNbKinPgs./.xf1XwZORiOg0x7oWJ/WO0SnX/WCaPRG', '123456789123456789', '', '13000000000', 'cRj0TYw6gn8sQqgsc5LYxs2tzg6DbbakKMMlw1gSg9zXbUP61mXGuRLGd1i3', '', '', '1', '2019-01-15 03:39:55', '2019-01-15 03:39:55');
INSERT INTO `sys_users` VALUES ('2', 'test', '$2y$10$zMOqD0UrxVeBLv2NK4n7Z.VnEp5.wSKdse08BHhXrgxXi2s/55jAi', '123456789123456789', '言先生', '13000000000', '', '', '', '1', '2019-01-18 02:33:15', '2019-01-18 02:33:15');
