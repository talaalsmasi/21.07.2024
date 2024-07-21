<?php include 'config.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Employee</title>
</head>
<body>
    <h2>Add Employee</h2>
    <form action="insert.php" method="post">
        <label>Name:</label><br>
        <input type="text" name="name"><br>
        <label>Address:</label><br>
        <input type="text" name="address"><br>
        <label>Salary:</label><br>
        <input type="text" name="salary"><br><br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>