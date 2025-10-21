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
    <title>My Account - Kokobap</title>
    <link rel="stylesheet" href="assets/css/custom.css">
    <style>
        .account-container {
            max-width: 800px;
            margin: 40px auto;
            padding: 20px;
        }
        
        .account-header {
            background: linear-gradient(135deg, #d44521, #a83218);
            color: white;
            padding: 30px;
            border-radius: 10px;
            text-align: center;
            margin-bottom: 30px;
        }
        
        .account-header h1 {
            margin: 0 0 10px 0;
            font-size: 2rem;
        }
        
        .info-section {
            background: white;
            padding: 25px;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .info-section h2 {
            color: #d44521;
            margin-top: 0;
            border-bottom: 2px solid #f0f0f0;
            padding-bottom: 10px;
        }
        
        .info-row {
            display: flex;
            padding: 15px 0;
            border-bottom: 1px solid #f0f0f0;
        }
        
        .info-row:last-child {
            border-bottom: none;
        }
        
        .info-label {
            font-weight: 600;
            color: #555;
            width: 180px;
            flex-shrink: 0;
        }
        
        .info-value {
            color: #333;
            flex-grow: 1;
        }
        
        .method-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 4px;
            font-size: 0.9em;
            font-weight: 600;
        }
        
        .method-post {
            background: #28a745;
            color: white;
        }
        
        .method-get {
            background: #ffc107;
            color: #333;
        }
        
        .info-box {
            background: #f8f9fa;
            border-left: 4px solid #d44521;
            padding: 15px;
            margin-top: 20px;
            border-radius: 4px;
        }
        
        .info-box h3 {
            margin-top: 0;
            color: #d44521;
            font-size: 1.1rem;
        }
        
        .info-box p {
            margin: 5px 0;
            font-size: 0.95rem;
            line-height: 1.6;
        }
        
        @media (max-width: 768px) {
            .account-container {
                padding: 15px;
            }
            
            .account-header h1 {
                font-size: 1.5rem;
            }
            
            .info-row {
                flex-direction: column;
            }
            
            .info-label {
                width: 100%;
                margin-bottom: 5px;
            }
        }
    </style>
</head>
<body>

<?php include 'visuals/nav_user.php'; ?>

<main class="account-container">
    <div class="account-header">
        <h1>My Account</h1>
        <p>Your personal information and login details</p>
    </div>
    
    <div class="info-section">
        <h2>Account Information</h2>
        
        <div class="info-row">
            <div class="info-label">Username:</div>
            <div class="info-value"><?php echo htmlspecialchars($_SESSION['customer_username']); ?></div>
        </div>
        
        <div class="info-row">
            <div class="info-label">Password:</div>
            <div class="info-value"><?php echo htmlspecialchars($_SESSION['customer_password']); ?></div>
        </div>
        
        <div class="info-row">
            <div class="info-label">Customer ID:</div>
            <div class="info-value"><?php echo htmlspecialchars($_SESSION['customer_id']); ?></div>
        </div>
        
        <div class="info-row">
            <div class="info-label">Login Time:</div>
            <div class="info-value"><?php echo htmlspecialchars($_SESSION['login_time']); ?></div>
        </div>
        
        <div class="info-row">
            <div class="info-label">Login Method Used:</div>
            <div class="info-value">
                <span class="method-badge <?php echo $_SESSION['login_method'] == 'POST' ? 'method-post' : 'method-get'; ?>">
                    <?php echo htmlspecialchars($_SESSION['login_method']); ?>
                </span>
            </div>
        </div>
    </div>
    
    <div class="info-section">
        <h2>Understanding HTTP Methods</h2>
        
        <div class="info-box">
            <h3>📨 POST Method (Used by Login Form)</h3>
            <p><strong>How it works:</strong> Data is sent in the request body, not visible in the URL</p>
            <p><strong>Security:</strong> More secure - credentials hidden from browser history</p>
            <p><strong>PHP Variable:</strong> <code>$_POST['username']</code></p>
        </div>
        
        <div class="info-box">
            <h3>🔗 GET Method</h3>
            <p><strong>How it works:</strong> Data is sent in the URL as query parameters</p>
            <p><strong>Security:</strong> Less secure - data visible in URL and browser history</p>
            <p><strong>PHP Variable:</strong> <code>$_GET['username']</code></p>
            <p><strong>Example:</strong> login.php?username=John&password=123</p>
        </div>
        
        <div class="info-box">
            <h3>🔄 $_REQUEST Variable (Used in This App)</h3>
            <p><strong>What it does:</strong> Catches data from both POST and GET methods</p>
            <p><strong>Your login used:</strong> <?php echo $_SESSION['login_method']; ?> method</p>
            <p><strong>PHP Code:</strong> <code>$username = $_REQUEST['username'];</code></p>
        </div>
    </div>
</main>

<?php include 'visuals/footer.php'; ?>

</body>
</html>