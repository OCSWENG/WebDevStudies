$(function(){
   var paint = false;
    
    var paintOrErase = "paint";
    
    var canvas = document.getElementById("paint");
    var ctx = canvas.getContext("2d");
    
    var container = $("#container");
    var mouse_pos = {x:0, y:0};
    
    // ONLOAD load saved work from localStorage
    if(localStorage.getItem("imgCanvas") != null){
        var img = new Image();
        img.onload = function () {
            ctx.drawImage(img, 0,0);
        }
        
        img.src = localStorage.getItem("imgCanvas");
        
    }
    
    // SET DRAW PARAMETERS
    ctx.lineWidth = 3;
    ctx.lineJoin = "round";
    ctx.lineCap = "round";
    
    // CLICK INSIDE CONTAINER
    container.mousedown(function(event){
        paint=true;
        ctx.beginPath();
        mouse_pos.x = event.pageX - this.offsetLeft;
        mouse_pos.y = event.pageY - this.offsetTop;
        ctx.moveTo(mouse_pos.x, mouse_pos.y);
    });                
      
    container.mousemove(function(event){
        mouse_pos.x = event.pageX - this.offsetLeft;
        mouse_pos.y = event.pageY - this.offsetTop;
    
        if(paint == true) {
            if(paintOrErase == "paint") {
                ctx.strokeStyle = $("#paintColor").val();
            } else {
                ctx.strokeStyle = "white";
            }
            
            ctx.lineTo(mouse_pos.x, mouse_pos.y);
            ctx.stroke();
        } 
    });
    
    container.mouseup(function() {
       paint = false; 
    });
    
    container.mouseleave(function() {
       paint = false; 
    });
    
    $("#reset").click(function () {
        ctx.clearRect(0,0,canvas.width,canvas.height);
        paintOrErase = "paint";
        $("#erase").removeClass("eraseMode");
    });
    
    $("#save").click (function () {
       if(typeof(localStorage) != null){
           localStorage.setItem("imgCanvas",canvas.toDataURL());           
       }  else {
            window.alert("Your browser doesn't support local storage");
        }
    });
    
    $("#erase").click(function(){
        if(paintOrErase == "paint") {
            paintOrErase = "erase";
        } else {
            paintOrErase = "paint";
        }
       $(this).toggleClass("eraseMode");
    });
    
    $("#paintColor").change(function(){
       $("#circle").css("background-color",$(this).val()); 
    });
    
     $("#slider").slider({
        min: 3,
        max: 30,
        slide: function(event, ui){
            $("#circle").height(ui.value);
            $("#circle").width(ui.value);
            ctx.lineWidth = ui.value;
        }
    });
});