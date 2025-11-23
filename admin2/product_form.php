<?php
require 'includes/db.php';
require 'includes/auth.php';
require 'includes/csrf.php';
require_login();

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$product = null;
if ($id) {
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->execute([$id]);
    $product = $stmt->fetch();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $name = $_POST['name'] ?? '';
    $image = $_POST['image'] ?? 'image/default.png';
    $price = $_POST['price'] ?? 0;

    if (!empty($_POST['id'])) {
        $stmt = $pdo->prepare("UPDATE products SET name=?, image=?, price=? WHERE id=?");
        $stmt->execute([$name, $image, $price, (int)$_POST['id']]);
    } else {
        $stmt = $pdo->prepare("INSERT INTO products (name,image,price) VALUES (?,?,?)");
        $stmt->execute([$name, $image, $price]);
    }
    header('Location: products.php');
    exit;
}
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title><?= $product ? 'Edit' : 'Add' ?> Product</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include 'nav.php'; ?>
<div class="container py-4">
  <h2><?= $product ? 'Edit' : 'Add' ?> Product</h2>
  <form method="post">
    <?= csrf_input() ?>
    <input type="hidden" name="id" value="<?= $product['id'] ?? '' ?>">
    <div class="mb-3">
      <label class="form-label">Name</label>
      <input name="name" class="form-control" value="<?= htmlspecialchars($product['name'] ?? '') ?>" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Image path (relative)</label>
      <input name="image" class="form-control" value="<?= htmlspecialchars($product['image'] ?? '') ?>">
    </div>
    <div class="mb-3">
      <label class="form-label">Price</label>
      <input name="price" type="number" step="0.01" class="form-control" value="<?= htmlspecialchars($product['price'] ?? '') ?>" required>
    </div>
    <button class="btn btn-primary"><?= $product ? 'Update' : 'Create' ?></button>
    <a class="btn btn-secondary" href="products.php">Cancel</a>
  </form>
</div>
</body>
</html>
