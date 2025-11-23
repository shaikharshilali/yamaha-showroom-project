<?php
// authenticate.php
require 'includes/db.php';
require 'includes/csrf.php';
session_start();
verify_csrf();

$email = $_POST['email'] ?? '';
$pass = $_POST['password'] ?? '';

$stmt = $pdo->prepare("SELECT id, password, name FROM users WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch();
if ($user && password_verify($pass, $user['password'])) {
    // set session
    session_regenerate_id(true);
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_name'] = $user['name'];
    header('Location: dashboard.php');
    exit;
}
header('Location: login.php?error=' . urlencode('Invalid credentials'));
exit;
