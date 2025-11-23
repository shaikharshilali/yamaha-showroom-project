<?php
// Database connection
$servername = "localhost";
$username = "root"; // Replace with your MySQL username
$password = ""; // Replace with your MySQL password
$dbname = "yamaha showroom"; // Ensure no spaces in the database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

// Prepare the SQL statement
$sql = "INSERT INTO contacts (name, email, message) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);

// Check if prepare() failed
if ($stmt === false) {
    die("Error preparing statement: " . $conn->error);
}

// Bind parameters and execute
$stmt->bind_param("sss", $name, $email, $message);

if ($stmt->execute()) {
    // Success message
    echo "Thank you for contacting us!<br>";
    echo '<a href="index.php">Go Back to Home Page</a>';
} else {
    // Error message
    echo "Error: " . $stmt->error . "<br>";
    echo '<a href="index.php">Go Back to Home Page</a>';
}

// Close connection
$stmt->close();
$conn->close();
?>