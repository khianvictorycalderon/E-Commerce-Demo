<?php
session_start();
require_once("../../phps/db.php");
require_once("../../phps/tables.php"); // contains $cartTableQuery

// Auto-create carts table
$createCartTable = transactionalMySQLQuery($cartTableQuery);
if (is_string($createCartTable)) die("DB Error: " . $createCartTable);

// If not logged in → redirect to login
if (!isset($_SESSION["user_id"])) {
    header("Location: /login/");
    exit();
}
$signed_user = $_SESSION["user_id"];

// Handle add-to-cart POST
$added = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    $quantity = max(1, (int)($_POST['quantity'] ?? 1)); // default to 1

    // Check if this product is already in user's cart
    $existing = transactionalMySQLQuery(
        "SELECT * FROM carts WHERE user_id = ? AND product_id = ?",
        [$signed_user, $product_id]
    );

    if (is_string($existing)) {
        die("DB Error: " . $existing);
    }

    if (!empty($existing)) {
        // Update quantity
        $new_qty = $existing[0]['quantity'] + $quantity;
        $update = transactionalMySQLQuery(
            "UPDATE carts SET quantity = ? WHERE id = ?",
            [$new_qty, $existing[0]['id']]
        );
        $added = $update === true;
        $product = transactionalMySQLQuery("SELECT * FROM products WHERE id = ?", [$product_id])[0];
    } else {
        // Insert new row
        $cart_id = generate_uuid_v4_manual();
        $insert = transactionalMySQLQuery(
            "INSERT INTO carts (id, user_id, product_id, quantity) VALUES (?, ?, ?, ?)",
            [$cart_id, $signed_user, $product_id, $quantity]
        );
        $added = $insert === true;
        $product = transactionalMySQLQuery("SELECT * FROM products WHERE id = ?", [$product_id])[0];
    }
}

// Determine selected item for GET
$item_id = $_GET['item'] ?? null;

// Fetch either the selected item or all products
if ($item_id) {
    $products = transactionalMySQLQuery("SELECT * FROM products WHERE id = ?", [$item_id]);
} else {
    $products = transactionalMySQLQuery("SELECT * FROM products ORDER BY created_at DESC");
}

if (is_string($products)) {
    die("DB Error: " . $products);
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta http-equiv='cache-control' content='no-cache'> 
        <meta http-equiv='expires' content='0'> 
        <meta http-equiv='pragma' content='no-cache'>
        
        <link rel="icon" href="/images/e-commerce-demo.png">
        <script src="/assets/tailwind-3.4.17.js"></script>
        <script type="module" src="/assets/main.js"></script>
        <title>Manage your Cart</title>
    </head>
    <body class="bg-gray-50 min-h-screen">

        <div class="logged-navbar"></div>

        <div class="container mx-auto px-4 pt-32 pb-16">

            <?php if (!empty($added) && isset($product)): ?>
                <div class="bg-green-100 text-green-700 p-3 rounded-lg mb-4">
                    Added <?= (int)($_POST['quantity'] ?? 1) ?> x <?= htmlspecialchars($product['name']) ?> to your cart.
                </div>
            <?php endif; ?>

            <?php if ($item_id && !empty($products)): ?>
                <?php $product = $products[0]; ?>
                <div class="max-w-md mx-auto bg-white rounded-2xl shadow p-6 flex flex-col space-y-4">
                    <div class="aspect-square rounded-xl overflow-hidden">
                        <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" class="object-cover w-full h-full">
                    </div>

                    <h2 class="text-xl font-bold"><?= htmlspecialchars($product['name']) ?></h2>
                    <p class="text-gray-500"><?= htmlspecialchars($product['description']) ?></p>
                    <p class="font-semibold text-blue-600 text-lg">$<?= number_format($product['price'], 2) ?></p>

                    <form method="POST" class="flex flex-col space-y-3">
                        <input type="hidden" name="product_id" value="<?= htmlspecialchars($product['id']) ?>">
                        <label class="flex justify-between items-center">
                            Quantity
                            <input type="number" name="quantity" value="1" min="1" class="w-20 px-2 py-1 border rounded">
                        </label>

                        <div class="flex gap-2">
                            <button type="submit" class="flex-1 px-4 py-2 rounded-xl bg-blue-500 text-white hover:bg-blue-400 transition">
                                Add to Cart
                            </button>
                            <a href="/products/cart" class="flex-1 px-4 py-2 rounded-xl bg-gray-200 hover:bg-gray-300 text-center transition">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>

            <?php else: ?>
                <h1 class="text-3xl font-bold mb-6 text-center">Browse Products</h1>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    <?php foreach ($products as $p): ?>
                        <div class="bg-white rounded-2xl shadow p-4 flex flex-col">
                            <div class="aspect-square rounded-xl overflow-hidden">
                                <img src="<?= htmlspecialchars($p['image']) ?>" alt="<?= htmlspecialchars($p['name']) ?>" class="object-cover w-full h-full">
                            </div>

                            <h2 class="mt-3 font-semibold text-gray-900"><?= htmlspecialchars($p['name']) ?></h2>
                            <p class="mt-1 text-gray-500 text-sm line-clamp-2"><?= htmlspecialchars($p['description']) ?></p>

                            <div class="mt-auto flex items-center justify-between">
                                <span class="font-bold text-blue-600">$<?= number_format($p['price'], 2) ?></span>
                                <form method="POST" class="ml-auto">
                                    <input type="hidden" name="product_id" value="<?= htmlspecialchars($p['id']) ?>">
                                    <input type="number" name="quantity" value="1" min="1" class="hidden">
                                    <button type="submit" class="px-3 py-1 rounded-lg bg-blue-500 text-white hover:bg-blue-400 transition text-sm">
                                        Add to Cart
                                    </button>
                                </form>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

        </div>

        <div class="footer mt-16"></div>

    </body>
</html>