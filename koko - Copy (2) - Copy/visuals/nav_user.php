<!-- visuals/nav_user.php - Customer Navigation -->
<?php
if (!isset($_SESSION)) {
    session_start();
}
$customer_name = isset($_SESSION['customer_username']) ? strtoupper(htmlspecialchars($_SESSION['customer_username'])) : 'GUEST';
?>
<header class="site-header">
  <div class="tape-top"></div>

  <div class="nav-bar">
    <!-- Hamburger Menu for Mobile (Hidden on desktop via CSS) -->
    <button class="hamburger-menu" aria-label="Toggle menu">☰</button>

    <!-- Desktop Navigation Left (Hidden on mobile via CSS) -->
    <div class="nav-left">
      <a class="nav-link" href="shop.php">SHOP+</a>
      <a class="nav-link" href="about.php">ABOUT+</a>
      <a class="nav-link" href="account.php">ACCOUNT</a>
      <a class="nav-link" href="customer_orders.php">MY ORDERS</a>
    </div>

    <!-- Logo (Always visible, centered on mobile, absolute center on desktop) -->
    <div class="nav-logo">
      <a href="index_user.php"><img src="WEB_KOKOBAP/pics/LOGO.png" alt="Kokobap Logo"></a>
    </div>

    <!-- Desktop Navigation Right (Hidden on mobile via CSS) -->
    <div class="nav-right">
      <span class="nav-link" style="color: var(--accent-dark); font-weight: 600;">
        WELCOME <?php echo $customer_name; ?>
      </span>
      <a class="nav-link" href="customer_logout.php">LOGOUT</a>
      <a class="cart-link" href="cart.php" style="position: relative;">
        <img src="WEB_KOKOBAP/pics/CART DESIGN.png" alt="Cart">
        <span id="cart-count" style="display:none; position: absolute; top: -5px; right: -5px; background: #d44521; color: white; border-radius: 50%; padding: 2px 6px; font-size: 11px; font-weight: bold; min-width: 18px; text-align: center;"></span>
      </a>
    </div>
  </div>

  <!-- Mobile Navigation Menu (Toggles via JavaScript) -->
  <div class="mobile-nav">
    <div style="padding: 15px; background: #f8f9fa; border-bottom: 2px solid #eee;">
      <strong style="color: var(--accent-dark);">WELCOME <?php echo $customer_name; ?></strong>
    </div>
    <a href="shop.php" class="mobile-nav-link">SHOP+</a>
    <a href="about.php" class="mobile-nav-link">ABOUT+</a>
    <a href="account.php" class="mobile-nav-link">ACCOUNT</a>
    <a href="customer_orders.php" class="mobile-nav-link">MY ORDERS</a>
    <a href="cart.php" class="mobile-nav-link">CART <span id="mobile-cart-count" style="display:none; background: #d44521; color: white; border-radius: 50%; padding: 2px 8px; font-size: 11px; margin-left: 5px;"></span></a>
    <a href="customer_logout.php" class="mobile-nav-link" style="color: #d44521; font-weight: bold;">LOGOUT</a>
  </div>
</header>

<!-- Load mobile menu script with cart count update -->
<script>
document.addEventListener('DOMContentLoaded', function() {
  const hamburger = document.querySelector('.hamburger-menu');
  const mobileNav = document.querySelector('.mobile-nav');
  
  // Update cart count function
  function updateCartCount() {
    const cart = JSON.parse(localStorage.getItem('kokobap_cart') || '[]');
    const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
    
    const cartCount = document.getElementById('cart-count');
    const mobileCartCount = document.getElementById('mobile-cart-count');
    
    if (cartCount) {
      cartCount.textContent = totalItems;
      cartCount.style.display = totalItems > 0 ? 'inline' : 'none';
    }
    
    if (mobileCartCount) {
      mobileCartCount.textContent = totalItems;
      mobileCartCount.style.display = totalItems > 0 ? 'inline' : 'none';
    }
  }
  
  // Initial cart count update
  updateCartCount();
  
  // Update cart count every 2 seconds
  setInterval(updateCartCount, 2000);
  
  if (hamburger && mobileNav) {
    // Toggle menu on hamburger click
    hamburger.addEventListener('click', function(e) {
      e.stopPropagation();
      mobileNav.classList.toggle('active');
      
      // Update icon
      if (mobileNav.classList.contains('active')) {
        hamburger.innerHTML = '✕';
      } else {
        hamburger.innerHTML = '☰';
      }
    });
    
    // Close menu when clicking outside
    document.addEventListener('click', function(e) {
      if (!mobileNav.contains(e.target) && !hamburger.contains(e.target)) {
        mobileNav.classList.remove('active');
        hamburger.innerHTML = '☰';
      }
    });
    
    // Close menu when clicking a link
    const mobileLinks = mobileNav.querySelectorAll('.mobile-nav-link');
    mobileLinks.forEach(link => {
      link.addEventListener('click', function() {
        mobileNav.classList.remove('active');
        hamburger.innerHTML = '☰';
      });
    });
    
    // Close menu on window resize to desktop
    let resizeTimer;
    window.addEventListener('resize', function() {
      clearTimeout(resizeTimer);
      resizeTimer = setTimeout(function() {
        if (window.innerWidth >= 768) {
          mobileNav.classList.remove('active');
          hamburger.innerHTML = '☰';
        }
      }, 250);
    });
  }
});
</script>
