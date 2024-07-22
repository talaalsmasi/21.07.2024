<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the form was submitted using the POST method
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Retrieve user input from the form fields

    // Validate that both fields are filled out
    if (empty($email) || empty($password)) {
        echo "Both fields are required.";
        // If either the email or password field is empty, show an error message
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Validate email format
        echo "Invalid email format.";
        // If the email format is not valid, show an error message
    } else {
        // Connect to the database
        $conn = new mysqli('localhost', 'root', '', 'user_registration');

        // Establish a connection to the MySQL database using the mysqli class
        // 'localhost' is the database host
        // 'root' is the username
        // '' is the password (empty in this case)
        // 'user_registration' is the database name

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            // Check if the connection was successful
            // If not, display an error message and terminate the script
        }

        // Prepare an SQL statement to select the password from the database
        $stmt = $conn->prepare("SELECT password FROM users WHERE email = ?");
        // The SQL statement selects the password for the given email

        $stmt->bind_param("s", $email);
        // Bind the email parameter to the SQL statement
        // "s" indicates that the parameter is a string

        $stmt->execute();
        // Execute the prepared statement

        $stmt->store_result();
        // Store the result set from the executed statement

        if ($stmt->num_rows > 0) {
            // Check if any rows were returned (i.e., if the email exists in the database)

            $stmt->bind_result($hashed_password);
            // Bind the result to a variable to retrieve the hashed password

            $stmt->fetch();
            // Fetch the result into the bound variable

            if (password_verify($password, $hashed_password)) {
                echo "Login successful!";
                // Verify the password against the hashed password stored in the database
                // If the password matches, display a success message
            } else {
                echo "Incorrect password.";
                // If the password does not match, display an error message
            }
        } else {
            echo "No account found with that email.";
            // If no rows were returned (i.e., the email is not found), display an error message
        }

        $stmt->close();
        // Close the prepared statement to free up resources

        $conn->close();
        // Close the database connection to free up resources
    }
}
?>

