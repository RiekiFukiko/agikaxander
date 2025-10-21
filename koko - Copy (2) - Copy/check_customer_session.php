<?php

require_once 'config.php';

header('Content-Type: application/json');

echo json_encode([
    'logged_in' => is_customer_logged_in(),
    'customer_id' => $_SESSION['customer_id'] ?? null,
    'customer_username' => $_SESSION['customer_username'] ?? null
]);
?>
