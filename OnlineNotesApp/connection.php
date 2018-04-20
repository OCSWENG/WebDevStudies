<?php

class DB_PORT extends SQLite3 {
    function __construct (){
        $this->open('db/notes');   
    }
}

$db = new DB_PORT();
if( !$db){
    echo $db->lastErrorMsg();
    $db->close();
    exit;
}
else {
    echo "Opened database successfully \n";    
}

?>