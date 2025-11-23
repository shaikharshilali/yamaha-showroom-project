<?php
require 'includes/db.php';
require 'includes/auth.php';
require_login();

// fetch counts
$counts = [];
foreach (['products','orders','contacts','users'] as $t) {
    $c = $pdo->query("SELECT COUNT(*) as c FROM {$t}")->fetchColumn();
    $counts[$t] = (int)$c;
}
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Admin Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include 'nav.php'; ?>
<div class="container py-4">
  <h1>Dashboard</h1>
  <div class="row mt-4">
    <div class="col-md-3">
      <div class="card p-3">
        <h5>Products</h5>
        <h2><?= $counts['products'] ?></h2>
        <a href="products.php">Manage</a>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card p-3">
        <h5>Orders</h5>
        <h2><?= $counts['orders'] ?></h2>
        <a href="orders.php">View</a>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card p-3">
        <h5>Contacts</h5>
        <h2><?= $counts['contacts'] ?></h2>
        <a href="contacts.php">Messages</a>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card p-3">
        <h5>Users</h5>
        <h2><?= $counts['users'] ?></h2>
        <a href="users.php">View</a>
      </div>
    </div>
  </div>
</div>
</body>
</html>
