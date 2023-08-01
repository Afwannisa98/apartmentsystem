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
            <li><a href="apartment.php">Apartment</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
    <div class="main-content">
        <div class="form-container">
            <h2>Register New Apartment Block</h2>
            <?php
            // Replace with your database connection details
            include 'db_connection.php';

            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                $id = $_POST["id"];
                $block = $_POST["block"];
                $name = $_POST["name"];

                // Update the apartment block in the "block" table
                $sql = "UPDATE block SET block='$block', name='$name' WHERE id='$id'";

                if ($conn->query($sql) === true) {
                    // Redirect back to "block.php" after successful update with a query parameter
                    header("Location: block.php?status=updated");
                    exit();
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }

            // Check if the "id" parameter is set in the URL
            if (isset($_GET["id"])) {
                $id = $_GET["id"];

                // Fetch the apartment block data from the "block" table
                $sql = "SELECT block, name FROM block WHERE id='$id'";
                $result = $conn->query($sql);

                if ($result->num_rows === 1) {
                    $row = $result->fetch_assoc();
                    $block = $row["block"];
                    $name = $row["name"];
                } else {
                    // No apartment block found with the given ID
                    echo "<p>Apartment block not found.</p>";
                    $conn->close();
                    exit();
                }
            } else {
                // No "id" parameter provided in the URL
                echo "<p>Invalid request.</p>";
                $conn->close();
                exit();
            }

            $conn->close();
            ?>

            <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
				<input type="hidden" name="id" value="<?php echo $id; ?>">
                <div class="form-group">
                    <label for="block">Block:</label>
                    <input type="text" id="block" name="block" value="<?php echo $block; ?>" required>
                </div>
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" value="<?php echo $name; ?>" required>
                </div>
                <div class="form-group">
                    <input type="submit" value="Update">
                </div>
            </form>
        </div>
    </div>
</div>
</body>