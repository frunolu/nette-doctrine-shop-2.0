INSERT INTO `category` (`id`, `parent_id`, `name`, `url`, `created`, `updated`, `deleted`)
VALUES (1, NULL, 'Pekárna a cukrárna', 'pekarna-cukrarna', now(), NULL, '0'),
       (2, NULL, 'Ovoce a zelenina', 'ovoce-a-zelenina', now(), NULL, '0'),
       (3, NULL, 'Maso a ryby', 'maso-a-ryby', now(), NULL, '0'),
       (4, NULL, 'Mléčné a chlazené', 'mlecne-a-chlazene', now(), NULL, '0'),
       (5, NULL, 'Nápoje', 'napoje', now(), NULL, '0'),
       (6, 1, 'Chléb', 'chleb', now(), NULL, '0'),
       (7, 1, 'Sladké pečivo', 'sladke-pecivo', now(), NULL, '0'),
       (8, 2, 'Zelenina', 'zelenina', now(), NULL, '0'),
       (9, 2, 'Ovoce', 'ovoce', now(), NULL, '0'),
       (10, 3, 'Hovězí maso', 'hovezi-maso', now(), NULL, '0'),
       (11, 3, 'Drůbeží maso', 'drubezi-maso', now(), NULL, '0'),
       (12, 4, 'Tvarohy', 'tvarohy', now(), NULL, '0'),
       (13, 4, 'Jogurty a mléčné dezerty', 'jogurty-a-mlecne-dezerty', now(), NULL, '0'),
       (14, 5, 'Vína', 'vina', now(), NULL, '0'),
       (15, 5, 'Čaje', 'caje', now(), NULL, '0');


INSERT INTO `product` (`id`, `name`, `url`, `short_description`, `created`, `updated`, `deleted`)
VALUES (1, 'Chléb konzumní kmínový', 'chleb-konzumni-kminovy', 'Chléb pšenično-žitný oválný.', now(), NULL, '0'),
       (2, 'Bageta světlá malá', 'bageta-svetla-mala', 'Běžné pšeničné pečivo.', now(), NULL, '0'),
       (3, 'Pizza rolka', 'pizza-rolka', 'Pekařský výrobek z listového těsta.', now(), NULL, '0'),
       (4, 'Jablko', 'jablko', 'Jablko od českých pěstovatelú.', '2023-01-31 11:10:39', NULL, 0),
       (5, 'Mrkev', 'mrkev', 'Mrkev od českých pěstovatelú.', '2023-01-31 11:11:10', NULL, 0),
       (6, 'Kiwi', 'kiwi', 'Púvod: Nový Zéland.', '2023-01-31 11:12:14', '2023-01-31 11:12:22', 0),
       (7, 'Kuřecí prsní řízek', 'kureci-prsni-rizek', NULL, '2023-01-31 11:21:55', NULL, 0),
       (8, 'Hovězí steak', 'hovezi-steak', NULL, '2023-01-31 11:52:45', NULL, 0),
       (9, 'Tvaroh měkký', 'tvaroh-mekky', NULL, '2023-01-31 11:55:24', NULL, 0),
       (10, 'Jogurt bílý', 'jogurt-bily', NULL, '2023-01-31 11:58:14', NULL, 0),
       (12, 'Zelený čaj', 'zeleny-caj', NULL, '2023-01-31 11:59:54', NULL, 0);

INSERT INTO `product_category` (id,`product_id`, `category_id`, `created`, `updated`, `deleted`)
VALUES (1, 1, 1,now(), NULL, '0'),
       (2, 2, 1,now(), NULL, '0'),
       (3, 3, 1,now(), NULL, '0'),
       (4, 4, 2, '2023-01-31 12:11:02', NULL, 0),
       (5, 5, 2, '2023-01-31 12:11:11', NULL, 0),
       (6, 6, 2, '2023-01-31 12:11:24', NULL, 0),
       (7, 7, 3, '2023-01-31 12:11:36', NULL, 0),
       (8, 8, 3, '2023-01-31 12:11:48', NULL, 0),
       (9, 9, 4, '2023-01-31 12:11:58', NULL, 0),
       (10, 10, 4, '2023-01-31 12:12:19', NULL, 0),
       (11, 11, 5, '2023-01-31 12:12:30', NULL, 0),
       (12, 12, 5, '2023-01-31 12:12:42', NULL, 0);
