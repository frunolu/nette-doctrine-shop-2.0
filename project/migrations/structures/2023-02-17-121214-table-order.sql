CREATE TABLE order (
                        id INT AUTO_INCREMENT PRIMARY KEY,
                        customer_name VARCHAR(255) NOT NULL,
                        customer_email VARCHAR(255) NOT NULL,
                        total_price DECIMAL(10,2) NOT NULL,
                        created_at DATETIME NOT NULL
);
