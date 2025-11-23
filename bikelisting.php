<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bikelisting - Yamaha_Showroom</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <div class="logo">
           <a href="index.php" onclick="window.location.reload(true);">
		   <img src="image/yamaha logo.png" alt="Yamaha Logo">
		   </a> 
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
				<li><a href="bikelisting.php">Bikelisting</a></li>
				<li><a href="about.php">About</a></li>
                <li><a href="contact.php">Contact</a></li>
				<li><a href="login.php">Login</a></li>
				<li><a href="register.php">Register</a></li>
            </ul>
        </nav>
    </header>

    <section class="bikes">
        <h1>Yamaha Bikes</h1>
        <div class="bike-list">
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

				// Fetch products from database
				$sql = "SELECT id, name, image, price FROM products";
				$result = $conn->query($sql);

				// Check if the query was successful
				if ($result === false) {
					die("Error executing query: " . $conn->error);
				}

				// Check if there are any rows returned
				if ($result->num_rows > 0) {
					// Output data of each row
					while ($row = $result->fetch_assoc()) {
						echo "<div class='product'>";
						echo "<img src='{$row['image']}' alt='{$row['name']}'>";
						echo "<h2>{$row['name']}</h2>";
						echo "<p>$" . number_format($row['price'], 2) . "</p>";

						// Add a form for placing orders
						echo "<form action='place_order.php' method='post'>";
						echo "<input type='hidden' name='product_id' value='{$row['id']}'>";
						echo "<input type='text' name='customer_name' placeholder='Your Name' required>";
						echo "<input type='email' name='customer_email' placeholder='Your Email' required>";
						echo "<input type='number' name='buying' placeholder='buying' required>";
						echo "<button type='submit'>Buy Now</button>";
						echo "</form>";

						echo "</div>";
					}
				} else {
					echo "0 results";
				}

				// Close connection
				$conn->close();
				?>
    </section>
    <footer class="footerBefore wb-footer  wb-footer theme-dark-color-11  " style="background-color:black;"><div class="container boxWidget">
        <div class="footer-content">
            <div class="footer-section about">
                <h3 style="color: white;">About Us</h3>
                <p>Yamaha Showroom is dedicated to providing the best motorcycles and services to our customers. Experience the thrill of riding with Yamaha.</p>
            </div>
            <div class="footer-section links">
                <h3 style="color: white;">Quick Links</h3>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="bikelisting.php">Bikelisting</a></li>
                    <li><a href="about.php">About</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
            </div>
            <div class="footer-section contact">
                <h3 style="color: white;">Contact Us</h3>
                <p>Email: info@yamahashowroom.com</p>
                <p>Phone: +123 456 7890</p>
                <p>Address: 123 Yamaha Street, Motor City</p>
            </div>
        </div>
		<div class="social-icons">
			<a href="https://www.facebook.com/YourPage" target="_blank">
			<img src="image/facebook-icon.png" alt="Facebook">
			</a>
			<a href="https://www.instagram.com/YourProfile" target="_blank">
			<img src="image/instagram-icon.png" alt="Instagram">
			</a>
			<a href="https://www.twitter.com/YourHandle" target="_blank">
			<img src="image/twitter-icon.png" alt="Twitter">
			</a>
		</div>
        <div class="footer-bottom">
            <p>&copy; 2024 Yamaha Showroom. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>