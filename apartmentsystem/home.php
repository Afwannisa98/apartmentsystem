<!DOCTYPE html>
<html>
<head>
    <title>Simple Main Page</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
    <div class="sidebar">
        <ul>
            <li><a href="home.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="#">Contact</a></li>
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
            <img src="thumb-1920-365706.jpg" width="1920" height="1200" alt=""/>
        </div>
        <!-- Rest of your main content goes here -->
    </div>
</div>
</body>
</html>
