<?php
// includes/csrf.php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

function csrf_input() {
    $t = htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8');
    return "<input type='hidden' name='csrf_token' value='{$t}'>";
}

function verify_csrf() {
    if (
        empty($_POST['csrf_token']) ||
        !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])
    ) {
        die("CSRF validation failed.");
    }
}
