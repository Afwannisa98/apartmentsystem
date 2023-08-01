<!DOCTYPE html>
<html>
<head>
    <title>Register New Apartment Block</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .container {
            display: flex;
        }

        .sidebar {
            width: 200px;
            background-color: #f1f1f1;
            padding: 20px;
        }

        .main-content {
            flex: 1;
            padding: 20px;
        }

        .form-container {
            max-width: 400px;
            margin: 0 auto;
            background-color: #6B6767; /* Set the form container color to a darker shade */
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            color: black; /* Set the text color to black */
        }

        .form-container h2 {
            margin-top: 0;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-group input[type="text"] {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-group input[type="submit"] {
            padding: 10px 20px;
            background-color: black;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .form-group input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="sidebar">
        <ul>
            <li><a href="block.php">Block</a></li>
            <li><a href="#">Apartment</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
    <div class="main-content">
        <div class="form-container">
            <h2>Register New Apartment Block</h2>
            <?php
            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                // Replace with your database connection details
              include 'db_connection.php';

                // Get form data
                $block = $_POST["block"];
                $name = $_POST["name"];

                // Insert the new apartment block into the "block" table
                $sql = "INSERT INTO block (block, name) VALUES ('$block', '$name')";

                if ($conn->query($sql) === true) {
                   	
				// Close the database connection
				$conn->close();

        	// Redirect back to "block.php" after successful registration with a query parameter
        		header("Location: block.php?status=success");
        		exit();
					
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }

                // Close the database connection
                $conn->close();
            }
            ?>

            <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                <div class="form-group">
                    <label for="block">Block:</label>
                    <input type="text" id="block" name="block" required>
                </div>
				
				
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <input type="submit" value="Register">
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
