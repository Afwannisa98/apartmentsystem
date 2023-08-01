<!DOCTYPE html>
<html>
<head>
    <title>Apartment Blocks</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: black;
        }

        .center {
            text-align: center;
        }

        .register-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: black;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-bottom: 20px; /* Add margin to create space between the button and the table */
        }

        .register-button:hover {
            background-color: #6B6767;
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
        <h2>List of Available Apartment Blocks</h2>
        <button class="register-button" onclick="location.href='register_block.php'">Register Block</button>
        <?php
        // Replace with your database connection details
        include 'db_connection.php';

        // Fetch data from the "block" table
        $sql = "SELECT id, block, name FROM block";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>ID</th><th>Block</th><th>Name</th><th colspan='2'>Actions</th></tr>";
           // $idd = 1; // Initialize the general ID counter
			$num=1;
            while ($row = $result->fetch_assoc()) {
            
				$block = $row["block"];
                $name = $row["name"];
				$id = $row["id"];
				
				//sini

                echo "<tr>";
                echo "<td>$num</td>"; // Use the general ID
                echo "<td>$block</td>";
                echo "<td>$name</td>";
                echo "<td class='center'><a href='edit_block.php?id=$id'>Edit</a></td>";
                echo "<td class='center'><a href='delete_block.php?id=$id'>Delete</a></td>";
                echo "</tr>";

               // $idd++; // Increment the ID for the next row
				$num++;
            }
            echo "</table>";
        } else {
            echo "<p>No apartment blocks available.</p>";
        }

        // Close the database connection
        $conn->close();
        ?>
    </div>
</div>
</body>
</html>


