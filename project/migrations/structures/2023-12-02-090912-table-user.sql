SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
                        `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'User ID',
                        `name` varchar(255) NOT NULL COMMENT 'name',
                        `password` varchar(60) NOT NULL COMMENT 'pwd',
                        `created` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Created date',
                        PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;
