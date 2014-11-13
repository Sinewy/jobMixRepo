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
            <select id="selectProduct">
                <option></option>
                <option>Product name 1</option>
                <option>Product name 2</option>
                <option>Product name 3</option>
                <option>Product name 4</option>
                <option>Product name 5</option>
            </select>
        </div>
        <div class="menuItem">
            <p><?php echo $lang["COLLECTIONS"]; ?></p>
            <select id="selectCollection">
                <option></option>
                <option>Collection name 1</option>
                <option>Collection name 2</option>
                <option>Collection name 3</option>
                <option>Collection name 4</option>
                <option>Collection name 5</option>
            </select>
        </div>
        <div class="menuItem">
            <p><?php echo $lang["COLORS"]; ?></p>
            <input type="text" id="color" name="color" size="25" value="" placeholder="<?php echo $lang["color"]; ?>" />
            <div class="clearSearchField" id="clearColorsSearch"><img src="images/clearField.svg"></div>
        </div>
        <div class="reset">
            <div class="resetAllBtn" id="resetAllSearchFields"><img src="images/clearIcon.svg"></div>
        </div>
    </div>
    <div class="topLogo right">
        <img class="right" src="images/jubLogoWhiteDrop.svg" alt="Jub Logo"/>
    </div>
</nav>

<section class="toolsBar right">
    <div class="toolBtn" id="printLabel">
        <img src="images/print.svg">
    </div>
    <div class="toolBtn" id="runTintingMachine">
        <img src="images/mixer.svg">
    </div>
    <div class="toolBtn">
        <img src="images/calcIconV2.svg">
    </div>
    <div class="toolBtn" id="showSettingsWindow">
        <img src="images/settingsIconV2.svg">
    </div>
</section>

<section class="colorDetailMain left">
    <div class="colorDetail left">
        <div class="colorInfo">
            <p class="productName">Product: JubosilColor Silicate (Jubosil FX)</p>
            <p class="elementName">Collection: TNS - Weber Terranova Farben Spectrum</p>
            <p class="elementName">Color name: 6OGM35MGO230FERT</p>
            <div class="approximateColor clearFix"><div class="selectedColor">&nbsp;</div>
            </div>
            <p class="elementName">Substrat: Unigrund, Acrylcolor</p>
            <div class="warningInfo">
                <p>Comment:</p>
                <p>Y = 81 ; ¤ = 7</p>
            </div>
            <div class="warningInfo">
                <p>Warning:</p>
                <p>Izdelek ni/pogojno primeren za zunanjo uporabo v TIS. Izdelek ni/pogojno primeren za zunanjo uporabo v TIS.</p>
            </div>
        </div>
    </div>
    <div class="componentsList right">
        <div class="row priceAndInfo">
            <div class="infoBtn left" id="showPriceInfoPopup" ><img src="images/moreInfoIconV3.svg"></div>
            <div class="bigPrice left">€1.345,03</div>
        </div>
        <div class="components">
            <div class="row tableHeader">
                <div class="left compNameHeader"><p><?php echo $lang["Component Name"]; ?></p></div>
                <div class="left compAmount"><p><?php echo $lang["Amount"]; ?></p></div>
                <div class="left compPrice"><p><?php echo $lang["Price/Unit"]; ?></p></div>
            </div>
            <div class="colorantList">
                <div class='row base'>
                    <div class='left compColor'>&nbsp;</div>
                    <div class='left compName'><p>Base NAME</p></div>
                    <div class='left compAmount'><p>25.00 KG</p></div>
                    <div class='left compPrice'><p>€1945.23</p></div>
                </div>
                <div class='row'>
                    <div class='left compColor'><div class='colorantColor'>&nbsp;</div></div>
                    <div class='left compName'><p>Colorant Name 234SDF</p></div>
                    <div class='left compAmount'><p>0.34 ml</p></div>
                    <div class='left compPrice'><p>€12.45</p></div>
                </div>
                <div class='row'>
                    <div class='left compColor'><div class='colorantColor'>&nbsp;</div></div>
                    <div class='left compName'><p>Colorant Name 234SDF</p></div>
                    <div class='left compAmount'><p>0.34 ml</p></div>
                    <div class='left compPrice'><p>€12.45</p></div>
                </div>
                <div class='row'>
                    <div class='left compColor'><div class='colorantColor'>&nbsp;</div></div>
                    <div class='left compName'><p>Colorant Name 234SDF</p></div>
                    <div class='left compAmount'><p>0.34 ml</p></div>
                    <div class='left compPrice'><p>€12.45</p></div>
                </div>
                <div class='row'>
                    <div class='left compColor'><div class='colorantColor'>&nbsp;</div></div>
                    <div class='left compName'><p>Colorant Name 234SDF</p></div>
                    <div class='left compAmount'><p>0.34 ml</p></div>
                    <div class='left compPrice'><p>€12.45</p></div>
                </div>
                <div class='row'>
                    <div class='left compColor'><div class='colorantColor'>&nbsp;</div></div>
                    <div class='left compName'><p>Colorant Name 234SDF</p></div>
                    <div class='left compAmount'><p>0.34 ml</p></div>
                    <div class='left compPrice'><p>€12.45</p></div>
                </div>
                <div class='row'>
                    <div class='left compColor'><div class='colorantColor'>&nbsp;</div></div>
                    <div class='left compName'><p>Colorant Name 234SDF</p></div>
                    <div class='left compAmount'><p>0.34 ml</p></div>
                    <div class='left compPrice'><p>€12.45</p></div>
                </div>
            </div>
        </div>
    </div>
    <div class="cansizeSelector right">
        <img src="images/paintBucketV2.svg">
        <p class="left">PLEASE SELECT CAN SIZE</p>
        <div class="selectionField left">
            <input type="text" id="customCanSize" name="customCanSize" size="25" value="" placeholder="can size" />
            <div class="clearCansizeField" id="clearCansize">
                <img src="images/clearField.svg">
            </div>
            OR
            <select id="selectCanSize">
                <option></option>
                <option>25.00 KG</option>
                <option>15.00 KG</option>
                <option>20.00 KG</option>
                <option>100.00 KG</option>
            </select>
        </div>
    </div>
</section>

<section class="availableColors left">
    <div class="availableColorsHideScroller">
        <div class="colorSwatch left">
            <div class="colorSwatchName"><?php echo $lang["COLORNAME"]; ?></div>
        </div>
        <div class="colorSwatch left">
            <div class="colorSwatchName"><?php echo $lang["COLORNAME"]; ?></div>
        </div>
        <div class="colorSwatch left">
            <div class="colorSwatchName"><?php echo $lang["COLORNAME"]; ?></div>
        </div>
        <div class="colorSwatch left">
            <div class="colorSwatchName"><?php echo $lang["COLORNAME"]; ?></div>
        </div>
        <div class="colorSwatch left">
            <div class="colorSwatchName"><?php echo $lang["COLORNAME"]; ?></div>
        </div>
        <div class="colorSwatch left">
            <div class="colorSwatchName"><?php echo $lang["COLORNAME"]; ?></div>
        </div>
        <div class="colorSwatch left">
            <div class="colorSwatchName"><?php echo $lang["COLORNAME"]; ?></div>
        </div>
        <div class="colorSwatch left">
            <div class="colorSwatchName"><?php echo $lang["COLORNAME"]; ?></div>
        </div>
        <div class="colorSwatch left selectedColorSwatch">
            <div class="colorSwatchName"><?php echo $lang["COLORNAME"]; ?></div>
        </div>
        <div class="colorSwatch left">
            <div class="colorSwatchName"><?php echo $lang["COLORNAME"]; ?></div>
        </div>
        <div class="colorSwatch left">
            <div class="colorSwatchName"><?php echo $lang["COLORNAME"]; ?></div>
        </div>
        <div class="colorSwatch left">
            <div class="colorSwatchName"><?php echo $lang["COLORNAME"]; ?></div>
        </div>
        <div class="colorSwatch left">
            <div class="colorSwatchName"><?php echo $lang["COLORNAME"]; ?></div>
        </div>
        <div class="colorSwatch left">
            <div class="colorSwatchName"><?php echo $lang["COLORNAME"]; ?></div>
        </div>
        <div class="colorSwatch left">
            <div class="colorSwatchName"><?php echo $lang["COLORNAME"]; ?></div>
        </div>
    </div>
</section>

<!--Exras - Popups, sideSlides and more-->

<div class="infoPopup" id="priceInfoPopup">
    <div class="row clearFix">
        <div class="propertyName left">Price Excluding VAT</div>
        <div class="propertyValue left">€1.034,23</div>
    </div>
    <div class="row clearFix">
        <div class="propertyName left">VAT</div>
        <div class="propertyValue left">€235,80</div>
    </div>
    <div class="row clearFix">
        <div class="propertyName left">VAT Rate</div>
        <div class="propertyValue left">20%</div>
    </div>
    <div class="row clearFix">
        <div class="propertyName left">Price Group</div>
        <div class="propertyValue left">I - IV</div>
    </div>
    <div class="row clearFix">
        <div class="propertyName left">Pricelist</div>
        <div class="propertyValue left">Testni cenik 1Testni ceni  ceni  ceni  ceni</div>
    </div>
    <div class="closeBtn button" id="closePriceInfoPopup">Close</div>
</div>

<div class="infoPopup" id="selectCanSizeError">
    <div class="row clearFix">
        <div class="propertyName left">Error...</div>
        <div class="propertyValue left">&nbsp;</div>
    </div>
    <div class="row clearFix">
        <div class="freeText left">Please eneter custom can size or select can size from the provided list.</div>
    </div>
    <div class="closeBtn button" id="closeSelectCanSizeError">Close</div>
</div>

<div class="infoPopup" id="printInfoPopup">
    <div class="row clearFix">
        <div class="propertyName left">SELECT NUMBER OF CANS</div>
    </div>
    <div class="row clearFix">
        <div class="freeText left">
            <select id="selectNumberOfCans">
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
                <option>6</option>
                <option>7</option>
                <option>8</option>
                <option>9</option>
                <option>10</option>
            </select>
        </div>
    </div>
    <div class="closeBtn button left" id="closePrintInfoPopup">Cancel</div>
    <div class="button left" id="printLabelToPrinter">Print</div>
</div>

<div class="infoPopup" id="printInfoPrintingToPrinter">
    <div class="row clearFix">
        <div class="freeText left">Printing label to printer...</div>
    </div>
    <div class="row clearFix">
        <div class="freeText left">This may take a few moments.. approximately 10 sec/label.</div>
    </div>
    <div class="closeBtn button" id="closePrintInfoPrintingToPrinter">OK</div>
</div>

<div class="infoPopup" id="runTintingMachinePopup">
    <div class="row clearFix">
        <div class="freeText left">Mixing colors...</div>
    </div>
    <div class="row clearFix">
        <div class="freeText left">This may take a few moments.. approximately 10 seconds.</div>
    </div>
    <div class="closeBtn button" id="closeRunTintingMachinePopup">OK</div>
</div>


<div class="setSettings">
    <p><?php echo $lang["SETTINGS"]; ?><img id="closeSettingsWithArrow" src="images/arrow-left.png"></p>
    <div class="language left">
        <p id="settingsSubTtitle"><?php echo $lang["Select GUI language:"]; ?></p>
        <?php //echo languageListView(); ?>
    </div>
    <div class="deactivateDevice">
        <div id="deactivateDevice" class="button left"><?php echo $lang["DEACTIVATE THIS DEVICE"]; ?></div>
    </div>
    <div class="confirmationLine left">
        <div id="cancelSettings" class="button left"><?php echo $lang["Cancel"]; ?></div>
        <div id="saveSettings" class="button left"><?php echo $lang["Save"]; ?></div>
    </div>
</div>




<script src="../js/jquery.js"></script>
<script src="../js/jquery-ui.js"></script>
<!--<script>-->
<!--    var lang = --><?php //echo json_encode($lang); ?><!--;-->
<!--    var langChanage = --><?php //echo json_encode($langChanage); ?><!--;-->
<!--    var pselectedProd = --><?php //echo $selectedProd; ?><!--;-->
<!--    var pselectedColl = --><?php //echo $selectedColl; ?><!--;-->
<!--    var pselectedColor = --><?php //echo $selectedColor; ?><!--;-->
<!--</script>-->
<script src="main.js"></script>

</body>
</html>

<?php
if (isset($conneciton)) {
    mysqli_close($conneciton);
}
?>









<!--            <div class="selectCanSize">-->
<!--                PLEASE SELECT CAN SIZE: <select>-->
<!--                    <option>25.00 KG</option>-->
<!--                    <option>15.00 KG</option>-->
<!--                    <option>20.00 KG</option>-->
<!--                    <option>100.00 KG</option>-->
<!--                    </select>-->
<!--            </div>-->
<!--            <div class="selectCanSize numberOfCans">-->
<!--                PLEASE SELECT NUMBER OF CANS: <select>-->
<!--                    <option>1</option>-->
<!--                    <option>2</option>-->
<!--                    <option>3</option>-->
<!--                    <option>4</option>-->
<!--                    <option>5</option>-->
<!--                    <option>6</option>-->
<!--                    <option>7</option>-->
<!--                </select>-->
<!--            </div>-->







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