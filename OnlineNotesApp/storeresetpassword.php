<?php
session_start();

include('connection.php');

// the user_id nad the key must be available 
if(!isset($_POST['user_id']) || !isset($_POST['key'])) {
    echo '<div class="alert alert-danger">There is no user_id or key available in the POST. Click on the link received by email.</div>';
    exit;
}

$user_id = $_POST['user_id'];
$key = $_POST['key'];
$time = time() - 86400;

// scrub the user_id and key
$user_id = $db->escapeString ( $user_id );
$key =  $db->escapeString ( $key );

// RUN the Query: Check the combo user_id and key exists and less than 24h old
$sql = "SELECT user_id FROM forgotpassword WHERE rkey='$key' AND user_id='$user_id' AND time > '$time' AND status='pending'";

 
$sql_count = "SELECT count(user_id) FROM forgotpassword WHERE rkey='$key' AND user_id='$user_id' AND time > '$time' AND status='pending'";

$db->exec('BEGIN');
$ret_count = $db->query($sql_count);
$ret = $db->query($sql); 
                    
if ( $ret_count !== 1){
    echo '<div class="alert alert-danger">Please try again.</div>';
    $db->close();
    exit;    
}

$db->exec('COMMIT');

//Define error messages
$missingPassword = '<p><strong>Please enter a Password!</strong></p>';
$invalidPassword = '<p><strong>Your password should be at least 6 characters long and inlcude one capital letter and one number!</strong></p>';
$differentPassword = '<p><strong>Passwords don\'t match!</strong></p>';
$missingPassword2 = '<p><strong>Please confirm your password</strong></p>';


if(empty($_POST["password"])) {
    $errors .= $missingPassword;
}elseif(!(strlen($_POST["password"])>6
         and preg_match('/[A-Z]/',$_POST["password"])
         and preg_match('/[0-9]', $_POST["password"])
         )
       ){
        $errors .= $invalidPassword;
}else {
    $password = filter_var($_POST["password"], FILTER_SANITIZE_STRING);
    if(empty($_POST["password2"])){
        $erros .= $missingPassword2;
    }else {
        $password2 = filter_var($_POST["password2"], FILTER_SANITIZE_STRING);
        if($password !== $password2){
            $errors .= $differentPassword;
        }
    }
}

if($errors){
    $resultMessage = '<div class="alert alert-danger">' . $errors .'</div>';
    echo $resultMessage;
    exit;
}

$password = $db->escapeString($password);
$password = hash('sha256', $password);

$sql = "UPDATE users SET password='$password' WHERE user_id='$user_id'";

$db->exec('BEGIN');
$result = $db->query($sql);
$db->exec('COMMIT');

if(!$result){
    echo '<div class="alert alert-danger">There was a problem storing the new password in the database!</div>';
    exit;
}

$sql = "UPDATE forgotpassword SET status='used' WHERE rkey='$key' AND user_id='$user_id'";
$db->exec('BEGIN');
$result = $db->query($sql);
$db->exec('COMMIT');

if(!$result){
    echo '<div class="alert alert-danger">Error running the query</div>';
}else{
    echo '<div class="alert alert-success">Your password has been update successfully!<a href="index.php">Login</a></div>';  
}
$db->close();
?>