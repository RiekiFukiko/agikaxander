<!-- visuals/nav.php - Guest Navigation (VERIFIED) -->
<header class="site-header">
  <div class="tape-top"></div>

  <div class="nav-bar">
    <!-- Hamburger Menu for Mobile (Hidden on desktop via CSS) -->
    <button class="hamburger-menu" aria-label="Toggle menu">☰</button>

    <!-- Desktop Navigation Left (Hidden on mobile via CSS) -->
    <div class="nav-left">
      <a class="nav-link" href="shop.php">SHOP+</a>
      <a class="nav-link" href="about.php">ABOUT+</a>
    </div>

    <!-- Logo (Always visible, centered on mobile, absolute center on desktop) -->
    <div class="nav-logo">
      <a href="index.php"><img src="WEB_KOKOBAP/pics/LOGO.png" alt="Kokobap Logo"></a>
    </div>

    <!-- Desktop Navigation Right (Hidden on mobile via CSS) -->
    <div class="nav-right">
      <a class="nav-link" href="login.php">LOGIN</a>
      <a class="cart-link" href="cart.php">
        <img src="WEB_KOKOBAP/pics/CART DESIGN.png" alt="Cart">
      </a>
    </div>
  </div>

  <!-- Mobile Navigation Menu (Toggles via JavaScript) -->
  <div class="mobile-nav">
    <a href="shop.php" class="mobile-nav-link">SHOP+</a>
    <a href="about.php" class="mobile-nav-link">ABOUT+</a>
    <a href="login.php" class="mobile-nav-link">LOGIN</a>
  </div>
</header>

<!-- Load mobile menu script -->
<script>
// Inline mobile menu script to ensure it works even if external file fails
document.addEventListener('DOMContentLoaded', function() {
  const hamburger = document.querySelector('.hamburger-menu');
  const mobileNav = document.querySelector('.mobile-nav');
  
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