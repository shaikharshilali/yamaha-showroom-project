<?php
include __DIR__ . '/../includes/db_connect.php';
include __DIR__ . '/../includes/header.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id = $_GET['id'];

// First get the product to delete its image
$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch();

if ($product) {
    // Delete the image file if it exists
    if (!empty($product['image']) && file_exists("../../" . $product['image'])) {
        unlink("../../" . $product['image']);
    }
    
    // Delete the product from database
    $stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
    $stmt->execute([$id]);
}

header("Location: index.php");
exit();
?>