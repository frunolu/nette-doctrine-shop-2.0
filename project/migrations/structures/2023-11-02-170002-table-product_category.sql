CREATE TABLE `product_category`
(
    `id`          int(11)   NOT NULL AUTO_INCREMENT,
    `product_id`  int(11)   NOT NULL,
    `category_id` int(11)   NOT NULL,
    `created`     timestamp NOT NULL DEFAULT current_timestamp(),
    `updated`     timestamp NULL     DEFAULT NULL ON UPDATE current_timestamp(),
    `deleted`     int(11)   NOT NULL DEFAULT 0,
    PRIMARY KEY (`id`),
    UNIQUE KEY `unique_product_id` (`product_id`, `category_id`, `deleted`),
    KEY `category_id` (`category_id`),
    KEY `product_id` (`product_id`),
    CONSTRAINT `product_category_ibfk_4` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT `product_category_ibfk_5` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8
  ROW_FORMAT = COMPACT;
