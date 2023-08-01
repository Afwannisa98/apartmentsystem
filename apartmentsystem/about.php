<!DOCTYPE html>
<html>
<head>
    <title>Slideshow Main Page</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .big-picture {
            width: 100%;
            height: 500px;
            overflow: hidden;
            position: relative;
        }

        .big-picture img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            position: absolute;
            top: 0;
            left: 0;
            opacity: 0;
            transition: opacity 1s ease-in-out;
        }

        .about-us {
            padding: 20px;
            background-color: #f1f1f1;
			color: #333;
        }

        .about-us h2 {
            margin-top: 0;
			color: #0056b3;
        }
		.about-us p {
            /* Set the text color of paragraphs to black */
            color: black;
            /* You can also use other CSS properties to modify the text appearance, such as font-size, font-weight, etc. */
        }
    </style>
</head>
<body>
<div class="container">
    <div class="sidebar">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>
        <div class="login-button">
            <!-- Login form goes here -->
			<?php
            // Include the database connection file
            include 'db_connection.php';

            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
                $username = $_POST['username'];
                $password = $_POST['password'];

                // Prepare a SQL query to retrieve login information
                $stmt = $conn->prepare("SELECT * FROM admin WHERE username = ?");
                $stmt->bind_param("s", $username);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows === 1) {
                    $row = $result->fetch_assoc();
                    $storedPassword = $row['password'];
                    // Simple password verification
                    if ($password === $storedPassword) {
                        // Login successful, redirect to a blank page or perform other actions.
                        header("Location: admin.php");
                        exit();
                    } else {
                        echo "<p>Login failed. Invalid username or password.</p>";
                    }
                } else {
                    echo "<p>Login failed. Invalid username or password.</p>";
                }

                // Close the database connection
                $stmt->close();
                $conn->close();
            }
            ?>
            <form method="post" action="">
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit" name="login">Login</button>
            </form>
        </div>
    </div>
    <div class="main-content">
        <div class="big-picture">
            <img src="1.jpg" alt="" class="slide-image" />
            <img src="2.jpg" alt="" class="slide-image" />
            <img src="3.jpg" alt="" class="slide-image" />
            <!-- Add more images here -->

            <!-- Script to handle the slideshow -->
            <script>
                // Slideshow script here
				 let currentSlide = 0;
                const slideImages = document.querySelectorAll('.slide-image');

                function showSlide(slideIndex) {
                    // Hide all images
                    slideImages.forEach(image => (image.style.opacity = 0));

                    // Display the current slide
                    slideImages[slideIndex].style.opacity = 1;
                }

                function nextSlide() {
                    currentSlide = (currentSlide + 1) % slideImages.length;
                    showSlide(currentSlide);
                }

                // Start the slideshow and change slide every 3 seconds
                setInterval(nextSlide, 3000);
            
            </script>
        </div>

        <div class="about-us">
            <h2>About Us</h2>
            <p>Welcome to our Apartment Management System!</p>
            <p>We strive to provide the best services for our residents, making sure they have a comfortable and enjoyable living experience. Our team is dedicated to maintaining the apartment buildings, keeping them in excellent condition, and promptly addressing any issues that may arise.</p>
            <p>Our goal is to create a safe and friendly community where our residents feel at home. We prioritize effective communication, transparency, and responsiveness to ensure that everyone's needs are met.</p>
            <p>Thank you for choosing us as your apartment management team. If you have any questions or concerns, feel free to reach out to us. We look forward to serving you!</p>
        </div>
    </div>
</div>
</body>
</html>
