<?php
session_start();

// If not logged in → redirect to login
if (!isset($_SESSION["user_id"])) {
    header("Location: /login/");
    exit();
}
$signed_user = $_SESSION["user_id"];
?>

<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="icon" href="/images/e-commerce-demo.png">
      <script src="/assets/tailwind-3.4.17.js"></script>
      <script type="module" src="/assets/main.js"></script>
      <title>Browse Products</title>
  </head>
  <body class="bg-gray-50 min-h-screen">

      <!-- Page Header -->
      <header class="bg-blue-600 text-white py-16">
          <div class="container mx-auto px-4 text-center">
              <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold">Shop Our Products</h1>
              <p class="mt-2 text-lg sm:text-xl text-blue-100">
                  Browse thousands of curated products at your fingertips
              </p>
          </div>
      </header>

      <!-- Filter / Categories Section -->
      <section class="container mx-auto px-4 mt-8">
          <div class="flex flex-wrap justify-between items-center gap-4 mb-6">
              <div>
                  <input type="text" placeholder="Search products..." class="px-4 py-2 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-300 outline-none transition w-full sm:w-64">
              </div>

              <div class="flex flex-wrap gap-2">
                  <button class="px-4 py-2 rounded-xl bg-blue-500 text-white hover:bg-blue-400 transition">All</button>
                  <button class="px-4 py-2 rounded-xl bg-gray-200 hover:bg-gray-300 transition">Electronics</button>
                  <button class="px-4 py-2 rounded-xl bg-gray-200 hover:bg-gray-300 transition">Clothing</button>
                  <button class="px-4 py-2 rounded-xl bg-gray-200 hover:bg-gray-300 transition">Accessories</button>
              </div>
          </div>
      </section>

      <!-- Products Grid -->
      <section class="container mx-auto px-4">
          <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

              <!-- Single Product Card -->
              <div class="bg-white rounded-2xl shadow p-4 flex flex-col">
                  <div class="aspect-square rounded-xl overflow-hidden">
                      <img src="/images/product-placeholder.png" alt="Product Name" class="object-cover w-full h-full">
                  </div>
                  <h2 class="mt-3 font-semibold text-gray-900">Product Name</h2>
                  <p class="mt-1 text-gray-500 text-sm line-clamp-2">Short product description goes here. Keeps it concise.</p>
                  <div class="mt-auto flex items-center justify-between">
                      <span class="font-bold text-blue-600">$49.99</span>
                      <button class="px-3 py-1 rounded-lg bg-blue-500 text-white hover:bg-blue-400 transition text-sm">Add to Cart</button>
                  </div>
              </div>

              <!-- Repeat the product card as needed -->
              <div class="bg-white rounded-2xl shadow p-4 flex flex-col">
                  <div class="aspect-square rounded-xl overflow-hidden">
                      <img src="/images/product-placeholder.png" alt="Product Name" class="object-cover w-full h-full">
                  </div>
                  <h2 class="mt-3 font-semibold text-gray-900">Product Name</h2>
                  <p class="mt-1 text-gray-500 text-sm line-clamp-2">Short product description goes here. Keeps it concise.</p>
                  <div class="mt-auto flex items-center justify-between">
                      <span class="font-bold text-blue-600">$79.99</span>
                      <button class="px-3 py-1 rounded-lg bg-blue-500 text-white hover:bg-blue-400 transition text-sm">Add to Cart</button>
                  </div>
              </div>

              <!-- ... More placeholder products ... -->

          </div>
      </section>

      <!-- Pagination -->
      <section class="container mx-auto px-4 mt-8 flex justify-center">
          <div class="flex space-x-2">
              <button class="px-3 py-1 rounded-xl bg-gray-200 hover:bg-gray-300 transition">1</button>
              <button class="px-3 py-1 rounded-xl bg-gray-200 hover:bg-gray-300 transition">2</button>
              <button class="px-3 py-1 rounded-xl bg-gray-200 hover:bg-gray-300 transition">3</button>
              <button class="px-3 py-1 rounded-xl bg-gray-200 hover:bg-gray-300 transition">Next</button>
          </div>
      </section>

      <div class="footer mt-16"></div>

  </body>
</html>