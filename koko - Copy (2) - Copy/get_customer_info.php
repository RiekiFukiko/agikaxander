<?php
session_start();
header('Content-Type: application/json');

if (isset($_SESSION['customer_logged_in']) && $_SESSION['customer_logged_in'] === true) {
    echo json_encode([
        'id' => $_SESSION['customer_id'],
        'name' => $_SESSION['customer_username']
    ]);
} else {
    http_response_code(401);
    echo json_encode(['error' => 'Not authenticated']);
}
?>
