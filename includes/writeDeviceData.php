<?php
require_once("dbc.php");
require_once("globalFunctions.php");

if(isset($_POST["confirmedData"])) {
    $isAutomatic = $_POST["isAutomatic"];
    $serialNumber = $_POST["serialNumber"];
    $deviceRemoteId = $_POST["deviceRemoteId"];
    $deviceCode = $_POST["deviceCode"];
    $cName = $_POST["cName"];
    $cPhone = $_POST["cPhone"];
    $cEmail = $_POST["cEmail"];

    $oRemoteId = $_POST["oRemoteId"];
    $oTitle = $_POST["oTitle"];
    $oCountryId = $_POST["oCountryId"];
    $oCountryName = $_POST["oCountryName"];
    $oStreet = $_POST["oStreet"];
    $oZip = $_POST["oZip"];
    $oCity = $_POST["oCity"];
    $oPhone = $_POST["oPhone"];
    $oFax = $_POST["oFax"];
    $oEmail = $_POST["oEmail"];
    $oWeb = $_POST["oWeb"];

    clearDataForMixerAndOwner();
    $currentOwnerId = writeOwnerInfoToDb($oRemoteId, $oTitle, $oCountryId, $oCountryName, $oStreet, $oZip, $oCity, $oPhone, $oFax, $oEmail, $oWeb);
    writeMixerInfoToDb($isAutomatic, $serialNumber, $deviceRemoteId, $deviceCode, $cName, $cPhone, $cEmail, $currentOwnerId);

    echo "success";

}


function clearDataForMixerAndOwner() {
    global $connection;
    $query  = "TRUNCATE TABLE device_info ";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);
    $query  = "DELETE FROM device_owner ";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);
    $query  = "ALTER TABLE device_owner AUTO_INCREMENT = 1 ";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);
}

function writeOwnerInfoToDb($oRemoteId, $oTitle, $oCountryId, $oCountryName, $oStreet, $oZip, $oCity, $oPhone, $oFax, $oEmail, $oWeb) {
    global $connection;
    $query  = "INSERT INTO device_owner ";
    $query  .= "(remoteId, title, countryId, countryName, street, zip, city, phone, fax, email, web) ";
    $query  .= "VALUES ";
    $query  .= "('{$oRemoteId}', '{$oTitle}', '{$oCountryId}', '{$oCountryName}', '{$oStreet}', '{$oZip}', '{$oCity}', '{$oPhone}', '{$oFax}', '{$oEmail}', '{$oWeb}') ";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);
    return mysqli_insert_id($connection);
}

function writeMixerInfoToDb($isAutomatic, $serialNumber, $deviceRemoteId, $deviceCode, $cName, $cPhone, $cEmail, $currentOwnerId) {
    global $connection;
    $query  = "INSERT INTO device_info ";
    $query  .= "(isAutomatic, serialNumber, remoteId, deviceCode, contactName, contactPhone, contactEmail, ownerId) ";
    $query  .= "VALUES ";
    $query  .= "({$isAutomatic}, '{$serialNumber}', '{$deviceRemoteId}', '{$deviceCode}', '{$cName}', '{$cPhone}', '{$cEmail}', {$currentOwnerId}) ";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);
}


?>