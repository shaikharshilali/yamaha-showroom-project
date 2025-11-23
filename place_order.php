<?php
// Database connection
$servername = "localhost";
$username = "root"; // default username for localhost
$password = ""; // default password for localhost
$dbname = "yamaha showroom";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Verify orders table exists, create if not
$check_table = $conn->query("SHOW TABLES LIKE 'orders'");
if ($check_table->num_rows == 0) {
    $create_table = "CREATE TABLE orders (
        id INT AUTO_INCREMENT PRIMARY KEY,
        product_id INT NOT NULL,
        customer_name VARCHAR(100) NOT NULL,
        customer_email VARCHAR(100) NOT NULL,
        buying INT NOT NULL,
        order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    
    if (!$conn->query($create_table)) {
        die("Error creating orders table: " . $conn->error);
    }
}

// Get form data
$product_id = $_POST['product_id'] ?? '';
$customer_name = $_POST['customer_name'] ?? '';
$customer_email = $_POST['customer_email'] ?? '';
$buying = $_POST['buying'] ?? '';

// Validate input
if (empty($product_id) || empty($customer_name) || empty($customer_email) || empty($buying)) {
    die("Please fill all the fields.");
}

// Validate email format
if (!filter_var($customer_email, FILTER_VALIDATE_EMAIL)) {
    die("Invalid email format.");
}

// Validate buying is numeric and positive
if (!is_numeric($buying) || $buying <= 0) {
    die("Buying must be a positive number.");
}

// Insert order into database
$sql = "INSERT INTO orders (product_id, customer_name, customer_email, buying) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Error preparing statement: " . $conn->error);
}

$stmt->bind_param("issi", $product_id, $customer_name, $customer_email, $buying);

if ($stmt->execute()) {
    echo "Order placed successfully!";
	echo '<a href="index.php">Go Back to Home Page</a>';
    // You could redirect or show order details here
    // header("Location: success.php");
} else {
    echo "Error: " . $stmt->error;
	echo '<a href="index.php">Go Back to Home Page</a>';
}

// Close connection
$stmt->close();
$conn->close();
?>