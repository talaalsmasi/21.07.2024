<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
</head>
<body>
    <h2>Register</h2>
    <form action="register.php" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <label for="confirm_password">Confirm Password:</label>
        <input type="password" id="confirm_password" name="confirm_password" required><br><br>

        <input type="submit" value="Register">
        <button><a href="login.php">login</a></button>
    </form>
</body>
</html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // if the user fill the filed 
    $name = $_POST['name'];
    // named the name entered by user --> name 
    $email = $_POST['email'];
    //named the email entered by user --> email
    $password = $_POST['password'];
    //named the password enter by user --> password
    $confirm_password = $_POST['confirm_password'];
    //named the confirm password entered by user --> confirm_password

    
    if (empty($name) || empty($email) || empty($password) || empty($confirm_password)) {
        // Validate all fields are filled out
        echo "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Validate email format ,, filter_var -->funation to filter the data , $email--> the thing i want to filter , filter_validate_email -->type of validation
        echo "Invalid email format.";
    } elseif ($password !== $confirm_password) {
        // Validate passwords match
        echo "Passwords do not match.";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        // Hash the password
        $conn = new mysqli('localhost', 'root', '', 'user_registration');
        // Insert the user into the database ant connect php with SQL
        if ($conn->connect_error)
        // check the connection if there is any error
             {die("Connection failed: " . $conn->connect_error);}
        // disconnect the connection 
        $statement  = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        // prepare the table to reception the data ? --> we can fill it later 
        $statement ->bind_param("sss", $name, $email, $hashed_password);
        // Associates the actual values with the placeholders parameters in the prepared query.
        if ($statement ->execute()) {
            echo "Registration successful!";
        //check if the data base recevied the data
        } else {
            echo "Error: " . $stmt->error;
        //if not give me an error message
        }
        $statement ->close();
        //close the prepared statment 
        $conn->close();
        // close the connection
    }
}
?>
