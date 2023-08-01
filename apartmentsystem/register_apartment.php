<!DOCTYPE html>
<html>
<head>
    <title>Register Apartment</title>
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
            <h2>Register New Apartment</h2>
            <?php
			include 'db_connection.php';
			// Fetch data from the "block" table
    		$blockSql = "SELECT id, name FROM block";
    		$blockResult = $conn->query($blockSql);
			
			// Fetch data from the "level" table
			$levelSql = "SELECT id, name FROM level";
    		$levelResult = $conn->query($levelSql);
			
			// Fetch data from the "cond" table
			$condSql = "SELECT id, name FROM cond";
    		$condResult = $conn->query($condSql);
			
			// Fetch data from the "status" table
			$statusSql = "SELECT id, name FROM status";
    		$statusResult = $conn->query($statusSql);
			
			
			
            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                // Replace with your database connection details
             //include 'db_connection.php';

                // Get form data
                $block_id = $_POST["block_id"];
                $level_id = $_POST["level_id"];
				$unit = $_POST["unit"];
				$cond_id = $_POST["cond_id"];
				$status_id = $_POST["status_id"];

                // Insert the new apartment block into the "block" table
              $sql = "INSERT INTO apartment (block_id, level_id, unit, cond_id,status_id) VALUES ('$block_id', '$level_id', '$unit', '$cond_id', $status_id)";
				//$sql="INSERT INTO apartment(blck_id)VALUES ('$block_id')";

                if ($conn->query($sql) === true) {
                   	
				// Close the database connection
				$conn->close();

        	// Redirect back to "block.php" after successful registration with a query parameter
        		header("Location: apartment.php?status=success");
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
            
					
					<label for="block_id">Block:</label>
						<select id="block_id" name="block_id" required>
						 <?php
                while ($row = $blockResult->fetch_assoc()) {
                    echo "<option value='" . htmlspecialchars($row["id"]) . "'>" . htmlspecialchars($row["name"]) . "</option>";
                }
                ?>
            </select>
                </div>
				 <div class="form-group">
            <label for="level_id">Level:</label>
            <select id="level_id" name="level_id" required>
                <?php
                while ($row = $levelResult->fetch_assoc()) {
                    $levelId = $row["id"];
                    $levelName = $row["name"];
                    echo "<option value='$levelId'>$levelName</option>";
                }
                ?>
            </select>
        </div>
				<div class="form-group">
            <label for="unit">Unit:</label>
            <input type="text" id="unit" name="unit" required>
        </div>
        <div class="form-group">
            <label for="cond_id">Condition:</label>
            <select id="cond_id" name="cond_id" required>
                <?php
                while ($row = $condResult->fetch_assoc()) {
                    $condId = $row["id"];
                    $condName = $row["name"];
                    echo "<option value='$condId'>$condName</option>";
                }
                ?>
            </select>
        </div>
				        <div class="form-group">
            <label for="status_id">Status:</label>
            <select id="status_id" name="status_id" required>
                <?php
                while ($row = $statusResult->fetch_assoc()) {
                    $statusId = $row["id"];
                    $statusName = $row["name"];
                    echo "<option value='$statusId'>$statusName</option>";
                }
                ?>
            </select>
        </div>
				
                
                <div class="form-group">
                    <input type="submit" value="Register">
                </div>
            </form>
        </div>
    </div>
</div>
</body>