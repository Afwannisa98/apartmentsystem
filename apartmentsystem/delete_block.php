<?php
// Replace with your database connection details
include 'db_connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete the specific apartment block from the "block" table
    $sql = "DELETE FROM block WHERE id = '$id'";

    if ($conn->query($sql) === true) {
        echo "<script>alert('Apartment block deleted successfully!'); window.location.href = 'block.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
