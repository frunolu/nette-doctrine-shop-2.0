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

CREATE TABLE `product`
(
    `id`                int(11) NOT NULL AUTO_INCREMENT COMMENT 'Product ID',
    `name`              varchar(255) NOT NULL COMMENT 'Universal name for product',
    `url`               varchar(255) NOT NULL COMMENT 'Product url',
    `short_description` text                  DEFAULT NULL COMMENT 'Short product description',
    `created`           timestamp    NOT NULL DEFAULT current_timestamp() COMMENT 'Created date',
    `updated`           timestamp NULL DEFAULT NULL ON UPDATE current_timestamp () COMMENT 'Updated date',
    `deleted`           int(11) NOT NULL DEFAULT 0 COMMENT 'Deleted flag',
    PRIMARY KEY (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8
  ROW_FORMAT = COMPACT;

CREATE TABLE `product_category`
(
    `id`          int(11) NOT NULL AUTO_INCREMENT,
    `product_id`  int(11) NOT NULL,
    `category_id` int(11) NOT NULL,
    `created`     timestamp NOT NULL DEFAULT current_timestamp(),
    `updated`     timestamp NULL DEFAULT NULL ON UPDATE current_timestamp (),
    `deleted`     int(11) NOT NULL DEFAULT 0,
    PRIMARY KEY (`id`),
    UNIQUE KEY `unique_product_id` (`product_id`, `category_id`, `deleted`),
    KEY           `category_id` (`category_id`),
    KEY           `product_id` (`product_id`),
    CONSTRAINT `product_category_ibfk_4` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT `product_category_ibfk_5` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8
  ROW_FORMAT = COMPACT;
