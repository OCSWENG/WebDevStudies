<?php

    session_start();
    include('connection.php');

    //get the id of the note sent through Ajax
    $id = $_POST['id'];
    //get the content of the note
    $note = $_POST['note'];
    //get the time
    $time = time();
    //run a query to update the note
    $db->exec("BEGIN");
    $sql = "UPDATE notes SET note='$note', time = '$time' WHERE id='$id'";
    $result = $db->query($sql);
    $db->exec("COMMIT");

    if(!$result) {
        echo 'error';
    }
    $db->close();
?>