CREATE TABLE cart_items (
                            id INT AUTO_INCREMENT PRIMARY KEY,
                            product_id INT NOT NULL,
                            quantity INT NOT NULL,
                            created_at DATETIME NOT NULL
);
