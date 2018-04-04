
//	start/reset action

// StartReset Action 
//var resetState = 0;
//var startState = 1;
//var curState = startState;  //??

// The game is already playing so hitting the start button should just reload the page.


var currentStatus = "";
function changeStatus() {
    var currentState = this.document.getElementById("startReset").innerHTML;
    var pattern1 = /Reset Game/i;
    var pattern2 = /Start Game/i;
    var result1 = pattern1.test(currentState);
    var result2 = pattern2.test(currentState);
    
    if (result2) {
        currentState = "Reset Game";
        this.document.getElementById("startReset").innerHTML = currentState;
        this.location.reload();
    }
    else if (result1) {
        currentState = "Start Game";
        this.document.getElementById("startReset").innerHTML = currentState;
        runGame();
    }
    else {        
        this.document.getElementById("gameOver").innerHTML = "Unkown Problem report to Developer";
    }
}


function runGame () {
 //   this.document.reload();
//    currState = resetState;
    
//}
//if the state is in reset and the start button
//if the state is in reset and the start button
   //      set score to zero 
    // should be a function to set the score to zero
    // should be a function to generate Q&A
    
    
    // generate new q&a
    // Number x Number
    // Answer1: Number1 Answer2: Number2 Answer3: Number3 Answer4: Number4
    
    var num1 = Math.floor(Math.random() * 9 +1) ;

    var num2 = Math.floor(Math.random() * 9 +1);
    
    var answer = num1 * num2;
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

    this.document.getElementById("scorevalue").innerHTML=0;
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


//	playing yes:
//		Reload Page

//	playing no:


//		change start button to reset button


    //    if in start state
    //    answer box selected:
    //        if correct:
    //            increase score
    //            show correct box
    //            generate new Q&A
    //        else:
    //            show try again box for 1 sec


//		show countdown
//		reduce time by 1 sec until it reaches zero
//		when time is up show game over, score and change 
//		reset button to start button.




