<?php
/**
 * Created by IntelliJ IDEA.
 * User: jurez
 * Date: 10/10/14
 * Time: 9:45
 */

require_once("dbc.php");
require_once("globalFunctions.php");

if(isset($_POST["collectionId"])) {
    $id = $_POST["collectionId"];
    $data = findCollectionById($id);
    echo json_encode($data);
}

//if(isset($_GET["collectionId"])) {
//    $id = $_GET["collectionId"];
//    $data = findCollectionById($id);
//    echo json_encode($data);
//}
