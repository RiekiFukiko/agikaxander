<!-- visuals/nav_admin.php - Admin Navigation -->
<?php
if (!isset($_SESSION)) {
    session_start();
}
$admin_name = isset($_SESSION['admin_name']) ? htmlspecialchars($_SESSION['admin_name']) : 'Administrator';
?>
<header class="site-header">
  <div class="tape-top"></div>

  <div class="nav-bar">
    <!-- Hamburger Menu for Mobile (Hidden on desktop via CSS) -->
    <button class="hamburger-menu" aria-label="Toggle menu">☰</button>

    <!-- Desktop Navigation Left (Hidden on mobile via CSS) -->
    <div class="nav-left">
      <a class="nav-link" href="index_admin.php">DASHBOARD</a>
      <a class="nav-link" href="orders.php">ORDERS</a>
    </div>

    <!-- Logo (Always visible, centered on mobile, absolute center on desktop) -->
    <div class="nav-logo">
      <a href="index_admin.php"><img src="WEB_KOKOBAP/pics/LOGO.png" alt="Kokobap Logo"></a>
    </div>

    <!-- Desktop Navigation Right (Hidden on mobile via CSS) -->
    <div class="nav-right">
      <span class="admin-badge" style="color: #d44521; font-weight: bold; font-family: 'Permanent Marker', 'Montserrat', sans-serif; letter-spacing: 1px;">ADMIN</span>
      <a class="nav-link" href="index.php" style="color: #d44521; font-weight: 600;">LOGOUT</a>
    </div>
  </div>

  <!-- Mobile Navigation Menu (Toggles via JavaScript) -->
  <div class="mobile-nav">
    <div style="padding: 15px; background: #4a1b18; color: white; border-bottom: 2px solid #333; text-align: center;">
      <strong style="font-family: 'Permanent Marker', 'Montserrat', sans-serif; letter-spacing: 1px;">🛡️ ADMIN PANEL</strong>
    </div>
    <a href="index_admin.php" class="mobile-nav-link">DASHBOARD</a>
    <a href="orders.php" class="mobile-nav-link">ORDERS</a>
    <a href="index.php" class="mobile-nav-link" style="color: #d44521; font-weight: bold;">LOGOUT</a>
  </div>
</header>

<!-- Load mobile menu script -->
<script>
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