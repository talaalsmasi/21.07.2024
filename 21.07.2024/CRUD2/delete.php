<?php
include 'config.php';

$id = $_GET['id'];

$sql = "DELETE FROM Employees WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "Employee deleted successfully";
} else {
    echo "Error deleting employee: " . $conn->error;
}

$conn->close();
?>