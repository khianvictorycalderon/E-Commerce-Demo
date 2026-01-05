<?php
session_start();
require_once("../phps/db.php"); // transactionalMySQLQuery()

// If not logged in → redirect to login
if (!isset($_SESSION["user_id"])) {
    header("Location: /login/");
    exit();
}
$signed_user = $_SESSION["user_id"];

// Fetch products from database
$products = transactionalMySQLQuery("SELECT * FROM products ORDER BY created_at DESC");
if (is_string($products)) {
    die("DB Error: " . $products);
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Forces the browser to load the latest version of this website -->
        <meta http-equiv='cache-control' content='no-cache'> 
        <meta http-equiv='expires' content='0'> 
        <meta http-equiv='pragma' content='no-cache'>
        
        <link rel="icon" href="/images/e-commerce-demo.png">
        <script src="/assets/tailwind-3.4.17.js"></script>
        <script type="module" src="/assets/main.js"></script>
        <title>Browse Products</title>
    </head>
    <body class="bg-gray-50 min-h-screen">

        <div class="logged-navbar"></div>

        <!-- Page Header -->
        <header class="bg-blue-600 text-white pt-32 pb-16">
            <div class="container mx-auto px-4 text-center">
                <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold">Shop Our Products</h1>
                <p class="mt-2 text-lg sm:text-xl text-blue-100">
                    Browse thousands of curated products at your fingertips
                </p>
            </div>
        </header>

        <!-- Products Grid -->
        <section class="container mx-auto px-4 pt-16">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

                <?php if (!empty($products)): ?>
                    <?php foreach ($products as $product): ?>
                        <div class="bg-white rounded-2xl shadow p-4 flex flex-col">
                            <div class="aspect-square rounded-xl overflow-hidden">
                                <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" class="object-cover w-full h-full">
                            </div>
                            <h2 class="mt-3 font-semibold text-gray-900"><?= htmlspecialchars($product['name']) ?></h2>
                            <p class="mt-1 text-gray-500 text-sm line-clamp-2"><?= htmlspecialchars($product['description']) ?></p>
                            <div class="mt-auto flex items-center justify-between">
                                <span class="font-bold text-blue-600">$<?= number_format($product['price'], 2) ?></span>
                                <button class="px-3 py-1 rounded-lg bg-blue-500 text-white hover:bg-blue-400 transition text-sm">Add to Cart</button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-center text-gray-500 col-span-full">No products available.</p>
                <?php endif; ?>

            </div>
        </section>

        <div class="footer mt-16"></div>

    </body>
</html>
