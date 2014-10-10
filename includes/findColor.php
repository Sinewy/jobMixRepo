<?php
/**
 * Created by IntelliJ IDEA.
 * User: jurez
 * Date: 10/10/14
 * Time: 9:45
 */

require_once("dbc.php");
require_once("globalFunctions.php");


if(isset($_GET["term"])) {
    $searchString = $_GET["term"];
    $result = findAllColorsWithFilter($searchString);
    $data = array();
    if(mysqli_num_rows($result) > 0) {
        while($product = mysqli_fetch_assoc($result)) {
            array_push($data, $product["name"]);
        }
    }
    echo json_encode($data);
}
