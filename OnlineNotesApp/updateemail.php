<?php
//start session and connect
session_start();
include ('connection.php');

//get userid and new email sent through Ajax
$userid = $_SESSION['userid'];
$newemail = $_POST['email'];

//check if new email exists
$db->exec("BEGIN");
$sql = "SELECT * FROM users WHERE email='$newemail'";
$sqlCount = "SELECT count(*) FROM users WHERE email='$newemail'";

$result = $db->query($sql);
$count  = ($result->numColumns() && $result->columnType(0) != SQLITE3_NULL);
if($count>0){
    echo "<div class='alert alert-danger'>There is already as user registered with that email! Please choose another one!</div>"; exit;
}


//get the current email
$sql = "SELECT * FROM users WHERE userid='$userid'";
$result = db->query($sql);

$count = ($result->numColumns() && $result->columnType(0) != SQLITE3_NULL);

if($count == 1){
    $row = $result->fetchArray(SQLITE3_ASSOC);
    $email = $row['email']; 
}else{
    echo "<div class='alert alert-danger'>There was an error retrieving the email from the database</div>";exit;   
}

//create a unique activation code
$activationKey = bin2hex(openssl_random_pseudo_bytes(16));

//insert new activation code in the users table
$sql = "UPDATE users SET activation2='$activationKey' WHERE userid = '$userid'";
$result = db->query($sql);
if(!$result){
    echo "<div class='alert alert-danger'>There was an error inserting the user details in the database.</div>";exit;
}else{
    //send email with link to activatenewemail.php with current email, new email and activation code
    $message = "Please click on this link prove that you own this email:\n\n";
$message .= "http://mynotes.thecompletewebhosting.com/activatenewemail.php?email=" . urlencode($email) . "&newemail=" . urlencode($newemail) . "&key=$activationKey";
if(mail($newemail, 'Email Update for you Online Notes App', $message, 'From:'.'developmentisland@gmail.com')){
       echo "<div class='alert alert-success'>An email has been sent to $newemail. Please click on the link to prove you own that email address.</div>";
}
    
}
$db->exec("COMMIT");
$db->close();


?>