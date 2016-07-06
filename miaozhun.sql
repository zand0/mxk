/*
Navicat MySQL Data Transfer

Source Server         : mxk
Source Server Version : 50624
Source Host           : 192.168.1.110:3306
Source Database       : miaozhun

Target Server Type    : MYSQL
Target Server Version : 50624
File Encoding         : 65001

Date: 2016-07-06 18:37:37
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for cb_company_application
-- ----------------------------
DROP TABLE IF EXISTS `cb_company_application`;
CREATE TABLE `cb_company_application` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(255) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `dept_name` varchar(255) DEFAULT NULL,
  `tel` varchar(255) DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for cb_dept_time
-- ----------------------------
DROP TABLE IF EXISTS `cb_dept_time`;
CREATE TABLE `cb_dept_time` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `dept_id` varchar(32) DEFAULT NULL,
  `inerview_date` datetime DEFAULT NULL,
  `inerview_time` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for company_maininfo
-- ----------------------------
DROP TABLE IF EXISTS `company_maininfo`;
CREATE TABLE `company_maininfo` (
  `CM_ID` int(6) NOT NULL AUTO_INCREMENT,
  `CM_NAME` varchar(32) DEFAULT NULL COMMENT '公司名称',
  `CM_LOGO` varchar(32) DEFAULT NULL COMMENT 'Photo.jpg	公司LOGO',
  `CM_VR` varchar(128) DEFAULT NULL COMMENT 'VR链接',
  `CM_JC` varchar(16) DEFAULT NULL COMMENT '公司简称',
  `CM_ISTRUE` tinyint(1) DEFAULT NULL COMMENT '公司是否认证（0，未认证；1，认证中；2，已认证）',
  `CM_CREATOR` int(6) DEFAULT NULL COMMENT '创建人ID（外键/k_user_info）',
  `CM_UPDATOR` int(6) DEFAULT NULL COMMENT '更新人ID（外键/k_user_info）',
  `CM_CRE_TIME` datetime DEFAULT NULL COMMENT '公司创建时间',
  `CM_UPD_TIME` datetime DEFAULT NULL COMMENT '最近修改时间',
  PRIMARY KEY (`CM_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for company_subinfo
-- ----------------------------
DROP TABLE IF EXISTS `company_subinfo`;
CREATE TABLE `company_subinfo` (
  `CM_ID` int(6) NOT NULL COMMENT '企业信息表一（外键/company_maininfo）',
  `CS_WEB` varchar(32) DEFAULT NULL COMMENT '公司网址',
  `CS_AREA` tinyint(2) DEFAULT NULL COMMENT '公司行业（标识）',
  `CS_PROPERTY` tinyint(2) DEFAULT NULL COMMENT '公司性质（标识）',
  `CS_SCALE` int(6) DEFAULT NULL COMMENT '公司规模（XX/人）',
  `CS_ADDR` varchar(128) DEFAULT NULL COMMENT '公司地址',
  `CITY` varchar(5) DEFAULT NULL COMMENT '公司所在省市（省_市） ',
  `CS_INTRO` varchar(2000) DEFAULT NULL COMMENT '公司简介',
  `CS_SORT` int(4) DEFAULT NULL COMMENT '公司排序号/从大到小',
  `CS_CREATOR` int(6) DEFAULT NULL COMMENT '创建人ID（外键/k_user_info）',
  `CS_UPDATOR` varchar(6) DEFAULT NULL COMMENT '更新人ID（外键/k_user_info）',
  `CS_CRE_TIME` datetime DEFAULT NULL COMMENT '公司创建时间',
  `CS_UPD_TIME` datetime DEFAULT NULL COMMENT '最近修改时间',
  PRIMARY KEY (`CM_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for fw_logs
-- ----------------------------
DROP TABLE IF EXISTS `fw_logs`;
CREATE TABLE `fw_logs` (
  `log_id` varchar(255) NOT NULL,
  `contents` varchar(255) DEFAULT NULL,
  `operate_args` varchar(255) DEFAULT NULL,
  `operate_date` datetime DEFAULT NULL,
  `operate_type` varchar(255) DEFAULT NULL,
  `req_url` varchar(255) DEFAULT NULL,
  `resource_ip` varchar(255) DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`log_id`),
  UNIQUE KEY `log_id` (`log_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for fw_menu
-- ----------------------------
DROP TABLE IF EXISTS `fw_menu`;
CREATE TABLE `fw_menu` (
  `menu_id` varchar(255) NOT NULL,
  `attribute1` varchar(255) DEFAULT NULL,
  `attribute2` varchar(255) DEFAULT NULL,
  `attribute3` varchar(255) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `date1` datetime DEFAULT NULL,
  `date2` datetime DEFAULT NULL,
  `is_enable` varchar(255) DEFAULT NULL,
  `last_update_by` varchar(255) DEFAULT NULL,
  `last_update_date` datetime DEFAULT NULL,
  `menu_name` varchar(255) DEFAULT NULL,
  `menu_url` varchar(255) DEFAULT NULL,
  `order_num` int(11) DEFAULT NULL,
  `parent_menu_id` varchar(255) DEFAULT NULL,
  `segment1` int(11) DEFAULT NULL,
  `segment2` int(11) DEFAULT NULL,
  PRIMARY KEY (`menu_id`),
  UNIQUE KEY `menu_id` (`menu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for fw_user
-- ----------------------------
DROP TABLE IF EXISTS `fw_user`;
CREATE TABLE `fw_user` (
  `user_id` varchar(255) NOT NULL,
  `QQ_NO` varchar(255) DEFAULT NULL,
  `ARRIVE_DATE` varchar(255) DEFAULT NULL,
  `attribute1` varchar(255) DEFAULT NULL,
  `attribute2` varchar(255) DEFAULT NULL,
  `attribute3` varchar(255) DEFAULT NULL,
  `attribute4` varchar(255) DEFAULT NULL,
  `attribute5` varchar(255) DEFAULT NULL,
  `BIRTH_DAY` varchar(255) DEFAULT NULL,
  `CREATED_BY` varchar(255) DEFAULT NULL,
  `CREATED_DATE` datetime DEFAULT NULL,
  `date1` datetime DEFAULT NULL,
  `date2` datetime DEFAULT NULL,
  `DEGREE` varchar(255) DEFAULT NULL,
  `EMAIL` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `id_no` varchar(255) DEFAULT NULL,
  `is_enable` varchar(255) DEFAULT NULL,
  `LAST_UPDATE_BY` varchar(255) DEFAULT NULL,
  `LAST_UPDATE_DATE` datetime DEFAULT NULL,
  `login_name` varchar(255) DEFAULT NULL,
  `marital` varchar(255) DEFAULT NULL,
  `NATIVE_ADDRESS` varchar(255) DEFAULT NULL,
  `NOW_ADDRESS` varchar(255) DEFAULT NULL,
  `OTHER_PHONE` varchar(255) DEFAULT NULL,
  `passwd` varchar(255) DEFAULT NULL,
  `RECOMMENDED_PERSON` varchar(255) DEFAULT NULL,
  `segment1` int(11) DEFAULT NULL,
  `segment2` int(11) DEFAULT NULL,
  `telephone` varchar(255) DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `work_experience` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for job_maininfo
-- ----------------------------
DROP TABLE IF EXISTS `job_maininfo`;
CREATE TABLE `job_maininfo` (
  `JM_ID` int(6) NOT NULL AUTO_INCREMENT,
  `CM_ID` int(6) DEFAULT NULL COMMENT '公司ID（外键/company_maininfo主键）',
  `NUM` tinyint(1) DEFAULT NULL COMMENT '职位是否在秒小空显示（0，不显示；1，显示）',
  `JM_NAME` varchar(16) DEFAULT NULL COMMENT '职位名称',
  `JM_SALARY` tinyint(1) DEFAULT NULL COMMENT '职位月薪（字段说明）',
  `CITY` varchar(5) DEFAULT NULL COMMENT '面试所在省市（省_市）',
  `STATE` tinyint(1) DEFAULT NULL COMMENT '职位状态（字段说明）',
  `JM_WORKEXP` varchar(32) DEFAULT NULL COMMENT '职位所需工作经验',
  `JM_CREATOR` int(6) DEFAULT NULL COMMENT '职位创建人ID（外键/k_user_info）',
  `JM_CRE_TIME` datetime DEFAULT NULL COMMENT '职位创建时间',
  `JM_UPDATOR` int(6) DEFAULT NULL COMMENT '最近一次更新人ID',
  `JM_UPD_TIME` datetime DEFAULT NULL COMMENT '最近一次修改时间',
  PRIMARY KEY (`JM_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for job_subinfo
-- ----------------------------
DROP TABLE IF EXISTS `job_subinfo`;
CREATE TABLE `job_subinfo` (
  `JS_ID` int(6) NOT NULL AUTO_INCREMENT,
  `JM_ID` int(6) DEFAULT NULL COMMENT '职位信息表一ID（外键/dept_maininfo）',
  `CM_ID` int(6) DEFAULT NULL COMMENT '公司ID（外键/company_maininfo主键）',
  `JS_PROPERTY` int(6) DEFAULT NULL COMMENT '职位性质',
  `JS_DEGREE` tinyint(1) DEFAULT NULL COMMENT '职位所需学历（字段说明）',
  `JS_TYPE` int(6) DEFAULT NULL COMMENT '职位类型',
  `JS_NEEDNUM` int(4) DEFAULT NULL COMMENT '招聘人数',
  `JS_YOUHUO` varchar(128) DEFAULT NULL COMMENT '职位诱惑',
  `JS_ZHIZE` varchar(2000) DEFAULT NULL COMMENT '岗位职责',
  `JS_RENZHI` varchar(2000) DEFAULT NULL COMMENT '任职要求',
  `JS_FULI` varchar(300) DEFAULT NULL COMMENT '福利待遇',
  `JS_SORT` int(6) DEFAULT NULL COMMENT '职位排序',
  `JS_CREATOR` int(6) DEFAULT NULL COMMENT '职位创建人ID（外键/k_user_info）',
  `JS_CRE_TIME` datetime DEFAULT NULL COMMENT '职位创建时间',
  `JS_UPDATOR` int(6) DEFAULT NULL COMMENT '最近一次更新人ID（外键/k_user_info）',
  `JS_UPD_TIME` datetime DEFAULT NULL COMMENT '最近一次修改时间',
  PRIMARY KEY (`JS_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for k_user_admin
-- ----------------------------
DROP TABLE IF EXISTS `k_user_admin`;
CREATE TABLE `k_user_admin` (
  `UA_ID` int(6) NOT NULL AUTO_INCREMENT,
  `UR_ID` int(6) DEFAULT NULL COMMENT '外键/k_user_register',
  `MG_ID` int(6) DEFAULT NULL COMMENT '管理组ID（外键/manager_group）',
  `UA_UPDATOR` int(6) DEFAULT NULL COMMENT '修改人ID（外键/UM_ID）',
  `UA_CRE_TIME` datetime NOT NULL COMMENT '创建时间',
  `UA_UPD_TIME` datetime DEFAULT NULL COMMENT '最后一次修改时间',
  PRIMARY KEY (`UA_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for k_user_code
-- ----------------------------
DROP TABLE IF EXISTS `k_user_code`;
CREATE TABLE `k_user_code` (
  `UC_ID` int(11) NOT NULL AUTO_INCREMENT,
  `UC_PHONE` varchar(11) DEFAULT NULL COMMENT '手机号/不可重复',
  `UC_STATE` tinyint(1) DEFAULT NULL COMMENT '状态 0未使用/1已使用',
  `UC_CODE` varchar(4) DEFAULT NULL COMMENT '验证码',
  `UC_START_TIME` datetime DEFAULT NULL COMMENT '开始时间/有效期10分钟',
  PRIMARY KEY (`UC_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for k_user_edu
-- ----------------------------
DROP TABLE IF EXISTS `k_user_edu`;
CREATE TABLE `k_user_edu` (
  `UE_ID` int(6) NOT NULL AUTO_INCREMENT,
  `UM_ID` int(6) DEFAULT NULL COMMENT '外键/k_user_info',
  `UE_SCHNAME` varchar(32) DEFAULT NULL COMMENT '学校名称',
  `UE_DEGREE` tinyint(1) DEFAULT NULL COMMENT '学历（字段说明）',
  `UE_SPECIALTY` varchar(10) DEFAULT NULL COMMENT '专业',
  `UE_START_TIME` datetime DEFAULT NULL COMMENT '开始时间',
  `UE_END_TIME` datetime DEFAULT NULL COMMENT '结束时间',
  `UE_CRE_TIME` datetime DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`UE_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for k_user_info
-- ----------------------------
DROP TABLE IF EXISTS `k_user_info`;
CREATE TABLE `k_user_info` (
  `UR_ID` int(6) NOT NULL COMMENT '外键/k_user_register',
  `CITY` varchar(5) DEFAULT NULL COMMENT '所在城市（省_市）',
  `UI_AGE` int(3) NOT NULL COMMENT '年龄',
  `UI_CRE_TIME` datetime NOT NULL COMMENT '创建时间',
  `UI_DEGREE` int(6) DEFAULT NULL COMMENT '最高学历',
  `UI_ELSE` varchar(140) DEFAULT NULL COMMENT '备注',
  `UI_EMAIL` varchar(50) DEFAULT NULL COMMENT '邮箱',
  `UI_NAME` varchar(10) NOT NULL COMMENT '姓名',
  `UI_PHOTO` varchar(22) DEFAULT NULL COMMENT '头像/年月日时分毫秒.jpg',
  `UI_SEX` int(6) NOT NULL COMMENT '性别/0男1女',
  `UI_UPDATOR` int(6) DEFAULT NULL COMMENT '修改人ID',
  `UI_UPD_TIME` datetime DEFAULT NULL COMMENT '最后一次修改时间',
  PRIMARY KEY (`UR_ID`),
  UNIQUE KEY `UR_ID` (`UR_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for k_user_money
-- ----------------------------
DROP TABLE IF EXISTS `k_user_money`;
CREATE TABLE `k_user_money` (
  `UR_ID` int(6) NOT NULL COMMENT '外键/k_user_register',
  `UM_FINMONEY` double(6,0) DEFAULT NULL COMMENT '已结算的佣金',
  `UM_GOMONEY` double(6,0) DEFAULT NULL COMMENT '进行中的佣金',
  `UM_CANMONEY` double(6,0) DEFAULT NULL COMMENT '可结算的佣金',
  PRIMARY KEY (`UR_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for k_user_project
-- ----------------------------
DROP TABLE IF EXISTS `k_user_project`;
CREATE TABLE `k_user_project` (
  `UPR_ID` int(6) NOT NULL AUTO_INCREMENT,
  `UM_ID` int(6) DEFAULT NULL COMMENT '外键/k_user_info',
  `UPR_PROJECT_NAME` varchar(32) DEFAULT NULL COMMENT '项目名称',
  `UPR_DUTY_DESC` varchar(32) DEFAULT NULL COMMENT '项目职责',
  `UPR_START_TIME` datetime DEFAULT NULL COMMENT '开始时间',
  `UPR_END_TIME` datetime DEFAULT NULL COMMENT '结束时间',
  `UPR_PROJECT_DESC` varchar(1200) DEFAULT NULL COMMENT '项目描述',
  `UPR_CRE_TIME` datetime DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`UPR_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for k_user_qq
-- ----------------------------
DROP TABLE IF EXISTS `k_user_qq`;
CREATE TABLE `k_user_qq` (
  `UQ_ID` int(6) NOT NULL,
  `UR_ID` int(6) NOT NULL COMMENT '外键/k_user_register',
  `UQ_ACC` varchar(16) DEFAULT NULL COMMENT '账号',
  `UQ_KEY` varchar(32) DEFAULT NULL COMMENT 'QQ号',
  `UQ_REG_TIME` datetime DEFAULT NULL COMMENT '创建时间	注册时间',
  PRIMARY KEY (`UQ_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for k_user_referrals
-- ----------------------------
DROP TABLE IF EXISTS `k_user_referrals`;
CREATE TABLE `k_user_referrals` (
  `URE_ID` int(6) NOT NULL AUTO_INCREMENT,
  `UM_IDS` int(6) DEFAULT NULL COMMENT '推荐人ID/k_user_info',
  `UM_IDN` int(6) DEFAULT NULL COMMENT '被推荐人ID/k_user_info',
  `JM_ID` int(6) DEFAULT NULL COMMENT '职位ID/job_maininfo',
  `CM_ID` int(6) DEFAULT NULL COMMENT '企业ID/company_maininfo',
  `STATE` tinyint(1) DEFAULT NULL COMMENT '入职状态（字段说明）',
  `STATE_SMONEY` tinyint(1) DEFAULT NULL COMMENT '推荐人领钱状态（字段说明）',
  `STATE_NMONEY` tinyint(1) DEFAULT NULL COMMENT '被推荐人领钱状态（字段说明）',
  `URE_ENTRYTIME` datetime DEFAULT NULL COMMENT '入职时间',
  `URE_ADMINID` int(6) DEFAULT NULL COMMENT '客服ID（联系人和顾问）（外键/k_user_info）',
  `URE_ADEDIT_TI` datetime DEFAULT NULL COMMENT '审核人操作时间',
  `URE_CONNECTID` int(6) DEFAULT NULL COMMENT '财务ID（外键/k_user_info）',
  `URE_CONEDIT_TI` datetime DEFAULT NULL COMMENT '财务操作时间',
  `URE_CRE_TIME` datetime DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`URE_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for k_user_reginfo
-- ----------------------------
DROP TABLE IF EXISTS `k_user_reginfo`;
CREATE TABLE `k_user_reginfo` (
  `UR_ID` int(6) NOT NULL AUTO_INCREMENT,
  `UR_PHONE` varchar(11) NOT NULL COMMENT '手机号/不可重复',
  `UR_PWD` varchar(32) NOT NULL COMMENT '密码/MD5',
  `UR_STATE` tinyint(1) NOT NULL COMMENT '账号状态 0正常/1封号',
  `WEIXIN_TYPE` int(6) DEFAULT NULL COMMENT '微信ID（k_user_reginfo_wechat）',
  `QQ_TYPE` int(6) DEFAULT NULL COMMENT 'QQID（外键/k_user_reginfo_qq）',
  `SINA_TYPE` int(6) DEFAULT NULL COMMENT '新浪微博ID（外键/k_user_reginfo_sina）',
  `UR_REG_TIME` datetime DEFAULT NULL COMMENT '创建时间	注册时间',
  `UR_LAST_TIME` datetime DEFAULT NULL COMMENT '最近登录时间',
  PRIMARY KEY (`UR_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for k_user_sina
-- ----------------------------
DROP TABLE IF EXISTS `k_user_sina`;
CREATE TABLE `k_user_sina` (
  `USI_ID` int(6) NOT NULL AUTO_INCREMENT,
  `UR_ID` int(6) NOT NULL COMMENT '外键/k_user_register',
  `USI_ACC` varchar(16) DEFAULT NULL COMMENT '账号',
  `USI_KEY` varchar(32) DEFAULT NULL COMMENT '新浪ID',
  `USI_REG_TIME` datetime DEFAULT NULL COMMENT '创建时间	注册时间',
  PRIMARY KEY (`USI_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for k_user_wechat
-- ----------------------------
DROP TABLE IF EXISTS `k_user_wechat`;
CREATE TABLE `k_user_wechat` (
  `UWE_ID` int(6) NOT NULL AUTO_INCREMENT,
  `UR_ID` int(6) NOT NULL COMMENT '外键/k_user_register',
  `UWE_ACC` varchar(16) DEFAULT NULL COMMENT '账号',
  `UWE_KEY` varchar(32) DEFAULT NULL COMMENT 'OPENID',
  `UWE_REG_TIME` datetime DEFAULT NULL COMMENT '创建时间	注册时间',
  PRIMARY KEY (`UWE_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for k_user_work
-- ----------------------------
DROP TABLE IF EXISTS `k_user_work`;
CREATE TABLE `k_user_work` (
  `UO_ID` int(6) NOT NULL AUTO_INCREMENT,
  `UI_ID` int(11) DEFAULT NULL COMMENT '外键/k_user_info',
  `UO_CUR_STATE` varchar(16) DEFAULT NULL COMMENT '目前状态',
  `UO_DEPT_TYPE` tinyint(1) DEFAULT NULL COMMENT '职位性质0全职/1兼职',
  `CITY` tinyint(1) DEFAULT NULL COMMENT '期望城市',
  `UO_SALARY` tinyint(1) DEFAULT NULL COMMENT '期望月薪',
  `UO_DESC` varchar(1200) DEFAULT NULL COMMENT '补充说明',
  `UO_CRE_TIME` datetime DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`UO_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for k_user_workinfo
-- ----------------------------
DROP TABLE IF EXISTS `k_user_workinfo`;
CREATE TABLE `k_user_workinfo` (
  `UW_ID` int(6) NOT NULL AUTO_INCREMENT,
  `UR_ID` int(6) DEFAULT NULL COMMENT '外键/k_user_info',
  `UW_COMPANY` varchar(20) DEFAULT NULL COMMENT '企业名称',
  `UW_TRADE_TYPE` tinyint(1) DEFAULT NULL COMMENT '行业类型（字段说明）',
  `UW_SALARY` tinyint(1) DEFAULT NULL COMMENT '月薪 （字段说明）',
  `UW_DEPT_NAME` varchar(16) DEFAULT NULL COMMENT '职位名称',
  `UW_START_TIME` datetime DEFAULT NULL COMMENT '开始时间',
  `UW_END_TIME` datetime DEFAULT NULL COMMENT '结束时间',
  `UW_WORK_DESC` varchar(1200) DEFAULT NULL COMMENT '工作描述/限制1200字',
  `UW_CRE_TIME` datetime DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`UW_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for manager_group
-- ----------------------------
DROP TABLE IF EXISTS `manager_group`;
CREATE TABLE `manager_group` (
  `MG_ID` int(6) NOT NULL AUTO_INCREMENT,
  `MG_NAME` varchar(16) DEFAULT NULL COMMENT '用户组名称',
  `MG_ISENABLE` tinyint(1) DEFAULT NULL COMMENT '用户组是否启用（0，启用；1，不启用）',
  `MG_DESCRIPTION` varchar(64) DEFAULT NULL COMMENT '用户组描述',
  `MG_CRE_TIME` datetime DEFAULT NULL COMMENT '用户组创建时间',
  `MG_CREATOR` int(6) DEFAULT NULL COMMENT '用户组创建者（外键/k_user_info）',
  `MG_UPDATOR` int(6) DEFAULT NULL COMMENT '用户组更新者（外键/k_user_info）',
  `MG_UPD_TIME` datetime DEFAULT NULL COMMENT '用户组更新时间',
  PRIMARY KEY (`MG_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for message_config
-- ----------------------------
DROP TABLE IF EXISTS `message_config`;
CREATE TABLE `message_config` (
  `CONFIG_ID` varchar(200) NOT NULL,
  `attribute1` varchar(200) DEFAULT NULL,
  `CONFIG_CODE` varchar(200) DEFAULT NULL,
  `CREATED_BY` varchar(200) DEFAULT NULL,
  `CREATED_DATE` datetime DEFAULT NULL,
  `IS_ENABLE` varchar(20) DEFAULT NULL,
  `LAST_UPDATE_BY` varchar(200) DEFAULT NULL,
  `LAST_UPDATE_DATE` datetime DEFAULT NULL,
  `NUMBER_REMAINING` int(11) DEFAULT NULL,
  `PASSWD` varchar(200) DEFAULT NULL,
  `USER_NAME` varchar(20) DEFAULT NULL,
  `VENDOR_NAME` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`CONFIG_ID`),
  UNIQUE KEY `CONFIG_ID` (`CONFIG_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for offer_info
-- ----------------------------
DROP TABLE IF EXISTS `offer_info`;
CREATE TABLE `offer_info` (
  `OI_ID` int(6) NOT NULL AUTO_INCREMENT,
  `OI_USERID` int(6) DEFAULT NULL COMMENT '上传用户ID（外键/k_user_info）',
  `OI_CREATI` datetime DEFAULT NULL COMMENT '上传时间',
  `OI_FILE` varchar(32) DEFAULT NULL COMMENT '上传文件储存位置',
  `OI_STATE` tinyint(1) DEFAULT NULL COMMENT '上传文件审核状态（0，未审核；1，审核中；2，已通过；3，未通过）',
  `UM_ID` int(6) DEFAULT NULL COMMENT '审核人ID（外键/k_user_info）',
  `OI_EDIT_TIME` datetime DEFAULT NULL COMMENT '审核人审核时间',
  PRIMARY KEY (`OI_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for reg_keywords
-- ----------------------------
DROP TABLE IF EXISTS `reg_keywords`;
CREATE TABLE `reg_keywords` (
  `RK_ID` int(6) NOT NULL,
  `RK_NAME` char(6) DEFAULT NULL COMMENT '过滤关键词名称/去重',
  PRIMARY KEY (`RK_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for user_message
-- ----------------------------
DROP TABLE IF EXISTS `user_message`;
CREATE TABLE `user_message` (
  `UME_ID` int(6) NOT NULL AUTO_INCREMENT,
  `STATE` tinyint(1) DEFAULT NULL COMMENT '类别0系统/1个人',
  `UME_NUM` tinyint(1) DEFAULT NULL COMMENT '0=未查看；1=查看；2=删除',
  `UME_IDS` int(6) DEFAULT NULL COMMENT '推荐人ID/k_user_info',
  `UME_IDN` int(6) DEFAULT NULL COMMENT '被推荐人ID/k_user_info',
  `JM_ID` int(6) DEFAULT NULL COMMENT '职位ID（外键/dept_maininfo）',
  `CM_ID` int(6) DEFAULT NULL COMMENT '公司ID（外键/company_maininfo）',
  `UME_DESC` varchar(32) DEFAULT NULL COMMENT '消息内容',
  `UME_CRE_TIME` datetime DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`UME_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
