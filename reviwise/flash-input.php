<?php

session_start();

$host = "localhost";
$dbusername = "id21943978_ahmed";
$dbpassword = "Ahmedos.123";
$dbname = "id21943978_database";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the user is logged in
if(isset($_SESSION['username'])){
    $loggedInUser = $_SESSION['username'];
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $question = $_POST["question"];
        $answer = $_POST["answer"];

        // Insert data into the flashcards table along with the username
        $sql = "INSERT INTO flashcards (username, question, answer) VALUES ('$loggedInUser', '$question', '$answer')";

        if ($conn->query($sql) === TRUE) {
            echo "Record inserted successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
} else {
    echo "User not logged in";  // You may redirect to a login page here
}

$conn->close();
?>
