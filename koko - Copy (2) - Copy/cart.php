<?php
session_start();

if (!isset($_SESSION['customer_logged_in']) || $_SESSION['customer_logged_in'] !== true) {
    header("Location: customer_login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart - Kokobap</title>
    <link rel="stylesheet" href="assets/css/custom.css">
</head>
<body>

<?php include 'visuals/nav_user.php'; ?>

<main class="cart-page">
    <div class="container">
        <h1>Your Cart</h1>
        
        <div id="cart-items">
            <div class="empty-cart" id="empty-cart">
                <img src="WEB_KOKOBAP/pics/CART DESIGN.png" alt="Empty Cart" class="empty-cart-icon">
                <h2>Your cart is empty</h2>
                <p>Add some delicious kimbap to get started!</p>
                <a href="shop.php" class="cta-button">Browse Menu</a>
            </div>
        </div>

        <div class="cart-summary" id="cart-summary" style="display: none;">
            <div class="summary-row">
                <span>Subtotal:</span>
                <span id="subtotal">₱0</span>
            </div>
            <div class="summary-row">
                <span>Delivery Fee:</span>
                <span>₱50</span>
            </div>
            <div class="summary-row total">
                <span>Total:</span>
                <span id="total">₱50</span>
            </div>
            <button class="checkout-btn" onclick="checkout()">Proceed to Checkout</button>
        </div>
    </div>
</main>

<?php include 'visuals/footer.php'; ?>

<script src="js/cart.js"></script>
<script>
function loadCart() {
    const cart = JSON.parse(localStorage.getItem('kokobap_cart') || '[]');
    const cartItems = document.getElementById('cart-items');
    const emptyCart = document.getElementById('empty-cart');
    const cartSummary = document.getElementById('cart-summary');
    
    if (cart.length === 0) {
        emptyCart.style.display = 'block';
        cartSummary.style.display = 'none';
        return;
    }
    
    emptyCart.style.display = 'none';
    cartSummary.style.display = 'block';
    
    let cartHTML = '<div class="cart-list">';
    let subtotal = 0;
    
    cart.forEach((item, index) => {
        const itemTotal = item.price * item.quantity;
        subtotal += itemTotal;
        
        cartHTML += `
            <div class="cart-item">
                <img src="${item.image}" alt="${item.name}" class="cart-item-image">
                <div class="cart-item-details">
                    <h3>${item.name}</h3>
                    <p class="cart-item-price">₱${item.price}</p>
                </div>
                <div class="cart-item-controls">
                    <button onclick="updateQuantity(${index}, -1)">-</button>
                    <span class="quantity">${item.quantity}</span>
                    <button onclick="updateQuantity(${index}, 1)">+</button>
                </div>
                <div class="cart-item-total">₱${itemTotal}</div>
                <button onclick="removeItem(${index})" class="remove-btn">×</button>
            </div>
        `;
    });
    
    cartHTML += '</div>';
    cartItems.innerHTML = cartHTML;
    
    document.getElementById('subtotal').textContent = '₱' + subtotal;
    document.getElementById('total').textContent = '₱' + (subtotal + 50);
}

function updateQuantity(index, change) {
    const cart = JSON.parse(localStorage.getItem('kokobap_cart') || '[]');
    cart[index].quantity += change;
    
    if (cart[index].quantity <= 0) {
        cart.splice(index, 1);
    }
    
    localStorage.setItem('kokobap_cart', JSON.stringify(cart));
    loadCart();
}

function removeItem(index) {
    const cart = JSON.parse(localStorage.getItem('kokobap_cart') || '[]');
    cart.splice(index, 1);
    localStorage.setItem('kokobap_cart', JSON.stringify(cart));
    loadCart();
}

function checkout() {
    alert('Checkout functionality is coming soon!');
}

document.addEventListener('DOMContentLoaded', loadCart);
</script>

</body>
</html>
