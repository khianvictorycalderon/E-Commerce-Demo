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

// --- Handle Add-to-Cart POST ---
$added = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    $quantity = max(1, (int)($_POST['quantity'] ?? 1)); // default to 1

    // Check if product already in cart
    $existing = transactionalMySQLQuery(
        "SELECT * FROM carts WHERE user_id = ? AND product_id = ?",
        [$signed_user, $product_id]
    );
    if (is_string($existing)) die("DB Error: " . $existing);

    if (!empty($existing)) {
        // Update quantity
        $new_qty = $existing[0]['quantity'] + $quantity;
        $update = transactionalMySQLQuery(
            "UPDATE carts SET quantity = ? WHERE id = ?",
            [$new_qty, $existing[0]['id']]
        );
        $added = $update === true;
    } else {
        // Insert new row
        $cart_id = generate_uuid_v4_manual();
        $insert = transactionalMySQLQuery(
            "INSERT INTO carts (id, user_id, product_id, quantity) VALUES (?, ?, ?, ?)",
            [$cart_id, $signed_user, $product_id, $quantity]
        );
        $added = $insert === true;
    }
}

// --- Fetch all items in user's cart ---
$cart_items = transactionalMySQLQuery(
    "SELECT c.id AS cart_id, c.quantity, p.* 
     FROM carts c 
     JOIN products p ON c.product_id = p.id 
     WHERE c.user_id = ?",
    [$signed_user]
);

if (is_string($cart_items)) die("DB Error: " . $cart_items);
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
        <title>Your Cart</title>
    </head>
    <body class="bg-gray-50 min-h-screen">

        <div class="logged-navbar"></div>

        <div class="container mx-auto px-4 pt-32 pb-16">

            <?php if (!empty($added) && isset($product_id)): ?>
                <div class="bg-green-100 text-green-700 p-3 rounded-lg mb-4">
                    Added <?= (int)($_POST['quantity'] ?? 1) ?> item(s) to your cart.
                </div>
            <?php endif; ?>

            <h1 class="text-3xl font-bold mb-6 text-center">Your Cart</h1>

            <?php if (!empty($cart_items)): ?>
                <div class="space-y-6 max-w-3xl mx-auto">
                    <?php $total = 0; ?>
                    <?php foreach ($cart_items as $item): ?>
                        <?php $subtotal = $item['price'] * $item['quantity']; ?>
                        <?php $total += $subtotal; ?>
                        <div class="flex bg-white rounded-2xl shadow p-4 gap-4 items-center">
                            <div class="w-24 h-24 flex-shrink-0 overflow-hidden rounded-xl">
                                <img src="<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>" class="object-cover w-full h-full">
                            </div>
                            <div class="flex-1">
                                <h2 class="font-semibold text-gray-900"><?= htmlspecialchars($item['name']) ?></h2>
                                <p class="text-gray-500 text-sm"><?= htmlspecialchars($item['description']) ?></p>
                                <p class="text-blue-600 font-semibold">$<?= number_format($item['price'], 2) ?> x <?= $item['quantity'] ?> = $<?= number_format($subtotal, 2) ?></p>
                            </div>
                            <form method="POST" action="/products/cart/remove.php">
                                <input type="hidden" name="cart_id" value="<?= htmlspecialchars($item['cart_id']) ?>">
                                <button type="submit" class="px-3 py-1 rounded-lg bg-red-500 text-white hover:bg-red-400 transition text-sm">
                                    Remove
                                </button>
                            </form>
                        </div>
                    <?php endforeach; ?>

                    <div class="flex justify-end font-bold text-lg">
                        Total: $<?= number_format($total, 2) ?>
                    </div>

                    <div class="flex justify-end mt-4 gap-2">
                        <a href="/checkout" class="px-4 py-2 rounded-xl bg-green-600 text-white hover:bg-green-500 transition">
                            Checkout
                        </a>
                        <a href="/products" class="px-4 py-2 rounded-xl bg-gray-200 hover:bg-gray-300 transition">
                            Continue Shopping
                        </a>
                    </div>
                </div>
            <?php else: ?>
                <p class="text-center text-gray-500">Your cart is empty.</p>
            <?php endif; ?>

        </div>

        <div class="footer mt-16"></div>

    </body>
</html>