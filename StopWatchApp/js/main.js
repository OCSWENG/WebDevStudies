
$(function(){

    var mode=0; //Application Mode
    var timeCounter=0; //time
    var lapCounter=0; //lapTime
    var action; // setInterval
    var lapNumber=0; //number of lap btn hits
    
    var topVal = 100*60*100;
    
    // time values
    var timeMin;
    var timeSec;
    var timeCentSec;
    
    //lap values
    var lapMin;
    var lapSec;
    var lapCentSec;
    
    // On the App load show start and lap buttons
    hideShowButtons('#startBtn','#lapBtn');
    
    
    // convert counters lap and time to min:sec:centSec
    function calcTimes () {
        //1min = 60*100centiseconds=6000centiseconds
        timeMin = Math.floor(timeCounter/6000);
        // 1 sec = 100 centiseconds
        timeSec = Math.floor((timeCounter%6000)/100);
        // 
        timeCentSec = (timeCounter%6000)%100;
        
        $('#timerminute').text(format(timeMin));
        $('#timersecond').text(format(timeSec));
        $('#timercentisecond').text(format(timeCentSec));
  
        //1min=60*100centiseconds=6000centiseconds
        lapMin = Math.floor(lapCounter/6000);
        //1sec=100centiseconds
        lapSec = Math.floor((lapCounter%6000)/100);
        lapCentsec = (lapCounter%6000)%100;
        $("#lapminute").text(format(lapMin));
        $("#lapsecond").text(format(lapSec));
        $("#lapcentisecond").text(format(lapCentsec));
    }
   
    function format (number){
        if(number<10){
            return '0'+number;
        }
        else {
            return number;
        }
    }
    
    
    function hideShowButtons (btn1, btn2){
        $(".control").hide();
        $(btn1).show();
        $(btn2).show();
    }
    
    $('#startBtn').click(function(){
        mode = 1;
        hideShowButtons('#stopBtn', '#lapBtn');
        runIt();
    });


    $('#stopBtn').click(function(){
        hideShowButtons('#resumeBtn','#resetBtn');
        clearInterval(action);
    });
    

    $('#resumeBtn').click(function(){
        hideShowButtons('#stopBtn','#lapBtn');
        runIt();
    });

    $('#resetBtn').click(function(){
        mode = 0;
        location.reload();
    });
    
    $('#lapBtn').click(function(){
        if(mode){
            clearInterval(action);
            lapCounter=0;
            addLap();
            runIt();
        }
    });

    function runIt (){
        action = setInterval(function (){
            timeCounter++;
            if(timeCounter == topVal){
                timeCounter=0;
            }
            lapCounter++;
            if(lapCounter == topVal){
                lapCounter=0;
            }
            calcTimes();
        },10);
    }
    
        //addLap function: print lap details inside the lap box
    function addLap(){
        lapNumber++;
           var myLapDetails =
               '<div class="lap">'+
                    '<div class="laptimetitle">'+
                        'Lap'+ lapNumber +
                    '</div>'+
                    '<div class="laptime">'+
                        '<span>'+ format(lapMin) +'</span>'+
                        ':<span>'+ format(lapSec) +'</span>'+
                        ':<span>'+ format(lapCentsec) +'</span>'+
                    '</div>'+
               '</div>';
        $(myLapDetails).prependTo("#laps");
    }
});
