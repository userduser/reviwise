<!DOCTYPE html>
<html>
  <head>
    <title>Timer</title>
    <link rel="stylesheet" type="text/css" href="/reviwise/styles/styles.css" />
    <script src="/reviwise/scripts.js"></script>
  </head>
    <body>
        <h1 class="timer-title">Timer</h1>
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
            

        <div class="Timer">
            <nav class="controls">
                <a href="#" class="button" onClick="stopwatch.start();">Start</a>
                <a href="#" class="button" onClick="stopwatch.lap();">Lap</a>
                <a href="#" class="button" onClick="stopwatch.stop();">Stop</a>
                <a href="#" class="button" onClick="stopwatch.restart();">Restart</a>
                <a href="#" class="button" onClick="stopwatch.clear();">Clear</a>
            </nav>
            <div class="stopwatch"></div>
            <ul class="results"></ul>

            <div id="timer">
                <h3>Input Time in minutes</h3>
                <div id="inputArea">
                </div>
    
                <h1 id="time">0:00</h1>
            </div>
        </div>


            

    </body>
</html>




<script>

var secondsRemaining;
var intervalHandle;

function resetPage(){

	document.getElementById("inputArea").style.display = "block";

}

function tick(){
	// grab the h1
	var timeDisplay = document.getElementById("time");

	// turn the seconds into mm:ss
	var min = Math.floor(secondsRemaining / 60);
	var sec = secondsRemaining - (min * 60);

	//add a leading zero (as a string value) if seconds less than 10
	if (sec < 10) {
		sec = "0" + sec;
	}

	// concatenate with colon
	var message = min.toString() + ":" + sec;

	// now change the display
	timeDisplay.innerHTML = message;

	// stop is down to zero
	if (secondsRemaining === 0){
		alert("Done!");
		clearInterval(intervalHandle);
		resetPage();
	}

	//subtract from seconds remaining
	secondsRemaining--;

}

function startCountdown(){

	function resetPage(){
		document.getElementById("inputArea").style.display = "block";
	}

	// get countents of the "minutes" text box
	var minutes = document.getElementById("minutes").value;
	
	// check if not a number
	if (isNaN(minutes)){
		alert("Please enter a number");
		return; // stops function if true
	}

	// how many seconds
	secondsRemaining = minutes * 60;
	
	//every second, call the "tick" function
	// have to make it into a variable so that you can stop the interval later!!!
	intervalHandle = setInterval(tick, 1000);

	// hide the form
	document.getElementById("inputArea").style.display = "none";


}

window.onload = function(){

	// create input text box and give it an id of "min"
	var inputMinutes = document.createElement("input");
	inputMinutes.setAttribute("id", "minutes");
	inputMinutes.setAttribute("type", "text");
	
	//create a button
	var startButton = document.createElement("input");
	startButton.setAttribute("type","button");
	startButton.setAttribute("value","Start Countdown");
	startButton.onclick = function(){
		startCountdown();
	};

	//add to the DOM, to the div called "inputArea"
	document.getElementById("inputArea").appendChild(inputMinutes);
	document.getElementById("inputArea").appendChild(startButton)		

}










    class Stopwatch {
        constructor(display, results) {
            this.running = false;
            this.display = display;
            this.results = results;
            this.laps = [];
            this.reset();
            this.print(this.times);
        }
        
        reset() {
            this.times = [ 0, 0, 0 ];
        }
        
        start() {
            if (!this.time) this.time = performance.now();
            if (!this.running) {
                this.running = true;
                requestAnimationFrame(this.step.bind(this));
            }
        }
        
        lap() {
            let times = this.times;
            let li = document.createElement('li');
            li.innerText = this.format(times);
            this.results.appendChild(li);
        }
        
        stop() {
            this.running = false;
            this.time = null;
        }

        restart() {
            if (!this.time) this.time = performance.now();
            if (!this.running) {
                this.running = true;
                requestAnimationFrame(this.step.bind(this));
            }
            this.reset();
        }
        
        clear() {
            clearChildren(this.results);
        }
        
        step(timestamp) {
            if (!this.running) return;
            this.calculate(timestamp);
            this.time = timestamp;
            this.print();
            requestAnimationFrame(this.step.bind(this));
        }
        
        calculate(timestamp) {
            var diff = timestamp - this.time;
            // Hundredths of a second are 100 ms
            this.times[2] += diff / 10;
            // Seconds are 100 hundredths of a second
            if (this.times[2] >= 100) {
                this.times[1] += 1;
                this.times[2] -= 100;
            }
            // Minutes are 60 seconds
            if (this.times[1] >= 60) {
                this.times[0] += 1;
                this.times[1] -= 60;
            }
        }
        
        print() {
            this.display.innerText = this.format(this.times);
        }
        
        format(times) {
            return `\
    ${pad0(times[0], 2)}:\
    ${pad0(times[1], 2)}:\
    ${pad0(Math.floor(times[2]), 2)}`;
        }
    }

    function pad0(value, count) {
        var result = value.toString();
        for (; result.length < count; --count)
            result = '0' + result;
        return result;
    }

    function clearChildren(node) {
        while (node.lastChild)
            node.removeChild(node.lastChild);
    }

    let stopwatch = new Stopwatch(
        document.querySelector('.stopwatch'),
        document.querySelector('.results'));

</script>