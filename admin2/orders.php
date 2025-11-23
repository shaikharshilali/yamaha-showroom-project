<?php
require 'includes/db.php';
require 'includes/auth.php';
require_login();

$orders = $pdo->query("SELECT o.*, p.name as product_name FROM orders o LEFT JOIN products p ON o.product_id=p.id ORDER BY o.order_date DESC")->fetchAll();
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Orders</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include 'nav.php'; ?>
<div class="container py-4">
  <h2>Orders</h2>
  <table class="table">
    <thead><tr><th>ID</th><th>Product</th><th>Customer</th><th>Email</th><th>Qty</th><th>Date</th></tr></thead>
    <tbody>
    <?php foreach($orders as $o): ?>
      <tr>
        <td><?= $o['id'] ?></td>
        <td><?= htmlspecialchars($o['product_name']) ?></td>
        <td><?= htmlspecialchars($o['customer_name']) ?></td>
        <td><?= htmlspecialchars($o['customer_email']) ?></td>
        <td><?= htmlspecialchars($o['buying'] ?? $o['quantity'] ?? '1') ?></td>
        <td><?= $o['order_date'] ?></td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
</div>
</body>
</html>
