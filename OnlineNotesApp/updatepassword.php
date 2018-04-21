<?php
//start session and connect
session_start();
include ('connection.php');

//define error messages
$missingCurrentPassword = '<p><strong>Enter your Current Password!</strong></p>';
$incorrectCurrentPassword = '<p><strong>The password entered is incorrect!</strong></p>';
$missingPassword = '<p><strong>Enter a new Password!</strong></p>';
$invalidPassword = '<p><strong>Your password should be at least 6 characters long and inlcude one capital letter and one number!</strong></p>';
$differentPassword = '<p><strong>Passwords do not match!</strong></p>';
$missingPassword2 = '<p><strong>Confirm your password</strong></p>';

//check for errors
if(empty($_POST["currentpassword"])){
    $errors .= $missingCurrentPassword;
}else{
    $currentPassword = $_POST["currentpassword"];
    $currentPassword = filter_var($currentPassword, FILTER_SANITIZE_STRING);
    $currentPassword = $db->escapeString ($currentPassword);
    $currentPassword = hash('sha256', $currentPassword);
    //check if given password is correct
    $userid = $_SESSION["userid"];
    $sql = "SELECT password FROM users WHERE userid='$userid'";
    $sql_count = "SELECT COUNT(password) as count FROM users WHERE userid='$userid'";
    $db->exec('BEGIN');
    $result = $db->query( $sql);     
    $count = $db->numRows($sql_count);
    $db->exec('COMMIT');
    if($count !== 1){
        echo '<div class="alert alert-danger">There was a problem running the query</div>';
    }else{
        $row =  $result->fetchArray(SQLITE3_ASSOC);
        if($currentPassword != $row['password']){
            $errors .= $incorrectCurrentPassword;
        }
    } 
}

if(empty($_POST["password"])){
    $errors .= $missingPassword; 
}elseif(!(strlen($_POST["password"])>6
         and preg_match('/[A-Z]/',$_POST["password"])
         and preg_match('/[0-9]/',$_POST["password"])
        )
       ){
    $errors .= $invalidPassword; 
}else{
    $password = filter_var($_POST["password"], FILTER_SANITIZE_STRING); 
    if(empty($_POST["password2"])){
        $errors .= $missingPassword2;
    }else{
        $password2 = filter_var($_POST["password2"], FILTER_SANITIZE_STRING);
        if($password !== $password2){
            $errors .= $differentPassword;
        }
    }
}

//if there is an error print error message
if($errors){
    $resultMessage = "<div class='alert alert-danger'>$errors</div>";
    echo $resultMessage;   
}else{
    $password = $db->escapeString($password);
    $password = hash('sha256', $password);
    //else run query and update password
    $sql = "UPDATE users SET password='$password' WHERE userid='$userid'";
     $db->exec('BEGIN');
    $result = $db->query( $sql);
     $db->exec('COMMIT');
    if(!$result){
        echo "<div class='alert alert-danger'>Try again later.</div>";
    }else{
        echo "<div class='alert alert-success'>Your password has been updated successfully.</div>";
    }   
}

?>