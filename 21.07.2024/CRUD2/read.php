<?php
include 'config.php';

$id = $_GET['id'];

$sql = "SELECT * FROM Employees WHERE id=$id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo "ID: " . $row["id"]. "<br>";
    echo "Name: " . $row["Name"]. "<br>";
    echo "Address: " . $row["Address"]. "<br>";
    echo "Salary: " . $row["Salary"]. "<br>";
} else {
    echo "No employee found with ID: $id";
}
$conn->close();
?>