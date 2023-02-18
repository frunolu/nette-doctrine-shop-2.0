CREATE TABLE `category`
(
    `id`        int(11) NOT NULL AUTO_INCREMENT COMMENT 'Category ID',
    `parent_id` int(11) DEFAULT NULL COMMENT 'Category parent ID',
    `name`      varchar(255) NOT NULL COMMENT 'Universal name for category',
    `url`       varchar(255) NOT NULL COMMENT 'Category url',
    `created`   timestamp    NOT NULL DEFAULT current_timestamp() COMMENT 'Created date',
    `updated`   timestamp NULL DEFAULT NULL ON UPDATE current_timestamp () COMMENT 'Updated date',
    `deleted`   int(11) NOT NULL DEFAULT 0 COMMENT 'Deleted flag',
    PRIMARY KEY (`id`),
    KEY         `parent_id` (`parent_id`),
    CONSTRAINT `category_ibfk_3` FOREIGN KEY (`parent_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8
  ROW_FORMAT = COMPACT;
