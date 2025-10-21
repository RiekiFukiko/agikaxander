<?php

require_once 'config.php';

if (!is_admin_logged_in()) {
    alert_and_redirect('Please log in as admin to access this page.', 'admin_login.php');
}
?>
