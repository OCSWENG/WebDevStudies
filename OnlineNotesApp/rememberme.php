<?php

session_start();

// USER is NOT LOGGED in AND the COOKIE REMEMBERME EXISTS
]if(!isset($_SESSION['user_id'])) && !empty($_COOKIE['rememberme'])){
    
    // GET AUTHENTICATORS FROM COOKIE
    
    list($authentifactor1, $authentificator2) = explode(',', $_COOKIE['rememberme']);
    
    $authentificator2 = hex2bin($authentificator2);
    
    $f2authentificator2 = hash('sha256', $authentificator2);
    
    
    // FIND AUTHENTIFICATOR1 in the REMEMBERME TABLE
    //$sql = "SELECT * FROM REMEMBERME WHERE authentifactor1 = '$authentifactor1' ";
    // $result = mysqli_query($link, $sql);
    
    $db->exec('BEGIN');

    $ret = $db->query("SELECT * FROM REMEMBERME WHERE authentifactor1 = '$authentifactor1'" ); //$statement->execute();//
   
    
    $row = $ret->fetchArray(SQLITE3_ASSOC);
    $row2 = $ret->fetchArray(SQLITE3_ASSOC);
    $db->exec('COMMIT');
    
    if(!$row){
        echo '<div class="alert alert-danger"> There was an error running the query.</div>';
        exit;
    }

    if ($row2) {
        echo '<div class="alert alert-danger"> The remember me process failed.</div>';
        exit;
    }

    if(!hash_equals($row['f2authentificator2'], $f2authentificator2)){
        echo '<div class="alert alert-danger">hash_equals returned false.</div>';
    } else {
        
        // GENERATE NEW AUTHENTICATORS AND STORE THEM IN A COOKIE and REMEMBERME TABLE
        
        $authentifactor1 = bin2hex(openssl_random_pseudo_bytes(10));
        
        $authentifactor2 = openssl_random_pseudo_bytes(20);
        
        function getCookieValue ($a, $b) {
            $c = $a . ",". bin2hex($b);
            return $c;
        }
        
        $cookieValue = getCookieValue($authentifactor1, $authentifactor2);
        
        setcookie ("rememberme", $cookieValue, time() + 1296000);
        
        // RUN THE QUERY to STORE THEM in REMEMBERME TABLE
        
        function f2 ($a) {
            $b = hash('sha256', $a);
            return $b;
        }
        
        $f2authentificator2 = f2($authentificator2);
        $user_id = $_SESSION['user_id'];
        $expiration = date('y-m-d h:i:s', time() + 1296000);
        
        $sql = "INSERT INTO REMEMBERME ('authentifactor1', 'f2authentificator2','user_id', 'expires')
        VALUES ('$authentifactor1', '$f2authentificator2', '$user_id', '$expiration')";
        
        // $result = mysqli_query($link, $sql);
        
        $db->exec('BEGIN');
        $ret = $db->query($sql); 
        $db->exec('COMMIT');
`
        if( !ret){
            echo '<div class="alert alert-danger">There was an error storing data to remember you next time.</div>';
        }
        
        // Log the user in and redirect to notes page
        $_SESSION['user_id'] = $row['user_id'];
        header("location:mainpageloggedin.php");        
    }
}

?>