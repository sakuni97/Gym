<?php

function dbConn() {
    $server = "localhost";
    $user = "root";
    $password = "";
    $dbname = "gym";

    $conn = new mysqli($server, $user, $password, $dbname);

    if ($conn->connect_error) {
        die("Database Error :" . $conn->connect_error);
    } else {
        return $conn;
    }
}

function cleanInput($input = null) {

    return htmlspecialchars(stripcslashes(trim($input)));
}

?>