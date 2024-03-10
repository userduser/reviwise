<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // retrieve form data
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email']; // New line to retrieve email from the form

    // Database Connection
    $host = "localhost";
    $dbusername = "id21943978_ahmed";
    $dbpassword = "Ahmedos.123";
    $dbname = "id21943978_database";

    $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the username already exists
    $checkUsername = "SELECT * FROM logins WHERE username = '$username'";
    $result = $conn->query($checkUsername);

    if ($result->num_rows > 0) {
        echo "Username already exists. Choose a different one.";
    } else {
        // Insert new user data into the database
        $insertUser = "INSERT INTO logins (username, email, password) VALUES ('$username', '$email', '$password')";
        if ($conn->query($insertUser) === TRUE) {
            header("Location: pages/login.html");
        } else {
            echo "Error: " . $insertUser . "<br>" . $conn->error;
        }
    }

    $conn->close();
}

?>
