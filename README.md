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

    INSERT INTO products (id, name, description, price, category, image) VALUES
    ('11111111-aaaa-bbbb-cccc-000000000001', 'Smartphone Pro', 'Latest 5G smartphone', 799.99, 'electronics', 'https://images.pexels.com/photos/1000467/pexels-photo-1000467.jpeg'),
    ('11111111-aaaa-bbbb-cccc-000000000002', 'Wireless Headphones', 'Noise-cancelling over ear headphones', 199.99, 'electronics', 'https://images.pexels.com/photos/373543/pexels-photo-373543.jpeg'),
    ('11111111-aaaa-bbbb-cccc-000000000003', '4K Monitor', '27″ Ultra HD display', 349.99, 'electronics', 'https://images.pexels.com/photos/1092671/pexels-photo-1092671.jpeg'),
    ('11111111-aaaa-bbbb-cccc-000000000004', 'Modern Sofa', 'Comfortable living room sofa', 499.99, 'home', 'https://images.pexels.com/photos/1643383/pexels-photo-1643383.jpeg'),
    ('11111111-aaaa-bbbb-cccc-000000000005', 'Wooden Dining Set', 'Dining table with 4 chairs', 299.99, 'home', 'https://images.pexels.com/photos/276583/pexels-photo-276583.jpeg'),
    ('11111111-aaaa-bbbb-cccc-000000000006', 'Minimalist Lamp', 'Decorative LED lamp', 59.99, 'home', 'https://images.pexels.com/photos/186077/pexels-photo-186077.jpeg'),
    ('11111111-aaaa-bbbb-cccc-000000000007', 'Coffee Maker', '12-cup programmable coffee maker', 89.99, 'appliances', 'https://images.pexels.com/photos/298842/pexels-photo-298842.jpeg'),
    ('11111111-aaaa-bbbb-cccc-000000000008', 'Blender', 'High-speed kitchen blender', 69.99, 'appliances', 'https://images.pexels.com/photos/159320/white-modern-house-kitchen-appliances-159320.jpeg'),
    ('11111111-aaaa-bbbb-cccc-000000000009', 'Air Purifier', 'HEPA air purifier', 129.99, 'appliances', 'https://images.pexels.com/photos/329990/pexels-photo-329990.jpeg'),
    ('11111111-aaaa-bbbb-cccc-000000000010', 'Leather Jacket', 'Stylish genuine leather jacket', 149.99, 'fashion', 'https://images.pexels.com/photos/2983464/pexels-photo-2983464.jpeg'),
    ('11111111-aaaa-bbbb-cccc-000000000011', 'Sneakers', 'Comfortable casual sneakers', 89.99, 'fashion', 'https://images.pexels.com/photos/2983467/pexels-photo-2983467.jpeg'),
    ('11111111-aaaa-bbbb-cccc-000000000012', 'Watch', 'Classic wristwatch for all occasions', 129.99, 'accessories', 'https://images.pexels.com/photos/190819/pexels-photo-190819.jpeg'),
    ('11111111-aaaa-bbbb-cccc-000000000013', 'Sunglasses', 'UV-protection stylish sunglasses', 59.99, 'accessories', 'https://images.pexels.com/photos/267320/pexels-photo-267320.jpeg'),
    ('11111111-aaaa-bbbb-cccc-000000000014', 'Backpack', 'Durable travel backpack', 69.99, 'accessories', 'https://images.pexels.com/photos/769289/pexels-photo-769289.jpeg'),
    ('11111111-aaaa-bbbb-cccc-000000000015', 'Smartwatch', 'Track fitness and notifications', 199.99, 'gadgets', 'https://images.pexels.com/photos/1089438/pexels-photo-1089438.jpeg'),
    ('11111111-aaaa-bbbb-cccc-000000000016', 'Wireless Mouse', 'Ergonomic Bluetooth mouse', 39.99, 'gadgets', 'https://images.pexels.com/photos/374074/pexels-photo-374074.jpeg'),
    ('11111111-aaaa-bbbb-cccc-000000000017', 'Office Chair', 'Comfortable ergonomic chair', 149.99, 'furniture', 'https://images.pexels.com/photos/776656/pexels-photo-776656.jpeg'),
    ('11111111-aaaa-bbbb-cccc-000000000018', 'Coffee Table', 'Modern wooden coffee table', 89.99, 'furniture', 'https://images.pexels.com/photos/279616/pexels-photo-279616.jpeg'),
    ('11111111-aaaa-bbbb-cccc-000000000019', 'Yoga Mat', 'Eco-friendly non-slip mat', 29.99, 'lifestyle', 'https://images.pexels.com/photos/291762/pexels-photo-291762.jpeg'),
    ('11111111-aaaa-bbbb-cccc-000000000020', 'Indoor Plant', 'Air-purifying indoor plant', 24.99, 'lifestyle', 'https://images.pexels.com/photos/298864/pexels-photo-298864.jpeg');
    ```
5. Go to your browser and run `localhost/e-commerce-demo`
6. Enjoy!