var score = 0;
var playing = false;
var livesLeft = 3;
var fruits= [
    'apple', 'Bananas', 'cherries', 'grapes', 'manggo', 'orange', 'peach', 'pear', 'watermelon'
];

var yaxis;
var action;




$(function (){
            /*
                Action: Slice Fruit
                play sound explode fruit
                increase score by one
            */
            // strike at it!

    $("#fruitId").mouseover(function () {
        //    play sound explode fruit
        // increase score by one
        score += 1;
        $("#scoreValue").html(score);
        $("#sliceSound")[0].play();
    
        clearInterval(action);
      //  $("#fruitId").hide("explode",500);
        // has problems rendering the screen after 
        // the first explosion.
        
        $("#fruitId").hide();
        
        setTimeout(sendFruits (), 500);
}); 
    
    
  $("#startReset").click(function(){
        var textVal = $("#startReset").text();
        // start:
        if (textVal == "Start"){
            playing = true;
            $("#startReset").text( "Reset");
            // set score to Zero.
            score = 0;
            livesLeft = 3;
            $("#scoreValue").html(score);
            
            //    show lives left box
            $("#lives").show();
            addHearts(livesLeft);
            
            $("#gameOver").hide();
            
            //    create random fruit
            sendFruits();

        }
        //reset: reload page
        else {
            $("#startReset").text( "Start");
            location.reload();
            playing = false;            
        }
    });


/*
click start/reset button

reset:
    reload page

start:
    show lives left box
    
    change button to reset game
    
    create random fruit

    
*/


function addHearts ( numLife) {
    $("#lives").empty();
    for ( var itr = 0; itr < numLife; itr++){
        $("#lives").append('<img src="img/heart.png">');
    }      
}

function sendFruits () {
    $("#fruitId").show();
    
    
    chooseFruit();
  /*
     move fruit down one step
    
    fruit too low?
    yes:
        any lives left?
        
            yes:
                remove on heart
        
                go back to create random fruit
        
            no:
                show game over
                change button to start game
    no:
        go back to moving fruit down one step
    */
    var xaxis = Math.round(Math.random()*500); 
    $("#fruitId").css({'left':xaxis, 'top':-35});   
       
    yaxis = 1+ Math.round(3*Math.random());

    action = setInterval(function() {
        $("#fruitId").css({'top': $("#fruitId").position().top + yaxis });
        
        // determine if the fruit is too low
        if ( $("#fruitId").position().top > $("#actionBox").height())
        {
            if ( livesLeft > 0) {
                $("#fruitId").show();
                chooseFruit();

                var xaxis = Math.round(Math.random()*500); 
                $("#fruitId").css({'left':xaxis, 'top':-35});   
                yaxis = 1+ Math.round(3*Math.random());

                livesLeft -=1;
                 addHearts ( livesLeft);
            }
            else {
                showGameOver();                
            }
        }
    }, 10); 
}


function chooseFruit () {
    $("#fruitId").attr("src", "img/"+ fruits[Math.round(Math.random()*8)]+".png");
}

function showGameOver() {
    playing = false; 
    $("#gameOver").empty();
    $("#gameOver").append("<p>game over</p> <p>Score is "+ score +" </p>");
    $("#gameOver").show(); 
    $("#startReset").text( "Start");
    $("#lives").hide();
    stopFruitDrop ();
}


function stopFruitDrop () {
    clearInterval(action);
    $("#fruitId").hide();    
}
    
});