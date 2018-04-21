<?php
session_start();
include('connection.php');

//get the userid
$userid = $_SESSION['userid'];
//run a query to delete empty notes
$sql = "DELETE FROM notes WHERE note=''";
$db->exec("BEGIN");
$result = $db->query($sql);
if(!$result){
    echo '<div class="alert alert-warning">An error occured!</div>'; exit;
}
//run a query to look for notes corresponding to userid
$sql = "SELECT * FROM notes WHERE userid ='$userid' ORDER BY time DESC";
$sqlCount  = "SELECT count(*) FROM notes WHERE userid ='$userid' ORDER BY time DESC";
$resultCount = $db->query($sqlCount);

//shows notes or alert message
if($result = $db->query($sql)){
    if($resultCount>0){
        while($row = $result->fetcharray(SQLITE3_ASSOC)){
            $note_id = $row['id'];
            $note = $row['note'];
            $time = $row['time'];
            $time = date("F d, Y h:i:s A", $time);
            
            echo "
        <div class='note'>
            <div class='col-xs-5 col-sm-3 delete'>
                <button class='btn-lg btn-danger' style='width:100%'>delete</button>
            
            </div>
            <div class='noteheader' id='$note_id'>
                <div class='text'>$note</div>
                <div class='timetext'>$time</div>    
            </div>
        </div>";
        }
    }else{
        echo '<div class="alert alert-warning">You have not created any notes yet!</div>'; exit;
    }
    
}else{
    echo '<div class="alert alert-warning">An error occured!</div>'; exit;
//    echo "ERROR: Unable to excecute: $sql." . mysqli_error($link);
}
$db->close();
?>