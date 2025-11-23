<?php
include '../includes/header.php';
include __DIR__ . '/../includes/db_connect.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id = $_GET['id'];

// Prevent deleting the admin user (ID 4 in your sample data)
if ($id == 4) {
    $_SESSION['error'] = "Cannot delete the main admin account";
    header("Location: index.php");
    exit();
}

$stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
$stmt->execute([$id]);

header("Location: index.php");
exit();
?>