<?php require_once("includes/session.php"); ?>
<?php require_once("includes/dbc.php"); ?>
<?php require_once("includes/globalFunctions.php"); ?>
<?php require_once("includes/formValidationFunctions.php"); ?>
<?php confirmLoggedInOnIndex(); ?>

<?php

if(isset($_POST["login"])) {

    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    if(!hasPresence($username) || !hasPresence($password)) {
        $errors["authenticUser"] = "Both username and password are required.";
    }

    if(empty($errors)) {
        $userFound = attemptLogin($username, $password);
        if ($userFound) {
            $_SESSION["UserID"] = $userFound["UserID"];
            $_SESSION["Username"] = $userFound["Username"];
            redirectTo("jumix.php");
        } else {
            // Failure
            $_SESSION["message"] = "Username/password not found.";
        }
    }
} else {
    $username = "";
}

?>

<?php include("includes/headerLogin.php"); ?>

<section class="loginSection">
    <form action="index.php" method="POST" class="loginForm">
        <fieldset>
            <legend>Please LogIn</legend>
            <label for="username">Username :</label>
            <input type="text" id="username" name="username" size="25" value="<?php echo htmlspecialchars($username); ?>" placeholder="username" />
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" size="25" value="" placeholder="password" />
            <input type="hidden" name="login" value="TRUE" />
            <input type="submit" value="Login" class="button right" />
        </fieldset>
    </form>

    <?php echo displayMessage(); ?>
    <?php echo formErrors($errors); ?>

</section>


<?php

//$q = "SELECT * FROM user";
//$result = mysqli_query($connection, $q);
//if (!$result) {
//    die("Database query failed.");
//}
//while($users = mysqli_fetch_assoc($result)) {
//    echo "<div>" . $users["Username"]. "</div>";
//}
//mysqli_free_result($result);


//Function to add custom user
$uname = "user";
//$uname = "jumix";
$pwd = "user";
//$pwd = "jub3mix4vit6";
$email = "jumix@jub.si";

//addUser($uname, $pwd, $email);

function addUser($uname, $pwd, $email) {
    global $connection;
    $hashedPassword = passwordEncrypt($pwd);
    $queryInsertUser = "INSERT INTO `user` (`Username`, `Password`, `Email`) ";
    $queryInsertUser .= "VALUES ('$uname', '$hashedPassword', '$email')";
    $resultInsertUser = mysqli_query($connection, $queryInsertUser);
    confirmQuery($resultInsertUser);
}
//END Function to add custom user

?>

<!--Footer Row-->
<footer class="row stickyFooter">
<?php include("includes/footer.php"); ?>