<?php
include 'auth.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yamaha Showroom - Admin Panel</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <div class="logo">Yamaha Showroom Admin</div>
        <div class="user-info">
            <span>Welcome, <?= htmlspecialchars($_SESSION['user_name']) ?></span>
            <a href="logout.php">Logout</a>
        </div>
    </header>
    
    <div class="sidebar">
        <ul class="sidebar-menu">
            <li <?= basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'class="active"' : '' ?>>
                <a href="dashboard.php">Dashboard</a>
            </li>
            <li <?= strpos($_SERVER['PHP_SELF'], 'products/') !== false ?  'class="active"' : '' ?>>
                <a href="products/">Products</a>
            </li>
            <li <?= strpos($_SERVER['PHP_SELF'], 'orders/') !== false ? 'class="active"' : '' ?>>
                <a href="orders/">Orders</a>
            </li>
            <li <?= strpos($_SERVER['PHP_SELF'], 'contacts/') !== false ? 'class="active"' : '' ?>>
                <a href="contacts/">Contacts</a>
            </li>
            <li <?= strpos($_SERVER['PHP_SELF'], 'users/') !== false ? 'class="active"' : '' ?>>
                <a href="users/">Users</a>
            </li>
        </ul>
		
    </div>
    
    <div class="main-content">