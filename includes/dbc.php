<?php

$dbhost = "localhost";
$dbuser = "root";
//$dbpass = "jagode4";
$dbpass = "masterj";
//$dbname = "jumix";
$dbname = "jumixGuiRPi";

$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if(mysqli_connect_errno()) {
    die("Database connection failed: " .
        mysqli_connect_error() . " (" . mysqli_connect_errno() . ")"
    );
}
mysqli_set_charset($connection, "utf8mb4");