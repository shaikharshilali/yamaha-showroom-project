<?php
require 'includes/db.php';
require 'includes/auth.php';
require 'includes/csrf.php';
require_login();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    verify_csrf();
    $id = (int)$_POST['delete_id'];
    $stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
    $stmt->execute([$id]);
    header('Location: products.php');
    exit;
}

$products = $pdo->query("SELECT * FROM products ORDER BY id DESC")->fetchAll();
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Products</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include 'nav.php'; ?>
<div class="container py-4">
  <div class="d-flex justify-content-between align-items-center">
    <h2>Products</h2>
    <a class="btn btn-success" href="product_form.php">Add Product</a>
  </div>
  <table class="table table-striped mt-3">
    <thead><tr><th>ID</th><th>Name</th><th>Image</th><th>Price</th><th>Actions</th></tr></thead>
    <tbody>
      <?php foreach($products as $p): ?>
        <tr>
          <td><?= $p['id'] ?></td>
          <td><?= htmlspecialchars($p['name']) ?></td>
          <td><img src="<?= htmlspecialchars($p['image']) ?>" style="height:40px" alt=""></td>
          <td><?= number_format($p['price'],2) ?></td>
          <td>
            <a class="btn btn-sm btn-primary" href="product_form.php?id=<?= $p['id'] ?>">Edit</a>
            <form method="post" style="display:inline-block" onsubmit="return confirm('Delete this product?')">
              <?= csrf_input() ?>
              <input type="hidden" name="delete_id" value="<?= $p['id'] ?>">
              <button class="btn btn-sm btn-danger">Delete</button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
</body>
</html>
