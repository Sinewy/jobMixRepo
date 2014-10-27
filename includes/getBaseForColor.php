<?php
/**
 * Created by IntelliJ IDEA.
 * User: jurez
 * Date: 10/10/14
 * Time: 14:28
 */

require_once("dbc.php");
require_once("globalFunctions.php");

if(isset($_POST["scid"])) {
	$scid = $_POST["scid"];

	$out = [];
	$data = findBaseForFormula($scid);
	foreach($data as $key => $value) {
		$out[$key] = $value;
	}
    $baseId =  $out[0]["id"];
    $prodId = $_POST["prodId"];
    $canSizeId = $_POST["canSize"];

    $baseInfo = [];
    $baseData = findBaseDetails($baseId, $prodId, $canSizeId);
    foreach($baseData as $key => $value) {
        $baseInfo[$key] = $value;
    }
	echo json_encode($baseInfo);
}

