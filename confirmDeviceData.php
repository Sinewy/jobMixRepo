<?php require_once("includes/session.php"); ?>
<?php require_once("includes/dbc.php"); ?>
<?php require_once("includes/setLanguage.php"); ?>
<?php require_once("includes/globalFunctions.php"); ?>
<?php require_once("includes/formValidationFunctions.php"); ?>
<?php include("includes/headerActivation.php"); ?>

<?php

if(isset($_GET["ac"])) {
    $activationCode = trim($_GET["ac"]);
    $response = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?address=Univerza%20v%20Ljubljani&sensor=false");
//    $response = file_get_contents("https://api.twitter.com/1.1/search/tweets.json?q=%23superbowl&result_type=recen");
    $parsedData = json_decode($response);
    $status = strtolower($parsedData->{"status"});

    if($status == "ok") {
        $isAutomatic = "YES";
        $serialNumber = "FD7GFD83N0-923G3I9V32V9VJFE";
        $cName = "John Doe";
        $cPhone = "+555-3245-23-4321";
        $cEmail = "john.doe@gmail.com";
        $oTitle = "Bauhaus Slovenija Smartno Ljubljana";
        $oStreet = "Bauhaus Streewet 6234573";
        $oZipCity = "1235667 Ljuljuljubljana";
        $oPhone = "+386 1 3523 435 45";
        $oFax = "+386 1 3523 435 40";
        $oEmail = "information@bauhausSlovenia.com";
        $oWeb = "http://www.bauhausslovenija.com";
    } else {
        $errors = $lang["Wrong activation code"];
        redirectTo("activateDevice.php?error=" . $errors);
    }
}


    if(isset($_POST["wrongMachine"])) {
        $errors = $lang["Wrong machine. Try different activation code."];
//        echo $errors;
        redirectTo("activateDevice.php?error=" . $errors);
    } else if(isset($_POST["confirm"])) {
        if(isset($_POST["numberOfCanisters"]) && trim($_POST["numberOfCanisters"]) != "") {
            redirectTo("getActivationData.php?error=" . $errors);
        } else {
            $errors["noCanisters"] = $lang["Please choose number of canisters for this machine."];
            $isAutomatic = $_POST["isAutomatic"];
            $serialNumber = $_POST["serialNumber"];
            $cName = $_POST["cName"];
            $cPhone = $_POST["cPhone"];
            $cEmail = $_POST["cEmail"];
            $oTitle = $_POST["oTitle"];
            $oStreet = $_POST["oStreet"];
            $oZipCity = $_POST["oZipCity"];
            $oPhone = $_POST["oPhone"];
            $oFax = $_POST["oFax"];
            $oEmail = $_POST["oEmail"];
            $oWeb = $_POST["oWeb"];
        }
    }
?>


<section class="confirmDeviceData clearFix">
    <form action="confirmDeviceData.php" method="POST" class="confirmDeviceDataForm">
        <fieldset>
            <p><?php echo $lang["Confirm device data"]; ?></p>
            <div class="line left">
                <div class="lineTitle left"><?php echo $lang["Automatic mixer:"]; ?></div>
                <input class="disabled left" type="text" id="isAutomatic" name="isAutomatic" value="<?php echo htmlspecialchars($isAutomatic); ?>" readOnly="true" />
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
                            <td><input class="disabled small left" type="text" id="oTitle" name="oTitle" value="<?php echo htmlspecialchars($oTitle); ?>" readOnly="true" /></td>
                        </tr>
                        <tr>
                            <td><?php echo $lang["Street:"]; ?></td>
                            <td><input class="disabled small left" type="text" id="oStreet" name="oStreet" value="<?php echo htmlspecialchars($oStreet); ?>" readOnly="true" /></td>
                        </tr>
                        <tr>
                            <td><?php echo $lang["Zip/City:"]; ?></td>
                            <td><input class="disabled small left" type="text" id="oZipCity" name="oZipCity" value="<?php echo htmlspecialchars($oZipCity); ?>" readOnly="true" /></td>
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
                    <input type="submit" value="<?php echo $lang["Confirm"]; ?>" name="confirm" class="button" />
                </div>
                <?php echo formErrors($errors); ?>
            </div>
        </fieldset>
    </form>

</section>

<?php include("includes/footer.php"); ?>