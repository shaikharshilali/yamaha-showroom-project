<?php
require 'includes/db.php';
require 'includes/auth.php';
require 'includes/csrf.php';
require_login();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    verify_csrf();
    $stmt = $pdo->prepare("DELETE FROM contacts WHERE id = ?");
    $stmt->execute([(int)$_POST['delete_id']]);
    header('Location: contacts.php');
    exit;
}

$messages = $pdo->query("SELECT * FROM contacts ORDER BY submission DESC")->fetchAll();
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Contacts</title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"></head>
<body>
<?php include 'nav.php'; ?>
<div class="container py-4">
  <h2>Contact Messages</h2>
  <table class="table">
    <thead><tr><th>ID</th><th>Name</th><th>Email</th><th>Message</th><th>Submitted</th><th>Action</th></tr></thead>
    <tbody>
      <?php foreach($messages as $m): ?>
        <tr>
          <td><?= $m['id'] ?></td>
          <td><?= htmlspecialchars($m['name']) ?></td>
          <td><?= htmlspecialchars($m['email']) ?></td>
          <td><?= htmlspecialchars($m['message']) ?></td>
          <td><?= $m['submission'] ?></td>
          <td>
            <form method="post" onsubmit="return confirm('Delete message?')">
              <?= csrf_input() ?>
              <input type="hidden" name="delete_id" value="<?= $m['id'] ?>">
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
