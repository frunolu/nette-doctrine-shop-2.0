INSERT INTO `product_category` (`product_id`, `category_id`, `created`, `updated`, `deleted`)
VALUES (1, 6, now(), NULL, '0'),
       (2, 6, now(), NULL, '0'),
       (3, 6, now(), NULL, '0');
INSERT INTO `product_category` (`id`, `product_id`, `category_id`, `created`, `updated`, `deleted`)
VALUES (4, 4, 2, '2023-01-31 12:11:02', NULL, 0),
       (5, 5, 2, '2023-01-31 12:11:11', NULL, 0),
       (6, 6, 2, '2023-01-31 12:11:24', NULL, 0),
       (7, 7, 3, '2023-01-31 12:11:36', NULL, 0),
       (8, 8, 3, '2023-01-31 12:11:48', NULL, 0),
       (9, 9, 4, '2023-01-31 12:11:58', NULL, 0),
       (10, 10, 4, '2023-01-31 12:12:19', NULL, 0),
       (11, 11, 5, '2023-01-31 12:12:30', NULL, 0),
       (12, 12, 5, '2023-01-31 12:12:42', NULL, 0);

UPDATE `product_category`
SET `id`          = '1',
    `product_id`  = '1',
    `category_id` = '1',
    `created`     = '2023-01-31 13:20:07',
    `updated`     = now(),
    `deleted`     = '0'
WHERE `id` = '1';

UPDATE `product_category`
SET `id`          = '2',
    `product_id`  = '2',
    `category_id` = '1',
    `created`     = '2023-01-31 13:20:07',
    `updated`     = now(),
    `deleted`     = '0'
WHERE `id` = '2';

UPDATE `product_category`
SET `id`          = '3',
    `product_id`  = '3',
    `category_id` = '1',
    `created`     = '2023-01-31 13:20:07',
    `updated`     = now(),
    `deleted`     = '0'
WHERE `id` = '3';
