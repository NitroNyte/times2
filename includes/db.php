<?php

//Only to get the connection here
function getConnection()
{
    $conn = new mysqli("localhost", "root", "", "times2db");
    if ($conn) {
        return $conn;
    } else {
        echo "Db is not working";
    }
}


?>
