# E-Commerce Demo
A simple PHP + MySQL CRUD project with relational database.

## Prerequisites
- Apache
- MySQL Server
I recommend using XAMPP as it comes with built-in Apache for PHP and MySQL Server.

## Setup
1. Go to you XAMPP htdocs directory (usually in `C:\xampp\htdocs`, depending on where you installed your XAMPP)
2. Clone this repository by running `git clone https://github.com/khianvictorycalderon/e-commerce-demo.git`
3. Start Apache and MySQL from XAMPP control panel.
4. Go to your phpmyadmin panel and run this MySQL query:
    ```sql
    CREATE TABLE IF NOT EXISTS products (
        id CHAR(36) PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        description TEXT,
        price DECIMAL(10,2) NOT NULL,
        image VARCHAR(255) NOT NULL,  -- path to the image
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );

    TRUNCATE TABLE products;

    INSERT INTO products (id, name, description, price, image) VALUES
    -- Appliances
    ('c3d4e5f6-a7b8-4c9d-0e1f-2a3b4c5d6e7f', 'Smart Espresso Machine', 'Programmable coffee maker with built-in grinder.', 599.00, 'https://images.unsplash.com/photo-1520970014086-2208d157c9e2'),
    
    -- Plants
    ('f6a7b8c9-d0e1-4f2a-3b4c-5d6e7f8a9b0c', 'Monstera Deliciosa', 'Large, healthy Swiss Cheese Plant in a ceramic pot.', 35.00, 'https://images.unsplash.com/photo-1614594975525-e45190c55d0b'),

    -- Jackets & Apparel
    ('2c3d4e5f-6a7b-8c9d-0e1f-2a3b4c5d6e7f', 'Classic Denim Jacket', 'Rugged blue denim with a vintage wash.', 89.00, 'https://images.unsplash.com/photo-1576871337632-b9aef4c17ab9'),
    ('3d4e5f6a-7b8c-9d0e-1f2a-3b4c5d6e7f8a', 'Waterproof Rain Parka', 'Breathable, windproof jacket for outdoor adventures.', 110.00, 'https://images.unsplash.com/photo-1591047139829-d91aecb6caea'),
    ('4e5f6a7b-8c9d-0e1f-2a3b-4c5d6e7f8a9b', 'Heavyweight Cotton Hoodie', 'Essential oversized fit in charcoal grey.', 55.00, 'https://images.unsplash.com/photo-1556821840-3a63f95609a7'),
    ('5f6a7b8c-9d0e-1f2a-3b4c-5d6e7f8a9b0c', 'Graphic Tee - Cyberpunk', '100% organic cotton with custom neon print.', 32.00, 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab'),

    -- Shoes
    ('6a7b8c9d-0e1f-2a3b-4c5d-6e7f8a9b0c1d', 'Urban Canvas Sneakers', 'Lightweight everyday shoes with vulcanized soles.', 65.00, 'https://images.unsplash.com/photo-1525966222134-fcfa99b8ae77'),
    ('7b8c9d0e-1f2a-3b4c-5d6e-7f8a9b0c1d2e', 'Performance Running Shoes', 'Engineered mesh with high-rebound cushioning.', 145.00, 'https://images.unsplash.com/photo-1542291026-7eec264c27ff'),
    ('8c9d0e1f-2a3b-4c5d-6e7f-8a9b0c1d2e3f', 'Leather Chelsea Boots', 'Handcrafted genuine leather boots with elastic sides.', 185.00, 'https://images.unsplash.com/photo-1638247025967-b4e38f787b76'),

    -- Lifestyle & Others
    ('9d0e1f2a-3b4c-5d6e-7f8a-9b0c1d2e3f4g', 'Minimalist Analog Watch', 'Stainless steel casing with a brown leather strap.', 120.00, 'https://images.unsplash.com/photo-1524592094714-0f0654e20314'),
    ('1f2a3b4c-5d6e-7f8a-9b0c-1d2e3f4g5h6i', 'Aromatic Soy Candle', 'Hand-poured candle with scents of sandalwood.', 22.00, 'https://images.unsplash.com/photo-1603006905003-be475563bc59'),
    ('2a3b4c5d-6e7f-8a9b-0c1d-2e3f4g5h6i7j', 'Canvas Travel Backpack', 'Water-resistant fabric with a 15-inch laptop sleeve.', 75.00, 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62');
    ```
5. Go to your browser and run `localhost/e-commerce-demo`
6. Enjoy!