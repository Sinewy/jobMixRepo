<?php
/**
 * Created by IntelliJ IDEA.
 * User: jurez
 * Date: 10/30/14
 * Time: 8:09
 */

require_once("dbc.php");
require_once("globalFunctions.php");

if(isset($_POST["formulaId"]) && isset($_POST["selectedCanSizeId"])) {
    $cansizeid = $_POST["selectedCanSizeId"];
    $formulaid = $_POST["formulaId"];

    $basePriceData = getPriceForBase($formulaid, $cansizeid);
    $colorantsData = getPricesAndQuantitiesForColorants($formulaid);

    $basePrice = floatval($basePriceData["price"]);
    $canSize = floatval(strstr($basePriceData["can"], " ", true));

    $price = 0;

    foreach($colorantsData as $value) {
        $price +=  ((floatval($value["price"]) * floatval($value["quantity"]))/1500) * $canSize;
    }

    $price += $basePrice;
    $return = [];

    $return["price"] = round($price, 2);;
    $return["priceListName"] = $basePriceData["name"];
    $return["baseName"] = $basePriceData["baseName"];
    $return["basePrice"] = $basePrice;

    echo json_encode($return);
}


