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
    <title>Kokobap - Customer Dashboard</title>
    <link rel="stylesheet" href="assets/css/custom.css">
    <style>
        .customer-dashboard {
            padding: 40px 20px;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .welcome-section {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            margin-bottom: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            text-align: center;
        }
        
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }
        
        .dashboard-card {
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            text-align: center;
        }
        
        .dashboard-card h3 {
            color: #d44521;
            margin-bottom: 15px;
        }
        
        .btn-primary {
            background: #d44521;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 6px;
            text-decoration: none;
            display: inline-block;
            margin: 10px;
            transition: background 0.3s;
        }
        
        .btn-primary:hover {
            background: #a83218;
        }
        
        /* Mobile responsive breakpoints */
        @media (max-width: 768px) {
            .customer-dashboard {
                padding: 20px 15px;
            }
            
            .welcome-section {
                padding: 20px;
            }
            
            .dashboard-grid {
                grid-template-columns: 1fr;
            }
        }
        
        @media (max-width: 480px) {
            .welcome-section h1 {
                font-size: 1.5rem;
            }
            
            .dashboard-card {
                padding: 20px;
            }
        }
    </style>
</head>
<body>

<?php include 'visuals/nav_user.php'; ?>

<main class="customer-dashboard">
    <div class="welcome-section">
        <h1>Welcome, <?php echo htmlspecialchars($_SESSION['customer_username']); ?>!</h1>
        <p>Enjoy authentic Korean cuisine from Kokobap</p>
    </div>

    <div class="dashboard-grid">
        <div class="dashboard-card">
            <h3>Browse Menu</h3>
            <p>Explore our delicious Korean dishes</p>
            <a href="shop.php" class="btn-primary">Shop Now</a>
        </div>
        
        <div class="dashboard-card">
            <h3>My Orders</h3>
            <p>View your order history and status</p>
            <a href="customer_orders.php" class="btn-primary">View Orders</a>
        </div>
        
        <div class="dashboard-card">
            <h3>Shopping Cart</h3>
            <p>Review items in your cart</p>
            <a href="cart.php" class="btn-primary">View Cart</a>
        </div>
    </div>
</main>

<?php include 'visuals/footer.php'; ?>

</body>
</html>
