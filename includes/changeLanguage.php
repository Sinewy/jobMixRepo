<?php
/**
 * Created by IntelliJ IDEA.
 * User: jurez
 * Date: 10/10/14
 * Time: 14:28
 */
require_once("session.php");
require_once("dbc.php");
require_once("globalFunctions.php");

if(isset($_POST["lang"])) {
    $lang = $_POST["lang"];

    var_dump($_POST);
    var_dump($_SESSION);

    // update entry in db
    global $connection;
    $query  = "UPDATE settings SET ";
    $query .= "language = '{$lang}' ";
    $query .= "WHERE id = 1 ";
    $query .= "LIMIT 1";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);
    if($result && mysqli_affected_rows($connection) == 1) {
        // Success
        $_SESSION["language"] = $lang;
        return true;
    } else {
        // Failure
        return null;
    }
}
