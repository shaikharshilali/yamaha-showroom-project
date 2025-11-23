<?php
// nav.php
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="dashboard.php">Yamaha Admin</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link" href="products.php">Products</a></li>
        <li class="nav-item"><a class="nav-link" href="orders.php">Orders</a></li>
        <li class="nav-item"><a class="nav-link" href="contacts.php">Contacts</a></li>
        <li class="nav-item"><a class="nav-link" href="users.php">Users</a></li>
      </ul>
      <div class="d-flex">
        <span class="navbar-text text-white me-3"><?=htmlspecialchars($_SESSION['user_name'] ?? '')?></span>
        <a class="btn btn-outline-light btn-sm" href="logout.php">Logout</a>
      </div>
    </div>
  </div>
</nav>
