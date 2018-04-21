<?php

class DB_PORT extends SQLite3 {
    function __construct (){
        $this->open('db/notes');   
    }
    
    // must wrap the call around a begin and commit
    function numRows (sql_statement){
        $rows = $this->query("SELECT COUNT(*) as count FROM USERIDS");
        $row = $rows->fetchArray();
        $numRows = $row['count'];
        return $numRows;
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