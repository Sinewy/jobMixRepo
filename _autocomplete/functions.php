<?php
/**
 * Created by IntelliJ IDEA.
 * User: jurez
 * Date: 10/8/14
 * Time: 11:14
 */

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "masterj";
$dbname = "autocomplet";
$dbc = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if(mysqli_connect_errno()) {
    die("Database connection failed: " .
        mysqli_connect_error() . " (" . mysqli_connect_errno() . ")"
    );
}

function findCountries($serachString) {
    global $dbc;
    $query  = "SELECT * ";
    $query .= "FROM country ";
    $query .= "WHERE country_name LIKE '%{$serachString}%' ";
    $result = mysqli_query($dbc, $query);
    confirmQuery($result);
    return $result;
}

function confirmQuery($resultSet) {
    global $dbc;
    if (!$resultSet) {
        echo mysqli_error($dbc);
        die("Database query failed.");
    }
}