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
        <!-- Rest of your main content goes here -->
    </div>
</div>
</body>
</html>


