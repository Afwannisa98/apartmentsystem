<!DOCTYPE html>
<html>
<head>
    <title>Edit Apartment</title>
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
            <h2>Edit Apartment</h2>
            <?php
            include 'db_connection.php';

            // Assuming you have the apartment ID passed to this page as a query parameter 'id'
            $apartment_id = $_GET['id'];

            // Fetch the current values of the apartment based on its ID
            $editSql = "SELECT * FROM apartment WHERE id = '$apartment_id'";
            $editResult = $conn->query($editSql);

            if ($editResult->num_rows > 0) {
                $apartmentData = $editResult->fetch_assoc();
                $block_id = $apartmentData["block_id"];
                $level_id = $apartmentData["level_id"];
                $unit = $apartmentData["unit"];
                $cond_id = $apartmentData["cond_id"];
                $status_id = $apartmentData["status_id"];
            }

            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                // Get form data
                $block_id = $_POST["block_id"];
                $level_id = $_POST["level_id"];
                $unit = $_POST["unit"];
                $cond_id = $_POST["cond_id"];
                $status_id = $_POST["status_id"];

                // Update the existing apartment based on its ID
                $sql = "UPDATE apartment 
                        SET block_id = '$block_id', 
                            level_id = '$level_id', 
                            unit = '$unit', 
                            cond_id = '$cond_id',
                            status_id = '$status_id'
                        WHERE id = '$apartment_id'";

                if ($conn->query($sql) === true) {
                    // Close the database connection
                    $conn->close();

                    // Redirect back to "apartment.php" after successful update with a query parameter
                    header("Location: apartment.php?status=success");
                    exit();
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }

                // Close the database connection
                $conn->close();
            }
            ?>

            <form method="post" action="<?php echo $_SERVER["PHP_SELF"] . '?id=' . $apartment_id; ?>">
                <div class="form-group">
                    <label for="block_id">Block:</label>
                    <select id="block_id" name="block_id" required>
                        <?php
                        $blockSql = "SELECT id, name FROM block";
                        $blockResult = $conn->query($blockSql);
                        while ($row = $blockResult->fetch_assoc()) {
                            $blockId = $row["id"];
                            $blockName = $row["name"];
                            $selected = ($blockId == $block_id) ? "selected" : "";
                            echo "<option value='$blockId' $selected>$blockName</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="level_id">Level:</label>
                    <select id="level_id" name="level_id" required>
                        <?php
                        $levelSql = "SELECT id, name FROM level";
                        $levelResult = $conn->query($levelSql);
                        while ($row = $levelResult->fetch_assoc()) {
                            $levelId = $row["id"];
                            $levelName = $row["name"];
                            $selected = ($levelId == $level_id) ? "selected" : "";
                            echo "<option value='$levelId' $selected>$levelName</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="unit">Unit:</label>
                    <input type="text" id="unit" name="unit" value="<?php echo $unit; ?>" required>
                </div>
                <div class="form-group">
                    <label for="cond_id">Condition:</label>
                    <select id="cond_id" name="cond_id" required>
                        <?php
                        $condSql = "SELECT id, name FROM cond";
                        $condResult = $conn->query($condSql);
                        while ($row = $condResult->fetch_assoc()) {
                            $condId = $row["id"];
                            $condName = $row["name"];
                            $selected = ($condId == $cond_id) ? "selected" : "";
                            echo "<option value='$condId' $selected>$condName</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="status_id">Status:</label>
                    <select id="status_id" name="status_id" required>
                        <?php
                        $statusSql = "SELECT id, name FROM status";
                        $statusResult = $conn->query($statusSql);
                        while ($row = $statusResult->fetch_assoc()) {
                            $statusId = $row["id"];
                            $statusName = $row["name"];
                            $selected = ($statusId == $status_id) ? "selected" : "";
                            echo "<option value='$statusId' $selected>$statusName</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <input type="submit" value="Update">
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
