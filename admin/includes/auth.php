<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Redirect to login if not authenticated
if (!isset($_SESSION['user_id']) && basename($_SERVER['PHP_SELF']) != 'login.php') {
    header("Location: login.php");
    exit();
}

// Check if user is admin
if (!function_exists('isAdmin')) {
    function isAdmin() {
        // Implement proper admin check (example):
        return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
    }
}
?>