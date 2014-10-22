<?php require_once("includes/session.php"); ?>
<?php require_once("includes/dbc.php"); ?>
<?php require_once("includes/setLanguage.php"); ?>
<?php require_once("includes/globalFunctions.php"); ?>
<?php
if(isset($_SESSION["language"])) {
    $_SESSION["language"] = null;
}
confirmActivated();

?>
