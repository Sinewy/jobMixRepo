<?php require_once("includes/session.php"); ?>
<?php require_once("includes/dbc.php"); ?>
<?php require_once("includes/setLanguage.php"); ?>
<?php require_once("includes/globalFunctions.php"); ?>

<?php
$langChanage = false;
$selectedProd = -1;
$selectedColl = -1;
$selectedColor = -1;
if(isset($_GET["langChanage"])) {
    $langChanage = true;
    $selectedProd = $_GET["selectedProd"];
    $selectedColl = $_GET["selectedColl"];
    $selectedColor = $_GET["selectedColor"];
}
?>

<?php include("includes/header.php"); ?>

<section class="mainSection left">

    <div class="selectedColorDetails">
        <div class="priceAndInfo left">
            <p><?php echo $lang["Currency"]; ?>00.00</p>
            <p><?php echo $lang["Product name is displayed here"]; ?></p>
            <div class="priceDetails right">
                <table>
                    <tr>
                        <td class="rowTitle"><?php echo $lang["Excluding VAT"]; ?></td>
                        <td class="rowValue"><?php echo $lang["Currency"]; ?>00.00</td>
                    </tr>
                    <tr>
                        <td class="rowTitle"><?php echo $lang["VAT"]; ?></td>
                        <td class="rowValue"><?php echo $lang["Currency"]; ?>00.00</td>
                    </tr>
                    <tr>
                        <td class="rowTitle"><?php echo $lang["Price Group"]; ?></td>
                        <td class="rowValue">-</td>
                    </tr>
                    <tr>
                        <td class="rowTitle"><?php echo $lang["Price List"]; ?></td>
                        <td class="rowValue">-</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="displayColor left" style="background-color: rgba(0, 0, 0, 0.3)">
            <div class="showComponents">
                <p><?php echo $lang["COLORNAME"]; ?></p>
                <p><?php echo $lang["SHOW COMPONENTS"]; ?></p>
            </div>
        </div>
    </div>

    <div class="spacer"></div>

    <div class="colorsAvailable">
        <div class="colorSwatch left">
            <div class="colorName"><?php echo $lang["COLORNAME"]; ?></div>
        </div>
        <div class="colorSwatch left">
            <div class="colorName"><?php echo $lang["COLORNAME"]; ?></div>
        </div>
        <div class="colorSwatch left">
            <div class="colorName"><?php echo $lang["COLORNAME"]; ?></div>
        </div>
        <div class="colorSwatch left">
            <div class="colorName"><?php echo $lang["COLORNAME"]; ?></div>
        </div>
        <div class="colorSwatch left">
            <div class="colorName"><?php echo $lang["COLORNAME"]; ?></div>
        </div>
        <div class="colorSwatch left">
            <div class="colorName"><?php echo $lang["COLORNAME"]; ?></div>
        </div>
        <div class="colorSwatch left">
            <div class="colorName"><?php echo $lang["COLORNAME"]; ?></div>
        </div>
	    <div class="colorSwatch left">
		    <div class="colorName"><?php echo $lang["COLORNAME"]; ?></div>
	    </div>
	    <div class="colorSwatch left">
		    <div class="colorName"><?php echo $lang["COLORNAME"]; ?></div>
	    </div>
	    <div class="colorSwatch left">
		    <div class="colorName"><?php echo $lang["COLORNAME"]; ?></div>
	    </div>
	    <div class="colorSwatch left">
		    <div class="colorName"><?php echo $lang["COLORNAME"]; ?></div>
	    </div>
	    <div class="colorSwatch left">
		    <div class="colorName"><?php echo $lang["COLORNAME"]; ?></div>
	    </div>
	    <div class="colorSwatch left">
		    <div class="colorName"><?php echo $lang["COLORNAME"]; ?></div>
	    </div>
	    <div class="colorSwatch left">
		    <div class="colorName"><?php echo $lang["COLORNAME"]; ?></div>
	    </div>
	    <div class="colorSwatch left">
		    <div class="colorName"><?php echo $lang["COLORNAME"]; ?></div>
	    </div>
	    <div class="colorSwatch left">
		    <div class="colorName"><?php echo $lang["COLORNAME"]; ?></div>
	    </div>
	    <div class="colorSwatch left">
		    <div class="colorName"><?php echo $lang["COLORNAME"]; ?></div>
	    </div>
	    <div class="colorSwatch left">
		    <div class="colorName"><?php echo $lang["COLORNAME"]; ?></div>
	    </div>
	    <div class="colorSwatch left">
		    <div class="colorName"><?php echo $lang["COLORNAME"]; ?></div>
	    </div>
	    <div class="colorSwatch left">
		    <div class="colorName"><?php echo $lang["COLORNAME"]; ?></div>
	    </div>
	    <div class="colorSwatch left">
		    <div class="colorName"><?php echo $lang["COLORNAME"]; ?></div>
	    </div>
	    <div class="colorSwatch left">
		    <div class="colorName"><?php echo $lang["COLORNAME"]; ?></div>
	    </div>
	    <div class="colorSwatch left">
		    <div class="colorName"><?php echo $lang["COLORNAME"]; ?></div>
	    </div>
	    <div class="colorSwatch left">
		    <div class="colorName"><?php echo $lang["COLORNAME"]; ?></div>
	    </div>
	    <div class="colorSwatch left">
		    <div class="colorName"><?php echo $lang["COLORNAME"]; ?></div>
	    </div>
	    <div class="colorSwatch left">
		    <div class="colorName"><?php echo $lang["COLORNAME"]; ?></div>
	    </div>
	    <div class="colorSwatch left">
		    <div class="colorName"><?php echo $lang["COLORNAME"]; ?></div>
	    </div>
	    <div class="colorSwatch left">
		    <div class="colorName"><?php echo $lang["COLORNAME"]; ?></div>
	    </div>
	    <div class="colorSwatch left">
		    <div class="colorName"><?php echo $lang["COLORNAME"]; ?></div>
	    </div>
	    <div class="colorSwatch left">
		    <div class="colorName"><?php echo $lang["COLORNAME"]; ?></div>
	    </div>
	    <div class="colorSwatch left">
		    <div class="colorName"><?php echo $lang["COLORNAME"]; ?></div>
	    </div>
        <div class="colorSwatch left">
            <div class="colorName"><?php echo $lang["COLORNAME"]; ?></div>
        </div>
        <div class="colorSwatch left">
            <div class="colorName"><?php echo $lang["COLORNAME"]; ?></div>
        </div>
        <div class="colorSwatch left">
            <div class="colorName"><?php echo $lang["COLORNAME"]; ?></div>
        </div>
        <div class="colorSwatch left">
            <div class="colorName"><?php echo $lang["COLORNAME"]; ?></div>
        </div>
        <div class="colorSwatch left">
            <div class="colorName"><?php echo $lang["COLORNAME"]; ?></div>
        </div>
        <div class="colorSwatch left">
            <div class="colorName"><?php echo $lang["COLORNAME"]; ?></div>
        </div>
        <div class="colorSwatch left">
            <div class="colorName"><?php echo $lang["COLORNAME"]; ?></div>
        </div>
        <div class="colorSwatch left">
            <div class="colorName"><?php echo $lang["COLORNAME"]; ?></div>
        </div>
        <div class="colorSwatch left">
            <div class="colorName"><?php echo $lang["COLORNAME"]; ?></div>
        </div>
    </div>

    <div class="components" id="colorantsShowHide">
        <div class="row tableHeader">
            <div class="left compNameBig"><p><?php echo $lang["Component Name"]; ?></p></div>
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

    <div class="searchResults">
        <p><?php echo $lang["SEARCH RESULTS:"]; ?><img src="images/arrow-left.png"></p>
        <div id="pAndCSearchResults">
        </div>
    </div>

    <div class="searchResultsForColor">
        <p><?php echo $lang["SEARCH RESULTS:"]; ?></p>
        <div class="left">
            <div id="colorPSearchResults">
            </div>
        </div>
        <div class="left">
            <div id="colorCSearchResults">
            </div>
        </div>
    </div>

    <div class="setSettings">
        <p><?php echo $lang["SETTINGS"]; ?><img src="images/arrow-left.png"></p>
        <div class="language left">
            <p id="settingsSubTtitle"><?php echo $lang["Select GUI language:"]; ?></p>
            <?php echo languageListView(); ?>
        </div>
        <div class="confirmationLine left">
            <div id="cancelSettings" class="button left">Cancel</div>
            <div id="saveSettings" class="button left">Save</div>
        </div>

    </div>

</section>

<section class="menuSection left">
    <div class="menuHeader">
        <img class="right" src="images/jubLogoTxt.svg" alt="Jub Logo"/>
    </div>
    <div class="menuItems">

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

        <div class="menuItem">
            <p><?php echo $lang["CAN SIZE"]; ?></p>
            <select id="cansize" name="cansize" class="selectMenu"></select>
        </div>

    </div>
    <div class="menuFooter">
        <div id="printSticker" class="iconBtn left"><img src="images/print.svg"></div>
        <div id="runMixer" class="iconBtn left"><img src="images/mixer.svg"></div>
        <div class="iconBtn left"><img src="images/calcIcon.png"></div>
        <div id="setSettings" class="smallIconBtn right"><img src="images/settingsIcon.png"></div>
    </div>
</section>

<?php include("includes/footer.php"); ?>

