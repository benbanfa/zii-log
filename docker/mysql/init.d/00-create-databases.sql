-- 初始化数据库

CREATE DATABASE IF NOT EXISTS `dev`;

CREATE USER 'dev_user'@'%' IDENTIFIED BY 'dev_pass';

GRANT ALL ON `dev`.* TO 'dev_user'@'%';

CREATE DATABASE IF NOT EXISTS `test`;

CREATE USER 'test_user'@'%' IDENTIFIED BY 'test_pass';

GRANT ALL ON `test`.* TO 'test_user'@'%';

-- 创建日志表

USE `dev`;

DROP TABLE IF EXISTS `log`;
CREATE TABLE `log` (
    `id` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `time` TIMESTAMP COMMENT '日志产生的时间',
    `level` VARCHAR(20) COMMENT '日志等级',
    `message` TEXT COMMENT '日志消息',
    `data` JSON COMMENT '日志数据',
    `appId` VARCHAR(60) COMMENT '产生日志的项目标识',
    `category` VARCHAR(200) COMMENT '日志分类',
    `userId` VARCHAR(60) COMMENT '相关用户ID',
    `sessionId` VARCHAR(200) COMMENT '相关会话ID',
    `remoteIp` VARCHAR(15) COMMENT '远程IP',
    `hostname` VARCHAR(200) COMMENT '物理主机名',
    INDEX (`time`),
    INDEX (`appId`)
);
