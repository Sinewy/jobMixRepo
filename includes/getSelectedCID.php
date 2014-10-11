<?php
/**
 * Created by IntelliJ IDEA.
 * User: jurez
 * Date: 10/10/14
 * Time: 9:45
 */

require_once("dbc.php");
require_once("globalFunctions.php");

if(isset($_POST["searchString"])) {
    $searchStr = $_POST["searchString"];
    $cid = findSelectedCollectionId($searchStr);
    echo $cid["id"];
}

