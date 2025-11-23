<?php
// login.php
require 'includes/db.php';
require 'includes/auth.php';
require 'includes/csrf.php';

if (is_logged_in()) {
    header('Location: dashboard.php');
    exit;
}
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Admin Login - Yamaha Showroom</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container">
    <div class="row justify-content-center py-5">
      <div class="col-md-5">
        <div class="card shadow-sm">
          <div class="card-body">
            <h4 class="card-title mb-4">Admin Login</h4>
            <?php if(!empty($_GET['error'])): ?>
              <div class="alert alert-danger"><?=htmlspecialchars($_GET['error'])?></div>
            <?php endif; ?>
            <form method="post" action="authenticate.php">
              <?= csrf_input() ?>
              <div class="mb-3">
                <label class="form-label">Email</label>
                <input name="email" class="form-control" required />
              </div>
              <div class="mb-3">
                <label class="form-label">Password</label>
                <input name="password" type="password" class="form-control" required />
              </div>
              <button class="btn btn-primary w-100">Login</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>

