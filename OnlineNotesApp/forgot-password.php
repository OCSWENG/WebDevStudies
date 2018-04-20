<?php

sessiont_start();

include('connection.php');

$missingEmail = '<p><strong>Please enter your email address!</strong></p>';
$invalidEmail = '<p><strong>Please enter a valid email address!</strong></p>';


if(empty($_POST['forgotemail'])){
    $errors .= $missingEmail;
} else {
    $email = filter_var ($_POST['forgotemail'], FILTER_SANITIZE_EMAIL);
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors .= $invalidEmail;
    }
}

if($errors){
    $resultMessage = '<div class="alert alert-danger">'. $errors . '</div>';
    exit;
}

$email  = $db->escapeString ( $email );
$sql = "SELECT * FROM users WHERE email ='$email'";
$db->exec('BEGIN');
$result = $db->query($sql);
$count = ($result->numColumns() && $result->columnType(0) != SQLITE3_NULL);
if($count != 1){
    echo '<div class="alert alert-danger">That email does not exist on our database!</div>';  
    exit;
}

$row = $result->fetchArray(SQLITE3_ASSOC);
$user_id = $row['user_id'];
$key = bin2hex(openssl_random_pseudo_bytes(16));
time = time();
$status = 'pending';
$sql = "INSERT INTO forgotpassword (`user_id`, `rkey`, `time`, `status`) VALUES ('$user_id', '$key', '$time', '$status')";
$result = $db->query($sql);

$db->exec('COMMIT');
if(!$result){
    echo '<div class="alert alert-danger">There was an error inserting the users details in the database!</div>'; 
    exit;
}

            //Send email with link to resetpassword.php with user id and activation code

$message = "Please click on this link to reset your password:\n\n";
$message .= "http://Blahwebhostingsite.com/resetpassword.php?user_id=$user_id&key=$key";
if(mail($email, 'Reset your password', $message, 'From:'.'Blahwebhostingsite@gmail.com')){
        //If email sent successfully
                //print success message
       echo "<div class='alert alert-success'>An email has been sent to $email. Please click on the link to reset your password.</div>";
}

    ?>