
<!DOCTYPE html>
<html>
  <head>
    <title>Practice Questions</title>
    <link rel="stylesheet" type="text/css" href="/reviwise/styles/styles.css" />
    <script src="/reviwise/scripts.js"></script>
  </head>
    <body>
        <h1 class="timer-title">Practice Questions</h1>
        <nav>
            <div class="menu">

                <div class="logo">
                    <a href="/reviwise/index.html">
                    <img src="/reviwise/images/R-LOGO.svg" class="header-logo">
                    <p>Home Page</p>
                    </a>
                </div>

                <div class="menu-buttons">
                  <a href="/reviwise/logout.php">
                      <button class="log-out-button">Log out</button>
                  </a>
                  
                  <a href="/reviwise/pages/menu.php">
                      <button class="log-out-button">Back to menu</button>
                  </a>
                </div>

            </div>
        </nav>
        

    <!-- Practice Questions Section -->
    <div class="practice-questions">
      <h2>Practice Questions</h2>

      <?php
session_start();  // Make sure to start the session at the beginning of the script

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: /reviwise/login.php");  // Redirect to login page if not logged in
    exit();
}

$host = "localhost";
$dbusername = "id21943978_ahmed";
$dbpassword = "Ahmedos.123";
$dbname = "id21943978_database";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve the username from the session
$username = $_SESSION['username'];

$sql = "SELECT question, answer FROM flashcards WHERE username = '$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="question">';
        echo '<p>' . $row['question'] . '</p>';
        echo '<input type="text" class="answer-input" placeholder="Your Answer">';
        echo '<button onclick="checkAnswer(\'' . $row['question'] . '\', \'' . $row['answer'] . '\')">Check Answer</button>';
        echo '</div>';
    }
} else {
    echo "No questions found for user: $username.";
}

$conn->close();
?>


      <div id="answer-feedback"></div>

    </div>
    <!-- End of Practice Questions Section -->

    <script>
      function checkAnswer(question, correctAnswer) {
        // Get the user's answer from the corresponding input field
        var userAnswer = document.querySelector('.answer-input').value;

        // Compare the user's answer with the correct answer
        var feedbackElement = document.getElementById('answer-feedback');

        if (userAnswer.toLowerCase() === correctAnswer.toLowerCase()) {
          // Correct answer
          feedbackElement.innerHTML = 'Correct!';
        } else {
          // Incorrect answer
          feedbackElement.innerHTML = 'Incorrect. The correct answer is: ' + correctAnswer;
        }
      }
    </script>

    </body>
</html>
