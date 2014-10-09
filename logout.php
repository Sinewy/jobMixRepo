<?php require_once("includes/session.php"); ?>
<?php require_once("includes/globalFunctions.php"); ?>

<?php
$_SESSION = array();
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time()-42000, '/');
}
session_destroy();
redirectTo("jumix.php");
?>