<?php
/**
 * KOKOBAP - Educational PHP Project
 * Configuration File
 * 
 * DISCLAIMER: This project is for educational purposes only.
 * It demonstrates fundamental PHP and web development concepts
 * for a BSIT 2nd-year student project. Not intended for production use.
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Define constants for the application
define('SITE_NAME', 'Kokobap');
define('DELIVERY_FEE', 50);

// Simple user credentials (In real applications, use database with hashed passwords)
define('ADMIN_USERNAME', 'admin');
define('ADMIN_PASSWORD', 'admin'); // In production, this should be hashed

define('DEMO_CUSTOMER_USERNAME', 'User');
define('DEMO_CUSTOMER_PASSWORD', '123'); // In production, this should be hashed
define('DEMO_CUSTOMER_ID', 'CUST001');

/**
 * Sanitize user input to prevent XSS attacks
 * This is a basic security measure for educational purposes
 */
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    return $data;
}

/**
 * Escape HTML output to prevent XSS
 */
function escapeHtml($text) {
    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}

/**
 * Validate email format
 */
function validate_email($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

/**
 * Check if user is logged in as admin
 */
function is_admin_logged_in() {
    return isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
}

/**
 * Check if user is logged in as customer
 */
function is_customer_logged_in() {
    return isset($_SESSION['customer_logged_in']) && $_SESSION['customer_logged_in'] === true;
}

/**
 * Redirect to a specific page
 */
function redirect($page) {
    header("Location: $page");
    exit();
}

/**
 * Display alert and redirect
 */
function alert_and_redirect($message, $page) {
    echo "<script>
            alert('" . addslashes($message) . "');
            window.location.href = '$page';
          </script>";
    exit();
}

/**
 * Display alert and go back
 */
function alert_and_back($message) {
    echo "<script>
            alert('" . addslashes($message) . "');
            window.history.back();
          </script>";
    exit();
}

define('CONFIG_LOADED', true);
?>
