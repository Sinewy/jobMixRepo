<?php
/**
 * Created by IntelliJ IDEA.
 * User: jurez
 * Date: 10/10/14
 * Time: 14:28
 */

require_once("dbc.php");
require_once("globalFunctions.php");

if(isset($_POST["pid"]) && isset($_POST["cid"])) {
	$pid = $_POST["pid"];
	$cid = $_POST["cid"];
	$out = [];
    $data = findAllColorsForProductAndCollection($pid, $cid);
	foreach($data as $key => $value) {
		$out[$key] = $value;
	}
    echo json_encode($out);
}

