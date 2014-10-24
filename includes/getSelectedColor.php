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
    $data = findColorById($scid);
    echo json_encode($data);
}

