/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 80012
 Source Host           : localhost:3306
 Source Schema         : laravel_v9

 Target Server Type    : MySQL
 Target Server Version : 80012
 File Encoding         : 65001

 Date: 16/07/2024 14:01:03
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admin_auth_group
-- ----------------------------
DROP TABLE IF EXISTS `admin_auth_group`;
CREATE TABLE `admin_auth_group`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '组名称',
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '组描述',
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '组状态：为1正常，为0禁用',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '权限组' ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of admin_auth_group
-- ----------------------------

-- ----------------------------
-- Table structure for admin_auth_group_access
-- ----------------------------
DROP TABLE IF EXISTS `admin_auth_group_access`;
CREATE TABLE `admin_auth_group_access`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uid` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `group_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `admin_auth_group_access_uid_index`(`uid`) USING BTREE,
  INDEX `admin_auth_group_access_group_id_index`(`group_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '用户和组的对应关系' ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of admin_auth_group_access
-- ----------------------------

-- ----------------------------
-- Table structure for admin_auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `admin_auth_rule`;
CREATE TABLE `admin_auth_rule`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `url` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '规则唯一标识',
  `group_id` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '权限所属组的ID',
  `auth` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '权限数值',
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '状态：为1正常，为0禁用',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '权限细节' ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of admin_auth_rule
-- ----------------------------

-- ----------------------------
-- Table structure for admin_menu
-- ----------------------------
DROP TABLE IF EXISTS `admin_menu`;
CREATE TABLE `admin_menu`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '菜单标题',
  `fid` int(11) NOT NULL DEFAULT 0 COMMENT '父级菜单ID',
  `url` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '链接',
  `auth` tinyint(4) NOT NULL DEFAULT 1 COMMENT '是否需要登录才可以访问，1-需要，0-不需要',
  `sort` int(11) NOT NULL DEFAULT 0 COMMENT '排序',
  `show` tinyint(4) NOT NULL DEFAULT 1 COMMENT '是否显示，1-显示，0-隐藏',
  `icon` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '菜单图标',
  `level` tinyint(4) NOT NULL DEFAULT 1 COMMENT '菜单层级，1-一级菜单，2-二级菜单，3-按钮',
  `component` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '前端组件',
  `router` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '前端路由',
  `log` tinyint(4) NOT NULL DEFAULT 1 COMMENT '是否记录日志，1-记录，0-不记录',
  `permission` tinyint(4) NOT NULL DEFAULT 1 COMMENT '是否验证权限，1-鉴权，0-放行',
  `method` tinyint(4) NOT NULL DEFAULT 1 COMMENT '请求方式，1-GET, 2-POST, 3-PUT, 4-DELETE',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 74 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '目录信息' ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of admin_menu
-- ----------------------------
INSERT INTO `admin_menu` VALUES (1, '用户登录', 73, 'admin/Login/index', 0, 0, 0, '', 2, '', '', 0, 0, 2, NULL, NULL);
INSERT INTO `admin_menu` VALUES (2, '用户登出', 73, 'admin/Login/logout', 1, 0, 0, '', 2, '', '', 1, 0, 1, NULL, NULL);
INSERT INTO `admin_menu` VALUES (3, '系统管理', 0, '', 1, 1, 1, 'ios-build', 1, '', '/system', 1, 1, 1, NULL, NULL);
INSERT INTO `admin_menu` VALUES (4, '菜单维护', 3, '', 1, 1, 1, 'md-menu', 2, 'system/menu', 'menu', 1, 1, 1, NULL, NULL);
INSERT INTO `admin_menu` VALUES (5, '菜单状态修改', 4, 'admin/Menu/changeStatus', 1, 0, 1, '', 3, '', '', 1, 1, 1, NULL, NULL);
INSERT INTO `admin_menu` VALUES (6, '新增菜单', 4, 'admin/Menu/add', 1, 0, 1, '', 3, '', '', 1, 1, 2, NULL, NULL);
INSERT INTO `admin_menu` VALUES (7, '编辑菜单', 4, 'admin/Menu/edit', 1, 0, 1, '', 3, '', '', 1, 1, 2, NULL, NULL);
INSERT INTO `admin_menu` VALUES (8, '菜单删除', 4, 'admin/Menu/del', 1, 0, 1, '', 3, '', '', 1, 1, 1, NULL, NULL);
INSERT INTO `admin_menu` VALUES (9, '用户管理', 3, '', 1, 2, 1, 'ios-people', 2, 'system/user', 'user', 1, 1, 1, NULL, NULL);
INSERT INTO `admin_menu` VALUES (10, '获取当前组的全部用户', 9, 'admin/User/getUsers', 1, 0, 1, '', 3, '', '', 1, 1, 1, NULL, NULL);
INSERT INTO `admin_menu` VALUES (11, '用户状态修改', 9, 'admin/User/changeStatus', 1, 0, 1, '', 3, '', '', 1, 1, 1, NULL, NULL);
INSERT INTO `admin_menu` VALUES (12, '新增用户', 9, 'admin/User/add', 1, 0, 1, '', 3, '', '', 1, 1, 2, NULL, NULL);
INSERT INTO `admin_menu` VALUES (13, '用户编辑', 9, 'admin/User/edit', 1, 0, 1, '', 3, '', '', 1, 1, 2, NULL, NULL);
INSERT INTO `admin_menu` VALUES (14, '用户删除', 9, 'admin/User/del', 1, 0, 1, '', 3, '', '', 1, 1, 1, NULL, NULL);
INSERT INTO `admin_menu` VALUES (15, '权限管理', 3, '', 1, 3, 1, 'md-lock', 2, 'system/auth', 'auth', 1, 1, 1, NULL, NULL);
INSERT INTO `admin_menu` VALUES (16, '权限组状态编辑', 15, 'admin/Auth/changeStatus', 1, 0, 1, '', 3, '', '', 1, 1, 1, NULL, NULL);
INSERT INTO `admin_menu` VALUES (17, '从指定组中删除指定用户', 15, 'admin/Auth/delMember', 1, 0, 1, '', 3, '', '', 1, 1, 1, NULL, NULL);
INSERT INTO `admin_menu` VALUES (18, '新增权限组', 15, 'admin/Auth/add', 1, 0, 1, '', 3, '', '', 1, 1, 2, NULL, NULL);
INSERT INTO `admin_menu` VALUES (19, '权限组编辑', 15, 'admin/Auth/edit', 1, 0, 1, '', 3, '', '', 1, 1, 2, NULL, NULL);
INSERT INTO `admin_menu` VALUES (20, '删除权限组', 15, 'admin/Auth/del', 1, 0, 1, '', 3, '', '', 1, 1, 1, NULL, NULL);
INSERT INTO `admin_menu` VALUES (21, '获取全部已开放的可选组', 15, 'admin/Auth/getGroups', 1, 0, 1, '', 3, '', '', 1, 1, 1, NULL, NULL);
INSERT INTO `admin_menu` VALUES (22, '获取组所有的权限列表', 15, 'admin/Auth/getRuleList', 1, 0, 1, '', 3, '', '', 1, 1, 1, NULL, NULL);
INSERT INTO `admin_menu` VALUES (23, '应用接入', 0, '', 1, 2, 1, 'ios-appstore', 1, '', '/apps', 1, 1, 1, NULL, NULL);
INSERT INTO `admin_menu` VALUES (24, '应用管理', 23, '', 1, 0, 1, 'md-list-box', 2, 'app/list', 'appsList', 1, 1, 1, NULL, NULL);
INSERT INTO `admin_menu` VALUES (25, '应用状态编辑', 24, 'admin/App/changeStatus', 1, 0, 1, '', 3, '', '', 1, 1, 1, NULL, NULL);
INSERT INTO `admin_menu` VALUES (26, '获取AppId,AppSecret,接口列表,应用接口权限细节', 24, 'admin/App/getAppInfo', 1, 0, 1, '', 3, '', '', 1, 1, 1, NULL, NULL);
INSERT INTO `admin_menu` VALUES (27, '新增应用', 24, 'admin/App/add', 1, 0, 1, '', 3, '', '', 1, 1, 2, NULL, NULL);
INSERT INTO `admin_menu` VALUES (28, '编辑应用', 24, 'admin/App/edit', 1, 0, 1, '', 3, '', '', 1, 1, 2, NULL, NULL);
INSERT INTO `admin_menu` VALUES (29, '删除应用', 24, 'admin/App/del', 1, 0, 1, '', 3, '', '', 1, 1, 1, NULL, NULL);
INSERT INTO `admin_menu` VALUES (30, '接口管理', 0, '', 1, 3, 1, 'ios-link', 1, '', '/interface', 1, 1, 1, NULL, NULL);
INSERT INTO `admin_menu` VALUES (31, '接口维护', 30, '', 1, 0, 1, 'md-infinite', 2, 'interface/list', 'interfaceList', 1, 1, 1, NULL, NULL);
INSERT INTO `admin_menu` VALUES (32, '接口状态编辑', 31, 'admin/InterfaceList/changeStatus', 1, 0, 1, '', 3, '', '', 1, 1, 1, NULL, NULL);
INSERT INTO `admin_menu` VALUES (33, '获取接口唯一标识', 31, 'admin/InterfaceList/getHash', 1, 0, 1, '', 3, '', '', 1, 1, 1, NULL, NULL);
INSERT INTO `admin_menu` VALUES (34, '添加接口', 31, 'admin/InterfaceList/add', 1, 0, 1, '', 3, '', '', 1, 1, 2, NULL, NULL);
INSERT INTO `admin_menu` VALUES (35, '编辑接口', 31, 'admin/InterfaceList/edit', 1, 0, 1, '', 3, '', '', 1, 1, 2, NULL, NULL);
INSERT INTO `admin_menu` VALUES (36, '删除接口', 31, 'admin/InterfaceList/del', 1, 0, 1, '', 3, '', '', 1, 1, 1, NULL, NULL);
INSERT INTO `admin_menu` VALUES (37, '获取接口请求字段', 30, 'admin/Fields/request', 1, 0, 1, '', 3, 'interface/request', 'request/:hash', 1, 1, 1, NULL, NULL);
INSERT INTO `admin_menu` VALUES (38, '获取接口返回字段', 30, 'admin/Fields/response', 1, 0, 1, '', 3, 'interface/response', 'response/:hash', 1, 1, 1, NULL, NULL);
INSERT INTO `admin_menu` VALUES (39, '添加接口字段', 31, 'admin/Fields/add', 1, 0, 1, '', 3, '', '', 1, 1, 2, NULL, NULL);
INSERT INTO `admin_menu` VALUES (40, '上传接口返回字段', 31, 'admin/Fields/upload', 1, 0, 1, '', 3, '', '', 1, 1, 2, NULL, NULL);
INSERT INTO `admin_menu` VALUES (41, '编辑接口字段', 31, 'admin/Fields/edit', 1, 0, 1, '', 3, '', '', 1, 1, 2, NULL, NULL);
INSERT INTO `admin_menu` VALUES (42, '删除接口字段', 31, 'admin/Fields/del', 1, 0, 1, '', 3, '', '', 1, 1, 1, NULL, NULL);
INSERT INTO `admin_menu` VALUES (43, '接口分组', 30, '', 1, 1, 1, 'md-archive', 2, 'interface/group', 'interfaceGroup', 1, 1, 1, NULL, NULL);
INSERT INTO `admin_menu` VALUES (44, '添加接口组', 43, 'admin/InterfaceGroup/add', 1, 0, 1, '', 3, '', '', 1, 1, 2, NULL, NULL);
INSERT INTO `admin_menu` VALUES (45, '编辑接口组', 43, 'admin/InterfaceGroup/edit', 1, 0, 1, '', 3, '', '', 1, 1, 2, NULL, NULL);
INSERT INTO `admin_menu` VALUES (46, '删除接口组', 43, 'admin/InterfaceGroup/del', 1, 0, 1, '', 3, '', '', 1, 1, 1, NULL, NULL);
INSERT INTO `admin_menu` VALUES (47, '获取全部有效的接口组', 43, 'admin/InterfaceGroup/getAll', 1, 0, 1, '', 3, '', '', 1, 1, 1, NULL, NULL);
INSERT INTO `admin_menu` VALUES (48, '接口组状态维护', 43, 'admin/InterfaceGroup/changeStatus', 1, 0, 1, '', 3, '', '', 1, 1, 1, NULL, NULL);
INSERT INTO `admin_menu` VALUES (49, '应用分组', 23, '', 1, 1, 1, 'ios-archive', 2, 'app/group', 'appsGroup', 1, 1, 1, NULL, NULL);
INSERT INTO `admin_menu` VALUES (50, '添加应用组', 49, 'admin/AppGroup/add', 1, 0, 1, '', 3, '', '', 1, 1, 2, NULL, NULL);
INSERT INTO `admin_menu` VALUES (51, '编辑应用组', 49, 'admin/AppGroup/edit', 1, 0, 1, '', 3, '', '', 1, 1, 2, NULL, NULL);
INSERT INTO `admin_menu` VALUES (52, '删除应用组', 49, 'admin/AppGroup/del', 1, 0, 1, '', 3, '', '', 1, 1, 1, NULL, NULL);
INSERT INTO `admin_menu` VALUES (53, '获取全部可用应用组', 49, 'admin/AppGroup/getAll', 1, 0, 1, '', 3, '', '', 1, 1, 1, NULL, NULL);
INSERT INTO `admin_menu` VALUES (54, '应用组状态编辑', 49, 'admin/AppGroup/changeStatus', 1, 0, 1, '', 3, '', '', 1, 1, 1, NULL, NULL);
INSERT INTO `admin_menu` VALUES (55, '菜单列表', 4, 'admin/Menu/index', 1, 0, 1, '', 3, '', '', 1, 1, 1, NULL, NULL);
INSERT INTO `admin_menu` VALUES (56, '用户列表', 9, 'admin/User/index', 1, 0, 1, '', 3, '', '', 1, 1, 1, NULL, NULL);
INSERT INTO `admin_menu` VALUES (57, '权限列表', 15, 'admin/Auth/index', 1, 0, 1, '', 3, '', '', 1, 1, 1, NULL, NULL);
INSERT INTO `admin_menu` VALUES (58, '应用列表', 24, 'admin/App/index', 1, 0, 1, '', 3, '', '', 1, 1, 1, NULL, NULL);
INSERT INTO `admin_menu` VALUES (59, '应用分组列表', 49, 'admin/AppGroup/index', 1, 0, 1, '', 3, '', '', 1, 1, 1, NULL, NULL);
INSERT INTO `admin_menu` VALUES (60, '接口列表', 31, 'admin/InterfaceList/index', 1, 0, 1, '', 3, '', '', 1, 1, 1, NULL, NULL);
INSERT INTO `admin_menu` VALUES (61, '接口分组列表', 43, 'admin/InterfaceGroup/index', 1, 0, 1, '', 3, '', '', 1, 1, 1, NULL, NULL);
INSERT INTO `admin_menu` VALUES (62, '日志管理', 3, '', 1, 4, 1, 'md-clipboard', 2, 'system/log', 'log', 1, 1, 1, NULL, NULL);
INSERT INTO `admin_menu` VALUES (63, '获取操作日志列表', 62, 'admin/Log/index', 1, 0, 1, '', 3, '', '', 1, 1, 1, NULL, NULL);
INSERT INTO `admin_menu` VALUES (64, '删除单条日志记录', 62, 'admin/Log/del', 1, 0, 1, '', 3, '', '', 1, 1, 1, NULL, NULL);
INSERT INTO `admin_menu` VALUES (65, '刷新路由', 31, 'admin/InterfaceList/refresh', 1, 0, 1, '', 3, '', '', 1, 1, 1, NULL, NULL);
INSERT INTO `admin_menu` VALUES (67, '文件上传', 73, 'admin/Index/upload', 1, 0, 0, '', 2, '', '', 1, 1, 2, NULL, NULL);
INSERT INTO `admin_menu` VALUES (68, '更新个人信息', 73, 'admin/User/own', 1, 0, 0, '', 2, '', '', 1, 1, 2, NULL, NULL);
INSERT INTO `admin_menu` VALUES (69, '刷新AppSecret', 24, 'admin/App/refreshAppSecret', 1, 0, 1, '', 3, '', '', 1, 1, 1, NULL, NULL);
INSERT INTO `admin_menu` VALUES (70, '获取用户信息', 73, 'admin/Login/getUserInfo', 1, 0, 0, '', 2, '', '', 0, 1, 1, NULL, NULL);
INSERT INTO `admin_menu` VALUES (71, '编辑权限细节', 15, 'admin/Auth/editRule', 1, 0, 1, '', 3, '', '', 1, 1, 2, NULL, NULL);
INSERT INTO `admin_menu` VALUES (72, '获取用户有权限的菜单', 73, 'admin/Login/getAccessMenu', 1, 0, 0, '', 2, '', '', 0, 0, 1, NULL, NULL);
INSERT INTO `admin_menu` VALUES (73, '系统支撑', 0, '', 0, 0, 0, 'logo-tux', 1, '', '', 0, 0, 1, NULL, NULL);

-- ----------------------------
-- Table structure for admin_user
-- ----------------------------
DROP TABLE IF EXISTS `admin_user`;
CREATE TABLE `admin_user`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '用户名',
  `nickname` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '用户昵称',
  `password` char(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '用户密码',
  `create_time` int(11) NOT NULL DEFAULT 0 COMMENT '注册时间',
  `create_ip` bigint(20) NOT NULL DEFAULT 0 COMMENT '注册IP',
  `update_time` int(11) NOT NULL DEFAULT 0 COMMENT '更新时间',
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '账号状态 0封号 1正常',
  `openid` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '三方登录唯一ID',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `admin_user_create_time_index`(`create_time`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '管理员认证信息' ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of admin_user
-- ----------------------------
INSERT INTO `admin_user` VALUES (1, 'root', 'root', 'd93a5def7511da3d0f2d171d9c344e91', 1694602205, 2130706433, 1694602205, 1, '', NULL, NULL);
INSERT INTO `admin_user` VALUES (2, 'root', 'root', '8bd44e2e8da293344ff7b8ab7135d678', 1694602205, 2130706433, 1694602205, 1, '', NULL, NULL);

-- ----------------------------
-- Table structure for admin_user_action
-- ----------------------------
DROP TABLE IF EXISTS `admin_user_action`;
CREATE TABLE `admin_user_action`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `action_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '行为名称',
  `uid` int(11) NOT NULL DEFAULT 0 COMMENT '操作用户ID',
  `nickname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '用户昵称',
  `add_time` int(11) NOT NULL DEFAULT 0 COMMENT '操作时间',
  `data` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '用户提交的数据',
  `url` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '操作URL',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `admin_user_action_uid_index`(`uid`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 297 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '用户操作日志' ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of admin_user_action
-- ----------------------------
INSERT INTO `admin_user_action` VALUES (1, '接口列表', 1, 'root', 1694602252, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/InterfaceList/index', '2023-09-13 10:50:52', '2023-09-13 10:50:52');
INSERT INTO `admin_user_action` VALUES (2, '获取全部有效的接口组', 1, 'root', 1694602252, '[]', 'admin/InterfaceGroup/getAll', '2023-09-13 10:50:52', '2023-09-13 10:50:52');
INSERT INTO `admin_user_action` VALUES (3, '接口分组列表', 1, 'root', 1694602254, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/InterfaceGroup/index', '2023-09-13 10:50:54', '2023-09-13 10:50:54');
INSERT INTO `admin_user_action` VALUES (4, '获取全部有效的接口组', 1, 'root', 1694602254, '[]', 'admin/InterfaceGroup/getAll', '2023-09-13 10:50:54', '2023-09-13 10:50:54');
INSERT INTO `admin_user_action` VALUES (5, '接口列表', 1, 'root', 1694602254, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/InterfaceList/index', '2023-09-13 10:50:54', '2023-09-13 10:50:54');
INSERT INTO `admin_user_action` VALUES (6, '应用列表', 1, 'root', 1694602259, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/App/index', '2023-09-13 10:50:59', '2023-09-13 10:50:59');
INSERT INTO `admin_user_action` VALUES (7, '应用分组列表', 1, 'root', 1694602261, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/AppGroup/index', '2023-09-13 10:51:01', '2023-09-13 10:51:01');
INSERT INTO `admin_user_action` VALUES (8, '获取全部有效的接口组', 1, 'root', 1694602263, '[]', 'admin/InterfaceGroup/getAll', '2023-09-13 10:51:03', '2023-09-13 10:51:03');
INSERT INTO `admin_user_action` VALUES (9, '接口列表', 1, 'root', 1694602263, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/InterfaceList/index', '2023-09-13 10:51:03', '2023-09-13 10:51:03');
INSERT INTO `admin_user_action` VALUES (10, '接口分组列表', 1, 'root', 1694602264, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/InterfaceGroup/index', '2023-09-13 10:51:04', '2023-09-13 10:51:04');
INSERT INTO `admin_user_action` VALUES (11, '获取全部有效的接口组', 1, 'root', 1694602267, '[]', 'admin/InterfaceGroup/getAll', '2023-09-13 10:51:07', '2023-09-13 10:51:07');
INSERT INTO `admin_user_action` VALUES (12, '接口列表', 1, 'root', 1694602267, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/InterfaceList/index', '2023-09-13 10:51:07', '2023-09-13 10:51:07');
INSERT INTO `admin_user_action` VALUES (13, '应用列表', 1, 'root', 1694602271, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/App/index', '2023-09-13 10:51:11', '2023-09-13 10:51:11');
INSERT INTO `admin_user_action` VALUES (14, '获取AppId,AppSecret,接口列表,应用接口权限细节', 1, 'root', 1694602272, '[]', 'admin/App/getAppInfo', '2023-09-13 10:51:12', '2023-09-13 10:51:12');
INSERT INTO `admin_user_action` VALUES (15, '获取全部可用应用组', 1, 'root', 1694602272, '[]', 'admin/AppGroup/getAll', '2023-09-13 10:51:12', '2023-09-13 10:51:12');
INSERT INTO `admin_user_action` VALUES (16, '应用分组列表', 1, 'root', 1694602276, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/AppGroup/index', '2023-09-13 10:51:16', '2023-09-13 10:51:16');
INSERT INTO `admin_user_action` VALUES (17, '获取接口唯一标识', 1, 'root', 1694602276, '[]', 'admin/InterfaceList/getHash', '2023-09-13 10:51:16', '2023-09-13 10:51:16');
INSERT INTO `admin_user_action` VALUES (18, '添加应用组', 1, 'root', 1694602280, '{\"description\":\"1\",\"name\":\"1\",\"hash\":\"65019424e75af\",\"id\":0}', 'admin/AppGroup/add', '2023-09-13 10:51:20', '2023-09-13 10:51:20');
INSERT INTO `admin_user_action` VALUES (19, '应用分组列表', 1, 'root', 1694602280, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/AppGroup/index', '2023-09-13 10:51:20', '2023-09-13 10:51:20');
INSERT INTO `admin_user_action` VALUES (20, '应用列表', 1, 'root', 1694602282, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/App/index', '2023-09-13 10:51:22', '2023-09-13 10:51:22');
INSERT INTO `admin_user_action` VALUES (21, '获取AppId,AppSecret,接口列表,应用接口权限细节', 1, 'root', 1694602283, '[]', 'admin/App/getAppInfo', '2023-09-13 10:51:23', '2023-09-13 10:51:23');
INSERT INTO `admin_user_action` VALUES (22, '获取全部可用应用组', 1, 'root', 1694602283, '[]', 'admin/AppGroup/getAll', '2023-09-13 10:51:23', '2023-09-13 10:51:23');
INSERT INTO `admin_user_action` VALUES (23, '新增应用', 1, 'root', 1694602290, '{\"app_name\":\"1-1\",\"app_id\":\"35387910\",\"app_secret\":\"euCaNGMcojeUDPqFJRxyPOVmbUPtqVCz\",\"app_info\":\"1-1\",\"app_api\":{\"default\":[]},\"app_group\":\"65019424e75af\",\"id\":0}', 'admin/App/add', '2023-09-13 10:51:30', '2023-09-13 10:51:30');
INSERT INTO `admin_user_action` VALUES (24, '应用列表', 1, 'root', 1694602290, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/App/index', '2023-09-13 10:51:30', '2023-09-13 10:51:30');
INSERT INTO `admin_user_action` VALUES (25, '应用列表', 1, 'root', 1694602293, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/App/index', '2023-09-13 10:51:33', '2023-09-13 10:51:33');
INSERT INTO `admin_user_action` VALUES (26, '应用列表', 1, 'root', 1694602298, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/App/index', '2023-09-13 10:51:38', '2023-09-13 10:51:38');
INSERT INTO `admin_user_action` VALUES (27, '菜单列表', 1, 'root', 1720858801, '{\"keywords\":null}', 'admin/Menu/index', '2024-07-13 08:20:01', '2024-07-13 08:20:01');
INSERT INTO `admin_user_action` VALUES (28, '应用列表', 1, 'root', 1720858803, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/App/index', '2024-07-13 08:20:03', '2024-07-13 08:20:03');
INSERT INTO `admin_user_action` VALUES (29, '应用分组列表', 1, 'root', 1720858804, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/AppGroup/index', '2024-07-13 08:20:04', '2024-07-13 08:20:04');
INSERT INTO `admin_user_action` VALUES (30, '接口分组列表', 1, 'root', 1720858806, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/InterfaceGroup/index', '2024-07-13 08:20:06', '2024-07-13 08:20:06');
INSERT INTO `admin_user_action` VALUES (31, '接口列表', 1, 'root', 1720858807, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/InterfaceList/index', '2024-07-13 08:20:07', '2024-07-13 08:20:07');
INSERT INTO `admin_user_action` VALUES (32, '获取全部有效的接口组', 1, 'root', 1720858807, '[]', 'admin/InterfaceGroup/getAll', '2024-07-13 08:20:07', '2024-07-13 08:20:07');
INSERT INTO `admin_user_action` VALUES (33, '应用列表', 1, 'root', 1720858808, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/App/index', '2024-07-13 08:20:08', '2024-07-13 08:20:08');
INSERT INTO `admin_user_action` VALUES (34, '应用分组列表', 1, 'root', 1720858809, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/AppGroup/index', '2024-07-13 08:20:09', '2024-07-13 08:20:09');
INSERT INTO `admin_user_action` VALUES (35, '菜单列表', 1, 'root', 1720858810, '{\"keywords\":null}', 'admin/Menu/index', '2024-07-13 08:20:10', '2024-07-13 08:20:10');
INSERT INTO `admin_user_action` VALUES (36, '用户列表', 1, 'root', 1720858811, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/User/index', '2024-07-13 08:20:11', '2024-07-13 08:20:11');
INSERT INTO `admin_user_action` VALUES (37, '权限列表', 1, 'root', 1720858812, '{\"page\":\"1\",\"size\":\"10\",\"keywords\":null,\"status\":null}', 'admin/Auth/index', '2024-07-13 08:20:12', '2024-07-13 08:20:12');
INSERT INTO `admin_user_action` VALUES (38, '获取操作日志列表', 1, 'root', 1720858812, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null}', 'admin/Log/index', '2024-07-13 08:20:12', '2024-07-13 08:20:12');
INSERT INTO `admin_user_action` VALUES (39, '权限列表', 1, 'root', 1720858835, '{\"page\":\"1\",\"size\":\"10\",\"keywords\":null,\"status\":null}', 'admin/Auth/index', '2024-07-13 08:20:35', '2024-07-13 08:20:35');
INSERT INTO `admin_user_action` VALUES (40, '权限列表', 1, 'root', 1720859389, '{\"page\":\"1\",\"size\":\"10\",\"keywords\":null,\"status\":null}', 'admin/Auth/index', '2024-07-13 08:29:49', '2024-07-13 08:29:49');
INSERT INTO `admin_user_action` VALUES (41, '权限列表', 1, 'root', 1720859392, '{\"page\":\"1\",\"size\":\"10\",\"keywords\":null,\"status\":null}', 'admin/Auth/index', '2024-07-13 08:29:52', '2024-07-13 08:29:52');
INSERT INTO `admin_user_action` VALUES (42, '获取操作日志列表', 1, 'root', 1720859518, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null}', 'admin/Log/index', '2024-07-13 08:31:58', '2024-07-13 08:31:58');
INSERT INTO `admin_user_action` VALUES (43, '应用列表', 1, 'root', 1720859524, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/App/index', '2024-07-13 08:32:04', '2024-07-13 08:32:04');
INSERT INTO `admin_user_action` VALUES (44, '应用分组列表', 1, 'root', 1720859525, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/AppGroup/index', '2024-07-13 08:32:05', '2024-07-13 08:32:05');
INSERT INTO `admin_user_action` VALUES (45, '应用列表', 1, 'root', 1720859526, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/App/index', '2024-07-13 08:32:06', '2024-07-13 08:32:06');
INSERT INTO `admin_user_action` VALUES (46, '应用分组列表', 1, 'root', 1720859528, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/AppGroup/index', '2024-07-13 08:32:08', '2024-07-13 08:32:08');
INSERT INTO `admin_user_action` VALUES (47, '接口列表', 1, 'root', 1720859530, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/InterfaceList/index', '2024-07-13 08:32:10', '2024-07-13 08:32:10');
INSERT INTO `admin_user_action` VALUES (48, '获取全部有效的接口组', 1, 'root', 1720859530, '[]', 'admin/InterfaceGroup/getAll', '2024-07-13 08:32:10', '2024-07-13 08:32:10');
INSERT INTO `admin_user_action` VALUES (49, '接口分组列表', 1, 'root', 1720859530, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/InterfaceGroup/index', '2024-07-13 08:32:10', '2024-07-13 08:32:10');
INSERT INTO `admin_user_action` VALUES (50, '获取全部有效的接口组', 1, 'root', 1720859704, '[]', 'admin/InterfaceGroup/getAll', '2024-07-13 08:35:04', '2024-07-13 08:35:04');
INSERT INTO `admin_user_action` VALUES (51, '接口列表', 1, 'root', 1720859704, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/InterfaceList/index', '2024-07-13 08:35:04', '2024-07-13 08:35:04');
INSERT INTO `admin_user_action` VALUES (52, '获取接口唯一标识', 1, 'root', 1720859707, '[]', 'admin/InterfaceList/getHash', '2024-07-13 08:35:07', '2024-07-13 08:35:07');
INSERT INTO `admin_user_action` VALUES (53, '接口列表', 1, 'root', 1720859718, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/InterfaceList/index', '2024-07-13 08:35:18', '2024-07-13 08:35:18');
INSERT INTO `admin_user_action` VALUES (54, '获取用户信息', 1, 'root', 1720941796, '[]', 'admin/Login/getUserInfo', '2024-07-14 07:23:16', '2024-07-14 07:23:16');
INSERT INTO `admin_user_action` VALUES (55, '菜单列表', 1, 'root', 1720941824, '{\"keywords\":null}', 'admin/Menu/index', '2024-07-14 07:23:44', '2024-07-14 07:23:44');
INSERT INTO `admin_user_action` VALUES (56, '用户列表', 1, 'root', 1720941825, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/User/index', '2024-07-14 07:23:45', '2024-07-14 07:23:45');
INSERT INTO `admin_user_action` VALUES (57, '权限列表', 1, 'root', 1720941826, '{\"page\":\"1\",\"size\":\"10\",\"keywords\":null,\"status\":null}', 'admin/Auth/index', '2024-07-14 07:23:46', '2024-07-14 07:23:46');
INSERT INTO `admin_user_action` VALUES (58, '获取操作日志列表', 1, 'root', 1720941826, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null}', 'admin/Log/index', '2024-07-14 07:23:46', '2024-07-14 07:23:46');
INSERT INTO `admin_user_action` VALUES (59, '应用列表', 1, 'root', 1720941828, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/App/index', '2024-07-14 07:23:48', '2024-07-14 07:23:48');
INSERT INTO `admin_user_action` VALUES (60, '应用分组列表', 1, 'root', 1720941828, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/AppGroup/index', '2024-07-14 07:23:48', '2024-07-14 07:23:48');
INSERT INTO `admin_user_action` VALUES (61, '接口列表', 1, 'root', 1720941829, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/InterfaceList/index', '2024-07-14 07:23:49', '2024-07-14 07:23:49');
INSERT INTO `admin_user_action` VALUES (62, '获取全部有效的接口组', 1, 'root', 1720941829, '[]', 'admin/InterfaceGroup/getAll', '2024-07-14 07:23:49', '2024-07-14 07:23:49');
INSERT INTO `admin_user_action` VALUES (63, '接口分组列表', 1, 'root', 1720941830, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/InterfaceGroup/index', '2024-07-14 07:23:50', '2024-07-14 07:23:50');
INSERT INTO `admin_user_action` VALUES (64, '菜单列表', 1, 'root', 1720941831, '{\"keywords\":null}', 'admin/Menu/index', '2024-07-14 07:23:51', '2024-07-14 07:23:51');
INSERT INTO `admin_user_action` VALUES (65, '获取全部有效的接口组', 1, 'root', 1720941879, '[]', 'admin/InterfaceGroup/getAll', '2024-07-14 07:24:39', '2024-07-14 07:24:39');
INSERT INTO `admin_user_action` VALUES (66, '接口列表', 1, 'root', 1720941879, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/InterfaceList/index', '2024-07-14 07:24:39', '2024-07-14 07:24:39');
INSERT INTO `admin_user_action` VALUES (67, '获取接口唯一标识', 1, 'root', 1720941880, '[]', 'admin/InterfaceList/getHash', '2024-07-14 07:24:40', '2024-07-14 07:24:40');
INSERT INTO `admin_user_action` VALUES (68, '添加接口', 1, 'root', 1720941883, '{\"api_class\":\"111\",\"info\":\"111\",\"group_hash\":\"default\",\"method\":2,\"hash_type\":2,\"hash\":\"66937d3834793\",\"access_token\":0,\"is_test\":0,\"id\":0}', 'admin/InterfaceList/add', '2024-07-14 07:24:43', '2024-07-14 07:24:43');
INSERT INTO `admin_user_action` VALUES (69, '接口列表', 1, 'root', 1720941883, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/InterfaceList/index', '2024-07-14 07:24:43', '2024-07-14 07:24:43');
INSERT INTO `admin_user_action` VALUES (70, '获取接口唯一标识', 1, 'root', 1720941884, '[]', 'admin/InterfaceList/getHash', '2024-07-14 07:24:44', '2024-07-14 07:24:44');
INSERT INTO `admin_user_action` VALUES (71, '获取接口唯一标识', 1, 'root', 1720941891, '[]', 'admin/InterfaceList/getHash', '2024-07-14 07:24:51', '2024-07-14 07:24:51');
INSERT INTO `admin_user_action` VALUES (72, '添加接口', 1, 'root', 1720941893, '{\"api_class\":\"111\",\"info\":\"111\",\"group_hash\":\"default\",\"method\":2,\"hash_type\":2,\"hash\":\"66937d431dd8b\",\"access_token\":0,\"is_test\":0,\"id\":0}', 'admin/InterfaceList/add', '2024-07-14 07:24:53', '2024-07-14 07:24:53');
INSERT INTO `admin_user_action` VALUES (73, '接口列表', 1, 'root', 1720941894, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/InterfaceList/index', '2024-07-14 07:24:54', '2024-07-14 07:24:54');
INSERT INTO `admin_user_action` VALUES (74, '添加接口', 1, 'root', 1720941955, '{\"api_class\":\"111\",\"info\":\"111\",\"group_hash\":\"default\",\"method\":2,\"hash_type\":2,\"hash\":\"66937d431dd8b\",\"access_token\":0,\"is_test\":0,\"id\":0}', 'admin/InterfaceList/add', '2024-07-14 07:25:55', '2024-07-14 07:25:55');
INSERT INTO `admin_user_action` VALUES (75, '添加接口', 1, 'root', 1720942032, '{\"api_class\":\"111\",\"info\":\"111\",\"group_hash\":\"default\",\"method\":2,\"hash_type\":2,\"hash\":\"66937d431dd8b\",\"access_token\":0,\"is_test\":0,\"id\":0}', 'admin/InterfaceList/add', '2024-07-14 07:27:12', '2024-07-14 07:27:12');
INSERT INTO `admin_user_action` VALUES (76, '添加接口', 1, 'root', 1720942056, '{\"api_class\":\"111\",\"info\":\"111\",\"group_hash\":\"default\",\"method\":2,\"hash_type\":2,\"hash\":\"66937d431dd8b\",\"access_token\":0,\"is_test\":0,\"id\":0}', 'admin/InterfaceList/add', '2024-07-14 07:27:36', '2024-07-14 07:27:36');
INSERT INTO `admin_user_action` VALUES (77, '添加接口', 1, 'root', 1720942067, '{\"api_class\":\"111\",\"info\":\"111\",\"group_hash\":\"default\",\"method\":2,\"hash_type\":2,\"hash\":\"66937d431dd8b\",\"access_token\":0,\"is_test\":0,\"id\":0}', 'admin/InterfaceList/add', '2024-07-14 07:27:47', '2024-07-14 07:27:47');
INSERT INTO `admin_user_action` VALUES (78, '添加接口', 1, 'root', 1720942104, '{\"api_class\":\"111\",\"info\":\"111\",\"group_hash\":\"default\",\"method\":2,\"hash_type\":2,\"hash\":\"66937d431dd8b\",\"access_token\":0,\"is_test\":0,\"id\":0}', 'admin/InterfaceList/add', '2024-07-14 07:28:24', '2024-07-14 07:28:24');
INSERT INTO `admin_user_action` VALUES (79, '添加接口', 1, 'root', 1720942164, '{\"api_class\":\"111\",\"info\":\"111\",\"group_hash\":\"default\",\"method\":2,\"hash_type\":2,\"hash\":\"66937d431dd8b\",\"access_token\":0,\"is_test\":0,\"id\":0}', 'admin/InterfaceList/add', '2024-07-14 07:29:24', '2024-07-14 07:29:24');
INSERT INTO `admin_user_action` VALUES (80, '添加接口', 1, 'root', 1720942266, '{\"api_class\":\"111\",\"info\":\"111\",\"group_hash\":\"default\",\"method\":2,\"hash_type\":2,\"hash\":\"66937d431dd8b\",\"access_token\":0,\"is_test\":0,\"id\":0}', 'admin/InterfaceList/add', '2024-07-14 07:31:06', '2024-07-14 07:31:06');
INSERT INTO `admin_user_action` VALUES (81, '添加接口', 1, 'root', 1720942269, '{\"api_class\":\"111\",\"info\":\"111\",\"group_hash\":\"default\",\"method\":2,\"hash_type\":2,\"hash\":\"66937d431dd8b\",\"access_token\":0,\"is_test\":0,\"id\":0}', 'admin/InterfaceList/add', '2024-07-14 07:31:09', '2024-07-14 07:31:09');
INSERT INTO `admin_user_action` VALUES (82, '添加接口', 1, 'root', 1720942315, '{\"api_class\":\"111\",\"info\":\"111\",\"group_hash\":\"default\",\"method\":2,\"hash_type\":2,\"hash\":\"66937d431dd8b\",\"access_token\":0,\"is_test\":0,\"id\":0}', 'admin/InterfaceList/add', '2024-07-14 07:31:55', '2024-07-14 07:31:55');
INSERT INTO `admin_user_action` VALUES (83, '添加接口', 1, 'root', 1720942325, '{\"api_class\":\"111\",\"info\":\"111\",\"group_hash\":\"default\",\"method\":2,\"hash_type\":2,\"hash\":\"66937d431dd8b\",\"access_token\":0,\"is_test\":0,\"id\":0}', 'admin/InterfaceList/add', '2024-07-14 07:32:05', '2024-07-14 07:32:05');
INSERT INTO `admin_user_action` VALUES (84, '获取用户信息', 1, 'root', 1720942357, '[]', 'admin/Login/getUserInfo', '2024-07-14 07:32:37', '2024-07-14 07:32:37');
INSERT INTO `admin_user_action` VALUES (85, '接口列表', 1, 'root', 1720942357, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/InterfaceList/index', '2024-07-14 07:32:37', '2024-07-14 07:32:37');
INSERT INTO `admin_user_action` VALUES (86, '获取全部有效的接口组', 1, 'root', 1720942357, '[]', 'admin/InterfaceGroup/getAll', '2024-07-14 07:32:37', '2024-07-14 07:32:37');
INSERT INTO `admin_user_action` VALUES (87, '删除接口', 1, 'root', 1720942371, '{\"hash\":null}', 'admin/InterfaceList/del', '2024-07-14 07:32:51', '2024-07-14 07:32:51');
INSERT INTO `admin_user_action` VALUES (88, '获取接口唯一标识', 1, 'root', 1720942397, '[]', 'admin/InterfaceList/getHash', '2024-07-14 07:33:17', '2024-07-14 07:33:17');
INSERT INTO `admin_user_action` VALUES (89, '添加接口', 1, 'root', 1720942400, '{\"api_class\":\"111\",\"info\":\"111\",\"group_hash\":\"default\",\"method\":2,\"hash_type\":2,\"hash\":\"66937f3de032b\",\"access_token\":0,\"is_test\":0,\"id\":0}', 'admin/InterfaceList/add', '2024-07-14 07:33:20', '2024-07-14 07:33:20');
INSERT INTO `admin_user_action` VALUES (90, '接口列表', 1, 'root', 1720942401, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/InterfaceList/index', '2024-07-14 07:33:21', '2024-07-14 07:33:21');
INSERT INTO `admin_user_action` VALUES (91, '获取接口唯一标识', 1, 'root', 1720942454, '[]', 'admin/InterfaceList/getHash', '2024-07-14 07:34:14', '2024-07-14 07:34:14');
INSERT INTO `admin_user_action` VALUES (92, '添加接口', 1, 'root', 1720942459, '{\"api_class\":\"111\",\"info\":\"111\",\"group_hash\":\"default\",\"method\":2,\"hash_type\":2,\"hash\":\"66937d431dd8b\",\"access_token\":0,\"is_test\":0,\"id\":0}', 'admin/InterfaceList/add', '2024-07-14 07:34:19', '2024-07-14 07:34:19');
INSERT INTO `admin_user_action` VALUES (93, '添加接口', 1, 'root', 1720942764, '{\"api_class\":\"111\",\"info\":\"111\",\"group_hash\":\"default\",\"method\":2,\"hash_type\":2,\"hash\":\"66937d431dd8b\",\"access_token\":0,\"is_test\":0,\"id\":0}', 'admin/InterfaceList/add', '2024-07-14 07:39:24', '2024-07-14 07:39:24');
INSERT INTO `admin_user_action` VALUES (94, '添加接口', 1, 'root', 1720942800, '{\"api_class\":\"111\",\"info\":\"111\",\"group_hash\":\"default\",\"method\":2,\"hash_type\":2,\"hash\":\"66937d431dd8b\",\"access_token\":0,\"is_test\":0,\"id\":0}', 'admin/InterfaceList/add', '2024-07-14 07:40:00', '2024-07-14 07:40:00');
INSERT INTO `admin_user_action` VALUES (95, '添加接口', 1, 'root', 1720943103, '{\"api_class\":\"111\",\"info\":\"111\",\"group_hash\":\"default\",\"method\":2,\"hash_type\":2,\"hash\":\"66937d431dd8b\",\"access_token\":0,\"is_test\":0,\"id\":0}', 'admin/InterfaceList/add', '2024-07-14 07:45:03', '2024-07-14 07:45:03');
INSERT INTO `admin_user_action` VALUES (96, '添加接口', 1, 'root', 1720943213, '{\"api_class\":\"111\",\"info\":\"111\",\"group_hash\":\"default\",\"method\":2,\"hash_type\":2,\"hash\":\"66937d431dd8b\",\"access_token\":0,\"is_test\":0,\"id\":0}', 'admin/InterfaceList/add', '2024-07-14 07:46:53', '2024-07-14 07:46:53');
INSERT INTO `admin_user_action` VALUES (97, '添加接口', 1, 'root', 1720943317, '{\"api_class\":\"111\",\"info\":\"111\",\"group_hash\":\"default\",\"method\":2,\"hash_type\":2,\"hash\":\"66937d431dd8b\",\"access_token\":0,\"is_test\":0,\"id\":0}', 'admin/InterfaceList/add', '2024-07-14 07:48:37', '2024-07-14 07:48:37');
INSERT INTO `admin_user_action` VALUES (98, '添加接口', 1, 'root', 1720943525, '{\"api_class\":\"111\",\"info\":\"111\",\"group_hash\":\"default\",\"method\":2,\"hash_type\":2,\"hash\":\"66937d431dd8b\",\"access_token\":0,\"is_test\":0,\"id\":0}', 'admin/InterfaceList/add', '2024-07-14 07:52:05', '2024-07-14 07:52:05');
INSERT INTO `admin_user_action` VALUES (99, '添加接口', 1, 'root', 1720943551, '{\"api_class\":\"111\",\"info\":\"111\",\"group_hash\":\"default\",\"method\":2,\"hash_type\":2,\"hash\":\"66937d431dd8b\",\"access_token\":0,\"is_test\":0,\"id\":0}', 'admin/InterfaceList/add', '2024-07-14 07:52:31', '2024-07-14 07:52:31');
INSERT INTO `admin_user_action` VALUES (100, '添加接口', 1, 'root', 1720943609, '{\"api_class\":\"111\",\"info\":\"111\",\"group_hash\":\"default\",\"method\":2,\"hash_type\":2,\"hash\":\"66937d431dd8b\",\"access_token\":0,\"is_test\":0,\"id\":0}', 'admin/InterfaceList/add', '2024-07-14 07:53:29', '2024-07-14 07:53:29');
INSERT INTO `admin_user_action` VALUES (101, '添加接口', 1, 'root', 1720943707, '{\"api_class\":\"111\",\"info\":\"111\",\"group_hash\":\"default\",\"method\":2,\"hash_type\":2,\"hash\":\"66937d431dd8b\",\"access_token\":0,\"is_test\":0,\"id\":0}', 'admin/InterfaceList/add', '2024-07-14 07:55:07', '2024-07-14 07:55:07');
INSERT INTO `admin_user_action` VALUES (102, '添加接口', 1, 'root', 1720943797, '{\"api_class\":\"111\",\"info\":\"111\",\"group_hash\":\"default\",\"method\":2,\"hash_type\":2,\"hash\":\"66937d431dd8b\",\"access_token\":0,\"is_test\":0,\"id\":0}', 'admin/InterfaceList/add', '2024-07-14 07:56:37', '2024-07-14 07:56:37');
INSERT INTO `admin_user_action` VALUES (103, '添加接口', 1, 'root', 1720943831, '{\"api_class\":\"111\",\"info\":\"111\",\"group_hash\":\"default\",\"method\":2,\"hash_type\":2,\"hash\":\"66937d431dd8b\",\"access_token\":0,\"is_test\":0,\"id\":0}', 'admin/InterfaceList/add', '2024-07-14 07:57:11', '2024-07-14 07:57:11');
INSERT INTO `admin_user_action` VALUES (104, '添加接口', 1, 'root', 1720943849, '{\"api_class\":\"111\",\"info\":\"111\",\"group_hash\":\"default\",\"method\":2,\"hash_type\":2,\"hash\":\"66937d431dd8b\",\"access_token\":0,\"is_test\":0,\"id\":0}', 'admin/InterfaceList/add', '2024-07-14 07:57:29', '2024-07-14 07:57:29');
INSERT INTO `admin_user_action` VALUES (105, '获取用户信息', 1, 'root', 1720943977, '[]', 'admin/Login/getUserInfo', '2024-07-14 07:59:37', '2024-07-14 07:59:37');
INSERT INTO `admin_user_action` VALUES (106, '获取全部有效的接口组', 1, 'root', 1720943977, '[]', 'admin/InterfaceGroup/getAll', '2024-07-14 07:59:37', '2024-07-14 07:59:37');
INSERT INTO `admin_user_action` VALUES (107, '接口列表', 1, 'root', 1720943977, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/InterfaceList/index', '2024-07-14 07:59:37', '2024-07-14 07:59:37');
INSERT INTO `admin_user_action` VALUES (108, '删除接口', 1, 'root', 1720944198, '{\"hash\":\"66937d431dd8b\"}', 'admin/InterfaceList/del', '2024-07-14 08:03:18', '2024-07-14 08:03:18');
INSERT INTO `admin_user_action` VALUES (109, '获取接口唯一标识', 1, 'root', 1720944201, '[]', 'admin/InterfaceList/getHash', '2024-07-14 08:03:21', '2024-07-14 08:03:21');
INSERT INTO `admin_user_action` VALUES (110, '添加接口', 1, 'root', 1720944204, '{\"api_class\":\"222\",\"info\":\"222\",\"group_hash\":\"default\",\"method\":2,\"hash_type\":2,\"hash\":\"669386496cb67\",\"access_token\":0,\"is_test\":0,\"id\":0}', 'admin/InterfaceList/add', '2024-07-14 08:03:24', '2024-07-14 08:03:24');
INSERT INTO `admin_user_action` VALUES (111, '接口列表', 1, 'root', 1720944204, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/InterfaceList/index', '2024-07-14 08:03:24', '2024-07-14 08:03:24');
INSERT INTO `admin_user_action` VALUES (112, '接口列表', 1, 'root', 1720944208, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/InterfaceList/index', '2024-07-14 08:03:28', '2024-07-14 08:03:28');
INSERT INTO `admin_user_action` VALUES (113, '删除接口', 1, 'root', 1720944210, '{\"hash\":\"66937d431dd8b\"}', 'admin/InterfaceList/del', '2024-07-14 08:03:30', '2024-07-14 08:03:30');
INSERT INTO `admin_user_action` VALUES (114, '删除接口', 1, 'root', 1720944322, '{\"hash\":\"66937d431dd8b\"}', 'admin/InterfaceList/del', '2024-07-14 08:05:22', '2024-07-14 08:05:22');
INSERT INTO `admin_user_action` VALUES (115, '接口列表', 1, 'root', 1720944354, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/InterfaceList/index', '2024-07-14 08:05:54', '2024-07-14 08:05:54');
INSERT INTO `admin_user_action` VALUES (116, '接口列表', 1, 'root', 1720944356, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/InterfaceList/index', '2024-07-14 08:05:56', '2024-07-14 08:05:56');
INSERT INTO `admin_user_action` VALUES (117, '删除接口', 1, 'root', 1720944363, '{\"hash\":\"66937d431dd8b\"}', 'admin/InterfaceList/del', '2024-07-14 08:06:03', '2024-07-14 08:06:03');
INSERT INTO `admin_user_action` VALUES (118, '删除接口', 1, 'root', 1720944373, '{\"api_class\":\"111\",\"info\":\"111\",\"group_hash\":\"default\",\"method\":2,\"hash_type\":2,\"hash\":\"66937d431dd8b\",\"access_token\":0,\"is_test\":0,\"id\":0}', 'admin/InterfaceList/del', '2024-07-14 08:06:13', '2024-07-14 08:06:13');
INSERT INTO `admin_user_action` VALUES (119, '删除接口', 1, 'root', 1720944382, '{\"api_class\":\"111\",\"info\":\"111\",\"group_hash\":\"default\",\"method\":2,\"hash_type\":2,\"hash\":\"66937d431dd8b\",\"access_token\":0,\"is_test\":0,\"id\":0}', 'admin/InterfaceList/del', '2024-07-14 08:06:22', '2024-07-14 08:06:22');
INSERT INTO `admin_user_action` VALUES (120, '删除接口', 1, 'root', 1720944424, '{\"api_class\":\"111\",\"info\":\"111\",\"group_hash\":\"default\",\"method\":2,\"hash_type\":2,\"hash\":\"66937d431dd8b\",\"access_token\":0,\"is_test\":0,\"id\":0}', 'admin/InterfaceList/del', '2024-07-14 08:07:04', '2024-07-14 08:07:04');
INSERT INTO `admin_user_action` VALUES (121, '删除接口', 1, 'root', 1720944446, '{\"api_class\":\"111\",\"info\":\"111\",\"group_hash\":\"default\",\"method\":2,\"hash_type\":2,\"hash\":\"66937d431dd8b\",\"access_token\":0,\"is_test\":0,\"id\":0}', 'admin/InterfaceList/del', '2024-07-14 08:07:26', '2024-07-14 08:07:26');
INSERT INTO `admin_user_action` VALUES (122, '删除接口', 1, 'root', 1720944495, '{\"api_class\":\"111\",\"info\":\"111\",\"group_hash\":\"default\",\"method\":2,\"hash_type\":2,\"hash\":\"66937d431dd8b\",\"access_token\":0,\"is_test\":0,\"id\":0}', 'admin/InterfaceList/del', '2024-07-14 08:08:15', '2024-07-14 08:08:15');
INSERT INTO `admin_user_action` VALUES (123, '获取用户信息', 1, 'root', 1720944695, '[]', 'admin/Login/getUserInfo', '2024-07-14 08:11:35', '2024-07-14 08:11:35');
INSERT INTO `admin_user_action` VALUES (124, '接口列表', 1, 'root', 1720944696, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/InterfaceList/index', '2024-07-14 08:11:36', '2024-07-14 08:11:36');
INSERT INTO `admin_user_action` VALUES (125, '获取全部有效的接口组', 1, 'root', 1720944696, '[]', 'admin/InterfaceGroup/getAll', '2024-07-14 08:11:36', '2024-07-14 08:11:36');
INSERT INTO `admin_user_action` VALUES (126, '删除接口', 1, 'root', 1720944698, '{\"hash\":\"669386496cb67\"}', 'admin/InterfaceList/del', '2024-07-14 08:11:38', '2024-07-14 08:11:38');
INSERT INTO `admin_user_action` VALUES (127, '删除接口', 1, 'root', 1720944887, '{\"hash\":\"669386496cb67\"}', 'admin/InterfaceList/del', '2024-07-14 08:14:47', '2024-07-14 08:14:47');
INSERT INTO `admin_user_action` VALUES (128, '接口列表', 1, 'root', 1720944889, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/InterfaceList/index', '2024-07-14 08:14:49', '2024-07-14 08:14:49');
INSERT INTO `admin_user_action` VALUES (129, '获取接口唯一标识', 1, 'root', 1720944891, '[]', 'admin/InterfaceList/getHash', '2024-07-14 08:14:51', '2024-07-14 08:14:51');
INSERT INTO `admin_user_action` VALUES (130, '添加接口', 1, 'root', 1720944893, '{\"api_class\":\"111\",\"info\":\"111\",\"group_hash\":\"default\",\"method\":2,\"hash_type\":2,\"hash\":\"669388fb0c586\",\"access_token\":0,\"is_test\":0,\"id\":0}', 'admin/InterfaceList/add', '2024-07-14 08:14:53', '2024-07-14 08:14:53');
INSERT INTO `admin_user_action` VALUES (131, '接口列表', 1, 'root', 1720944893, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/InterfaceList/index', '2024-07-14 08:14:53', '2024-07-14 08:14:53');
INSERT INTO `admin_user_action` VALUES (132, '接口分组列表', 1, 'root', 1720945005, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/InterfaceGroup/index', '2024-07-14 08:16:45', '2024-07-14 08:16:45');
INSERT INTO `admin_user_action` VALUES (133, '接口分组列表', 1, 'root', 1720945294, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/InterfaceGroup/index', '2024-07-14 08:21:34', '2024-07-14 08:21:34');
INSERT INTO `admin_user_action` VALUES (134, '获取接口唯一标识', 1, 'root', 1720945295, '[]', 'admin/InterfaceList/getHash', '2024-07-14 08:21:35', '2024-07-14 08:21:35');
INSERT INTO `admin_user_action` VALUES (135, '添加接口组', 1, 'root', 1720945299, '{\"description\":\"333\",\"name\":\"333\",\"hash\":\"66938a8f27d37\",\"image\":null,\"id\":0}', 'admin/InterfaceGroup/add', '2024-07-14 08:21:39', '2024-07-14 08:21:39');
INSERT INTO `admin_user_action` VALUES (136, '接口分组列表', 1, 'root', 1720945299, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/InterfaceGroup/index', '2024-07-14 08:21:39', '2024-07-14 08:21:39');
INSERT INTO `admin_user_action` VALUES (137, '获取接口唯一标识', 1, 'root', 1720945300, '[]', 'admin/InterfaceList/getHash', '2024-07-14 08:21:40', '2024-07-14 08:21:40');
INSERT INTO `admin_user_action` VALUES (138, '接口分组列表', 1, 'root', 1720945303, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/InterfaceGroup/index', '2024-07-14 08:21:43', '2024-07-14 08:21:43');
INSERT INTO `admin_user_action` VALUES (139, '删除接口组', 1, 'root', 1720945305, '{\"hash\":\"66938a8f27d37\"}', 'admin/InterfaceGroup/del', '2024-07-14 08:21:45', '2024-07-14 08:21:45');
INSERT INTO `admin_user_action` VALUES (140, '应用列表', 1, 'root', 1720945317, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/App/index', '2024-07-14 08:21:57', '2024-07-14 08:21:57');
INSERT INTO `admin_user_action` VALUES (141, '获取全部可用应用组', 1, 'root', 1720945318, '[]', 'admin/AppGroup/getAll', '2024-07-14 08:21:58', '2024-07-14 08:21:58');
INSERT INTO `admin_user_action` VALUES (142, '获取AppId,AppSecret,接口列表,应用接口权限细节', 1, 'root', 1720945318, '[]', 'admin/App/getAppInfo', '2024-07-14 08:21:58', '2024-07-14 08:21:58');
INSERT INTO `admin_user_action` VALUES (143, '新增应用', 1, 'root', 1720945321, '{\"app_name\":\"333\",\"app_id\":\"57823507\",\"app_secret\":\"PopvWEymMJMnrBLMHebKfCNixgnmltUg\",\"app_info\":null,\"app_api\":{\"default\":[]},\"app_group\":\"default\",\"id\":0}', 'admin/App/add', '2024-07-14 08:22:01', '2024-07-14 08:22:01');
INSERT INTO `admin_user_action` VALUES (144, '应用列表', 1, 'root', 1720945321, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/App/index', '2024-07-14 08:22:01', '2024-07-14 08:22:01');
INSERT INTO `admin_user_action` VALUES (145, '删除应用', 1, 'root', 1720945325, '{\"id\":\"2\"}', 'admin/App/del', '2024-07-14 08:22:05', '2024-07-14 08:22:05');
INSERT INTO `admin_user_action` VALUES (146, '应用分组列表', 1, 'root', 1720945327, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/AppGroup/index', '2024-07-14 08:22:07', '2024-07-14 08:22:07');
INSERT INTO `admin_user_action` VALUES (147, '获取接口唯一标识', 1, 'root', 1720945330, '[]', 'admin/InterfaceList/getHash', '2024-07-14 08:22:10', '2024-07-14 08:22:10');
INSERT INTO `admin_user_action` VALUES (148, '添加应用组', 1, 'root', 1720945332, '{\"description\":null,\"name\":\"333\",\"hash\":\"66938ab239be2\",\"id\":0}', 'admin/AppGroup/add', '2024-07-14 08:22:12', '2024-07-14 08:22:12');
INSERT INTO `admin_user_action` VALUES (149, '应用分组列表', 1, 'root', 1720945332, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/AppGroup/index', '2024-07-14 08:22:12', '2024-07-14 08:22:12');
INSERT INTO `admin_user_action` VALUES (150, '删除应用组', 1, 'root', 1720945335, '{\"hash\":\"66938ab239be2\"}', 'admin/AppGroup/del', '2024-07-14 08:22:15', '2024-07-14 08:22:15');
INSERT INTO `admin_user_action` VALUES (151, '应用列表', 1, 'root', 1720945337, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/App/index', '2024-07-14 08:22:17', '2024-07-14 08:22:17');
INSERT INTO `admin_user_action` VALUES (152, '菜单列表', 1, 'root', 1720945338, '{\"keywords\":null}', 'admin/Menu/index', '2024-07-14 08:22:18', '2024-07-14 08:22:18');
INSERT INTO `admin_user_action` VALUES (153, '接口列表', 1, 'root', 1720947001, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/InterfaceList/index', '2024-07-14 08:50:01', '2024-07-14 08:50:01');
INSERT INTO `admin_user_action` VALUES (154, '获取全部有效的接口组', 1, 'root', 1720947001, '[]', 'admin/InterfaceGroup/getAll', '2024-07-14 08:50:01', '2024-07-14 08:50:01');
INSERT INTO `admin_user_action` VALUES (155, '菜单列表', 1, 'root', 1721032692, '{\"keywords\":null}', 'admin/Menu/index', '2024-07-15 08:38:12', '2024-07-15 08:38:12');
INSERT INTO `admin_user_action` VALUES (156, '应用列表', 1, 'root', 1721032694, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/App/index', '2024-07-15 08:38:14', '2024-07-15 08:38:14');
INSERT INTO `admin_user_action` VALUES (157, '应用分组列表', 1, 'root', 1721032694, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/AppGroup/index', '2024-07-15 08:38:14', '2024-07-15 08:38:14');
INSERT INTO `admin_user_action` VALUES (158, '接口列表', 1, 'root', 1721032695, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/InterfaceList/index', '2024-07-15 08:38:15', '2024-07-15 08:38:15');
INSERT INTO `admin_user_action` VALUES (159, '获取全部有效的接口组', 1, 'root', 1721032696, '[]', 'admin/InterfaceGroup/getAll', '2024-07-15 08:38:16', '2024-07-15 08:38:16');
INSERT INTO `admin_user_action` VALUES (160, '接口分组列表', 1, 'root', 1721032696, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/InterfaceGroup/index', '2024-07-15 08:38:16', '2024-07-15 08:38:16');
INSERT INTO `admin_user_action` VALUES (161, '获取全部有效的接口组', 1, 'root', 1721032880, '[]', 'admin/InterfaceGroup/getAll', '2024-07-15 08:41:20', '2024-07-15 08:41:20');
INSERT INTO `admin_user_action` VALUES (162, '接口列表', 1, 'root', 1721032880, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/InterfaceList/index', '2024-07-15 08:41:20', '2024-07-15 08:41:20');
INSERT INTO `admin_user_action` VALUES (163, '接口列表', 1, 'root', 1721034616, '{\"page\":\"1\",\"size\":\"10\",\"type\":\"\",\"keywords\":\"\",\"status\":\"\"}', 'admin/InterfaceList/index', NULL, NULL);
INSERT INTO `admin_user_action` VALUES (164, '获取全部有效的接口组', 1, 'root', 1721034616, '[]', 'admin/InterfaceGroup/getAll', NULL, NULL);
INSERT INTO `admin_user_action` VALUES (165, '接口列表', 1, 'root', 1721034959, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/InterfaceList/index', '2024-07-15 09:15:59', '2024-07-15 09:15:59');
INSERT INTO `admin_user_action` VALUES (166, '获取全部有效的接口组', 1, 'root', 1721034959, '[]', 'admin/InterfaceGroup/getAll', '2024-07-15 09:15:59', '2024-07-15 09:15:59');
INSERT INTO `admin_user_action` VALUES (167, '接口列表', 1, 'root', 1721034978, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/InterfaceList/index', '2024-07-15 09:16:18', '2024-07-15 09:16:18');
INSERT INTO `admin_user_action` VALUES (168, '获取全部有效的接口组', 1, 'root', 1721034978, '[]', 'admin/InterfaceGroup/getAll', '2024-07-15 09:16:18', '2024-07-15 09:16:18');
INSERT INTO `admin_user_action` VALUES (169, '应用列表', 1, 'root', 1721034981, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/App/index', '2024-07-15 09:16:21', '2024-07-15 09:16:21');
INSERT INTO `admin_user_action` VALUES (170, '获取全部可用应用组', 1, 'root', 1721034985, '[]', 'admin/AppGroup/getAll', '2024-07-15 09:16:25', '2024-07-15 09:16:25');
INSERT INTO `admin_user_action` VALUES (171, '获取AppId,AppSecret,接口列表,应用接口权限细节', 1, 'root', 1721034986, '{\"id\":\"1\"}', 'admin/App/getAppInfo', '2024-07-15 09:16:26', '2024-07-15 09:16:26');
INSERT INTO `admin_user_action` VALUES (172, '编辑应用', 1, 'root', 1721034988, '{\"app_name\":\"1-1\",\"app_id\":\"35387910\",\"app_secret\":\"euCaNGMcojeUDPqFJRxyPOVmbUPtqVCz\",\"app_info\":\"1-1\",\"app_api\":{\"default\":[\"669388fb0c586\"]},\"app_group\":\"65019424e75af\",\"id\":1}', 'admin/App/edit', '2024-07-15 09:16:28', '2024-07-15 09:16:28');
INSERT INTO `admin_user_action` VALUES (173, '应用列表', 1, 'root', 1721034988, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/App/index', '2024-07-15 09:16:28', '2024-07-15 09:16:28');
INSERT INTO `admin_user_action` VALUES (174, '获取全部可用应用组', 1, 'root', 1721034988, '[]', 'admin/AppGroup/getAll', '2024-07-15 09:16:28', '2024-07-15 09:16:28');
INSERT INTO `admin_user_action` VALUES (175, '获取AppId,AppSecret,接口列表,应用接口权限细节', 1, 'root', 1721034989, '{\"id\":\"1\"}', 'admin/App/getAppInfo', '2024-07-15 09:16:29', '2024-07-15 09:16:29');
INSERT INTO `admin_user_action` VALUES (176, '应用列表', 1, 'root', 1721035544, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/App/index', '2024-07-15 09:25:44', '2024-07-15 09:25:44');
INSERT INTO `admin_user_action` VALUES (177, '应用分组列表', 1, 'root', 1721035546, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/AppGroup/index', '2024-07-15 09:25:46', '2024-07-15 09:25:46');
INSERT INTO `admin_user_action` VALUES (178, '菜单列表', 1, 'root', 1721035547, '{\"keywords\":null}', 'admin/Menu/index', '2024-07-15 09:25:47', '2024-07-15 09:25:47');
INSERT INTO `admin_user_action` VALUES (179, '用户列表', 1, 'root', 1721035548, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/User/index', '2024-07-15 09:25:48', '2024-07-15 09:25:48');
INSERT INTO `admin_user_action` VALUES (180, '权限列表', 1, 'root', 1721035548, '{\"page\":\"1\",\"size\":\"10\",\"keywords\":null,\"status\":null}', 'admin/Auth/index', '2024-07-15 09:25:48', '2024-07-15 09:25:48');
INSERT INTO `admin_user_action` VALUES (181, '获取操作日志列表', 1, 'root', 1721035548, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null}', 'admin/Log/index', '2024-07-15 09:25:48', '2024-07-15 09:25:48');
INSERT INTO `admin_user_action` VALUES (182, '获取全部有效的接口组', 1, 'root', 1721090744, '[]', 'admin/InterfaceGroup/getAll', '2024-07-16 00:45:44', '2024-07-16 00:45:44');
INSERT INTO `admin_user_action` VALUES (183, '接口列表', 1, 'root', 1721090744, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/InterfaceList/index', '2024-07-16 00:45:44', '2024-07-16 00:45:44');
INSERT INTO `admin_user_action` VALUES (184, '获取接口请求字段', 1, 'root', 1721090756, '{\"page\":\"1\",\"size\":\"10\",\"hash\":\"669388fb0c586\"}', 'admin/Fields/request', '2024-07-16 00:45:56', '2024-07-16 00:45:56');
INSERT INTO `admin_user_action` VALUES (185, '接口列表', 1, 'root', 1721090761, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/InterfaceList/index', '2024-07-16 00:46:01', '2024-07-16 00:46:01');
INSERT INTO `admin_user_action` VALUES (186, '获取全部有效的接口组', 1, 'root', 1721090761, '[]', 'admin/InterfaceGroup/getAll', '2024-07-16 00:46:01', '2024-07-16 00:46:01');
INSERT INTO `admin_user_action` VALUES (187, '获取用户信息', 1, 'root', 1721090784, '[]', 'admin/Login/getUserInfo', '2024-07-16 00:46:24', '2024-07-16 00:46:24');
INSERT INTO `admin_user_action` VALUES (188, '接口列表', 1, 'root', 1721090785, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/InterfaceList/index', '2024-07-16 00:46:25', '2024-07-16 00:46:25');
INSERT INTO `admin_user_action` VALUES (189, '获取全部有效的接口组', 1, 'root', 1721090785, '[]', 'admin/InterfaceGroup/getAll', '2024-07-16 00:46:25', '2024-07-16 00:46:25');
INSERT INTO `admin_user_action` VALUES (190, '接口列表', 1, 'root', 1721091097, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/InterfaceList/index', '2024-07-16 00:51:37', '2024-07-16 00:51:37');
INSERT INTO `admin_user_action` VALUES (191, '获取全部有效的接口组', 1, 'root', 1721091097, '[]', 'admin/InterfaceGroup/getAll', '2024-07-16 00:51:37', '2024-07-16 00:51:37');
INSERT INTO `admin_user_action` VALUES (192, '接口列表', 1, 'root', 1721091105, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/InterfaceList/index', '2024-07-16 00:51:45', '2024-07-16 00:51:45');
INSERT INTO `admin_user_action` VALUES (193, '获取全部有效的接口组', 1, 'root', 1721091105, '[]', 'admin/InterfaceGroup/getAll', '2024-07-16 00:51:45', '2024-07-16 00:51:45');
INSERT INTO `admin_user_action` VALUES (194, '获取用户信息', 1, 'root', 1721091106, '[]', 'admin/Login/getUserInfo', '2024-07-16 00:51:46', '2024-07-16 00:51:46');
INSERT INTO `admin_user_action` VALUES (195, '获取全部有效的接口组', 1, 'root', 1721091107, '[]', 'admin/InterfaceGroup/getAll', '2024-07-16 00:51:47', '2024-07-16 00:51:47');
INSERT INTO `admin_user_action` VALUES (196, '接口列表', 1, 'root', 1721091107, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/InterfaceList/index', '2024-07-16 00:51:47', '2024-07-16 00:51:47');
INSERT INTO `admin_user_action` VALUES (197, '获取全部有效的接口组', 1, 'root', 1721091110, '[]', 'admin/InterfaceGroup/getAll', '2024-07-16 00:51:50', '2024-07-16 00:51:50');
INSERT INTO `admin_user_action` VALUES (198, '接口列表', 1, 'root', 1721091110, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/InterfaceList/index', '2024-07-16 00:51:50', '2024-07-16 00:51:50');
INSERT INTO `admin_user_action` VALUES (199, '接口列表', 1, 'root', 1721091114, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/InterfaceList/index', '2024-07-16 00:51:54', '2024-07-16 00:51:54');
INSERT INTO `admin_user_action` VALUES (200, '获取全部有效的接口组', 1, 'root', 1721091114, '[]', 'admin/InterfaceGroup/getAll', '2024-07-16 00:51:54', '2024-07-16 00:51:54');
INSERT INTO `admin_user_action` VALUES (201, '获取全部有效的接口组', 1, 'root', 1721091120, '[]', 'admin/InterfaceGroup/getAll', '2024-07-16 00:52:00', '2024-07-16 00:52:00');
INSERT INTO `admin_user_action` VALUES (202, '接口列表', 1, 'root', 1721091120, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/InterfaceList/index', '2024-07-16 00:52:00', '2024-07-16 00:52:00');
INSERT INTO `admin_user_action` VALUES (203, '获取全部有效的接口组', 1, 'root', 1721091419, '[]', 'admin/InterfaceGroup/getAll', '2024-07-16 00:56:59', '2024-07-16 00:56:59');
INSERT INTO `admin_user_action` VALUES (204, '接口列表', 1, 'root', 1721091419, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/InterfaceList/index', '2024-07-16 00:56:59', '2024-07-16 00:56:59');
INSERT INTO `admin_user_action` VALUES (205, '获取接口请求字段', 1, 'root', 1721091431, '{\"page\":\"1\",\"size\":\"10\",\"hash\":\"6695c4441133a\"}', 'admin/Fields/request', '2024-07-16 00:57:11', '2024-07-16 00:57:11');
INSERT INTO `admin_user_action` VALUES (206, '获取接口请求字段', 1, 'root', 1721091499, '{\"page\":\"1\",\"size\":\"10\",\"hash\":\"6695c4441133a\"}', 'admin/Fields/request', '2024-07-16 00:58:19', '2024-07-16 00:58:19');
INSERT INTO `admin_user_action` VALUES (207, '获取接口请求字段', 1, 'root', 1721091544, '{\"page\":\"1\",\"size\":\"10\",\"hash\":\"6695c4441133a\"}', 'admin/Fields/request', '2024-07-16 00:59:04', '2024-07-16 00:59:04');
INSERT INTO `admin_user_action` VALUES (208, '获取接口请求字段', 1, 'root', 1721091572, '{\"page\":\"1\",\"size\":\"10\",\"hash\":\"6695c4441133a\"}', 'admin/Fields/request', '2024-07-16 00:59:32', '2024-07-16 00:59:32');
INSERT INTO `admin_user_action` VALUES (209, '获取接口请求字段', 1, 'root', 1721091587, '{\"page\":\"1\",\"size\":\"10\",\"hash\":\"6695c4441133a\"}', 'admin/Fields/request', '2024-07-16 00:59:47', '2024-07-16 00:59:47');
INSERT INTO `admin_user_action` VALUES (210, '获取接口请求字段', 1, 'root', 1721091709, '{\"page\":\"1\",\"size\":\"10\",\"hash\":\"6695c4441133a\"}', 'admin/Fields/request', '2024-07-16 01:01:49', '2024-07-16 01:01:49');
INSERT INTO `admin_user_action` VALUES (211, '获取接口请求字段', 1, 'root', 1721091712, '{\"page\":\"1\",\"size\":\"10\",\"hash\":\"6695c4441133a\"}', 'admin/Fields/request', '2024-07-16 01:01:52', '2024-07-16 01:01:52');
INSERT INTO `admin_user_action` VALUES (212, '获取接口请求字段', 1, 'root', 1721091743, '{\"page\":\"1\",\"size\":\"10\",\"hash\":\"6695c4441133a\"}', 'admin/Fields/request', '2024-07-16 01:02:23', '2024-07-16 01:02:23');
INSERT INTO `admin_user_action` VALUES (213, '获取接口请求字段', 1, 'root', 1721091770, '{\"page\":\"1\",\"size\":\"10\",\"hash\":\"6695c4441133a\"}', 'admin/Fields/request', '2024-07-16 01:02:50', '2024-07-16 01:02:50');
INSERT INTO `admin_user_action` VALUES (214, '获取用户信息', 1, 'root', 1721091814, '[]', 'admin/Login/getUserInfo', '2024-07-16 01:03:34', '2024-07-16 01:03:34');
INSERT INTO `admin_user_action` VALUES (215, '获取全部有效的接口组', 1, 'root', 1721091814, '[]', 'admin/InterfaceGroup/getAll', '2024-07-16 01:03:34', '2024-07-16 01:03:34');
INSERT INTO `admin_user_action` VALUES (216, '接口列表', 1, 'root', 1721091814, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/InterfaceList/index', '2024-07-16 01:03:34', '2024-07-16 01:03:34');
INSERT INTO `admin_user_action` VALUES (217, '接口列表', 1, 'root', 1721091821, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/InterfaceList/index', '2024-07-16 01:03:41', '2024-07-16 01:03:41');
INSERT INTO `admin_user_action` VALUES (218, '获取全部有效的接口组', 1, 'root', 1721091821, '[]', 'admin/InterfaceGroup/getAll', '2024-07-16 01:03:41', '2024-07-16 01:03:41');
INSERT INTO `admin_user_action` VALUES (219, '接口列表', 1, 'root', 1721091975, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/InterfaceList/index', '2024-07-16 01:06:15', '2024-07-16 01:06:15');
INSERT INTO `admin_user_action` VALUES (220, '获取全部有效的接口组', 1, 'root', 1721091975, '[]', 'admin/InterfaceGroup/getAll', '2024-07-16 01:06:15', '2024-07-16 01:06:15');
INSERT INTO `admin_user_action` VALUES (221, '获取用户信息', 1, 'root', 1721091977, '[]', 'admin/Login/getUserInfo', '2024-07-16 01:06:17', '2024-07-16 01:06:17');
INSERT INTO `admin_user_action` VALUES (222, '接口列表', 1, 'root', 1721091977, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/InterfaceList/index', '2024-07-16 01:06:17', '2024-07-16 01:06:17');
INSERT INTO `admin_user_action` VALUES (223, '获取全部有效的接口组', 1, 'root', 1721091977, '[]', 'admin/InterfaceGroup/getAll', '2024-07-16 01:06:17', '2024-07-16 01:06:17');
INSERT INTO `admin_user_action` VALUES (224, '接口列表', 1, 'root', 1721091995, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/InterfaceList/index', '2024-07-16 01:06:35', '2024-07-16 01:06:35');
INSERT INTO `admin_user_action` VALUES (225, '获取全部有效的接口组', 1, 'root', 1721091995, '[]', 'admin/InterfaceGroup/getAll', '2024-07-16 01:06:35', '2024-07-16 01:06:35');
INSERT INTO `admin_user_action` VALUES (226, '接口列表', 1, 'root', 1721092728, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/InterfaceList/index', '2024-07-16 01:18:48', '2024-07-16 01:18:48');
INSERT INTO `admin_user_action` VALUES (227, '获取全部有效的接口组', 1, 'root', 1721092728, '[]', 'admin/InterfaceGroup/getAll', '2024-07-16 01:18:48', '2024-07-16 01:18:48');
INSERT INTO `admin_user_action` VALUES (228, '获取用户信息', 1, 'root', 1721092730, '[]', 'admin/Login/getUserInfo', '2024-07-16 01:18:50', '2024-07-16 01:18:50');
INSERT INTO `admin_user_action` VALUES (229, '获取全部有效的接口组', 1, 'root', 1721092730, '[]', 'admin/InterfaceGroup/getAll', '2024-07-16 01:18:50', '2024-07-16 01:18:50');
INSERT INTO `admin_user_action` VALUES (230, '接口列表', 1, 'root', 1721092730, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/InterfaceList/index', '2024-07-16 01:18:50', '2024-07-16 01:18:50');
INSERT INTO `admin_user_action` VALUES (231, '获取接口请求字段', 1, 'root', 1721092741, '{\"page\":\"1\",\"size\":\"10\",\"hash\":\"669388fb0c586\"}', 'admin/Fields/request', '2024-07-16 01:19:01', '2024-07-16 01:19:01');
INSERT INTO `admin_user_action` VALUES (232, '添加接口字段', 1, 'root', 1721092820, '{\"field_name\":\"test\",\"data_type\":\"2\",\"defaults\":null,\"range\":\"111\",\"is_must\":\"1\",\"info\":\"111\",\"type\":0,\"id\":0,\"hash\":\"669388fb0c586\"}', 'admin/Fields/add', '2024-07-16 01:20:20', '2024-07-16 01:20:20');
INSERT INTO `admin_user_action` VALUES (233, '添加接口字段', 1, 'root', 1721092900, '{\"field_name\":\"test\",\"data_type\":\"2\",\"defaults\":null,\"range\":\"111\",\"is_must\":\"1\",\"info\":\"111\",\"type\":0,\"id\":0,\"hash\":\"669388fb0c586\"}', 'admin/Fields/add', '2024-07-16 01:21:40', '2024-07-16 01:21:40');
INSERT INTO `admin_user_action` VALUES (234, '获取接口请求字段', 1, 'root', 1721092900, '{\"page\":\"1\",\"size\":\"10\",\"hash\":\"669388fb0c586\"}', 'admin/Fields/request', '2024-07-16 01:21:40', '2024-07-16 01:21:40');
INSERT INTO `admin_user_action` VALUES (235, '编辑接口字段', 1, 'root', 1721092910, '{\"field_name\":\"test\",\"data_type\":\"2\",\"defaults\":\"111\",\"range\":\"111\",\"is_must\":\"0\",\"info\":\"111\",\"type\":0,\"id\":1,\"hash\":\"669388fb0c586\",\"isMust\":\"1\"}', 'admin/Fields/edit', '2024-07-16 01:21:50', '2024-07-16 01:21:50');
INSERT INTO `admin_user_action` VALUES (236, '编辑接口字段', 1, 'root', 1721092957, '{\"field_name\":\"test\",\"data_type\":\"2\",\"defaults\":\"111\",\"range\":\"111\",\"is_must\":\"0\",\"info\":\"111\",\"type\":0,\"id\":1,\"hash\":\"669388fb0c586\",\"isMust\":\"1\"}', 'admin/Fields/edit', '2024-07-16 01:22:37', '2024-07-16 01:22:37');
INSERT INTO `admin_user_action` VALUES (237, '编辑接口字段', 1, 'root', 1721093010, '{\"field_name\":\"test\",\"data_type\":\"2\",\"defaults\":\"111\",\"range\":\"111\",\"is_must\":\"0\",\"info\":\"111\",\"type\":0,\"id\":1,\"hash\":\"669388fb0c586\",\"isMust\":\"1\"}', 'admin/Fields/edit', '2024-07-16 01:23:30', '2024-07-16 01:23:30');
INSERT INTO `admin_user_action` VALUES (238, '编辑接口字段', 1, 'root', 1721093027, '{\"field_name\":\"test\",\"data_type\":\"2\",\"defaults\":\"111\",\"range\":\"111\",\"is_must\":\"0\",\"info\":\"111\",\"type\":0,\"id\":1,\"hash\":\"669388fb0c586\",\"isMust\":\"1\"}', 'admin/Fields/edit', '2024-07-16 01:23:47', '2024-07-16 01:23:47');
INSERT INTO `admin_user_action` VALUES (239, '获取接口请求字段', 1, 'root', 1721093027, '{\"page\":\"1\",\"size\":\"10\",\"hash\":\"669388fb0c586\"}', 'admin/Fields/request', '2024-07-16 01:23:47', '2024-07-16 01:23:47');
INSERT INTO `admin_user_action` VALUES (240, '编辑接口字段', 1, 'root', 1721093033, '{\"field_name\":\"test\",\"data_type\":\"2\",\"defaults\":\"111\",\"range\":\"111\",\"is_must\":\"1\",\"info\":\"111\",\"type\":0,\"id\":1,\"hash\":\"669388fb0c586\",\"isMust\":\"1\"}', 'admin/Fields/edit', '2024-07-16 01:23:53', '2024-07-16 01:23:53');
INSERT INTO `admin_user_action` VALUES (241, '获取接口请求字段', 1, 'root', 1721093033, '{\"page\":\"1\",\"size\":\"10\",\"hash\":\"669388fb0c586\"}', 'admin/Fields/request', '2024-07-16 01:23:53', '2024-07-16 01:23:53');
INSERT INTO `admin_user_action` VALUES (242, '添加接口字段', 1, 'root', 1721093042, '{\"field_name\":\"222\",\"data_type\":\"2\",\"defaults\":\"222\",\"range\":\"222\",\"is_must\":\"0\",\"info\":\"222\",\"type\":0,\"id\":0,\"hash\":\"669388fb0c586\",\"isMust\":\"1\"}', 'admin/Fields/add', '2024-07-16 01:24:02', '2024-07-16 01:24:02');
INSERT INTO `admin_user_action` VALUES (243, '获取接口请求字段', 1, 'root', 1721093043, '{\"page\":\"1\",\"size\":\"10\",\"hash\":\"669388fb0c586\"}', 'admin/Fields/request', '2024-07-16 01:24:03', '2024-07-16 01:24:03');
INSERT INTO `admin_user_action` VALUES (244, '接口列表', 1, 'root', 1721093046, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/InterfaceList/index', '2024-07-16 01:24:06', '2024-07-16 01:24:06');
INSERT INTO `admin_user_action` VALUES (245, '获取全部有效的接口组', 1, 'root', 1721093046, '[]', 'admin/InterfaceGroup/getAll', '2024-07-16 01:24:06', '2024-07-16 01:24:06');
INSERT INTO `admin_user_action` VALUES (246, '获取接口返回字段', 1, 'root', 1721093047, '{\"page\":\"1\",\"size\":\"10\",\"hash\":\"669388fb0c586\"}', 'admin/Fields/response', '2024-07-16 01:24:07', '2024-07-16 01:24:07');
INSERT INTO `admin_user_action` VALUES (247, '获取用户信息', 1, 'root', 1721093051, '[]', 'admin/Login/getUserInfo', '2024-07-16 01:24:11', '2024-07-16 01:24:11');
INSERT INTO `admin_user_action` VALUES (248, '获取接口返回字段', 1, 'root', 1721093051, '{\"page\":\"1\",\"size\":\"10\",\"hash\":\"669388fb0c586\"}', 'admin/Fields/response', '2024-07-16 01:24:11', '2024-07-16 01:24:11');
INSERT INTO `admin_user_action` VALUES (249, '接口列表', 1, 'root', 1721093052, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/InterfaceList/index', '2024-07-16 01:24:12', '2024-07-16 01:24:12');
INSERT INTO `admin_user_action` VALUES (250, '获取全部有效的接口组', 1, 'root', 1721093052, '[]', 'admin/InterfaceGroup/getAll', '2024-07-16 01:24:12', '2024-07-16 01:24:12');
INSERT INTO `admin_user_action` VALUES (251, '获取接口请求字段', 1, 'root', 1721093054, '{\"page\":\"1\",\"size\":\"10\",\"hash\":\"669388fb0c586\"}', 'admin/Fields/request', '2024-07-16 01:24:14', '2024-07-16 01:24:14');
INSERT INTO `admin_user_action` VALUES (252, '删除接口字段', 1, 'root', 1721093056, '{\"id\":\"1\"}', 'admin/Fields/del', '2024-07-16 01:24:16', '2024-07-16 01:24:16');
INSERT INTO `admin_user_action` VALUES (253, '删除接口字段', 1, 'root', 1721093058, '{\"id\":\"2\"}', 'admin/Fields/del', '2024-07-16 01:24:18', '2024-07-16 01:24:18');
INSERT INTO `admin_user_action` VALUES (254, '获取用户信息', 1, 'root', 1721093061, '[]', 'admin/Login/getUserInfo', '2024-07-16 01:24:21', '2024-07-16 01:24:21');
INSERT INTO `admin_user_action` VALUES (255, '获取接口请求字段', 1, 'root', 1721093062, '{\"page\":\"1\",\"size\":\"10\",\"hash\":\"669388fb0c586\"}', 'admin/Fields/request', '2024-07-16 01:24:22', '2024-07-16 01:24:22');
INSERT INTO `admin_user_action` VALUES (256, '接口列表', 1, 'root', 1721093063, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/InterfaceList/index', '2024-07-16 01:24:23', '2024-07-16 01:24:23');
INSERT INTO `admin_user_action` VALUES (257, '获取全部有效的接口组', 1, 'root', 1721093063, '[]', 'admin/InterfaceGroup/getAll', '2024-07-16 01:24:23', '2024-07-16 01:24:23');
INSERT INTO `admin_user_action` VALUES (258, '获取接口返回字段', 1, 'root', 1721093083, '{\"page\":\"1\",\"size\":\"10\",\"hash\":\"669388fb0c586\"}', 'admin/Fields/response', '2024-07-16 01:24:43', '2024-07-16 01:24:43');
INSERT INTO `admin_user_action` VALUES (259, '上传接口返回字段', 1, 'root', 1721093086, '{\"jsonStr\":\"{\\n    \\\"code\\\": -14,\\n    \\\"msg\\\": \\\"ApiAuth\\u4e0d\\u5339\\u914d\\\",\\n    \\\"data\\\": []\\n}\",\"type\":1,\"hash\":\"669388fb0c586\"}', 'admin/Fields/upload', '2024-07-16 01:24:46', '2024-07-16 01:24:46');
INSERT INTO `admin_user_action` VALUES (260, '上传接口返回字段', 1, 'root', 1721093129, '{\"jsonStr\":\"{\\n    \\\"code\\\": -14,\\n    \\\"msg\\\": \\\"ApiAuth\\u4e0d\\u5339\\u914d\\\",\\n    \\\"data\\\": []\\n}\",\"type\":1,\"hash\":\"669388fb0c586\"}', 'admin/Fields/upload', '2024-07-16 01:25:29', '2024-07-16 01:25:29');
INSERT INTO `admin_user_action` VALUES (261, '获取接口返回字段', 1, 'root', 1721093129, '{\"page\":\"1\",\"size\":\"10\",\"hash\":\"669388fb0c586\"}', 'admin/Fields/response', '2024-07-16 01:25:29', '2024-07-16 01:25:29');
INSERT INTO `admin_user_action` VALUES (262, '接口列表', 1, 'root', 1721095355, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/InterfaceList/index', '2024-07-16 02:02:35', '2024-07-16 02:02:35');
INSERT INTO `admin_user_action` VALUES (263, '获取全部有效的接口组', 1, 'root', 1721095355, '[]', 'admin/InterfaceGroup/getAll', '2024-07-16 02:02:35', '2024-07-16 02:02:35');
INSERT INTO `admin_user_action` VALUES (264, '获取接口返回字段', 1, 'root', 1721095357, '{\"page\":\"1\",\"size\":\"10\",\"hash\":\"669388fb0c586\"}', 'admin/Fields/response', '2024-07-16 02:02:37', '2024-07-16 02:02:37');
INSERT INTO `admin_user_action` VALUES (265, '上传接口返回字段', 1, 'root', 1721095364, '{\"jsonStr\":\"{\\n    \\\"code\\\": 1,\\n    \\\"msg\\\": \\\"\\u64cd\\u4f5c\\u6210\\u529f\\\",\\n    \\\"data\\\": {\\n        \\\"list\\\": [\\n            {\\n                \\\"id\\\": 1,\\n                \\\"api_class\\\": \\\"111\\\",\\n                \\\"hash\\\": \\\"6695c4441133a\\\",\\n                \\\"access_token\\\": 0,\\n                \\\"status\\\": 1,\\n                \\\"method\\\": 2,\\n                \\\"info\\\": \\\"111\\\",\\n                \\\"is_test\\\": 0,\\n                \\\"return_str\\\": null,\\n                \\\"group_hash\\\": \\\"default\\\",\\n                \\\"hash_type\\\": 2\\n            }\\n        ],\\n        \\\"count\\\": 1\\n    }\\n}\",\"type\":1,\"hash\":\"669388fb0c586\"}', 'admin/Fields/upload', '2024-07-16 02:02:44', '2024-07-16 02:02:44');
INSERT INTO `admin_user_action` VALUES (266, '获取接口返回字段', 1, 'root', 1721095365, '{\"page\":\"1\",\"size\":\"10\",\"hash\":\"669388fb0c586\"}', 'admin/Fields/response', '2024-07-16 02:02:45', '2024-07-16 02:02:45');
INSERT INTO `admin_user_action` VALUES (267, '获取接口返回字段', 1, 'root', 1721095368, '{\"page\":\"2\",\"size\":\"10\",\"hash\":\"669388fb0c586\"}', 'admin/Fields/response', '2024-07-16 02:02:48', '2024-07-16 02:02:48');
INSERT INTO `admin_user_action` VALUES (268, '获取接口返回字段', 1, 'root', 1721095369, '{\"page\":\"1\",\"size\":\"10\",\"hash\":\"669388fb0c586\"}', 'admin/Fields/response', '2024-07-16 02:02:49', '2024-07-16 02:02:49');
INSERT INTO `admin_user_action` VALUES (269, '获取全部有效的接口组', 1, 'root', 1721095370, '[]', 'admin/InterfaceGroup/getAll', '2024-07-16 02:02:50', '2024-07-16 02:02:50');
INSERT INTO `admin_user_action` VALUES (270, '接口列表', 1, 'root', 1721095370, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/InterfaceList/index', '2024-07-16 02:02:50', '2024-07-16 02:02:50');
INSERT INTO `admin_user_action` VALUES (271, '获取用户信息', 1, 'root', 1721096905, '[]', 'admin/Login/getUserInfo', '2024-07-16 02:28:25', '2024-07-16 02:28:25');
INSERT INTO `admin_user_action` VALUES (272, '菜单列表', 1, 'root', 1721096908, '{\"keywords\":null}', 'admin/Menu/index', '2024-07-16 02:28:28', '2024-07-16 02:28:28');
INSERT INTO `admin_user_action` VALUES (273, '应用列表', 1, 'root', 1721096910, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/App/index', '2024-07-16 02:28:30', '2024-07-16 02:28:30');
INSERT INTO `admin_user_action` VALUES (274, '应用分组列表', 1, 'root', 1721096910, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/AppGroup/index', '2024-07-16 02:28:30', '2024-07-16 02:28:30');
INSERT INTO `admin_user_action` VALUES (275, '应用列表', 1, 'root', 1721096911, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/App/index', '2024-07-16 02:28:31', '2024-07-16 02:28:31');
INSERT INTO `admin_user_action` VALUES (276, '接口列表', 1, 'root', 1721096934, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/InterfaceList/index', '2024-07-16 02:28:54', '2024-07-16 02:28:54');
INSERT INTO `admin_user_action` VALUES (277, '获取全部有效的接口组', 1, 'root', 1721096934, '[]', 'admin/InterfaceGroup/getAll', '2024-07-16 02:28:54', '2024-07-16 02:28:54');
INSERT INTO `admin_user_action` VALUES (278, '获取用户信息', 1, 'root', 1721097061, '[]', 'admin/Login/getUserInfo', '2024-07-16 02:31:01', '2024-07-16 02:31:01');
INSERT INTO `admin_user_action` VALUES (279, '接口列表', 1, 'root', 1721097061, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/InterfaceList/index', '2024-07-16 02:31:01', '2024-07-16 02:31:01');
INSERT INTO `admin_user_action` VALUES (280, '获取全部有效的接口组', 1, 'root', 1721097061, '[]', 'admin/InterfaceGroup/getAll', '2024-07-16 02:31:01', '2024-07-16 02:31:01');
INSERT INTO `admin_user_action` VALUES (281, '获取用户信息', 1, 'root', 1721097094, '[]', 'admin/Login/getUserInfo', '2024-07-16 02:31:34', '2024-07-16 02:31:34');
INSERT INTO `admin_user_action` VALUES (282, '获取全部有效的接口组', 1, 'root', 1721097095, '[]', 'admin/InterfaceGroup/getAll', '2024-07-16 02:31:35', '2024-07-16 02:31:35');
INSERT INTO `admin_user_action` VALUES (283, '接口列表', 1, 'root', 1721097095, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/InterfaceList/index', '2024-07-16 02:31:35', '2024-07-16 02:31:35');
INSERT INTO `admin_user_action` VALUES (284, '接口列表', 1, 'root', 1721097114, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/InterfaceList/index', '2024-07-16 02:31:54', '2024-07-16 02:31:54');
INSERT INTO `admin_user_action` VALUES (285, '获取全部有效的接口组', 1, 'root', 1721097114, '[]', 'admin/InterfaceGroup/getAll', '2024-07-16 02:31:54', '2024-07-16 02:31:54');
INSERT INTO `admin_user_action` VALUES (286, '接口分组列表', 1, 'root', 1721097115, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/InterfaceGroup/index', '2024-07-16 02:31:55', '2024-07-16 02:31:55');
INSERT INTO `admin_user_action` VALUES (287, '获取接口唯一标识', 1, 'root', 1721097122, '[]', 'admin/InterfaceList/getHash', '2024-07-16 02:32:02', '2024-07-16 02:32:02');
INSERT INTO `admin_user_action` VALUES (288, '接口列表', 1, 'root', 1721097125, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/InterfaceList/index', '2024-07-16 02:32:05', '2024-07-16 02:32:05');
INSERT INTO `admin_user_action` VALUES (289, '获取全部有效的接口组', 1, 'root', 1721097125, '[]', 'admin/InterfaceGroup/getAll', '2024-07-16 02:32:05', '2024-07-16 02:32:05');
INSERT INTO `admin_user_action` VALUES (290, '获取接口唯一标识', 1, 'root', 1721097126, '[]', 'admin/InterfaceList/getHash', '2024-07-16 02:32:06', '2024-07-16 02:32:06');
INSERT INTO `admin_user_action` VALUES (291, '接口列表', 1, 'root', 1721097377, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/InterfaceList/index', '2024-07-16 02:36:17', '2024-07-16 02:36:17');
INSERT INTO `admin_user_action` VALUES (292, '接口列表', 1, 'root', 1721097380, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/InterfaceList/index', '2024-07-16 02:36:20', '2024-07-16 02:36:20');
INSERT INTO `admin_user_action` VALUES (293, '接口列表', 1, 'root', 1721097383, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/InterfaceList/index', '2024-07-16 02:36:23', '2024-07-16 02:36:23');
INSERT INTO `admin_user_action` VALUES (294, '接口列表', 1, 'root', 1721097385, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/InterfaceList/index', '2024-07-16 02:36:25', '2024-07-16 02:36:25');
INSERT INTO `admin_user_action` VALUES (295, '接口列表', 1, 'root', 1721097386, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/InterfaceList/index', '2024-07-16 02:36:26', '2024-07-16 02:36:26');
INSERT INTO `admin_user_action` VALUES (296, '接口列表', 1, 'root', 1721097387, '{\"page\":\"1\",\"size\":\"10\",\"type\":null,\"keywords\":null,\"status\":null}', 'admin/InterfaceList/index', '2024-07-16 02:36:27', '2024-07-16 02:36:27');

-- ----------------------------
-- Table structure for admin_user_data
-- ----------------------------
DROP TABLE IF EXISTS `admin_user_data`;
CREATE TABLE `admin_user_data`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `login_times` int(11) NOT NULL DEFAULT 0 COMMENT '账号登录次数',
  `last_login_ip` bigint(20) NOT NULL DEFAULT 0 COMMENT '最后登录IP',
  `last_login_time` int(11) NOT NULL DEFAULT 0 COMMENT '最后登录时间',
  `uid` int(11) NOT NULL DEFAULT 0 COMMENT '用户ID',
  `head_img` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '用户头像',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `admin_user_data_uid_index`(`uid`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '管理员数据表' ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of admin_user_data
-- ----------------------------
INSERT INTO `admin_user_data` VALUES (1, 14, 2130706433, 1721097108, 1, '', '2023-09-13 10:50:44', '2024-07-16 02:31:48');
INSERT INTO `admin_user_data` VALUES (2, 2, 2130706433, 1721034550, 2, '', NULL, NULL);

-- ----------------------------
-- Table structure for api_app
-- ----------------------------
DROP TABLE IF EXISTS `api_app`;
CREATE TABLE `api_app`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `app_id` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '应用id',
  `app_secret` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '应用密码',
  `app_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '应用名称',
  `app_status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '应用状态：0表示禁用，1表示启用',
  `app_info` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '应用说明',
  `app_api` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '当前应用允许请求的全部API接口',
  `app_group` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default' COMMENT '当前应用所属的应用组唯一标识',
  `app_add_time` int(11) NOT NULL DEFAULT 0 COMMENT '应用创建时间',
  `app_api_show` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '前台样式显示所需数据格式',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `api_app_app_id_unique`(`app_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = 'appId和appSecret表' ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of api_app
-- ----------------------------
INSERT INTO `api_app` VALUES (1, '35387910', 'euCaNGMcojeUDPqFJRxyPOVmbUPtqVCz', '1-1', 1, '1-1', '669388fb0c586', '65019424e75af', 1694602290, '{\"default\":[\"669388fb0c586\"]}', '2023-09-13 10:51:30', '2024-07-15 09:16:28');

-- ----------------------------
-- Table structure for api_app_group
-- ----------------------------
DROP TABLE IF EXISTS `api_app_group`;
CREATE TABLE `api_app_group`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '组名称',
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '组说明',
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '组：0表示禁用，1表示启用',
  `hash` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '组标识',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '应用组，目前只做管理使用，没有实际权限控制' ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of api_app_group
-- ----------------------------
INSERT INTO `api_app_group` VALUES (1, '1', '1', 1, '65019424e75af', '2023-09-13 10:51:20', '2023-09-13 10:51:20');

-- ----------------------------
-- Table structure for api_fields
-- ----------------------------
DROP TABLE IF EXISTS `api_fields`;
CREATE TABLE `api_fields`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `field_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '字段名称',
  `hash` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '权限所属组的ID',
  `data_type` tinyint(4) NOT NULL DEFAULT 0 COMMENT '数据类型，来源于DataType类库',
  `default` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '默认值',
  `is_must` tinyint(4) NOT NULL DEFAULT 0 COMMENT '是否必须 0为不必须，1为必须',
  `range` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '范围，Json字符串，根据数据类型有不一样的含义',
  `info` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '字段说明',
  `type` tinyint(4) NOT NULL DEFAULT 0 COMMENT '字段用处：0为request，1为response',
  `show_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'wiki显示用字段',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `api_fields_hash_index`(`hash`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 19 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '用于保存各个API的字段规则' ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of api_fields
-- ----------------------------
INSERT INTO `api_fields` VALUES (4, 'data', '669388fb0c586', 9, '', 1, '', '', 1, 'data', NULL, NULL);
INSERT INTO `api_fields` VALUES (3, 'data', '669388fb0c586', 3, '', 1, '', '', 1, 'data', NULL, NULL);
INSERT INTO `api_fields` VALUES (5, 'list', '669388fb0c586', 3, '', 1, '', '', 1, 'data{}list', NULL, NULL);
INSERT INTO `api_fields` VALUES (6, 'data', '669388fb0c586', 9, '', 1, '', '', 1, 'data{}list[]', NULL, NULL);
INSERT INTO `api_fields` VALUES (7, 'id', '669388fb0c586', 1, '', 1, '', '', 1, 'data{}list[]{}id', NULL, NULL);
INSERT INTO `api_fields` VALUES (8, 'api_class', '669388fb0c586', 1, '', 1, '', '', 1, 'data{}list[]{}api_class', NULL, NULL);
INSERT INTO `api_fields` VALUES (9, 'hash', '669388fb0c586', 2, '', 1, '', '', 1, 'data{}list[]{}hash', NULL, NULL);
INSERT INTO `api_fields` VALUES (10, 'access_token', '669388fb0c586', 1, '', 1, '', '', 1, 'data{}list[]{}access_token', NULL, NULL);
INSERT INTO `api_fields` VALUES (11, 'status', '669388fb0c586', 1, '', 1, '', '', 1, 'data{}list[]{}status', NULL, NULL);
INSERT INTO `api_fields` VALUES (12, 'method', '669388fb0c586', 1, '', 1, '', '', 1, 'data{}list[]{}method', NULL, NULL);
INSERT INTO `api_fields` VALUES (13, 'info', '669388fb0c586', 1, '', 1, '', '', 1, 'data{}list[]{}info', NULL, NULL);
INSERT INTO `api_fields` VALUES (14, 'is_test', '669388fb0c586', 1, '', 1, '', '', 1, 'data{}list[]{}is_test', NULL, NULL);
INSERT INTO `api_fields` VALUES (15, 'return_str', '669388fb0c586', 2, '', 1, '', '', 1, 'data{}list[]{}return_str', NULL, NULL);
INSERT INTO `api_fields` VALUES (16, 'group_hash', '669388fb0c586', 2, '', 1, '', '', 1, 'data{}list[]{}group_hash', NULL, NULL);
INSERT INTO `api_fields` VALUES (17, 'hash_type', '669388fb0c586', 1, '', 1, '', '', 1, 'data{}list[]{}hash_type', NULL, NULL);
INSERT INTO `api_fields` VALUES (18, 'count', '669388fb0c586', 1, '', 1, '', '', 1, 'data{}count', NULL, NULL);

-- ----------------------------
-- Table structure for api_group
-- ----------------------------
DROP TABLE IF EXISTS `api_group`;
CREATE TABLE `api_group`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '组名称',
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '组说明',
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '状态：为1正常，为0禁用',
  `hash` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '组标识',
  `create_time` int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
  `update_time` int(11) NOT NULL DEFAULT 0 COMMENT '修改时间',
  `image` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '分组封面图',
  `hot` int(11) NOT NULL DEFAULT 0 COMMENT '分组热度',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '接口组管理' ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of api_group
-- ----------------------------
INSERT INTO `api_group` VALUES (1, '默认分组', '默认分组', 1, 'default', 1694602205, 1694602205, '', 3, NULL, '2024-07-16 02:18:26');

-- ----------------------------
-- Table structure for api_list
-- ----------------------------
DROP TABLE IF EXISTS `api_list`;
CREATE TABLE `api_list`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `api_class` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'api索引，保存了类和方法',
  `hash` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'api唯一标识',
  `access_token` tinyint(4) NOT NULL DEFAULT 1 COMMENT '认证方式 1：复杂认证，0：简易认证',
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT 'API状态：0表示禁用，1表示启用',
  `method` tinyint(4) NOT NULL DEFAULT 2 COMMENT '请求方式0：不限1：Post，2：',
  `info` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'api中文说明',
  `is_test` tinyint(4) NOT NULL DEFAULT 0 COMMENT '是否是测试模式：0:生产模式，1：测试模式',
  `return_str` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '返回数据示例',
  `group_hash` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default' COMMENT '当前接口所属的接口分组',
  `hash_type` tinyint(4) NOT NULL DEFAULT 2 COMMENT '是否采用hash映射， 1：普通模式 2：加密模式',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `api_list_hash_index`(`hash`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 18 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '用于维护接口信息' ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of api_list
-- ----------------------------
INSERT INTO `api_list` VALUES (17, '111', '669388fb0c586', 1, 1, 2, '111', 0, '{\"code\":1,\"msg\":\"\\u64cd\\u4f5c\\u6210\\u529f\",\"data\":{\"list\":[{\"id\":1,\"api_class\":\"111\",\"hash\":\"6695c4441133a\",\"access_token\":0,\"status\":1,\"method\":2,\"info\":\"111\",\"is_test\":0,\"return_str\":null,\"group_hash\":\"default\",\"hash_type\":2}],\"count\":1}}', 'default', 2, '2024-07-14 08:14:53', '2024-07-16 02:02:44');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 17 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2019_12_14_000001_create_personal_access_tokens_table', 1);
INSERT INTO `migrations` VALUES (2, '2023_03_10_024559_create_api_app_table', 1);
INSERT INTO `migrations` VALUES (3, '2023_03_10_024759_create_api_app_group_table', 1);
INSERT INTO `migrations` VALUES (4, '2023_03_10_024856_create_admin_auth_group_table', 1);
INSERT INTO `migrations` VALUES (5, '2023_03_10_024935_create_admin_auth_group_access_table', 1);
INSERT INTO `migrations` VALUES (6, '2023_03_10_025000_create_admin_auth_rule_table', 1);
INSERT INTO `migrations` VALUES (7, '2023_03_10_025020_create_api_fields_table', 1);
INSERT INTO `migrations` VALUES (8, '2023_03_10_025036_create_api_group_table', 1);
INSERT INTO `migrations` VALUES (9, '2023_03_10_025057_create_api_list_table', 1);
INSERT INTO `migrations` VALUES (10, '2023_03_10_025114_create_admin_menu_table', 1);
INSERT INTO `migrations` VALUES (11, '2023_03_10_025132_create_admin_user_table', 1);
INSERT INTO `migrations` VALUES (12, '2023_03_10_025149_create_admin_user_action_table', 1);
INSERT INTO `migrations` VALUES (13, '2023_03_10_025204_create_admin_user_data_table', 1);
INSERT INTO `migrations` VALUES (14, '2023_08_24_030808_init_admin_menu_table', 1);
INSERT INTO `migrations` VALUES (15, '2023_08_24_055741_init_api_group_table', 1);
INSERT INTO `migrations` VALUES (16, '2023_08_24_055849_init_admin_user_table', 1);

-- ----------------------------
-- Table structure for personal_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `personal_access_tokens_token_unique`(`token`) USING BTREE,
  INDEX `personal_access_tokens_tokenable_type_tokenable_id_index`(`tokenable_type`, `tokenable_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of personal_access_tokens
-- ----------------------------

SET FOREIGN_KEY_CHECKS = 1;
