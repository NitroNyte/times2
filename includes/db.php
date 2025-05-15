<?php

//Only to get the connection here
function getConnection()
{
    //$conn = new mysqli("sql7.freesqldatabase.com", "sql7777708", "faRFydU6WE", "sql7777708",3306);
    $conn = new mysqli("localhost", "root", "", "times2db");
    if ($conn) {
        return $conn;
    } else {
        echo "Db is not working";
    }
}

?>
