<?php
session_start();
include('connection.php');

$user_id = $_SESSION['user_id'];
//get the current time
$time = time();
//run a query to create new note
$sql = "INSERT INTO notes (`user_id`, `note`, `time`) VALUES ($user_id, '', '$time')";
$db->exec("BEGIN");
$result = $db->query($sql);
$db->exec("COMMIT");
if(!$result){
    echo 'error';
}else{
    // return the auto generated id used in the last query
    echo $db->lastInsertRowID();   
}

$db->close();
?>