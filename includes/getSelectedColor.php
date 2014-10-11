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
    $data = findColorById($scid);
//	foreach($data as $key => $value) {
//		$out[$key] = $value;
//	}
//    echo $data;
    echo json_encode($data);
}

