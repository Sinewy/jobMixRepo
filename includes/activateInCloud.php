<?php
/**
 * Created by IntelliJ IDEA.
 * User: jurez
 * Date: 11/2/14
 * Time: 11:24 AM
 */

require_once("dbc.php");
require_once("globalFunctions.php");

if(isset($_POST["deviceRemoteId"])) {
	$deviceSerial = $_POST["deviceRemoteId"];
    $apiKey = findApiKey();
	$response = file_get_contents(API_MIXER_DATA . "/" . $deviceSerial . API_ACTIVATE . "/" . $apiKey);
	$parsedData = json_decode($response);
	$status = strtolower($parsedData->{"status"});
	if($status == "ok") {
		echo "success";
	} else {
		echo "Device activation in the cloud FAILED.";
	}
}