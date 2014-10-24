<?php
/**
 * Created by IntelliJ IDEA.
 * User: jurez
 * Date: 10/10/14
 * Time: 9:45
 */

require_once("dbc.php");
require_once("globalFunctions.php");

if(isset($_POST["productId"])) {
    $id = $_POST["productId"];
    $data = findProductById($id);
    echo json_encode($data);
}

if(isset($_GET["productId"])) {
    $id = $_GET["productId"];
    $data = findProductById($id);
    echo json_encode($data);
}
