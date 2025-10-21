<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kokobap — Shop</title>
  <link rel="stylesheet" href="assets/css/custom.css">
</head>
<body>

<?php 
if (isset($_SESSION['customer_logged_in']) && $_SESSION['customer_logged_in'] === true) {
    include 'visuals/nav_user.php';
} else {
    include 'visuals/nav.php';
}
?>

<main class="shop-page">
  <section class="shop-hero">
    <h1>FIND YOUR FLAVOR!</h1>
  </section>

  <section class="shop-grid">
    <div class="product">
      <div class="bubble kani"><img src="WEB_KOKOBAP/pics/KANI.jpg" alt="Kani"></div>
      <p class="product-title">KOKOBAP'S KANI<br><span class="subtitle">FLAVORED KIMBAP</span></p>
      <p class="price">₱140 PHP</p>
      <button class="add-btn" onclick="addToCart('KOKOBAP\'S KANI FLAVORED KIMBAP', 140, 'WEB_KOKOBAP/pics/KANI.jpg')">ADD TO CART</button>
    </div>

    <div class="product">
      <div class="bubble tuna"><img src="WEB_KOKOBAP/pics/TUNA.jpg" alt="Tuna"></div>
      <p class="product-title">KOKOBAP'S TUNA<br><span class="subtitle">FLAVORED KIMBAP</span></p>
      <p class="price">₱140 PHP</p>
      <button class="add-btn" onclick="addToCart('KOKOBAP\'S TUNA FLAVORED KIMBAP', 140, 'WEB_KOKOBAP/pics/TUNA.jpg')">ADD TO CART</button>
    </div>

    <div class="product">
      <div class="bubble bulgogi"><img src="WEB_KOKOBAP/pics/BULGOGI.jpg" alt="Bulgogi"></div>
      <p class="product-title">KOKOBAP'S BULGOGI<br><span class="subtitle">FLAVORED KIMBAP</span></p>
      <p class="price">₱140 PHP</p>
      <button class="add-btn" onclick="addToCart('KOKOBAP\'S BULGOGI FLAVORED KIMBAP', 140, 'WEB_KOKOBAP/pics/BULGOGI.jpg')">ADD TO CART</button>
    </div>

    <div class="product">
      <div class="bubble spam"><img src="WEB_KOKOBAP/pics/SPAM.jpg" alt="Spam"></div>
      <p class="product-title">KOKOBAP'S SPAM<br><span class="subtitle">FLAVORED KIMBAP</span></p>
      <p class="price">₱140 PHP</p>
      <button class="add-btn" onclick="addToCart('KOKOBAP\'S SPAM FLAVORED KIMBAP', 140, 'WEB_KOKOBAP/pics/SPAM.jpg')">ADD TO CART</button>
    </div>

    <div class="product">
      <div class="bubble ham"><img src="WEB_KOKOBAP/pics/HAM.jpg" alt="Ham"></div>
      <p class="product-title">KOKOBAP'S KOREAN HAM<br><span class="subtitle">FLAVORED KIMBAP</span></p>
      <p class="price">₱140 PHP</p>
      <button class="add-btn" onclick="addToCart('KOKOBAP\'S KOREAN HAM FLAVORED KIMBAP', 140, 'WEB_KOKOBAP/pics/HAM.jpg')">ADD TO CART</button>
    </div>
  </section>
</main>

<?php include 'visuals/footer.php'; ?>

<script src="js/cart.js"></script>

</body>
</html>
