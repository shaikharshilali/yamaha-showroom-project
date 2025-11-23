<?php
include __DIR__ . '/../includes/db_connect.php';
include __DIR__ . '/../includes/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    
    // Handle file upload
    $image = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $target_dir = "../../image/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        
        // Check if image file is a actual image
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            // Generate unique filename
            $new_filename = uniqid() . '.' . $imageFileType;
            $target_file = $target_dir . $new_filename;
            
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $image = 'image/' . $new_filename;
            }
        }
    }
    
    $stmt = $pdo->prepare("INSERT INTO products (name, image, price) VALUES (?, ?, ?)");
    $stmt->execute([$name, $image, $price]);
    
    header("Location: index.php");
    exit();
}
?>
<link rel="stylesheet" href="css/style.css">
<div class="container">
    <h1>Add New Product</h1>
    
    <form method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Product Name</label>
            <input type="text" id="name" name="name" required>
        </div>
        
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" id="price" name="price" step="0.01" required>
        </div>
        
        <div class="form-group">
            <label for="image">Product Image</label>
            <input type="file" id="image" name="image" accept="image/*">
        </div>
        
        <button type="submit" class="btn">Add Product</button>
        <a href="index.php" class="btn btn-delete">Cancel</a>
    </form>
</div>
