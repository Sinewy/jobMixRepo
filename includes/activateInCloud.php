<?php
/**
 * Created by IntelliJ IDEA.
 * User: jurez
 * Date: 11/2/14
 * Time: 11:24 AM
 */

require_once("config.php");

if(isset($_POST["deviceSerial"])) {
	$deviceSerial = $_POST["deviceSerial"];
	$response = file_get_contents(API_ACTIVATE . "/" . $deviceSerial);
	$parsedData = json_decode($response);
	$status = strtolower($parsedData->{"status"});
	if($status == "ok") {
		echo "success";
	} else {
		echo "Device activation in the cloud FAILED.";
	}
}