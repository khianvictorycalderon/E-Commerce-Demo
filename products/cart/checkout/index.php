<?php
session_start();
require_once("../../../phps/db.php");
require_once("../../../phps/tables.php"); // for cart table if needed

if (!isset($_SESSION["user_id"])) {
    header("Location: /login/");
    exit();
}

$signed_user = $_SESSION["user_id"];

// Auto-create carts table (just in case)
$createCartTable = transactionalMySQLQuery($cartTableQuery);
if (is_string($createCartTable)) die("DB Error: ".$createCartTable);

// Clear the user's cart
$clearCart = transactionalMySQLQuery("DELETE FROM carts WHERE user_id=?", [$signed_user]);
if (is_string($clearCart)) die("DB Error: ".$clearCart);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Checkout Complete</title>
        <link rel="icon" href="/images/e-commerce-demo.png">
        <script src="/assets/tailwind-3.4.17.js"></script>
    </head>
    <body class="bg-gray-50 min-h-screen flex items-center justify-center">

        <!-- Modal -->
        <div class="bg-white rounded-2xl shadow-xl p-8 max-w-md text-center">
            <h1 class="text-2xl font-bold text-green-600 mb-4">✅ Order Complete!</h1>
            <p class="text-gray-700 mb-6">
                Your dummy order has been successfully placed. Thank you for shopping at our demo store!
            </p>
            <a href="/products" class="inline-block px-6 py-2 bg-blue-600 text-white rounded-xl hover:bg-blue-500 transition">
                Continue Shopping
            </a>
        </div>

    </body>
</html>
