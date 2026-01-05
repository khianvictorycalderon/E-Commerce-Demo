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

// --- Handle Add-to-Cart POST internally ---
$added = false;
$addedProductName = "";
$addedQuantity = 1;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'], $_POST['product_id'])) {
    if ($_POST['action'] === 'add') {
        $product_id = $_POST['product_id'];
        $quantity = max(1, (int)($_POST['quantity'] ?? 1));
        $addedQuantity = $quantity;

        // Check if product already in cart
        $existing = transactionalMySQLQuery(
            "SELECT * FROM carts WHERE user_id=? AND product_id=?",
            [$signed_user, $product_id]
        );
        if (!is_string($existing)) {
            if (!empty($existing)) {
                $new_qty = $existing[0]['quantity'] + $quantity;
                $update = transactionalMySQLQuery(
                    "UPDATE carts SET quantity=? WHERE id=?",
                    [$new_qty, $existing[0]['id']]
                );
                $added = $update === true;
            } else {
                $cart_id = generate_uuid_v4_manual();
                $insert = transactionalMySQLQuery(
                    "INSERT INTO carts (id,user_id,product_id,quantity) VALUES (?,?,?,?)",
                    [$cart_id, $signed_user, $product_id, $quantity]
                );
                $added = $insert === true;
            }
        }

        // Get product name for modal
        foreach ($products as $p) {
            if ($p['id'] === $product_id) {
                $addedProductName = $p['name'];
                break;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Browse Products</title> 
        <link rel="icon" href="/images/e-commerce-demo.png">
        <script src="/assets/tailwind-3.4.17.js"></script>
        <script type="module" src="/assets/main.js"></script>
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
                                <span class="font-bold text-blue-600">$<?= number_format($product['price'],2) ?></span>
                                <button
                                    class="add-to-cart-btn px-3 py-1 rounded-lg bg-blue-500 text-white hover:bg-blue-400 transition text-sm"
                                    data-id="<?= htmlspecialchars($product['id']) ?>"
                                    data-name="<?= htmlspecialchars($product['name']) ?>"
                                    data-desc="<?= htmlspecialchars($product['description']) ?>"
                                >
                                    Add to Cart
                                </button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-center text-gray-500 col-span-full">No products available.</p>
                <?php endif; ?>
            </div>
        </section>

        <!-- Add to Cart Modal -->
        <div id="addCartModal" class="fixed inset-0 flex items-center justify-center bg-black/40 hidden z-50">
            <div class="bg-white rounded-2xl shadow-xl p-6 w-80 text-center space-y-4 relative">
                <button id="closeModal" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">&times;</button>
                <h2 class="text-xl font-semibold" id="modalProductName">Added to Cart!</h2>
                <p id="modalProductDesc" class="text-gray-600 text-sm">Your item has been added.</p>
                <div class="flex items-center justify-center gap-2">
                    <label for="modalQuantity" class="text-sm">Quantity:</label>
                    <input id="modalQuantity" type="number" min="1" value="1" class="w-16 border rounded px-2 py-1 text-center">
                </div>
                <form method="POST" id="modalForm">
                    <input type="hidden" name="action" value="add">
                    <input type="hidden" name="product_id" id="modalProductId">
                    <input type="hidden" name="quantity" id="modalProductQty">
                    <button type="submit" class="w-full py-2 rounded-xl bg-blue-600 hover:bg-blue-500 text-white font-medium transition">
                        Add to Cart
                    </button>
                </form>
            </div>
        </div>

        <div class="footer mt-16"></div>

        <script>
        const modal = document.getElementById("addCartModal");
        const closeModalBtn = document.getElementById("closeModal");
        const modalProductName = document.getElementById("modalProductName");
        const modalProductDesc = document.getElementById("modalProductDesc");
        const modalProductId = document.getElementById("modalProductId");
        const modalQuantity = document.getElementById("modalQuantity");
        const modalQtyInput = document.getElementById("modalProductQty");
        const modalForm = document.getElementById("modalForm");

        // Open modal
        document.querySelectorAll(".add-to-cart-btn").forEach(btn => {
            btn.addEventListener("click", () => {
                modalProductId.value = btn.dataset.id;
                modalProductName.textContent = btn.dataset.name;
                modalProductDesc.textContent = btn.dataset.desc;
                modalQuantity.value = 1;
                modalQtyInput.value = 1;
                modal.classList.remove("hidden");
            });
        });

        // Close modal
        closeModalBtn.addEventListener("click", () => modal.classList.add("hidden"));

        // Update hidden quantity input when modal changes
        modalQuantity.addEventListener("input", () => {
            modalQtyInput.value = modalQuantity.value;
        });

        // Auto-show confirmation if item added successfully (from POST)
        <?php if($added): ?>
            alert("Added <?= htmlspecialchars($addedQuantity) ?> x <?= htmlspecialchars($addedProductName) ?> to cart!");
        <?php endif; ?>
        </script>

    </body>
</html>
