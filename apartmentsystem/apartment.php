<!DOCTYPE html>
<html>
<head>
    <title>Apartment </title>
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
        
      <button class="register-button" onclick="location.href='register_apartment.php'">Register Apartment</button>
		<div class="search-form">
    <form action="" method="GET">
        <label for="search_query">Search:</label>
        <input type="text" id="search_query" name="search_query" placeholder="Enter">
        <input type="submit" value="Search">
    </form>
</div>
        <?php
        include 'db_connection.php';

        // Fetch data from the "apartment" table and join with other tables
/*
		$sql = "SELECT apartment.id AS apartment_id, 
                   block.name AS block_name, 
                   level.name AS level_name,
                   apartment.unit, 
                   cond.name AS cond_name,
                   status.name AS status_name
                   
            FROM apartment
            INNER JOIN block ON apartment.block_id = block.id
            INNER JOIN level ON apartment.level_id = level.id
            INNER JOIN cond ON apartment.cond_id = cond.id
            INNER JOIN status ON apartment.status_id = status.id";*/
		if (isset($_GET['search_query']) && !empty($_GET['search_query'])) {
    $search_query = $_GET['search_query'];

    // Modify the SQL query to include the WHERE clause for filtering based on search query
    $sql = "SELECT apartment.id AS apartment_id, 
               block.name AS block_name, 
               level.name AS level_name,
               apartment.unit, 
               cond.name AS cond_name,
               status.name AS status_name
               
        FROM apartment
        INNER JOIN block ON apartment.block_id = block.id
        INNER JOIN level ON apartment.level_id = level.id
        INNER JOIN cond ON apartment.cond_id = cond.id
        INNER JOIN status ON apartment.status_id = status.id
        WHERE block.name LIKE '%$search_query%'
        OR level.name LIKE '%$search_query%'
        OR apartment.unit LIKE '%$search_query%'
        OR cond.name LIKE '%$search_query%'
        OR status.name LIKE '%$search_query%'";
} else {
    $sql = "SELECT apartment.id AS apartment_id, 
               block.name AS block_name, 
               level.name AS level_name,
               apartment.unit, 
               cond.name AS cond_name,
               status.name AS status_name
               
        FROM apartment
        INNER JOIN block ON apartment.block_id = block.id
        INNER JOIN level ON apartment.level_id = level.id
        INNER JOIN cond ON apartment.cond_id = cond.id
        INNER JOIN status ON apartment.status_id = status.id";
}
		



		
        $result = $conn->query($sql);
		
		echo "<h2>List of Apartments</h2>";
		echo "<table>";
		echo "<tr>
		<th>No</th>
		<th>Block Name</th>
		<th>Level Name</th>
		<th>Unit</th>
		<th>Condition Name</th>
		<th>Status</th>
		<th colspan='2'>Actions</th>
		</tr>";

        if ($result->num_rows > 0) {
            
			$num=1;
            while ($row = $result->fetch_assoc()) {
          
				$id = $row["apartment_id"];
        		$blockName = $row["block_name"];
        		$levelName = $row["level_name"];
        		$unit = $row["unit"];
        		$condName = $row["cond_name"];
        		$statusName = $row["status_name"];
				
				//sini

            
				echo "<tr>";
				echo "<td>$num</td>";
				echo "<td>$blockName</td>";
        		echo "<td>$levelName</td>";
        		echo "<td>$unit</td>";
        		echo "<td>$condName</td>";
        		echo "<td>$statusName</td>";
				echo "<td class='center'><a href='edit_apartment.php?id=$id'>Edit</a></td>";
                echo "<td class='center'><a href='delete_apartment.php?id=$id'>Delete</a></td>";
				echo "</tr>";

               // $idd++; // Increment the ID for the next row
				$num++;
            }
           
        } else {
            //echo "<p>No apartment blocks available.</p>";
			    echo "<tr><td colspan='7'>No Apartment Available</td></tr>";
        }
		 echo "</table>";

        // Close the database connection
        $conn->close();
        ?>
    </div>
</div>
</body>
</html>
