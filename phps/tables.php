<?php
$userTableQuery = "
    CREATE TABLE IF NOT EXISTS users (
        id CHAR(36) PRIMARY KEY,
        first_name VARCHAR(50) NOT NULL,
        last_name VARCHAR(50) NOT NULL,
        birth_date DATE NOT NULL,
        username VARCHAR(50) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )
";

$cartTableQuery = "
    CREATE TABLE IF NOT EXISTS carts (
        id CHAR(36) PRIMARY KEY,               -- UUID for the cart record
        user_id VARCHAR(200) NOT NULL,         -- FK to users(id)
        product_id CHAR(36) NOT NULL,          -- FK to products(id)
        quantity INT NOT NULL DEFAULT 1,
        added_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        
        UNIQUE KEY unique_user_product (user_id, product_id),  -- ensures one row per user/product
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
        FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
    )
";