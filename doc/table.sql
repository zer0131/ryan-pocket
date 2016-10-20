
CREATE DATABASE IF NOT EXISTS `pocket_web` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `pocket_web`;


CREATE TABLE `users` (
 `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
 `account` varchar(100) NOT NULL DEFAULT '' COMMENT '登陆账号',
 `token` varchar(200) NOT NULL DEFAULT '' COMMENT '登陆token',
 `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
 `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
 PRIMARY KEY (`id`),
 UNIQUE KEY `uidx_account` (`account`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户表';