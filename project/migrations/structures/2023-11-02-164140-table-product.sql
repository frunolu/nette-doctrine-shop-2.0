CREATE TABLE `product`
(
    `id`                int(11)      NOT NULL AUTO_INCREMENT COMMENT 'Product ID',
    `name`              varchar(255) NOT NULL COMMENT 'Universal name for product',
    `url`               varchar(255) NOT NULL COMMENT 'Product url',
    `short_description` text                  DEFAULT NULL COMMENT 'Short product description',
    `created`           timestamp    NOT NULL DEFAULT current_timestamp() COMMENT 'Created date',
    `updated`           timestamp    NULL     DEFAULT NULL ON UPDATE current_timestamp() COMMENT 'Updated date',
    `deleted`           int(11)      NOT NULL DEFAULT 0 COMMENT 'Deleted flag',
    PRIMARY KEY (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8
  ROW_FORMAT = COMPACT;
