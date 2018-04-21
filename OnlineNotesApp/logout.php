<?php
if(isset($_SESSION['userid']) && $_GET['logout'] == 1){
    session_destroy();
    setcookie("rememberme", "", time()-3600);   
}
?>