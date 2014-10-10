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
//    syslog(LOG_WARNING, "We are inside IF");
    $searchString = $_GET["term"];
    $result = findAllProductsWithFilter($searchString);
    $data = array();
    if(mysqli_num_rows($result) > 0) {
        while($product = mysqli_fetch_assoc($result)) {
//            syslog(LOG_WARNING, $product);
//            $data[$product["id"]] = $product["name"];
//            array_push($data, $product);
            array_push($data, $product["name"]);
        }
    }
//    syslog(LOG_WARNING, listArray($data, " - data"));
    echo json_encode($data);
//    echo json_encode($result);
//    echo $result;
}

//function listArray($array, $str) {
//    $out = "";
//    foreach ($array as $key => $value) {
//        $out .= $key . " - key, " . $value . " - value, FOR: " . $str . " ****** ";
//    }
//    return $out;
//}
//
//
//syslog(LOG_WARNING, listArray($_GET, " - get"));
//syslog(LOG_WARNING, listArray($_SESSION, " - session"));
//syslog(LOG_WARNING, listArray($_POST, " - post"));
//syslog(LOG_WARNING, listArray($_REQUEST, " - request"));

