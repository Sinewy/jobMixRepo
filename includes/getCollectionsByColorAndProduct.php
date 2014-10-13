<?php
/**
 * Created by IntelliJ IDEA.
 * User: jurez
 * Date: 10/10/14
 * Time: 9:45
 */

require_once("dbc.php");
require_once("globalFunctions.php");

if(isset($_POST["colorid"]) && isset($_POST["productid"])) {
    $colorId = $_POST["colorid"];
    $productId = $_POST["productid"];
    $out = [];
    $pData = findAllCollectionsForColorAndProduct($colorId, $productId);
    foreach($pData as $key => $value) {
        $out[$key] = $value;
    }
    echo json_encode($out);
}

