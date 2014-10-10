<?php
/**
 * Created by IntelliJ IDEA.
 * User: jurez
 * Date: 10/10/14
 * Time: 14:28
 */

require_once("dbc.php");
require_once("globalFunctions.php");

if(isset($_POST["pid"])) {
    $pid = $_POST["pid"];
    $out = collectionsListViewSearch($pid);
    echo $out;
}

