<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Yamaha Showroom</title>
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

    <section class="contact-form">
        <h1>Contact Us</h1>
        <form action="submit_contact.php" method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="message">Message:</label>
            <textarea id="message" name="message" rows="5" required></textarea>

            <button type="submit">Submit</button>
        </form>
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