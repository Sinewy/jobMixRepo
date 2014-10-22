<?php require_once("includes/session.php"); ?>
<?php require_once("includes/dbc.php"); ?>
<?php require_once("includes/setLanguage.php"); ?>
<?php require_once("includes/globalFunctions.php"); ?>
<?php require_once("includes/formValidationFunctions.php"); ?>


<?php

if(isset($_POST["activate"])) {
    $activationCode = trim($_POST["activationCode"]);
    if(!hasPresence($activationCode)) {
        $errors["activationCode"] = $lang["Activation code cannot be empty. Please enter the code."];
    }
    if(empty($errors)) {
        redirectTo("confirmDeviceData.php?ac=". $activationCode);
    }
}

if(isset($_GET["error"])) {
    $errors["responseError"] = $_GET["error"];
}

?>

<?php include("includes/headerActivation.php"); ?>

<section class="activateDevice">
    <p><?php echo $lang["Enter Activation Code"]; ?></p>
    <form action="activateDevice.php" method="POST" class="activateDeviceForm">
        <fieldset>
            <input type="text" id="activationCode" name="activationCode" size="50" value="" placeholder="<?php echo $lang["activation code"]; ?>" />
            <input type="hidden" name="activate" value="TRUE" />
            <input type="submit" value="<?php echo $lang["Activate"]; ?>" class="button right" />
        </fieldset>
    </form>
    <?php echo formErrors($errors); ?>
</section>

<?php include("includes/footer.php"); ?>