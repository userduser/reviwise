<!DOCTYPE html>
<html>
  <head>
    <title>Flashcards</title>
    <link rel="stylesheet" type="text/css" href="/reviwise/styles/styles.css" />
    <script src="/reviwise/scripts.js"></script>
  </head>
    <body>
        <h1 class="timer-title">Flashcards</h1>
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
        
        <form id="card-make-form" class="card-make-wrapper" action="/reviwise/flash-input.php" method="post">
            <div class="card-make">
                <h2>Input your question here</h2>
                <input name="question" class="question" required>
                <h2>Input answer to your question here</h2>
                <input name="answer" class="answer" required>
                <button type="button" class="done-button" onclick="submitForm()">Done</button>
            </div>
        </form>

        <div class="done-msg">
            <h2>Flashcard saved to library</h2>
            <p>Go to practice questions or press okay to input next question.</p>
            <button class="k-btn">Okay</button>
                        <a href="/reviwise/pages/practice-questions.php"
              <button class="k-btn" id="practice-question-btn">Practice Questions</button>
            </a>
        </div>
            

    </body>
</html>


<script>
function submitForm() {
    // Get form data
    var form = document.getElementById("card-make-form");
    var questionInput = document.querySelector('.question');
    var answerInput = document.querySelector('.answer');

    // Check if input fields are not empty
    if (questionInput.value.trim() === '' || answerInput.value.trim() === '') {
        alert('Please enter both question and answer.');
        return;
    }

    var formData = new FormData(form);

    // Create an XMLHttpRequest object
    var xhr = new XMLHttpRequest();

    // Configure it: POST-request for the URL /reviwise/flash-input.php
    xhr.open("POST", "/reviwise/flash-input.php", true);

    // Set up a callback function to run when the request is complete
    xhr.onload = function() {
        if (xhr.status == 200) {
            // If the request was successful, display the response
            console.log(xhr.responseText);
            // Clear the form
            form.reset();
            // You can update the page or show a success message here
        } else {
            // If the request failed, log the error
            console.error("Error: " + xhr.status);
        }
    };

    // Send the request and include the form data
    xhr.send(formData);
}
</script>



<script>
document.addEventListener("DOMContentLoaded", function () {
    const doneButton = document.querySelector(".done-button");
    const doneMsg = document.querySelector(".done-msg");
    const okayButton = document.querySelector(".k-btn");

    doneButton.addEventListener("click", function () {
        // Check if the form is complete before displaying the message
        if (isFormComplete()) {
            doneMsg.style.display = "flex";
            doneMsg.style.transition = "ease-in-out 0.3s";
            doneMsg.style.opacity = "1";
        }
    });

    okayButton.addEventListener("click", function () {
        doneMsg.style.display = "none";
        doneMsg.style.opacity = "0";
    });

    function isFormComplete() {
        // Modify this function based on your form structure and validation criteria
        const questionInput = document.querySelector('.question');
        const answerInput = document.querySelector('.answer');

        return questionInput.value.trim() !== '' && answerInput.value.trim() !== '';
    }
});
</script>
