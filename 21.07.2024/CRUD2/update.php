<?php
include 'config.php';

$id = $_GET['id'];

$sql = "SELECT * FROM Employees WHERE id=$id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Update Employee</title>
    </head>
    <body>
        <h2>Update Employee</h2>
        <form action="modify.php" method="post">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <label>Name:</label><br>
            <input type="text" name="name" value="<?php echo $row['Name']; ?>"><br>
            <label>Address:</label><br>
            <input type="text" name="address" value="<?php echo $row['Address']; ?>"><br>
            <label>Salary:</label><br>
            <input type="text" name="salary" value="<?php echo $row['Salary']; ?>"><br><br>
            <input type="submit" value="Update">
        </form>
    </body>
    </html>
<?php
} else {
    echo "No employee found with ID: $id";
}
$conn->close();
?>