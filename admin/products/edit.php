<?php
include __DIR__ . '/../includes/db_connect.php';
include __DIR__ . '/../includes/header.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch();

if (!$product) {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $image = $product['image']; // Keep old image by default
    
    // Handle file upload if new image is provided
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $target_dir = "../../image/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            // Generate unique filename
            $new_filename = uniqid() . '.' . $imageFileType;
            $target_file = $target_dir . $new_filename;
            
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                // Delete old image if it exists
                if (!empty($product['image']) && file_exists("../../" . $product['image'])) {
                    unlink("../../" . $product['image']);
                }
                $image = 'image/' . $new_filename;
            }
        }
    }
    
    $stmt = $pdo->prepare("UPDATE products SET name = ?, image = ?, price = ? WHERE id = ?");
    $stmt->execute([$name, $image, $price, $id]);
    
    header("Location: index.php");
    exit();
}
?>

<div class="container">
    <h1>Edit Product</h1>
    
    <form method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Product Name</label>
            <input type="text" id="name" name="name" value="<?= htmlspecialchars($product['name']) ?>" required>
        </div>
        
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" id="price" name="price" step="0.01" value="<?= htmlspecialchars($product['price']) ?>" required>
        </div>
        
        <div class="form-group">
            <label for="image">Product Image</label>
            <?php if (!empty($product['image'])): ?>
                <img src="../../<?= $product['image'] ?>" alt="Current Image" width="150" style="display: block; margin-bottom: 10px;">
            <?php endif; ?>
            <input type="file" id="image" name="image" accept="image/*">
            <small>Leave blank to keep current image</small>
        </div>
        
        <button type="submit" class="btn">Update Product</button>
        <a href="index.php" class="btn btn-delete">Cancel</a>
    </form>
</div>

<?php
include '../includes/footer.php';
?>