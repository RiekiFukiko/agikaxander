<?php
session_start();

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit();
}

$admin_name = $_SESSION['admin_name'] ?? 'Administrator';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Added viewport meta tag for mobile responsiveness -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Kokobap</title>
    <link rel="stylesheet" href="assets/css/custom.css">
    <style>
        /* Added mobile-first responsive styles */
        .admin-dashboard {
            padding: 40px 20px;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .welcome-section {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            margin-bottom: 30px;
            border: 2px solid #d44521;
        }
        
        .dashboard-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            border: 2px solid #d44521;
            text-align: center;
        }
        
        .stat-number {
            font-size: 2.5em;
            font-weight: bold;
            color: #d44521;
            margin-bottom: 10px;
        }
        
        .recent-orders {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            border: 2px solid #d44521;
        }
        
        .order-item {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            padding: 15px;
            border-bottom: 1px solid #eee;
        }
        
        .order-item:last-child {
            border-bottom: none;
        }
        
        .logout-btn {
            background: #d44521;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }
        
        .logout-btn:hover {
            background: #a83218;
        }
        
        /* Mobile responsive breakpoints */
        @media (max-width: 768px) {
            .admin-dashboard {
                padding: 20px 15px;
            }
            
            .welcome-section {
                padding: 20px;
            }
            
            .dashboard-stats {
                grid-template-columns: 1fr;
            }
            
            .stat-number {
                font-size: 2em;
            }
            
            .recent-orders {
                padding: 20px;
            }
        }
        
        @media (max-width: 480px) {
            .welcome-section h1 {
                font-size: 1.5rem;
            }
            
            .order-item {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
</head>
<body>

<?php include 'visuals/nav_admin.php'; ?>

<main class="admin-dashboard">
    <div class="welcome-section">
        <h1>Welcome back, <?php echo htmlspecialchars($admin_name); ?>!</h1>
        <p>Here's your restaurant overview for today.</p>
        <a href="index.php" class="logout-btn">Logout</a>
    </div>

    <div class="dashboard-stats">
        <div class="stat-card">
            <div class="stat-number" id="total-orders">0</div>
            <div>Total Orders Today</div>
        </div>
        <div class="stat-card">
            <div class="stat-number" id="total-revenue">₱0</div>
            <div>Today's Revenue</div>
        </div>
        <div class="stat-card">
            <div class="stat-number" id="pending-orders">0</div>
            <div>Pending Orders</div>
        </div>
    </div>

    <div class="recent-orders">
        <h2>Recent Orders</h2>
        <div id="orders-list">
            <p>No orders yet today.</p>
        </div>
    </div>
</main>

<?php include 'visuals/footer.php'; ?>

<script>
function loadDashboardData() {
    const orders = JSON.parse(localStorage.getItem('kokobap_orders') || '[]');
    
    document.getElementById('total-orders').textContent = orders.length;
    
    let totalRevenue = 0;
    let pendingCount = 0;
    
    orders.forEach(order => {
        totalRevenue += order.total;
        if (order.status === 'pending') pendingCount++;
    });
    
    document.getElementById('total-revenue').textContent = '₱' + totalRevenue;
    document.getElementById('pending-orders').textContent = pendingCount;
    
    const ordersList = document.getElementById('orders-list');
    if (orders.length === 0) {
        ordersList.innerHTML = '<p>No orders yet today.</p>';
        return;
    }
    
    let ordersHTML = '';
    orders.slice(-5).reverse().forEach(order => {
        const statusColor = order.status === 'pending' ? '#d44521' : '#28a745';
        ordersHTML += `
            <div class="order-item">
                <div>
                    <strong>Order #${order.id}</strong><br>
                    <small>${order.date}</small>
                </div>
                <div>₱${order.total}</div>
                <div style="color: ${statusColor}; font-weight: bold;">
                    ${order.status.toUpperCase()}
                </div>
            </div>
        `;
    });
    
    ordersList.innerHTML = ordersHTML;
}

document.addEventListener('DOMContentLoaded', loadDashboardData);

setInterval(loadDashboardData, 30000);
</script>

</body>
</html>
