<?php

require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    alert_and_redirect('Invalid request method.', 'register.php');
}

$fname     = sanitize_input($_POST['fname'] ?? '');
$lname     = sanitize_input($_POST['lname'] ?? '');
$email     = sanitize_input($_POST['email'] ?? '');
$phone     = sanitize_input($_POST['phone'] ?? '');
$dob       = sanitize_input($_POST['dob'] ?? '');
$referral  = sanitize_input($_POST['referral'] ?? '');
$password  = $_POST['password'] ?? ''; 

$errors = [];

if (empty($fname)) {
    $errors[] = 'First name is required.';
}

if (empty($lname)) {
    $errors[] = 'Last name is required.';
}

if (empty($email)) {
    $errors[] = 'Email is required.';
} elseif (!validate_email($email)) {
    $errors[] = 'Invalid email format.';
}

if (empty($phone)) {
    $errors[] = 'Phone number is required.';
}

if (empty($dob)) {
    $errors[] = 'Date of birth is required.';
}

if (empty($password)) {
    $errors[] = 'Password is required.';
} elseif (strlen($password) < 8) {
    $errors[] = 'Password must be at least 8 characters long.';
}

if (!empty($errors)) {
    $error_message = implode('\n', $errors);
    alert_and_back($error_message);
}


alert_and_redirect('Thank you for registering! You can now log in.', 'customer_login.php');
?>
