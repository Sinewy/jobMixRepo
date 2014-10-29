<?php
/**
 * Created by IntelliJ IDEA.
 * User: jurez
 * Date: 10/10/14
 * Time: 9:45
 */

require_once("session.php");
require_once("dbc.php");
require_once("globalFunctions.php");

if(isset($_POST["colorid"]) && isset($_POST["collectionid"])) {
    $colorId = $_POST["colorid"];
    $collectionId = $_POST["collectionid"];
	$out = [];
	$pData = findAllProductsForColorAndCollection($colorId, $collectionId);
	foreach($pData as $key => $value) {
        $out[$key] = $value;
	}
	echo json_encode($out);
}

