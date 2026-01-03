<?php
// Optional: You can pass a $cartCount variable to show number of items in cart
$cartCount = $cartCount ?? 0;
?>

<nav class="navbar">
  <div class="navbar-container">
    <div class="logo">
      <a href="index.php">E-Commerce Demo</a>
    </div>

    <ul class="nav-links">
      <li><a href="index.php">Home</a></li>
      <li><a href="#products">Products</a></li>
      <li><a href="#about">About</a></li>
      <li><a href="cart.php" class="cart-link">
        Cart (<span id="cart-count"><?php echo $cartCount; ?></span>)
      </a></li>
    </ul>

    <!-- Hamburger menu for mobile -->
    <div class="hamburger">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </div>
</nav>