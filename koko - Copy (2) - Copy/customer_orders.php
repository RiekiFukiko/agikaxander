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
    <!-- Added viewport meta tag for mobile responsiveness -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders - Kokobap</title>
    <link rel="stylesheet" href="assets/css/custom.css">
    <style>
        /* Added mobile-first responsive styles */
        .orders-container {
            padding: 40px 20px;
            max-width: 1000px;
            margin: 0 auto;
        }
        
        .order-card {
            background: #fff;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .order-header {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }
        
        .order-status {
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            white-space: nowrap;
        }
        
        .status-pending { background: #fff3cd; color: #856404; }
        .status-confirmed { background: #d4edda; color: #155724; }
        .status-preparing { background: #cce5ff; color: #004085; }
        .status-ready { background: #d1ecf1; color: #0c5460; }
        
        .order-items {
            margin-top: 10px;
        }
        
        .order-item {
            display: flex;
            justify-content: space-between;
            padding: 5px 0;
        }
        
        .no-orders {
            text-align: center;
            padding: 60px 20px;
            color: #666;
        }
        
        .btn-primary {
            background: #d44521;
            color: white;
            padding: 12px 24px;
            border-radius: 6px;
            text-decoration: none;
            display: inline-block;
            margin-top: 15px;
        }
        
        /* Mobile responsive breakpoints */
        @media (max-width: 768px) {
            .orders-container {
                padding: 20px 15px;
            }
            
            .order-card {
                padding: 15px;
            }
            
            .order-header {
                flex-direction: column;
                align-items: flex-start;
            }
        }
        
        @media (max-width: 480px) {
            .no-orders {
                padding: 40px 15px;
            }
            
            .no-orders h3 {
                font-size: 1.2rem;
            }
        }
    </style>
</head>
<body>

<?php include 'visuals/nav_user.php'; ?>

<main class="orders-container">
    <h1>My Orders</h1>
    
    <div id="customer-orders">
        <div class="no-orders">
            <h3>No orders yet</h3>
            <p>Start shopping to see your orders here!</p>
            <a href="shop.php" class="btn-primary">Browse Menu</a>
        </div>
    </div>
</main>

<script>
function loadCustomerOrders() {
    const customerId = '<?php echo $_SESSION['customer_id']; ?>';
    const orders = JSON.parse(localStorage.getItem('orders') || '[]');
    const customerOrders = orders.filter(order => order.customerId === customerId);
    
    const container = document.getElementById('customer-orders');
    
    if (customerOrders.length === 0) {
        return; // Keep the no-orders message
    }
    
    container.innerHTML = customerOrders.map(order => `
        <div class="order-card">
            <div class="order-header">
                <div>
                    <strong>Order #${order.id}</strong>
                    <div style="font-size: 14px; color: #666; margin-top: 5px;">
                        ${new Date(order.date).toLocaleDateString()} at ${new Date(order.date).toLocaleTimeString()}
                    </div>
                </div>
                <span class="order-status status-${order.status.toLowerCase().replace(' ', '-')}">${order.status}</span>
            </div>
            <div class="order-items">
                ${order.items.map(item => `
                    <div class="order-item">
                        <span>${item.name} x${item.quantity}</span>
                        <span>₱${(item.price * item.quantity).toFixed(2)}</span>
                    </div>
                `).join('')}
            </div>
            <div style="text-align: right; margin-top: 15px; padding-top: 10px; border-top: 1px solid #eee;">
                <strong>Total: ₱${order.total.toFixed(2)}</strong>
            </div>
        </div>
    `).join('');
}

document.addEventListener('DOMContentLoaded', loadCustomerOrders);
</script>

<?php include 'visuals/footer.php'; ?>

</body>
</html>
