<?php
require 'includes/db.php';
require 'includes/auth.php';
require_login();

$users = $pdo->query("SELECT id,name,email,creates_at FROM users ORDER BY creates_at DESC")->fetchAll();
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Users</title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"></head>
<body>
<?php include 'nav.php'; ?>
<div class="container py-4">
  <h2>Users</h2>
  <table class="table">
    <thead><tr><th>ID</th><th>Name</th><th>Email</th><th>Created</th></tr></thead>
    <tbody>
      <?php foreach($users as $u): ?>
      <tr>
        <td><?= $u['id'] ?></td>
        <td><?= htmlspecialchars($u['name']) ?></td>
        <td><?= htmlspecialchars($u['email']) ?></td>
        <td><?= $u['creates_at'] ?></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
</body>
</html>
