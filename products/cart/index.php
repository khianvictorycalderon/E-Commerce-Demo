<?php
session_start();
require_once("../../phps/db.php");
require_once("../../phps/tables.php"); 

if (!isset($_SESSION["user_id"])) {
    header("Location: /login/");
    exit();
}
$signed_user = $_SESSION["user_id"];

// Auto-create carts table
$createCartTable = transactionalMySQLQuery($cartTableQuery);
if (is_string($createCartTable)) die("DB Error: ".$createCartTable);

// Handle Add or Remove POST (internal, no redirect)
$message = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['action']) && $_POST['action'] === 'remove' && isset($_POST['cart_id'])) {
        $remove = transactionalMySQLQuery(
            "DELETE FROM carts WHERE id=? AND user_id=?",
            [$_POST['cart_id'],$signed_user]
        );
        $message = $remove===true ? "Item removed from cart." : "Failed to remove item.";
    }
}

// Fetch current cart items
$cart_items = transactionalMySQLQuery(
    "SELECT c.id AS cart_id, c.quantity, p.* 
     FROM carts c 
     JOIN products p ON c.product_id = p.id 
     WHERE c.user_id=?",
    [$signed_user]
);
if (is_string($cart_items)) die("DB Error: ".$cart_items);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Your Cart</title>
        <link rel="icon" href="/images/e-commerce-demo.png">
        <script src="/assets/tailwind-3.4.17.js"></script>
        <script src="/assets/main.js"></script>
    </head>
    <body class="bg-gray-50 min-h-screen">

    <div class="logged-navbar"></div>

    <div class="container mx-auto px-4 pt-32 pb-16">

        <?php if($message): ?>
            <div class="bg-green-100 text-green-700 p-3 rounded-lg mb-4"><?= htmlspecialchars($message) ?></div>
        <?php endif; ?>

        <h1 class="text-3xl font-bold mb-6 text-center">Your Cart</h1>

        <?php if(!empty($cart_items)): ?>
            <div class="space-y-6 max-w-3xl mx-auto">
                <?php $total=0; ?>
                <?php foreach($cart_items as $item): ?>
                    <?php $subtotal = $item['price']*$item['quantity']; $total+=$subtotal; ?>
                    <div class="flex bg-white rounded-2xl shadow p-4 gap-4 items-center">
                        <div class="w-24 h-24 flex-shrink-0 overflow-hidden rounded-xl">
                            <img src="<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>" class="object-cover w-full h-full">
                        </div>
                        <div class="flex-1">
                            <h2 class="font-semibold text-gray-900"><?= htmlspecialchars($item['name']) ?></h2>
                            <p class="text-gray-500 text-sm"><?= htmlspecialchars($item['description']) ?></p>
                            <p class="text-blue-600 font-semibold">$<?= number_format($item['price'],2) ?> x <?= $item['quantity'] ?> = $<?= number_format($subtotal,2) ?></p>
                        </div>
                        <form method="POST">
                            <input type="hidden" name="action" value="remove">
                            <input type="hidden" name="cart_id" value="<?= htmlspecialchars($item['cart_id']) ?>">
                            <button type="submit" class="px-3 py-1 rounded-lg bg-red-500 text-white hover:bg-red-400 transition text-sm">
                                Remove
                            </button>
                        </form>
                    </div>
                <?php endforeach; ?>

                <div class="flex justify-end font-bold text-lg">Total: $<?= number_format($total,2) ?></div>

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
