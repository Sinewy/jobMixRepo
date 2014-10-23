<?php

//******************* Global Variables *********************\\

$productId = 0;
$collectionId = 0;
$cansizesId = 0;

$selectedCanSize = 0;
$selectedColorPrice = 0;
$selectedColorName = "";
$selectedColorPriceGroup = "";
$selectedColorPriceList = "";
$selectedColorHEX = "";

//******************* END Global Variables *********************\\

function redirectTo($newLocation) {
    echo "kwa je";
    header("Location: " . $newLocation);
    exit;
}

function makeHexColorFromRgb($rgbValue) {
    $hexColor = dechex($rgbValue);
    if (strlen($hexColor) < 6) {
        $diff = 6 - strlen($hexColor);
        for ($i = 0; $i < $diff; $i++) {
            $hexColor = "0" . "$hexColor";
        }
    }
    return $hexColor;
}

function HTMLToRGB($htmlCode) {
    if($htmlCode[0] == '#') {
        $htmlCode = substr($htmlCode, 1);
    }

    if (strlen($htmlCode) == 3) {
        $htmlCode = $htmlCode[0] . $htmlCode[0] . $htmlCode[1] . $htmlCode[1] . $htmlCode[2] . $htmlCode[2];
    }

    $r = hexdec($htmlCode[0] . $htmlCode[1]);
    $g = hexdec($htmlCode[2] . $htmlCode[3]);
    $b = hexdec($htmlCode[4] . $htmlCode[5]);

    return $b + ($g << 0x8) + ($r << 0x10);
}

function RGBToHSL($RGB) {
    $r = 0xFF & ($RGB >> 0x10);
    $g = 0xFF & ($RGB >> 0x8);
    $b = 0xFF & $RGB;

    $r = ((float)$r) / 255.0;
    $g = ((float)$g) / 255.0;
    $b = ((float)$b) / 255.0;

    $maxC = max($r, $g, $b);
    $minC = min($r, $g, $b);

    $l = ($maxC + $minC) / 2.0;

    if($maxC == $minC) {
        $s = 0;
        $h = 0;
    }
    else {
        if($l < .5) {
            $s = ($maxC - $minC) / ($maxC + $minC);
        }
        else {
            $s = ($maxC - $minC) / (2.0 - $maxC - $minC);
        }
        if($r == $maxC) {
            $h = ($g - $b) / ($maxC - $minC);
        }
        if($g == $maxC) {
            $h = 2.0 + ($b - $r) / ($maxC - $minC);
        }
        if($b == $maxC) {
            $h = 4.0 + ($r - $g) / ($maxC - $minC);
        }
        $h = $h / 6.0;
    }

    $h = (int)round(255.0 * $h);
    $s = (int)round(255.0 * $s);
    $l = (int)round(255.0 * $l);

    return (object) Array('hue' => $h, 'saturation' => $s, 'lightness' => $l);
}

function isLightColor($color) {
    //    $colour = '#F12346';
    $rgb = HTMLToRGB($color);
    $hsl = RGBToHSL($rgb);
    if($hsl->lightness > 180) {
        // this is light colour!
        return true;
    } else {
        return false;
    }
}

//******************* Password/Login Functions *********************\\

function passwordEncrypt($password) {
    $hashFormat = "$2y$10$";   			// Tells PHP to use Blowfish with a "cost" of 10
    $saltLength = 22; 					// Blowfish salts should be 22-characters or more
    $salt = generateSalt($saltLength);
    $formaAndSalt = $hashFormat . $salt;
    $hash = crypt($password, $formaAndSalt);
    return $hash;
}

function generateSalt($length) {
    // Not 100% unique, not 100% random, but good enough for a salt
    // MD5 returns 32 characters
    $uniqueRandomString = md5(uniqid(mt_rand(), true));

    // Valid characters for a salt are [a-zA-Z0-9./]
    $base64String = base64_encode($uniqueRandomString);

    // But not '+' which is valid in base64 encoding
    $modifiedBase64String = str_replace('+', '.', $base64String);

    // Truncate string to the correct length
    $salt = substr($modifiedBase64String, 0, $length);

    return $salt;
}

function passwordCheck($password, $existingHash) {
    // existing hash contains format and salt at start
    $hash = crypt($password, $existingHash);
    if ($hash === $existingHash) {
        return true;
    } else {
        return false;
    }
}

function attemptLogin($username, $password) {
    $user = findUserByUsername($username);
    if($user) {
    // found USER, now check password
        if (passwordCheck($password, $user["Password"])) {
            // password matches
            return $user;
        } else {
            // password does not match
            return false;
        }
    } else {
        // USER not found
        return false;
    }
}

function loggedIn() {
    //if we have set user id in session we are logged in
    return isset($_SESSION['UserID']);
}

function confirmLoggedIn() {
    if (!loggedIn()) {
        redirectTo("index.php");
    }
}

function confirmLoggedInOnIndex() {
    if (loggedIn()) {
        redirectTo("jumix.php");
    }
}

//******************* Password/Login Functions END *********************\\

//******************* Session message *********************\\

function displayMessage() {
    if (isset($_SESSION["message"])) {
        $output = "<div class='message'>";
        $output .= "<p>" . gettext("Warning:") . "</p>";
        $output .= "<p>";
        $output .=  htmlentities($_SESSION["message"]);
        $output .= "</p>";
        $output .= "</div>";

        // clear message after use
        $_SESSION["message"] = null;

        return $output;
    }
}

//******************* Session message END *********************\\


//******************* Activation Functions END *********************\\

function isActivated() {
    if(findDeviceInfo()["status"] == 1) {
        return true;
    } else {
        return false;
    }
}

function confirmActivated() {
    if (isActivated()) {
        redirectTo("jumix.php");
    } else {
        redirectTo("activateDevice.php");
    }
}

//******************* Activation Functions END *********************\\





//******************* Database Query Functions *********************\\

// ****************** Activation

function findDeviceInfo() {
    global $connection;
    $query  = "SELECT * ";
    $query .= "FROM device_info ";
    $query .= "LIMIT 1";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);
    if($device = mysqli_fetch_assoc($result)) {
        return $device;
    } else {
        return null;
    }
}




// ****************** END Activation


function confirmQuery($resultSet) {
    global $connection;
    if (!$resultSet) {
        echo mysqli_error($connection);
        die("Database query failed.");
    }
}

function findUserByUsername($username) {
    global $connection;
    $safeUsername = mysqli_real_escape_string($connection, $username);

    $query  = "SELECT * ";
    $query .= "FROM user ";
    $query .= "WHERE Username = '{$safeUsername}' ";
    $query .= "LIMIT 1";
    $userSet = mysqli_query($connection, $query);
    confirmQuery($userSet);
    if($user = mysqli_fetch_assoc($userSet)) {
        return $user;
    } else {
        return null;
    }
}

function findAllProducts() {
    global $connection;
    $query  = "SELECT * ";
    $query .= "FROM products ";
    $query .= "ORDER BY name ASC";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);
    return $result;
}

function findAllProductsWithFilter($searchString) {
    global $connection;
    $query  = "SELECT * ";
    $query .= "FROM products ";
    $query .= "WHERE name LIKE '%{$searchString}%' ";
    $query .= "ORDER BY name ASC";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);
    return $result;
}

function findSelectedProductId($searchStr) {
    global $connection;
    $query  = "SELECT * ";
    $query .= "FROM products ";
    $query .= "WHERE name LIKE '{$searchStr}' ";
    $query .= "LIMIT 1";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);
    if($id = mysqli_fetch_assoc($result)) {
        return $id;
    } else {
        return null;
    }
}

function findAllCollectionsForProduct($productId) {
    global $connection;
    $query = "SELECT DISTINCT ";
    $query .= "c.id, c.name ";
    $query .= "FROM formulas f " ;
    $query .= "INNER JOIN collections c ON (c.id = f.collections_id) ";
    $query .= "WHERE products_id = {$productId} ";
    $query .= "ORDER BY c.name ASC ";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);
    return $result;
}

function findAllProductsForCollection($collectionId) {
	global $connection;
	$query = "SELECT DISTINCT ";
	$query .= "p.id, p.name ";
	$query .= "FROM formulas f " ;
	$query .= "INNER JOIN products p ON (p.id = f.products_id) ";
	$query .= "WHERE collections_id = {$collectionId} ";
	$query .= "ORDER BY p.name ASC ";
	$result = mysqli_query($connection, $query);
	confirmQuery($result);
	return $result;
}

function findAllProductsForColor($colorId) {
	global $connection;
	$query = "SELECT DISTINCT ";
	$query .= "p.id, p.name ";
	$query .= "FROM formulas f " ;
	$query .= "INNER JOIN products p ON (p.id = f.products_id) ";
//	$query .= "INNER JOIN colors c ON (c.id = f.colors_id) ";
	$query .= "WHERE colors_id = {$colorId} ";
//	$query .= "WHERE colors_id in (SELECT id FROM colors WHERE name IN (SELECT id FROM colors WHERE id = {$colorId})) ";
	$query .= "ORDER BY p.name ASC ";
	$result = mysqli_query($connection, $query);
	confirmQuery($result);
	return $result;
}

function findAllProductsForColorAndCollection($colorId, $collectionId) {
    global $connection;
    $query = "SELECT DISTINCT ";
    $query .= "p.id, p.name ";
    $query .= "FROM formulas f " ;
    $query .= "INNER JOIN products p ON (p.id = f.products_id) ";
    $query .= "WHERE colors_id = {$colorId} ";
//    $query .= "WHERE colors_id in (SELECT id FROM colors WHERE name IN (SELECT id FROM colors WHERE id = {$colorId})) ";
    $query .= "AND collections_id = {$collectionId} ";
    $query .= "ORDER BY p.name ASC ";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);
    return $result;
}

function findAllCollectionsForColor($colorId) {
	global $connection;
	$query = "SELECT DISTINCT ";
	$query .= "c.id, c.name ";
	$query .= "FROM formulas f " ;
	$query .= "INNER JOIN collections c ON (c.id = f.collections_id) ";
	$query .= "WHERE colors_id = {$colorId} ";
//    $query .= "WHERE colors_id in (SELECT id FROM colors WHERE name IN (SELECT id FROM colors WHERE id = {$colorId})) ";
    $query .= "ORDER BY c.name ASC ";
	$result = mysqli_query($connection, $query);
	confirmQuery($result);
	return $result;
}

function findAllCollectionsForColorAndProduct($colorId, $productId) {
    global $connection;
    $query = "SELECT DISTINCT ";
    $query .= "c.id, c.name ";
    $query .= "FROM formulas f " ;
    $query .= "INNER JOIN collections c ON (c.id = f.collections_id) ";
	$query .= "WHERE colors_id = {$colorId} ";
//    $query .= "WHERE colors_id in (SELECT id FROM colors WHERE name IN (SELECT id FROM colors WHERE id = {$colorId})) ";
    $query .= "AND products_id = {$productId} ";
    $query .= "ORDER BY c.name ASC ";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);
    return $result;
}

function findAllCollectionsWithFilter($searchString) {
    global $connection;
    $query  = "SELECT * ";
    $query .= "FROM collections ";
    $query .= "WHERE name LIKE '%{$searchString}%' ";
    $query .= "ORDER BY name ASC";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);
    return $result;
}

function findSelectedCollectionId($searchStr) {
	global $connection;
	$query  = "SELECT * ";
	$query .= "FROM collections ";
	$query .= "WHERE name LIKE '{$searchStr}' ";
	$query .= "LIMIT 1";
	$result = mysqli_query($connection, $query);
	confirmQuery($result);
	if($id = mysqli_fetch_assoc($result)) {
		return $id;
	} else {
		return null;
	}
}

function findCansizesForProduct($productId) {
    global $connection;
    $query = "SELECT c.id, c.can ";
    $query .= "FROM products_has_cansizes p ";
    $query .= "INNER JOIN cansizes c ON (c.id = p.cansizes_id) ";
    $query .= "WHERE p.products_id = {$productId} ";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);
    return $result;
}

function findAllColorsForProductAndCollection($productId, $collectionId) {
    global $connection;
    $query = "SELECT f.id, c.name, c.id as colorId, f.rgb, f.price_group_description ";
    $query .= "FROM formulas f ";
    $query .= "INNER JOIN colors c ON (c.id = f.colors_id) ";
    $query .= "WHERE f.products_id = {$productId} ";
    $query .= "AND f.collections_id = {$collectionId} ";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);
    return $result;
}

function findSelectedColorId($searchStr) {
	global $connection;
	$query  = "SELECT * ";
	$query .= "FROM colors ";
	$query .= "WHERE name LIKE '{$searchStr}' ";
	$query .= "LIMIT 1";
	$result = mysqli_query($connection, $query);
	confirmQuery($result);
	if($id = mysqli_fetch_assoc($result)) {
		return $id;
	} else {
		return null;
	}
}

function findColorById($colorId) {
	global $connection;
	$query = "SELECT * ";
	$query .= "FROM formulas f ";
	$query .= "WHERE id = {$colorId} ";
	$query .= "LIMIT 1";
	$result = mysqli_query($connection, $query);
	confirmQuery($result);
	if($data = mysqli_fetch_assoc($result)) {
		return $data;
	} else {
		return null;
	}
}

function findAllColorsWithFilter($searchString) {
    global $connection;
    $query  = "SELECT * ";
    $query .= "FROM colors ";
    $query .= "WHERE name LIKE '%{$searchString}%' ";
    $query .= "ORDER BY name ASC";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);
    return $result;
}

function findAllColorantsForFormula($formulaId) {
    global $connection;
    $query = "SELECT c.name, c.rgb, f.quantity, c.price_per_unit ";
    $query .= "FROM formulas_has_colorants f ";
    $query .= "INNER JOIN colorants c ON (c.id = f.colorants_id) ";
    $query .= "WHERE f.formulas_id = {$formulaId} ";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);
    return $result;
}

function findAllLanguages() {
    global $connection;
    $query = "SELECT * ";
    $query .= "FROM languages " ;
    $query .= "ORDER BY code ASC ";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);
    return $result;
}

//******************* Layout functions *********************\\

function productsListView() {
    global $productId;
    $dataSet = findAllProducts();
    $output = "";
    $count = 0;
    if (mysqli_num_rows($dataSet) > 0) {
        while ($data = mysqli_fetch_assoc($dataSet)) {
            if($productId == null) {
                $productId = $data["id"];
//                $_SESSION["productId"] = $productId;
            }
            if ($productId == $data["id"]) {
                $output .= "<li class='active'>";
            } else {
                $output .= "<li>";
            }
            $output .= "<a href='jumix.php?productId=" . $data["id"] . "'>";
            $output .= $data["name"];
            $output .= "</a></li>";
            $count++;
        }
    }
    return $output;
}

function productsListViewAsSelect() {
    global $productId;
    $dataSet = findAllProducts();
    $output = "";
    $count = 0;
    if (mysqli_num_rows($dataSet) > 0) {
        while ($data = mysqli_fetch_assoc($dataSet)) {
            if($productId == null) {
                $productId = $data["id"];
                $_SESSION["productId"] = $productId;
            }
            $output .= "<option value='jumix.php?productId=" . $data["id"] . "'";
            if ($productId == $data["id"]) {
                $output .= " selected";
            }
            $output .= ">";
            $output .= $data["name"];
            $output .= "</option>";
            $count++;
        }
    }
    return $output;
}

function collectionsListView() {
    global $productId;
    global $collectionId;
    global $cansizesId;
    $dataSet = findAllCollectionsForProduct($productId);
    $output = "";
    $count = 0;
    if (mysqli_num_rows($dataSet) > 0) {
        while ($data = mysqli_fetch_assoc($dataSet)) {
            if($collectionId == null) {
                $collectionId = $data["id"];
            }
            if ($collectionId == $data["id"]) {
                $output .= "<li class='active'>";
            } else {
                $output .= "<li>";
            }
            $output .= "<a href='jumix.php?productId=" . $productId . "&collectionId=" . $data["id"] . "&cansizesId=" . $cansizesId . "'>";
            $output .= $data["name"];
            $output .= "</a></li>";
            $count++;
        }
    }
    return $output;
}

function collectionsListViewSearch($pid) {
//    global $productId;
//    global $collectionId;
//    global $cansizesId;
    $dataSet = findAllCollectionsForProduct($pid);
    $output = "";
//    $count = 0;
    if (mysqli_num_rows($dataSet) > 0) {
        while ($data = mysqli_fetch_assoc($dataSet)) {
//            if($collectionId == null) {
//                $collectionId = $data["id"];
//            }
//            if ($collectionId == $data["id"]) {
//                $output .= "<li class='active'>";
//            } else {
//                $output .= "<li>";
//            }
            $output .= "<li>";
//            $output .= "<a href='jumix.php?productId=" . $pid . "&collectionId=" . $data["id"] . "&cansizesId=" . $cansizesId . "'>";
            $output .= $data["name"];
//            $output .= "</a>";
            $output .= "</li>";
//            $count++;
        }
    }
    return $output;
}

function collectionsListViewAsSelect() {
    global $productId;
    global $collectionId;
    global $cansizesId;
    $dataSet = findAllCollectionsForProduct($productId);
    $output = "";
    $count = 0;
    if (mysqli_num_rows($dataSet) > 0) {
        while ($data = mysqli_fetch_assoc($dataSet)) {
            if($collectionId == null) {
                $collectionId = $data["id"];
                $_SESSION["collectionId"] = $collectionId;
            }
            $output .= "<option value='jumix.php?productId=" . $productId . "&collectionId=" . $data["id"] . "&cansizesId=" . $cansizesId . "'";
            if ($collectionId == $data["id"]) {
                $output .= " selected";
            }
            $output .= ">";
            $output .= $data["name"];
            $output .= "</option>";
            $count++;
        }
    }
    return $output;
}

function cansizesListView() {
    global $productId;
    global $collectionId;
    global $cansizesId;

    global $selectedCanSize;

    $dataSet = findCansizesForProduct($productId);
    $output = "";
    $count = 0;
    if (mysqli_num_rows($dataSet) > 0) {
        while ($data = mysqli_fetch_assoc($dataSet)) {
            if($cansizesId == null) {
                $cansizesId = $data["id"];
            }
            if ($cansizesId == $data["id"]) {
                $output .= "<li class='active'>";
                $selectedCanSize = substr($data["can"], 0, strpos($data["can"], " "));
            } else {
                $output .= "<li>";
            }
            $output .= "<a href='jumix.php?productId=" . $productId .  "&collectionId=" . $collectionId . "&cansizesId=" . $data["id"] . "'>";
            $output .= $data["can"];
            $output .= "</a></li>";
            $count++;
        }
    }
    return $output;
}

function cansizesListViewAsSelect() {
    global $productId;
    global $collectionId;
    global $cansizesId;

    global $selectedCanSize;

    $dataSet = findCansizesForProduct($productId);
    $output = "";
    $count = 0;
    if (mysqli_num_rows($dataSet) > 0) {
        while ($data = mysqli_fetch_assoc($dataSet)) {
            if($cansizesId == null) {
                $cansizesId = $data["id"];
                $_SESSION["cansizesId"] = $cansizesId;
            }
            $output .= "<option value='jumix.php?productId=" . $productId .  "&collectionId=" . $collectionId . "&cansizesId=" . $data["id"] . "'";
            if ($collectionId == $data["id"]) {
                $output .= " selected";
                $selectedCanSize = substr($data["can"], 0, strpos($data["can"], " "));
            }
            $output .= ">";
            $output .= $data["can"];
            $output .= "</option>";
            $count++;
        }
    }
    return $output;
}

function colorsListView() {
    global $productId;
    global $collectionId;
    global $cansizesId;

    global $selectedColorFormulaId;
    global $selectedColorName;
    global $selectedColorHEX;
    global $selectedColorPriceGroup;
    global $selectedColorPriceList;

    $dataSet = findAllColorsForProductAndCollection($productId, $collectionId);
    $output = "";
    $count = 0;
    if (mysqli_num_rows($dataSet) > 0) {
        while ($data = mysqli_fetch_assoc($dataSet)) {
            if($selectedColorFormulaId == null) {
                $selectedColorFormulaId = $data["id"];
            }
            $output .= "<li><span data-tooltip aria-haspopup='true' data-options='disable_for_touch:true' class='has-tip tip-top radius' title='";
            $output .= "Color name: " . $data["name"];
            $output .= "'><a href='jumix.php?productId=" . $productId .  "&collectionId=" . $collectionId . "&cansizesId=" . $cansizesId .  "&selectedColorFormulaId=" . $data["id"] . "'>";
            $output .= "<div class='colorPlaceholder";
            if ($selectedColorFormulaId == $data["id"]) {
                $output .= " activeColor";
                $selectedColorName = $data["name"];
                $selectedColorHEX = makeHexColorFromRgb($data["rgb"]);
                $selectedColorPriceGroup = $data["price_group_description"];
                $selectedColorPriceList = "Unknown Price List (id): " . $data["id"]; //$data["price_list"];
            }
            $output .= "' style='background:#" . makeHexColorFromRgb($data["rgb"]);
            $output .= "'></div></a></span></li>";
            $count++;
        }
    }
    return $output;
}

function colorsListSwipeView() {
    global $productId;
    global $collectionId;
    global $cansizesId;

    global $selectedColorFormulaId;
    global $selectedColorName;
    global $selectedColorHEX;
    global $selectedColorPriceGroup;
    global $selectedColorPriceList;

    $dataSet = findAllColorsForProductAndCollection($productId, $collectionId);
    $output = "";

    $maxItemsPerPage = 32;
//    if($screenSize == "small") {
//        $maxItemsPerPage = 20;
//    } elseif($screenSize == "medium") {
//        $maxItemsPerPage = 32;
//    } elseif($screenSize == "big") {
//        $maxItemsPerPage = 44;
//    }

    $timeStart = microtime(true);

    $numberOfColors = mysqli_num_rows($dataSet);
    $allItemsCount = 0;
    $itemsPerPageCount = 0;
    $pageNumber = 0;

    if ($numberOfColors > 0) {
        while ($data = mysqli_fetch_assoc($dataSet)) {
            if($selectedColorFormulaId == null) {
                $selectedColorFormulaId = $data["id"];
            }
            if($itemsPerPageCount == 0) {
                $output .= "<div class='swiper-slide'>";
//                $output .= "<ul class='small-block-grid-5 medium-block-grid-8 large-block-grid-11'>";
                $output .= "<ul class='small-block-grid-8'>";
            }
            $output .= "<li><span data-tooltip aria-haspopup='true' data-options='disable_for_touch:true' class='has-tip tip-top radius' title='";
            $output .= "Color name: " . $data["name"];
            $output .= "'><a href='jumix.php?productId=" . $productId .  "&collectionId=" . $collectionId . "&cansizesId=" . $cansizesId .  "&selectedColorFormulaId=" . $data["id"] . "&activeSwipeIndex=" . $pageNumber . "'>";
            $output .= "<div class='colorPlaceholder";
            if ($selectedColorFormulaId == $data["id"]) {
                $output .= " activeColor";
                $selectedColorName = $data["name"];
                $selectedColorHEX = makeHexColorFromRgb($data["rgb"]);
                $selectedColorPriceGroup = $data["price_group_description"];
                $selectedColorPriceList = "Unknown Price List (id): " . $data["id"]; //$data["price_list"];
            }
            $output .= "' style='background:#" . makeHexColorFromRgb($data["rgb"]);
            $output .= "'></div></a></span></li>";
            if($itemsPerPageCount == ($maxItemsPerPage - 1) || ($allItemsCount + 1) == $numberOfColors) {
                $output .= "</ul></div>";
                $itemsPerPageCount = 0;
                $pageNumber++;
            } else {
                $itemsPerPageCount++;
            }
            $allItemsCount++;
        }
    }

//    $timeEnd = microtime(true);
//    syslog(LOG_ALERT, "Time to execute display colors: " . ($timeEnd - $timeStart));
    return $output;
}

function colorantListView() {

    global $selectedColorFormulaId;
    global $selectedColorPrice;

    $dataSet = findAllColorantsForFormula($selectedColorFormulaId);
    $output = "";
    if (mysqli_num_rows($dataSet) > 0) {
        while ($data = mysqli_fetch_assoc($dataSet)) {
            $output .= "<div class='row'>";
            $output .= "<div class='left compColor'><div class='colorantColor' style='background:#" . makeHexColorFromRgb($data["rgb"]) . "'>&nbsp;</div></div>";
            $output .= "<div class='left compName'><p>" . $data["name"] . "</p></div>";
            $output .= "<div class='left compAmount'><p>" . $data["quantity"] . "</p></div>";
            $output .= "<div class='left compPrice'><p>" . $data["price_per_unit"] . "</p></div>";
            $output .= "</div>";
            $selectedColorPrice += $data["quantity"] * $data["price_per_unit"];
        }
    }
    return $output;
}

function colorDetialDataView($sCHex, $sPrice, $sName, $sPGroup, $sPList, $sCanSize) {
    $sPrice = round($sPrice, 1, PHP_ROUND_HALF_UP);
    $fontColor = isLightColor($sCHex) ? "000" : "FFF";
    $output = "";
    $output .= "<div class='row colorDetail' style='background:#" . $sCHex . "; color:#" . $fontColor . ";' data-equalizer>";
    $output .= "<div class='medium-5 columns text-center colorDetailBg colorDetailTopSpace' data-equalizer-watch>";
    $output .= "<div class='priceBig'>€" . $sPrice * 0.8 . "</div>";
    $output .= "<div class='priceColorName'>Name: " . $sName . "</div>";
    $output .= "</div>";
    $output .= "<div class='medium-7 columns colorDetailTopSpace' data-equalizer-watch>";
    $output .= "<div class='colorDetailDataBg'>";
    $output .= "<div class='row'>";
    $output .= "<div class='small-5 columns priceInfo'>Excluding VAT</div>";
    $output .= "<div class='small-7 columns priceData'>" . $sPrice * 0.8 . "</div>";
    $output .= "</div>";
    $output .= "<div class='row'>";
    $output .= "<div class='small-5 columns priceInfo'>VAT</div>";
    $output .= "<div class='small-7 columns priceData'>" . $sPrice * 0.2 . "</div>";
    $output .= "</div>";
    $output .= "<div class='row'>";
    $output .= "<div class='small-5 columns priceInfo'>Including VAT</div>";
    $output .= "<div class='small-7 columns priceData'>" . $sPrice . "</div>";
    $output .= "</div>";
    $output .= "<div class='row'>";
    $output .= "<div class='small-5 columns priceInfo'>Price Group</div>";
    $output .= "<div class='small-7 columns priceData'>" . $sPGroup . "</div>";
    $output .= "</div>";
    $output .= "<div class='row'>";
    $output .= "<div class='small-5 columns priceInfo'>Price List<br/></div>";
    $output .= "<div class='small-7 columns priceData'>" . $sPList . "</div>";
    $output .= "</div>";
    $output .= "</div>";
    $output .= "</div>";
    $output .= "</div>";
    return $output;
}

function languageListView() {
    $dataSet = findAllLanguages();
    $output = "<ul>";
    if (mysqli_num_rows($dataSet) > 0) {
        while ($data = mysqli_fetch_assoc($dataSet)) {
            $output .= "<li>";
            if($_SESSION["language"] == $data["code"]) {
                $output .= "<input id='" . $data["code"] . "' type='radio' name='lang' value='" . $data["code"] . "' checked >";
            } else {
                $output .= "<input id='" . $data["code"] . "' type='radio' name='lang' value='" . $data["code"] . "'>";
            }
            $output .= "<label for='" . $data["code"] . "'>";
            $output .= "<img src='images/flags/" . $data["code"] . ".svg'>";
            $output .= $data["name"] . "</label>";
            $output .= "</li>";
        }
    }
    $output .= "</ul>";
    return $output;
}