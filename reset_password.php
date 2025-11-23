<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "yamaha showroom";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $new_password = $_POST['password'];
    $confirm_password = $_POST['confirmpassword'];

    // Validate passwords match
    if ($new_password !== $confirm_password) {
        echo "Passwords do not match.";
        exit;
    }

    // Hash the new password
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    // Update the password in the database
    $stmt = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
    $stmt->bind_param("ss", $hashed_password, $email);

    if ($stmt->execute()) {
        echo "Password updated successfully.";
		echo '<a href="index.php">Go Back to Home Page</a>';
    } else {
        echo "Error updating password: " . $stmt->error;
		echo '<a href="index.php">Go Back to Home Page</a>';
    }

    $stmt->close();
}

$conn->close();
?>