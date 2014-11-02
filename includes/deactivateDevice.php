<?php
/**
 * Created by IntelliJ IDEA.
 * User: jurez
 * Date: 11/2/14
 * Time: 11:30 AM
 */

require_once("dbc.php");
require_once("globalFunctions.php");

if(isset($_POST["deviceSerial"])) {
	$deviceSerial = $_POST["deviceSerial"];
	$response = file_get_contents(API_DEACTIVATE_DEVICE . "/" . $deviceSerial);
	$parsedData = json_decode($response);
	$status = strtolower($parsedData->{"status"});
	if($status == "ok") {
		$data = deactivateDevice($deviceSerial);
		if($data !== null) {
			echo "success";
		} else {
			echo "Device deactivation locally FAILED.";
		}
	} else {
		echo "Device deactivation in the cloud FAILED.";
	}
}