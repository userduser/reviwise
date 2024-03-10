<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // retrieve form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Database Connection
    $host = "localhost";
    $dbusername = "id21943978_ahmed";
    $dbpassword = "Ahmedos.123";
    $dbname = "id21943978_database";

    $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM logins WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);

    // Execute the prepared statement
    $stmt->execute();

    // Get result
    $result = $stmt->get_result();

    // Check if username and password match
    if ($result->num_rows == 1) {
        // Password is correct, start the session here
        session_start();

        $_SESSION['username'] = $username;


        // Redirect to the menu page
        header("Location: pages/menu.php");
        exit();
    } else {
        echo "Password incorrect";
    }

    // Close the statement
    $stmt->close();
    $conn->close();
}
?>
