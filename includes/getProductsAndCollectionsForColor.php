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

if(isset($_POST["scid"])) {
	$scid = $_POST["scid"];
	$out = [];
	$pArr = [];
	$cArr = [];
	$pData = findAllProductsForColor($scid);
	foreach($pData as $key => $value) {
		$pArr[$key] = $value;
	}
	$cData = findAllCollectionsForColor($scid);
	foreach($cData as $key => $value) {
		$cArr[$key] = $value;
	}
	$out[0] = $pArr;
	$out[1] = $cArr;
	echo json_encode($out);
//	echo $out;
}

