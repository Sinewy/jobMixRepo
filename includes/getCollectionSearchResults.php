<?php
/**
 * Created by IntelliJ IDEA.
 * User: jurez
 * Date: 10/10/14
 * Time: 14:28
 */

require_once("dbc.php");
require_once("globalFunctions.php");

if(isset($_POST["cid"])) {
    $cid = $_POST["cid"];
	$out = [];
//    $out = collectionsListViewSearch($pid);
    $data = findAllProductsForCollection($cid);
	foreach($data as $key => $value) {
		$out[$key] = $value;
	}
//    echo findAllCollectionsForProduct($pid);
    echo json_encode($out);
}

