<?php
// Check if the username and password are correct (replace with your authentication logic)
$adminUsername = 'admin';
$adminPassword = 'admin123';

if ($_POST['username'] === $adminUsername && $_POST['password'] === $adminPassword) {
    // Authentication successful, redirect to admin dashboard or another page
    header('Location: ../admin/admin_dashboard.php');
    exit();
} else {
    // Authentication failed, redirect back to the login page with an error message
    header('Location: login.php?error=1');
    exit();
}
?>