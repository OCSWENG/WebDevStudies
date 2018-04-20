<?php

include('connection.php'); 

$missingUserName = '<p><strong>Please Enter a User Name!</strong></p>';
$missingEmail = '<p><strong>Please Enter your Email Address!</strong></p>';
$invalidEmail = '<p><strong>Please Enter a Valid Email Address!</strong></p>';
$missingPassword = '<p><strong>Please Enter a Password!</strong></p>';
$invalidPassword = '<p><strong>Your password should be at least 6 characters long and include one capital letter and one number!</strong></p>';
$differentPassword = '<p><strong>Passwords do not match!</strong></p>';
$missingPassword2 = '<p><strong>Please Confirm your Password</strong></p>';

//<!--Get username, email, password, password2-->
//Get username

if( empty($_POST["username"])){
    $errors .= $missingUsername;
} else {
    $username = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
}

//Get email
if(empty($_POST["email"])) {
    $errors .= $missingEmail;
} else {
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors .= $invalidEmail;
    }
}

//Get passwords
if(empty($_POST["password"])){
    $errors .= $missingPassword;
} elseif (!(strlen($_POST["password"])>6
            and preg_match('/[A-Z]/',$_POST["password"])
            and preg_match('/[0-9]/', $_POST["password"])
            )
          ){
    $errors .= $invalidPassword;    
} else {
    $password = filter_var($_POST["password"], FILTER_SANITIZE_STRING);
    if(empty($_POST["password2"])) {
        $errors .= $missingPassword2;
    } else {
        $password2 = filter_var($_POST["password2"], FILTER_SANITIZE_STRING);
        if($passowrd !== $password2){
            $errors .= $differentPassword;
        }
    }
}

//If there are any errors print error
if($errors){
    $resultMessage = '<div class="alert alert-danger">' . $errors . '</div>';
    echo $resultMessage;
    exit;
}

/* testing
$username = 'Alfred45*eyed';
$email = "hammock45@yahoo.com";
$password = "candyPaint";
*/

//Prepare variables for the queries
//$username = mysqli_real_escape_string($link, $username);
//$email = mysqli_real_escape_string($link, $email);
//$password = mysqli_real_escape_string($link, $password);

// bigger hash is required in real world applications
$password = hash('sha256', $password);



$db->exec('BEGIN');
//$statement = $db->prepare("SELECT * FROM USERS WHERE username = :name;");
//$statement->bindValue(':name', $username);

$ret = $db->query("SELECT * FROM USERS WHERE username = '$username'" ); //$statement->execute();//

$row = $ret->fetchArray(SQLITE3_ASSOC);
if ( $row ) {
    echo '<div class="alert alter-danger>The email :' . $email . ' is already registered. </div>';

/*    
    while($row = $ret->fetchArray(SQLITE3_ASSOC) ) {
      echo "USERNAME = ". $row['username'] . "\n";
      echo "EMAIL = ". $row['email'] ."\n";
      echo "PASSWORD = ". $row['password'] ."\n";
      echo "ACTIVATION = ".$row['activation'] ."\n\n";
   }
    */
        $db->close();
    exit;
}
$db->exec('COMMIT');

//Create a unique  activation code
$activationKey = bin2hex(openssl_random_pseudo_bytes(16));


$sql = <<<EOF
    INSERT INTO USERS (username,email, password, activation) VALUES ('$username', '$email', '$password', '$activationKey');
EOF;

//$stmt = $db->prepare('SELECT bar FROM foo WHERE id=:id');
//$stmt->bindValue(':id', 1, SQLITE3_INTEGER);


$db->exec('BEGIN');
$result = $db->query($sql);
$db->exec('COMMIT');

if(!$result){
      echo $db->lastErrorMsg();
    $db->close();
    exit;
   } else {
      echo "Insert created successfully\n";
   }


$message = "Click on this link to activate your account:\n\n\n";
$message .= "http://mynotes.websitehosting.com/activate.php?email=" . urlencode($email) . "&key=$activationKey";
if(mail($email, 'Confirm Registration', $message, 'From: developmentisland@gmail.com')) {
    echo "<div class='alert alert-success'> Thanks for registering! A confirmation email has been sent to $emal.
    Click on the activation link to activate your account.</div>";
}

$db->close();

?>
