<?php //require_once("../includes/session.php"); ?>
<?php //require_once("../includes/dbc.php"); ?>
<?php //require_once("../includes/setLanguage.php"); ?>
<?php //require_once("../includes/globalFunctions.php"); ?>
<?php require_once("../includes/languages/en-US.php"); ?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Jumix RPi Demo</title>
    <script src="../js/modernizr.js"></script>
    <link rel="stylesheet" href="../css/cssreset.css">
    <link rel="stylesheet" href="../css/jquery-ui.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="main.css">
</head>

<body>

<nav class="topNavigation left">
    <div class="menuItems left">
        <div class="menuItem">
            <p><?php echo $lang["PRODUCTS"]; ?></p>
            <input type="text" id="product" name="product" size="25" value="" placeholder="<?php echo $lang["product"]; ?>" />
        </div>
        <div class="menuItem">
            <p><?php echo $lang["COLLECTIONS"]; ?></p>
            <input type="text" id="collection" name="collection" size="25" value="" placeholder="<?php echo $lang["collection"]; ?>" />
        </div>
        <div class="menuItem">
            <p><?php echo $lang["COLORS"]; ?></p>
            <input type="text" id="color" name="color" size="25" value="" placeholder="<?php echo $lang["color"]; ?>" />
        </div>
        <div class="menuItem reset">
            <div class="resetAllBtn">RESET ALL</div>
        </div>
    </div>
    <div class="topLogo right">
        <img class="right" src="images/jubLogoWhiteDrop.svg" alt="Jub Logo"/>
    </div>
</nav>

<section class="toolsBar right"></section>

<section class="colorDetailMain left">
    <div class="colorDetail left">
        <div class="selectedColor">
            <p class="colorName">6OGM35MGO230FERT</p>
        </div>
        <div class="colorInfo">
            <p class="productName">JubosilColor Silicate (Jubosil FX)</p>
            <p class="collectionName">TNS - Weber Terranova Farben Spectrum</p>
            <p class="warningInfo"><b>Opozorilo:</b> Izdelek ni/pogojno primeren za zunanjo uporabo v TIS. Izdelek ni/pogojno primeren za zunanjo uporabo v TIS.</p>
            <div class="selectCanSize">
                PLEASE SELECT CAN SIZE: <select>
                    <option>25.00 KG</option>
                    <option>15.00 KG</option>
                    <option>20.00 KG</option>
                    <option>100.00 KG</option>
                    </select>
            </div>
        </div>
    </div>
    <div class="componentsList right">
        <p class="bigPrice">$1.345,03</p>
        <div class="components">
            <div class="row tableHeader">
                <div class="left compNameHeader"><p><?php echo $lang["Component Name"]; ?></p></div>
                <div class="left compAmount"><p><?php echo $lang["Amount"]; ?></p></div>
                <div class="left compPrice"><p><?php echo $lang["Price/Unit"]; ?></p></div>
            </div>
            <div class="colorantList">
                <div class='row'>
                    <div class='left compColor'><div class='colorantColor'>&nbsp;</div></div>
                    <div class='left compName'><p><?php echo $lang["Name"]; ?></p></div>
                    <div class='left compAmount'><p><?php echo $lang["Qantity"]; ?></p></div>
                    <div class='left compPrice'><p><?php echo $lang["Price/Unit"]; ?></p></div>
                </div>
            </div>
        </div>

    </div>
</section>

<!--<section class="availableColors left"></section>-->


<!---->
<!--<section class="topNavigation">-->
<!--    <div class="menuItems">-->
<!--        <div class="menuItem">-->
<!--            <p>--><?php //echo $lang["PRODUCTS"]; ?><!--</p>-->
<!--            <input type="text" id="product" name="product" size="25" value="" placeholder="--><?php //echo $lang["product"]; ?><!--" />-->
<!--        </div>-->
<!---->
<!--        <div class="menuItem">-->
<!--            <p>--><?php //echo $lang["COLLECTIONS"]; ?><!--</p>-->
<!--            <input type="text" id="collection" name="collection" size="25" value="" placeholder="--><?php //echo $lang["collection"]; ?><!--" />-->
<!--        </div>-->
<!---->
<!--        <div class="menuItem">-->
<!--            <p>--><?php //echo $lang["COLORS"]; ?><!--</p>-->
<!--            <input type="text" id="color" name="color" size="25" value="" placeholder="--><?php //echo $lang["color"]; ?><!--" />-->
<!--        </div>-->
<!---->
<!--        <div class="menuItem">-->
<!--            <p>--><?php //echo $lang["CAN SIZE"]; ?><!--</p>-->
<!--            <select id="cansize" name="cansize" class="selectMenu"></select>-->
<!--        </div>-->
<!--    </div>-->
<!--</section>-->
<!---->
<!--<section class="mainSection left">-->
<!---->
<!--    <div class="selectedColorDetails">-->
<!--        <div class="priceAndInfo left">-->
<!--            <p>--><?php //echo $lang["Currency"]; ?><!--00.00</p>-->
<!--            <p>--><?php //echo $lang["Product name is displayed here"]; ?><!--</p>-->
<!--            <div class="priceDetails right">-->
<!--                <table>-->
<!--                    <tr>-->
<!--                        <td class="rowTitle">--><?php //echo $lang["Excluding VAT"]; ?><!--</td>-->
<!--                        <td class="rowValue">--><?php //echo $lang["Currency"]; ?><!--00.00</td>-->
<!--                    </tr>-->
<!--                    <tr>-->
<!--                        <td class="rowTitle">--><?php //echo $lang["VAT"]; ?><!--</td>-->
<!--                        <td class="rowValue">--><?php //echo $lang["Currency"]; ?><!--00.00</td>-->
<!--                    </tr>-->
<!--                    <tr>-->
<!--                        <td class="rowTitle">--><?php //echo $lang["Price Group"]; ?><!--</td>-->
<!--                        <td class="rowValue">-</td>-->
<!--                    </tr>-->
<!--                    <tr>-->
<!--                        <td class="rowTitle">--><?php //echo $lang["Price List"]; ?><!--</td>-->
<!--                        <td class="rowValue">-</td>-->
<!--                    </tr>-->
<!--                </table>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="displayColor left" style="background-color: rgba(0, 0, 0, 0.3)">-->
<!--            <div class="showComponents">-->
<!--                <p>--><?php //echo $lang["COLORNAME"]; ?><!--</p>-->
<!--                <p>--><?php //echo $lang["SHOW COMPONENTS"]; ?><!--</p>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!---->
<!--    <div class="spacer"></div>-->
<!---->
<!--    <div class="colorsAvailable">-->
<!--        <div class="colorSwatch left">-->
<!--            <div class="colorName">--><?php //echo $lang["COLORNAME"]; ?><!--</div>-->
<!--        </div>-->
<!--        <div class="colorSwatch left">-->
<!--            <div class="colorName">--><?php //echo $lang["COLORNAME"]; ?><!--</div>-->
<!--        </div>-->
<!--        <div class="colorSwatch left">-->
<!--            <div class="colorName">--><?php //echo $lang["COLORNAME"]; ?><!--</div>-->
<!--        </div>-->
<!--        <div class="colorSwatch left">-->
<!--            <div class="colorName">--><?php //echo $lang["COLORNAME"]; ?><!--</div>-->
<!--        </div>-->
<!--        <div class="colorSwatch left">-->
<!--            <div class="colorName">--><?php //echo $lang["COLORNAME"]; ?><!--</div>-->
<!--        </div>-->
<!--        <div class="colorSwatch left">-->
<!--            <div class="colorName">--><?php //echo $lang["COLORNAME"]; ?><!--</div>-->
<!--        </div>-->
<!--        <div class="colorSwatch left">-->
<!--            <div class="colorName">--><?php //echo $lang["COLORNAME"]; ?><!--</div>-->
<!--        </div>-->
<!--	    <div class="colorSwatch left">-->
<!--		    <div class="colorName">--><?php //echo $lang["COLORNAME"]; ?><!--</div>-->
<!--	    </div>-->
<!--	    <div class="colorSwatch left">-->
<!--		    <div class="colorName">--><?php //echo $lang["COLORNAME"]; ?><!--</div>-->
<!--	    </div>-->
<!--	    <div class="colorSwatch left">-->
<!--		    <div class="colorName">--><?php //echo $lang["COLORNAME"]; ?><!--</div>-->
<!--	    </div>-->
<!--	    <div class="colorSwatch left">-->
<!--		    <div class="colorName">--><?php //echo $lang["COLORNAME"]; ?><!--</div>-->
<!--	    </div>-->
<!--	    <div class="colorSwatch left">-->
<!--		    <div class="colorName">--><?php //echo $lang["COLORNAME"]; ?><!--</div>-->
<!--	    </div>-->
<!--	    <div class="colorSwatch left">-->
<!--		    <div class="colorName">--><?php //echo $lang["COLORNAME"]; ?><!--</div>-->
<!--	    </div>-->
<!--	    <div class="colorSwatch left">-->
<!--		    <div class="colorName">--><?php //echo $lang["COLORNAME"]; ?><!--</div>-->
<!--	    </div>-->
<!--	    <div class="colorSwatch left">-->
<!--		    <div class="colorName">--><?php //echo $lang["COLORNAME"]; ?><!--</div>-->
<!--	    </div>-->
<!--	    <div class="colorSwatch left">-->
<!--		    <div class="colorName">--><?php //echo $lang["COLORNAME"]; ?><!--</div>-->
<!--	    </div>-->
<!--	    <div class="colorSwatch left">-->
<!--		    <div class="colorName">--><?php //echo $lang["COLORNAME"]; ?><!--</div>-->
<!--	    </div>-->
<!--	    <div class="colorSwatch left">-->
<!--		    <div class="colorName">--><?php //echo $lang["COLORNAME"]; ?><!--</div>-->
<!--	    </div>-->
<!--	    <div class="colorSwatch left">-->
<!--		    <div class="colorName">--><?php //echo $lang["COLORNAME"]; ?><!--</div>-->
<!--	    </div>-->
<!--	    <div class="colorSwatch left">-->
<!--		    <div class="colorName">--><?php //echo $lang["COLORNAME"]; ?><!--</div>-->
<!--	    </div>-->
<!--	    <div class="colorSwatch left">-->
<!--		    <div class="colorName">--><?php //echo $lang["COLORNAME"]; ?><!--</div>-->
<!--	    </div>-->
<!--	    <div class="colorSwatch left">-->
<!--		    <div class="colorName">--><?php //echo $lang["COLORNAME"]; ?><!--</div>-->
<!--	    </div>-->
<!--	    <div class="colorSwatch left">-->
<!--		    <div class="colorName">--><?php //echo $lang["COLORNAME"]; ?><!--</div>-->
<!--	    </div>-->
<!--	    <div class="colorSwatch left">-->
<!--		    <div class="colorName">--><?php //echo $lang["COLORNAME"]; ?><!--</div>-->
<!--	    </div>-->
<!--	    <div class="colorSwatch left">-->
<!--		    <div class="colorName">--><?php //echo $lang["COLORNAME"]; ?><!--</div>-->
<!--	    </div>-->
<!--	    <div class="colorSwatch left">-->
<!--		    <div class="colorName">--><?php //echo $lang["COLORNAME"]; ?><!--</div>-->
<!--	    </div>-->
<!--	    <div class="colorSwatch left">-->
<!--		    <div class="colorName">--><?php //echo $lang["COLORNAME"]; ?><!--</div>-->
<!--	    </div>-->
<!--	    <div class="colorSwatch left">-->
<!--		    <div class="colorName">--><?php //echo $lang["COLORNAME"]; ?><!--</div>-->
<!--	    </div>-->
<!--	    <div class="colorSwatch left">-->
<!--		    <div class="colorName">--><?php //echo $lang["COLORNAME"]; ?><!--</div>-->
<!--	    </div>-->
<!--	    <div class="colorSwatch left">-->
<!--		    <div class="colorName">--><?php //echo $lang["COLORNAME"]; ?><!--</div>-->
<!--	    </div>-->
<!--	    <div class="colorSwatch left">-->
<!--		    <div class="colorName">--><?php //echo $lang["COLORNAME"]; ?><!--</div>-->
<!--	    </div>-->
<!--        <div class="colorSwatch left">-->
<!--            <div class="colorName">--><?php //echo $lang["COLORNAME"]; ?><!--</div>-->
<!--        </div>-->
<!--        <div class="colorSwatch left">-->
<!--            <div class="colorName">--><?php //echo $lang["COLORNAME"]; ?><!--</div>-->
<!--        </div>-->
<!--        <div class="colorSwatch left">-->
<!--            <div class="colorName">--><?php //echo $lang["COLORNAME"]; ?><!--</div>-->
<!--        </div>-->
<!--        <div class="colorSwatch left">-->
<!--            <div class="colorName">--><?php //echo $lang["COLORNAME"]; ?><!--</div>-->
<!--        </div>-->
<!--        <div class="colorSwatch left">-->
<!--            <div class="colorName">--><?php //echo $lang["COLORNAME"]; ?><!--</div>-->
<!--        </div>-->
<!--        <div class="colorSwatch left">-->
<!--            <div class="colorName">--><?php //echo $lang["COLORNAME"]; ?><!--</div>-->
<!--        </div>-->
<!--        <div class="colorSwatch left">-->
<!--            <div class="colorName">--><?php //echo $lang["COLORNAME"]; ?><!--</div>-->
<!--        </div>-->
<!--        <div class="colorSwatch left">-->
<!--            <div class="colorName">--><?php //echo $lang["COLORNAME"]; ?><!--</div>-->
<!--        </div>-->
<!--        <div class="colorSwatch left">-->
<!--            <div class="colorName">--><?php //echo $lang["COLORNAME"]; ?><!--</div>-->
<!--        </div>-->
<!--    </div>-->
<!---->
<!--    <div class="components" id="colorantsShowHide">-->
<!--        <div class="row tableHeader">-->
<!--            <div class="left compNameBig"><p>--><?php //echo $lang["Component Name"]; ?><!--</p></div>-->
<!--            <div class="left compAmount"><p>--><?php //echo $lang["Amount"]; ?><!--</p></div>-->
<!--            <div class="left compPrice"><p>--><?php //echo $lang["Price/Unit"]; ?><!--</p></div>-->
<!--        </div>-->
<!--        <div class="colorantList">-->
<!--            <div class='row'>-->
<!--                <div class='left compColor'><div class='colorantColor'>&nbsp;</div></div>-->
<!--                <div class='left compName'><p>--><?php //echo $lang["Name"]; ?><!--</p></div>-->
<!--                <div class='left compAmount'><p>--><?php //echo $lang["Qantity"]; ?><!--</p></div>-->
<!--                <div class='left compPrice'><p>--><?php //echo $lang["Price/Unit"]; ?><!--</p></div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!---->
<!--    <div class="searchResults">-->
<!--        <p>--><?php //echo $lang["SEARCH RESULTS:"]; ?><!--<img src="images/arrow-left.png"></p>-->
<!--        <div id="pAndCSearchResults">-->
<!--        </div>-->
<!--    </div>-->
<!---->
<!--    <div class="searchResultsForColor">-->
<!--        <p>--><?php //echo $lang["SEARCH RESULTS:"]; ?><!--</p>-->
<!--        <div class="left">-->
<!--            <div id="colorPSearchResults">-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="left">-->
<!--            <div id="colorCSearchResults">-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!---->
<!--    <div class="setSettings">-->
<!--        <p>--><?php //echo $lang["SETTINGS"]; ?><!--<img src="images/arrow-left.png"></p>-->
<!--        <div class="language left">-->
<!--            <p id="settingsSubTtitle">--><?php //echo $lang["Select GUI language:"]; ?><!--</p>-->
<!--<!--            --><?php ////echo languageListView(); ?>
<!--        </div>-->
<!--	    <div class="deactivateDevice">-->
<!--		    <div id="deactivateDevice" class="button left">--><?php //echo $lang["DEACTIVATE THIS DEVICE"]; ?><!--</div>-->
<!--	    </div>-->
<!--        <div class="confirmationLine left">-->
<!--            <div id="cancelSettings" class="button left">--><?php //echo $lang["Cancel"]; ?><!--</div>-->
<!--            <div id="saveSettings" class="button left">--><?php //echo $lang["Save"]; ?><!--</div>-->
<!--        </div>-->
<!---->
<!--    </div>-->
<!---->
<!--</section>-->
<!---->
<!--<section class="menuSection left">-->
<!--    <div class="menuHeader">-->
<!--        <img class="right" src="images/jubLogoWhiteDrop.svg" alt="Jub Logo"/>-->
<!--    </div>-->
<!--    <div class="menuFooter">-->
<!--        <div id="printSticker" class="iconBtn left"><img src="images/print.svg"></div>-->
<!--        <div id="runMixer" class="iconBtn left"><img src="images/mixer.svg"></div>-->
<!--        <div class="iconBtn left"><img src="images/calcIcon.png"></div>-->
<!--        <div id="setSettings" class="smallIconBtn right"><img src="images/settingsIcon.png"></div>-->
<!--    </div>-->
<!--</section>-->


</body>
</html>

<?php
if (isset($conneciton)) {
    mysqli_close($conneciton);
}
?>

