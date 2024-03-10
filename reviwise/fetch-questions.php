<?php
// Include your database connection code here

// Fetch questions from the database
$query = "SELECT id, question FROM ";
$result = mysqli_query($conn, $query);

$questions = array();
while ($row = mysqli_fetch_assoc($result)) {
    $questions[] = $row;
}

// Output questions as JSON
echo json_encode($questions);
?>