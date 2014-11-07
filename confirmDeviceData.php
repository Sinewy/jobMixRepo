<?php require_once("includes/session.php"); ?>
<?php require_once("includes/dbc.php"); ?>
<?php require_once("includes/setLanguage.php"); ?>
<?php require_once("includes/globalFunctions.php"); ?>
<?php require_once("includes/formValidationFunctions.php"); ?>

<?php

if(isset($_GET["ac"])) {
    $activationCode = trim($_GET["ac"]);
    $response = file_get_contents(API_DEVICE_INFO . "/" . $activationCode);
    $parsedData = json_decode($response);
    $status = strtolower($parsedData->{"status"});
    if($status == "ok") {
        rememberActivationCode($activationCode);
        $isAutomatic = $parsedData->mixer->is_automatic;
        $serialNumber = $parsedData->mixer->serial_number;
        $deviceRemoteId = $parsedData->mixer->id;
        $deviceCode = $parsedData->mixer->code;
        $cName = $parsedData->mixer->contact_person;
        $cPhone = $parsedData->mixer->contact_phone;
        $cEmail = $parsedData->mixer->contact_email;

        $oRemoteId = $parsedData->mixer->owner->id;
        $oTitle = $parsedData->mixer->owner->title;
        $oCountryId = $parsedData->mixer->owner->country_id;
        $oCountryName = $parsedData->mixer->owner->country_name;
        $oStreet = $parsedData->mixer->owner->street;
        $oZip = $parsedData->mixer->owner->zip;
        $oCity = $parsedData->mixer->owner->city;
        $oPhone = $parsedData->mixer->owner->phone;
        $oFax = $parsedData->mixer->owner->fax;
        $oEmail = $parsedData->mixer->owner->email;
        $oWeb = $parsedData->mixer->owner->web;
    } else {
        $errors = $lang["Wrong activation code"];
        redirectTo("activateDevice.php?error=" . $errors);
    }
}

if(isset($_POST["wrongMachine"])) {
    $errors = $lang["Wrong machine. Try different activation code."];
    redirectTo("activateDevice.php?error=" . $errors);
}

//else if(isset($_POST["confirm"])) {
//    $isAutomatic = $_POST["isAutomatic"];
//    $serialNumber = $_POST["serialNumber"];
//    $deviceRemoteId = $_POST["deviceRemoteId"];
//    $deviceCode = $_POST["deviceCode"];
//    $cName = $_POST["cName"];
//    $cPhone = $_POST["cPhone"];
//    $cEmail = $_POST["cEmail"];
//
//    $oRemoteId = $_POST["oRemoteId"];
//    $oTitle = $_POST["oTitle"];
//    $oCountryId = $_POST["oCountryId"];
//    $oCountryName = $_POST["oCountryName"];
//    $oStreet = $_POST["oStreet"];
//    $oZip = $_POST["oZip"];
//    $oCity = $_POST["oCity"];
//    $oPhone = $_POST["oPhone"];
//    $oFax = $_POST["oFax"];
//    $oEmail = $_POST["oEmail"];
//    $oWeb = $_POST["oWeb"];
//
//    if(isset($_POST["numberOfCanisters"]) && trim($_POST["numberOfCanisters"]) != "") {
//        clearDataForMixerAndOwner();
//        $currentOwnerId = writeOwnerInfoToDb($oRemoteId, $oTitle, $oCountryId, $oCountryName, $oStreet, $oZip, $oCity, $oPhone, $oFax, $oEmail, $oWeb);
//        writeMixerInfoToDb($isAutomatic, $serialNumber, $deviceRemoteId, $deviceCode, $cName, $cPhone, $cEmail, $currentOwnerId);
//        redirectTo("setInitialData.php?remoteId=" . $deviceRemoteId);
//    } else {
//        $errors["noCanisters"] = $lang["Please choose number of canisters for this machine."];
//
//    }
//}



?>

<?php include("includes/headerActivation.php"); ?>

<section class="confirmDeviceData clearFix">
    <form action="confirmDeviceData.php" method="POST" class="confirmDeviceDataForm">
        <fieldset>
            <p><?php echo $lang["Confirm device data"]; ?></p>
            <div class="line left">
                <div class="lineTitle left"><?php echo $lang["Automatic mixer:"]; ?></div>
                <input type="hidden" id="deviceRemoteId" name="deviceRemoteId" value="<?php echo htmlspecialchars($deviceRemoteId); ?>" />
                <input type="hidden" id="deviceCode" name="deviceCode" value="<?php echo htmlspecialchars($deviceCode); ?>" />
                <input type="hidden" id="isAutomatic" name="isAutomatic" value="<?php echo htmlspecialchars($isAutomatic); ?>" />
                <input class="disabled left" type="text" id="isAutomaticText" name="isAutomaticText" value="<?php echo $isAutomatic == 1 ? $lang["Yes"] : $lang["No"]; ?>" readOnly="true" />
            </div>
            <div class="line left">
                <div class="lineTitle left"><?php echo $lang["Serial number:"]; ?></div>
                <input class="disabled left" type="text" id="serialNumber" name="serialNumber" value="<?php echo htmlspecialchars($serialNumber); ?>" readOnly="true" />
            </div>
            <div class="line left">
                <div class="lineTitle left"><?php echo $lang["Contact name:"]; ?></div>
                <input class="disabled left" type="text" id="cName" name="cName" value="<?php echo htmlspecialchars($cName); ?>" readOnly="true" />
            </div>
            <div class="line left">
                <div class="lineTitle left"><?php echo $lang["Contact phone:"]; ?></div>
                <input class="disabled left" type="text" id="cPhone" name="cPhone" value="<?php echo htmlspecialchars($cPhone); ?>" readOnly="true" />
            </div>
            <div class="line left">
                <div class="lineTitle left"><?php echo $lang["Contact email:"]; ?></div>
                <input class="disabled left" type="text" id="cEmail" name="cEmail" value="<?php echo htmlspecialchars($cEmail); ?>" readOnly="true" />
            </div>
            <div class="line left">
                <div class="lineTitle left"><?php echo $lang["Owner:"]; ?></div>
                <div class="lineValue left">
                    <table>
                        <tr>
                            <td><?php echo $lang["Title:"]; ?></td>
                            <td>
                                <input type="hidden" id="oRemoteId" name="oRemoteId" value="<?php echo htmlspecialchars($oRemoteId); ?>" />
                                <input type="hidden" id="oCountryId" name="oCountryId" value="<?php echo htmlspecialchars($oCountryId); ?>" />
                                <input type="hidden" id="oCountryName" name="oCountryName" value="<?php echo htmlspecialchars($oCountryName); ?>" />
                                <input class="disabled small left" type="text" id="oTitle" name="oTitle" value="<?php echo htmlspecialchars($oTitle); ?>" readOnly="true" /></td>
                        </tr>
                        <tr>
                            <td><?php echo $lang["Street:"]; ?></td>
                            <td><input class="disabled small left" type="text" id="oStreet" name="oStreet" value="<?php echo htmlspecialchars($oStreet); ?>" readOnly="true" /></td>
                        </tr>
                        <tr>
                            <td><?php echo $lang["Zip/City:"]; ?></td>
                            <td><input type="hidden" id="oZip" name="oZip" value="<?php echo htmlspecialchars($oZip); ?>" />
                                <input type="hidden" id="oCity" name="oCity" value="<?php echo htmlspecialchars($oCity); ?>" />
                                <input class="disabled small left" type="text" id="oZipCity" name="oZipCity" value="<?php echo htmlspecialchars($oZip) . " " . htmlspecialchars($oCity); ?>" readOnly="true" />
                        </tr>
                        <tr>
                            <td><?php echo $lang["Phone/Fax:"]; ?></td>
                            <td><input class="disabled small left" type="text" id="oPhone" name="oPhone" value="<?php echo htmlspecialchars($oPhone); ?>" readOnly="true" /><br>
                                <input class="disabled small left" type="text" id="oFax" name="oFax" value="<?php echo htmlspecialchars($oFax); ?>" readOnly="true" /></td>
                        </tr>
                        <tr>
                            <td><?php echo $lang["Email:"]; ?></td>
                            <td><input class="disabled small left" type="text" id="oEmail" name="oEmail" value="<?php echo htmlspecialchars($oEmail); ?>" readOnly="true" /></td>
                        </tr>
                        <tr>
                            <td><?php echo $lang["Web:"]; ?></td>
                            <td><input class="disabled small left" type="text" id="oWeb" name="oWeb" value="<?php echo htmlspecialchars($oWeb); ?>" readOnly="true" /></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="lineForm left">
                <label for="numberOfCanisters"><?php echo $lang["Choose number of canisters:"]; ?></label>
                <select id="numberOfCanisters" name="numberOfCanisters">
                    <option value=""></option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                </select>
                <div class="lineButtons">
                    <input type="submit" value="<?php echo $lang["Wrong Machine"]; ?>" name="wrongMachine" class="button" />
                    <input type="button" id="confirmDeviceData" value="<?php echo $lang["Confirm"]; ?>" name="confirm" class="button" />
                </div>
                <?php echo formErrors($errors); ?>
            </div>
        </fieldset>
    </form>

</section>

<div class="pleaseWait">
    <p><?php echo $lang["Please wait."]; ?></p>
    <p><?php echo $lang["Initializing data..."]; ?></p>
    <p><img src="images/loaderAnimation2.gif"></p>
</div>

<?php include("includes/footerActivation.php"); ?>
<script>
    var lang = <?php echo json_encode($lang); ?>;
</script>
<script src="js/confirmDeviceData.js"></script>