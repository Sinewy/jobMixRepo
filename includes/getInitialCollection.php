<?php
/**
 * Created by IntelliJ IDEA.
 * User: jurez
 * Date: 10/10/14
 * Time: 9:45
 */

require_once("dbc.php");
require_once("globalFunctions.php");

if(isset($_POST["code"])) {
    $code = $_POST["code"];
    $data = findInitialCollectionByCode($code);
    echo json_encode($data);
}
//
//if(isset($_GET["code"])) {
//    $code = $_GET["code"];
//    $data = findInitialCollectionByCode($code);
//    echo json_encode($data);
//}
