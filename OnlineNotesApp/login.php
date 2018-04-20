<?php
session_start();

include('connection.php');

$missingEmail = '<p><strong>Please Enter your email address!</strong></p>';
$missingPassword = '<p><strong>Please Enter your password!</strong></p>';

if(empty($_POST['loginemail'])){
    $errors .= $missingEmail;
} else {
    $email = filter_var($_POST["loginemail"], FILTER_SANITIZE_EMAIL);
}

if(empty($_POST["loginpassword"])){
    $errors .= $missingPassword;   
}else{
    $password = filter_var($_POST["loginpassword"], FILTER_SANITIZE_STRING);
}

if($errors){
    //print error message
    $resultMessage = '<div class="alert alert-danger">' . $errors .'</div>';
    echo $resultMessage;   
}else{
    $email = $db->escapeString ($email);
    $password = $db->escapeString ($password);
    $password = hash('sha256', $password);
    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password' AND activation='activated'";
    $sql_count = "SELECT count(*) FROM users WHERE email='$email' AND password='$password' AND activation='activated'";
    $db->exec('BEGIN');
    $ret_count = $db->query($sql_count);
    $ret = $db->query($sql);
    
    if($ret_count !== 1){
        echo '<div class="alert alert-danger">Wrong Username or Password</div>';
        $db->close();
    }
    else {
        
        $row = $results->fetchArray();
        $db->exec('COMMIT');
        $_SESSION['user_id']=$row['user_id'];
        $_SESSION['username']=$row['username'];
        $_SESSION['email']=$row['email'];
    }
    if(empty($_POST['rememberme'])){
        //If remember me is not checked
        echo "success";
    }else{
        //Create two variables $authentificator1 and $authentificator2
        $authentificator1 = bin2hex(openssl_random_pseudo_bytes(10));
        
        $authentificator2 = openssl_random_pseudo_bytes(20);
        
        function f1($a, $b){
            $c = $a . "," . bin2hex($b);
            return $c;
        }
       
        //Store them in a cookie
        $cookieValue = f1($authentificator1, $authentificator2);
        setcookie(
            "rememberme",
            $cookieValue,
            time() + 1296000
        );
        
        
        function f2($a){
            $b = hash('sha256', $a); 
            return $b;
        }
        $f2authentificator2 = f2($authentificator2);
        $user_id = $_SESSION['user_id'];
        $expiration = date('Y-m-d H:i:s', time() + 1296000);
        //Run query to store them in rememberme table
        
        $sql = "INSERT INTO rememberme
        (`authentificator1`, `f2authentificator2`, `user_id`, `expires`)
        VALUES
        ('$authentificator1', '$f2authentificator2', '$user_id', '$expiration')";
        
        $db->exec('BEGIN');
        $result = $db->query($sql);
        $db->commit('COMMIT');
        
        if(!$result){
            echo  '<div class="alert alert-danger">There was an error storing data to remember you next time.</div>';  
        }else{
            echo "success";   
        }
        
    }
}
$db->close();
    