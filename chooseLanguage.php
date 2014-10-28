<?php require_once("includes/session.php"); ?>
<?php require_once("includes/dbc.php"); ?>
<?php require_once("includes/languages/en-US.php"); ?>
<?php require_once("includes/globalFunctions.php"); ?>
<?php require_once("includes/formValidationFunctions.php"); ?>


<?php

$showLanguages = "";

if(isset($_POST["chooseLanguage"])) {
    if(isset($_POST["lang"])) {
        $choosenLang = $_POST["lang"];
        $_SESSION["language"] = $choosenLang;
        setChoosenLanguage($choosenLang);
        redirectTo("activateDevice.php");
    } else {
        $showLanguages = redrawLangugesView();
        $errors["chooseLang"] = $lang["Please select your language."];
    }
} else {
    $response = file_get_contents("http://10.20.0.101:8000/api/v1/languages");
    $parsedData = json_decode($response);
    $myLangs = [];
    foreach($parsedData as $value) {
        $tmpLang = [];
        $tmpLang["code"] = $value->code;
        $tmpLang["name"] = $value->name;
        $myLangs[] = $tmpLang;
    }

    //if($status == "ok") {
        insertLanguages($myLangs);
        $showLanguages = prepareLanguagesView($myLangs);
    //}
}

function redrawLangugesView() {
    global $connection;
    $query  = "SELECT * FROM languages ";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);
    $myLanguages = [];
    foreach($result as $value) {
        $myLanguages[] = $value;
    }
    return prepareLanguagesView($myLanguages);
}

function insertLanguages($languages) {
    global $connection;
    $query  = "TRUNCATE TABLE settings ";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);
    $query  = "DELETE FROM languages ";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);
    $query  = "ALTER TABLE languages AUTO_INCREMENT = 1 ";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);
    foreach ($languages as $language) {
        $query  = "INSERT INTO languages ";
        $query  .= "(code, name) ";
        $query  .= "VALUES ";
        $query  .= "('{$language["code"]}', '{$language["name"]}') ";
        $result = mysqli_query($connection, $query);
        confirmQuery($result);
    }
}

function prepareLanguagesView($languages) {
    $output = "";
    if(count($languages) > 7) {
        $output .= "<ul class='left'>";
        for($i = 0; $i < 7; $i++) {
            $output .= "<li>";
            $output .= "<input id='" . $languages[$i]["code"] . "' type='radio' name='lang' value='" . $languages[$i]["code"] . "' >";
            $output .= "<label for='" . $languages[$i]["code"] . "'>";
            $output .= "<img src='images/flags/" . $languages[$i]["code"] . ".svg'>";
            $output .= $languages[$i]["name"] . "</label>";
            $output .= "</li>";
        }
        $output .= "</ul>";
        $output .= "<ul class='left'>";
        for($i = 7; $i < count($languages); $i++) {
            $output .= "<li>";
            $output .= "<input id='" . $languages[$i]["code"] . "' type='radio' name='lang' value='" . $languages[$i]["code"] . "' >";
            $output .= "<label for='" . $languages[$i]["code"] . "'>";
            $output .= "<img src='images/flags/" . $languages[$i]["code"] . ".svg'>";
            $output .= $languages[$i]["name"] . "</label>";
            $output .= "</li>";
        }
        $output .= "</ul>";
    } else {
        $output .= "<ul class='left'>";
        for($i = 0; $i < count($languages); $i++) {
            $output .= "<li>";
            $output .= "<input id='" . $languages[$i]["code"] . "' type='radio' name='lang' value='" . $languages[$i]["code"] . "' >";
            $output .= "<label for='" . $languages[$i]["code"] . "'>";
            $output .= "<img src='images/flags/" . $languages[$i]["code"] . ".svg'>";
            $output .= $languages[$i]["name"] . "</label>";
            $output .= "</li>";
        }
        $output .= "</ul>";
    }
    return $output;
}

function setChoosenLanguage($language) {
    global $connection;
    $query  = "INSERT INTO settings ";
    $query  .= "(language) ";
    $query  .= "VALUES ";
    $query  .= "('{$language}') ";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);
}

?>

<?php include("includes/headerActivation.php"); ?>

    <section class="chooseYourLanguage">
        <p><?php echo $lang["Please Choose Your Language:"]; ?></p>
        <form action="chooseLanguage.php" method="POST" class="chooseLanguageForm">
            <fieldset>
                <?php echo $showLanguages; ?>
                <div class="confirmationLine left">
                    <input type="hidden" name="chooseLanguage" value="TRUE" />
                    <input type="submit" value="<?php echo $lang["Next"]; ?>" class="button right" />
                </div>
            </fieldset>
        </form>
        <?php echo formErrors($errors); ?>
    </section>

<?php include("includes/footerActivation.php"); ?>