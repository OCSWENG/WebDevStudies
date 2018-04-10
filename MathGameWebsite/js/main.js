// utilities 
function sleep(ms) {
    var unixtime_ms = new Date().getTime();
    while(new Date().getTime() < unixtime_ms + ms) {}
}

function changeDisplay ( Id, value) {
   this.document.getElementById(Id).style.display=value;
}

function changeVisibilty ( Id, value){
   this.document.getElementById(Id).style.visibility=value;
}

var answer = -1;

// This is the start and reset part of the game
// Problems, rendering the screen only works in debug?
// The ability to generate a game loop and take user input

var currentStatus = "";
function changeStatus() {
    var currentState = this.document.getElementById("startReset").innerHTML;
    var pattern1 = /Reset Game/i;
    var pattern2 = /Start Game/i;
    var result1 = pattern1.test(currentState);
    var result2 = pattern2.test(currentState);
    
    if (result1) {
        currentState = "Reset Game";
        this.document.getElementById("startReset").innerHTML = currentState;
        this.location.reload();
    }
    else if (result2) {
        currentState = "Start Game";
        this.document.getElementById("startReset").innerHTML = currentState;
//              this.document.getElementById("scorevalue").innerHTML=0;
        computeQA();
    }
    else {        
        this.document.getElementById("gameOver").innerHTML = "Unkown Problem report to Developer";
    }
}


function gameOver () {
    changeDisplay ( "gameOver", "block");
    var score = this.document.getElementById("scorevalue").innerHTML;
    this.document.getElementById("gameOver").innerHTML="GAME OVER! </br> YOUR SCORE IS "+score; 
    this.document.getElementById("startReset").innerHTML = "Reset Game";
    
}

function incrementErrorCount() {
    var errorCount = this.document.getElementById("errorCountgvalue").innerHTML;
    errorCount ++;
    this.document.getElementById("errorCountgvalue").innerHTML=errorCount;
    if ( errorCount > 2) {gameOver();}
}



// Obtain the answer, generate 3 other possible answers and display
function computeQA () {
        var num1 = Math.floor(Math.random() * 9 +1) ;
        var num2 = Math.floor(Math.random() * 9 +1);
    
   
        answer = num1 * num2;
        var question = ""+num1+"x"+num2;
        var generateNumber = 0;
        var allGenNumbers =  [0,0,0,0];
        var randGenNumbers = [0,0,0,0];
    

        // now randomly select an index to place the real answer.
        var index = Math.floor(Math.random() *4);
        allGenNumbers[index]=answer;
    
        // should be a function returning an array
        while (generateNumber < 3) {
            var possibleAnswer = Math.floor(Math.random() * 100 +1);
        
        // problem is the random generator must produce unique numbers
            while ( randGenNumbers.includes(possibleAnswer) != 0 || possibleAnswer == answer) {
                possibleAnswer = Math.floor(Math.random() * 100 +1);            
            }

            randGenNumbers.push(possibleAnswer);
            generateNumber++;
        }

        for (var x= 0; x< 4; x++) {
            if (x != index) {
                allGenNumbers[x] = randGenNumbers.pop();
            }
        }

  
        this.document.getElementById("question").innerHTML=question;
        var y = 1;
        var len = allGenNumbers.length;
        var itr = 0;
        for (; itr < len; itr++) { 
            var id  ="choice"+y;
            this.document.getElementById(id).innerHTML=allGenNumbers[itr];
            y++;
        }
}


// The most used function
// This will respond to answers selected if more than 2 errors given game over
function isCorrect (value) {
    var choiceValue = this.document.getElementById(value).innerHTML;     
    
    if ( answer == choiceValue){
        // set the correct visible for one second and add to the score
      //  changeVisibilty ("correctMsg", "visible");
    //    sleep(200);
        var scoreValue = this.document.getElementById("scorevalue").innerHTML;
        scoreValue++;
        this.document.getElementById("scorevalue").innerHTML=scoreValue; 
      //  sleep(200);
    //    changeVisibilty ("correctMsg", "hidden");
    //    sleep(200);
        computeQA();
    }
    else {
        // set the try again visible for 2 seconds
     //   changeVisibilty ("wrongMsg", "visible");
    //    sleep(200);
    //    changeVisibilty ("wrongMsg", "hidden");
        incrementErrorCount();
    }
}






