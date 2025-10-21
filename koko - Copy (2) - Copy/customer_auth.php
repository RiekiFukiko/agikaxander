<?php
session_start();


$username = $_REQUEST['username'] ?? '';
$password = $_REQUEST['password'] ?? '';


if (!empty($username) && !empty($password)) {
    $_SESSION['customer_logged_in'] = true;
    $_SESSION['customer_username'] = $username;
    $_SESSION['customer_password'] = $password;
    $_SESSION['customer_id'] = 'CUST' . rand(100, 999);
    $_SESSION['login_time'] = date('F j, Y g:i A');
    $_SESSION['login_method'] = $_SERVER['REQUEST_METHOD'];
    
    header("Location: index_user.php"); 
    exit();
} else {
    echo "<script>
            alert('Please enter both username and password.');
            window.history.back();
          </script>";
    exit();
}
?>