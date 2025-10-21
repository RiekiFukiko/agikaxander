<?php

require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    alert_and_redirect('Invalid request method.', 'admin_login.php');
}

$username = sanitize_input($_POST['username'] ?? '');
$password = sanitize_input($_POST['password'] ?? '');

if (empty($username) || empty($password)) {
    alert_and_back('Please fill in all fields.');
}

if ($username === ADMIN_USERNAME && $password === ADMIN_PASSWORD) {
    $_SESSION['admin_logged_in'] = true;
    $_SESSION['admin_name'] = 'Administrator';
    
    session_regenerate_id(true);
    
    redirect('index_admin.php');
} else {
    alert_and_back('Invalid username or password. Please try again.');
}
?>
