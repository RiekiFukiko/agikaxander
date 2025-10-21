<?php
session_start();


if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Management - Kokobap</title>
    <link rel="stylesheet" href="assets/css/custom.css">
    <style>
        .orders-page {
            padding: 40px 20px;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .orders-header {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-bottom: 30px;
        }
        
        .filter-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        
        .filter-btn {
            padding: 10px 20px;
            border: 2px solid #d44521;
            background: white;
            color: #d44521;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }
        
        .filter-btn.active {
            background: #d44521;
            color: white;
        }
        
        .orders-container {
            background: white;
            border-radius: 10px;
            border: 2px solid #d44521;
            overflow: hidden;
        }
        
        .order-card {
            padding: 20px;
            border-bottom: 1px solid #eee;
        }
        
        .order-card:last-child {
            border-bottom: none;
        }
        
        .order-header {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-bottom: 15px;
        }
        
        .order-items {
            margin: 15px 0;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 5px;
        }
        
        .status-btn {
            padding: 8px 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            font-size: 14px;
        }
        
        .status-pending {
            background: #ffc107;
            color: #000;
        }
        
        .status-completed {
            background: #28a745;
            color: white;
        }
        
        .status-cancelled {
            background: #dc3545;
            color: white;
        }
        
        /* Mobile responsive breakpoints */
        @media (max-width: 768px) {
            .orders-page {
                padding: 20px 15px;
            }
            
            .orders-header {
                flex-direction: column;
                align-items: stretch;
            }
            
            .orders-header h1 {
                font-size: 1.5rem;
            }
            
            .filter-buttons {
                justify-content: center;
            }
            
            .order-header {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .order-card {
                padding: 15px;
            }
        }
        
        @media (max-width: 480px) {
            .filter-btn {
                flex: 1;
                min-width: 100px;
            }
        }
    </style>
</head>
<body>

<?php include 'visuals/nav_admin.php'; ?>

<main class="orders-page">
    <div class="orders-header">
        <h1>Order Management</h1>
        <div class="filter-buttons">
            <button class="filter-btn active" onclick="filterOrders('all')">All Orders</button>
            <button class="filter-btn" onclick="filterOrders('pending')">Pending</button>
            <button class="filter-btn" onclick="filterOrders('completed')">Completed</button>
        </div>
    </div>

    <div class="orders-container" id="orders-container">
        <div style="padding: 40px; text-align: center; color: #666;">
            No orders found.
        </div>
    </div>
</main>

<?php include 'visuals/footer.php'; ?>

<script>
let currentFilter = 'all';

function loadOrders() {
    const orders = JSON.parse(localStorage.getItem('kokobap_orders') || '[]');
    const container = document.getElementById('orders-container');
    
    if (orders.length === 0) {
        container.innerHTML = '<div style="padding: 40px; text-align: center; color: #666;">No orders found.</div>';
        return;
    }
    
    let filteredOrders = orders;
    if (currentFilter !== 'all') {
        filteredOrders = orders.filter(order => order.status === currentFilter);
    }
    
    if (filteredOrders.length === 0) {
        container.innerHTML = '<div style="padding: 40px; text-align: center; color: #666;">No orders found for this filter.</div>';
        return;
    }
    
    let ordersHTML = '';
    filteredOrders.reverse().forEach(order => {
        let itemsHTML = '';
        order.items.forEach(item => {
            itemsHTML += `<div>${item.name} x${item.quantity} - ₱${item.price * item.quantity}</div>`;
        });
        
        ordersHTML += `
            <div class="order-card">
                <div class="order-header">
                    <div>
                        <h3>Order #${order.id}</h3>
                        <p><strong>Date:</strong> ${order.date}</p>
                        <p><strong>Customer:</strong> ${order.customer || 'Walk-in Customer'}</p>
                    </div>
                    <div>
                        <p><strong>Total: ₱${order.total}</strong></p>
                        <button class="status-btn status-${order.status}" onclick="updateOrderStatus('${order.id}', '${order.status}')">
                            ${order.status.toUpperCase()}
                        </button>
                    </div>
                </div>
                <div class="order-items">
                    <strong>Items:</strong><br>
                    ${itemsHTML}
                </div>
            </div>
        `;
    });
    
    container.innerHTML = ordersHTML;
}

function filterOrders(filter) {
    currentFilter = filter;
    
    // Update active button
    document.querySelectorAll('.filter-btn').forEach(btn => btn.classList.remove('active'));
    event.target.classList.add('active');
    
    loadOrders();
}

function updateOrderStatus(orderId, currentStatus) {
    const orders = JSON.parse(localStorage.getItem('kokobap_orders') || '[]');
    const orderIndex = orders.findIndex(order => order.id === orderId);
    
    if (orderIndex === -1) return;
    
    // Cycle through statuses
    const statuses = ['pending', 'completed', 'cancelled'];
    const currentIndex = statuses.indexOf(currentStatus);
    const nextStatus = statuses[(currentIndex + 1) % statuses.length];
    
    orders[orderIndex].status = nextStatus;
    localStorage.setItem('kokobap_orders', JSON.stringify(orders));
    
    loadOrders();
}

// Load orders when page loads
document.addEventListener('DOMContentLoaded', loadOrders);
</script>

</body>
</html>
