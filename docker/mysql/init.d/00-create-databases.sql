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
    `time` TIMESTAMP,
    `level` VARCHAR(20),
    `message` TEXT,
    `data` JSON,
    `appId` VARCHAR(200),
    `category` VARCHAR(200),
    `userId` VARCHAR(60),
    `sessionId` VARCHAR(200),
    `remoteIp` VARCHAR(15),
    `hostname` VARCHAR(200)
);
