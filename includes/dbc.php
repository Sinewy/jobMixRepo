<?php

$dbhost = "localhost";
$dbuser = "root";
//$dbpass = "jagode4";
$dbpass = "masterj";
$dbname = "jumixGuiRPi";

$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if(mysqli_connect_errno()) {
    die("Database connection failed: " .
        mysqli_connect_error() . " (" . mysqli_connect_errno() . ")"
    );
}
