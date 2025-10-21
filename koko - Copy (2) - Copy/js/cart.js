function addToCart(name, price, image) {
  // Check if customer is logged in first
  fetch("check_customer_session.php")
    .then((response) => response.json())
    .then((data) => {
      if (!data.logged_in) {
        alert("Please log in to add items to cart!")
        window.location.href = "customer_login.php"
        return
      }

      // Proceed with adding to cart if logged in
      const cart = JSON.parse(localStorage.getItem("kokobap_cart") || "[]")

      // Check if item already exists
      const existingItem = cart.find((item) => item.name === name)

      if (existingItem) {
        existingItem.quantity += 1
      } else {
        cart.push({
          name: name,
          price: price,
          image: image,
          quantity: 1,
        })
      }

      localStorage.setItem("kokobap_cart", JSON.stringify(cart))

      // Show success message
      alert("Added to cart!")

      // Update cart count if exists
      updateCartCount()
    })
    .catch(() => {
      alert("Please log in to add items to cart!")
      window.location.href = "customer_login.php"
    })
}

function updateCartCount() {
  const cart = JSON.parse(localStorage.getItem("kokobap_cart") || "[]")
  const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0)

  const cartCount = document.getElementById("cart-count")
  if (cartCount) {
    cartCount.textContent = totalItems
    cartCount.style.display = totalItems > 0 ? "inline" : "none"
  }
}

function createOrder(cartItems, total, customerId, customerName) {
  const orders = JSON.parse(localStorage.getItem("orders") || "[]")

  const newOrder = {
    id: "ORD" + Date.now(),
    date: new Date().toISOString(),
    items: cartItems,
    total: total,
    status: "Pending",
    customerId: customerId,
    customer: customerName,
  }

  orders.push(newOrder)
  localStorage.setItem("orders", JSON.stringify(orders))

  return newOrder
}

function checkout() {
  const cart = JSON.parse(localStorage.getItem("kokobap_cart") || "[]")

  if (cart.length === 0) {
    alert("Your cart is empty!")
    return
  }

  const subtotal = cart.reduce((sum, item) => sum + item.price * item.quantity, 0)
  const total = subtotal + 50 // Add delivery fee

  // Get customer info from session via PHP
  fetch("get_customer_info.php")
    .then((response) => response.json())
    .then((customerData) => {
      const order = createOrder(cart, total, customerData.id, customerData.name)

      alert(
        `Thank you for your order! Order #${order.id} has been placed.`,
      )

      // Clear cart
      localStorage.removeItem("kokobap_cart")
      updateCartCount()

      window.location.href = "customer_orders.php"
    })
    .catch(() => {
      alert("Error processing order. Please try again.")
    })
}

// Update cart count when page loads
document.addEventListener("DOMContentLoaded", updateCartCount)
