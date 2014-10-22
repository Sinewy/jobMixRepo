<?php

$lang = "";
if(isset($_SESSION["language"])) {
    $lang = $_SESSION["language"];
    include("includes/languages/" . $_SESSION["language"] . ".php");
} else {
    global $connection;
    $query  = "SELECT * ";
    $query .= "FROM settings ";
    $query .= "WHERE id = 1 ";
    $query .= "LIMIT 1";
    $result = mysqli_query($connection, $query);
    if (!$result) {
        echo mysqli_error($connection);
        die("Database query failed.");
    }
    if($data = mysqli_fetch_assoc($result)) {
        $lang = $data["language"];
        $_SESSION["language"] = $lang;
        include("includes/languages/" . $_SESSION["language"] . ".php");
    }
}
