<?php
    $host = "127.0.0.1";
    $dbuser = "root";
    $dbpass = "";
    $dbname = "final_lab";

    function getConnection(){
        $con = mysqli_connect($GLOBALS['host'], $GLOBALS['dbuser'], $GLOBALS['dbpass'], $GLOBALS['dbname']);
        
        
        if (mysqli_connect_errno()) {
            die("Database connection failed: " . mysqli_connect_error());
        }
        
        return $con;
    }
?>