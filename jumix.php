<?php require_once("includes/session.php"); ?>
<?php require_once("includes/dbc.php"); ?>
<?php require_once("includes/globalFunctions.php"); ?>
<?php confirmLoggedIn(); ?>

<?php

if(!isset($_GET["productId"])) {
    $productId = null;
} else {
    $productId = $_GET["productId"];
}

if(!isset($_GET["collectionId"])) {
    $collectionId = null;
} else {
    $collectionId = $_GET["collectionId"];
}

if(!isset($_GET["cansizesId"])) {
    $cansizesId = null;
} else {
    $cansizesId = $_GET["cansizesId"];
}

if(!isset($_GET["selectedColorFormulaId"])) {
    $selectedColorFormulaId = null;
} else {
    $selectedColorFormulaId = $_GET["selectedColorFormulaId"];
}

//$productsView = productsListView();
$productsView = productsListViewAsSelect();
$collectionsView = collectionsListView();
//$collectionsView = collectionsListViewAsSelect();
//$cansizesView = cansizesListView();
$cansizesView = cansizesListViewAsSelect();
//$colorsView = colorsListView();
//$colorsView = colorsListSwipeView("small", $productId, $collectionId, $cansizesId);
//$colorsViewSmall = colorsListSwipeView("small");
//$colorsViewMedium = colorsListSwipeView("medium");
//$colorsViewBig = colorsListSwipeView("big");
//$colorsView = colorsListSwipeView();
//$colorsView = "";
//$colorantView = colorantListView();
//$colorDetailView = colorDetialDataView($selectedColorHEX, $selectedColorPrice, $selectedColorName, $selectedColorPriceGroup, $selectedColorPriceList, $selectedCanSize);


?>

<?php include("includes/header.php"); ?>

<section class="mainSection left">

    <div class="selectedColorDetails">
        <div class="priceAndInfo left">
            <?php echo "<p>$00.00</p>"; ?>
            <?php echo "<p>Product name is displayed here</p>"; ?>
            <div class="priceDetails right">
                <table>
                    <tr>
                        <td class="rowTitle">Excluding VAT</td>
                        <td class="rowValue">$00.00</td>
                    </tr>
                    <tr>
                        <td class="rowTitle">Including VAT</td>
                        <td class="rowValue">$00.00</td>
                    </tr>
                    <tr>
                        <td class="rowTitle">Price Group</td>
                        <td class="rowValue">??</td>
                    </tr>
                    <tr>
                        <td class="rowTitle">Price List</td>
                        <td class="rowValue">??</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="displayColor left" style="background-color: rgba(0, 0, 0, 0.3)">
            <div class="showComponents">
                <?php echo "<p>COLORNAME</p>"; ?>
                <p>SHOW COMPONENTS</p>
            </div>
        </div>
    </div>

    <div class="spacer"></div>

    <div class="colorsAvailable">
        <div class="colorSwatch left">
            <div class="colorName">COLOR NAME</div>
        </div>
        <div class="colorSwatch left">
            <div class="colorName">COLOR NAME</div>
        </div>
        <div class="colorSwatch left">
            <div class="colorName">COLOR NAME</div>
        </div>
        <div class="colorSwatch left">
            <div class="colorName">COLOR NAME</div>
        </div>
        <div class="colorSwatch left">
            <div class="colorName">COLOR NAME</div>
        </div>
        <div class="colorSwatch left">
            <div class="colorName">COLOR NAME</div>
        </div>
        <div class="colorSwatch left">
            <div class="colorName">COLOR NAME</div>
        </div>
        <div class="colorSwatch left">
            <div class="colorName">COLOR NAME</div>
        </div>
	    <div class="colorSwatch left">
		    <div class="colorName">COLOR NAME</div>
	    </div>
	    <div class="colorSwatch left">
		    <div class="colorName">COLOR NAME</div>
	    </div>
	    <div class="colorSwatch left">
		    <div class="colorName">COLOR NAME</div>
	    </div>
	    <div class="colorSwatch left">
		    <div class="colorName">COLOR NAME</div>
	    </div>
	    <div class="colorSwatch left">
		    <div class="colorName">COLOR NAME</div>
	    </div>
	    <div class="colorSwatch left">
		    <div class="colorName">COLOR NAME</div>
	    </div>
	    <div class="colorSwatch left">
		    <div class="colorName">COLOR NAME</div>
	    </div>
	    <div class="colorSwatch left">
		    <div class="colorName">COLOR NAME</div>
	    </div>
	    <div class="colorSwatch left">
		    <div class="colorName">COLOR NAME</div>
	    </div>
	    <div class="colorSwatch left">
		    <div class="colorName">COLOR NAME</div>
	    </div>
	    <div class="colorSwatch left">
		    <div class="colorName">COLOR NAME</div>
	    </div>
	    <div class="colorSwatch left">
		    <div class="colorName">COLOR NAME</div>
	    </div>
	    <div class="colorSwatch left">
		    <div class="colorName">COLOR NAME</div>
	    </div>
	    <div class="colorSwatch left">
		    <div class="colorName">COLOR NAME</div>
	    </div>
	    <div class="colorSwatch left">
		    <div class="colorName">COLOR NAME</div>
	    </div>
	    <div class="colorSwatch left">
		    <div class="colorName">COLOR NAME</div>
	    </div>
	    <div class="colorSwatch left">
		    <div class="colorName">COLOR NAME</div>
	    </div>
	    <div class="colorSwatch left">
		    <div class="colorName">COLOR NAME</div>
	    </div>
	    <div class="colorSwatch left">
		    <div class="colorName">COLOR NAME</div>
	    </div>
	    <div class="colorSwatch left">
		    <div class="colorName">COLOR NAME</div>
	    </div>
	    <div class="colorSwatch left">
		    <div class="colorName">COLOR NAME</div>
	    </div>
	    <div class="colorSwatch left">
		    <div class="colorName">COLOR NAME</div>
	    </div>
	    <div class="colorSwatch left">
		    <div class="colorName">COLOR NAME</div>
	    </div>
	    <div class="colorSwatch left">
		    <div class="colorName">COLOR NAME</div>
	    </div>
    </div>

</section>

<section class="menuSection left">
    <div class="menuHeader">
        <img src="images/icon-header-logoWhite.svg" alt="Jub Logo"/>
        <a href="logout.php"><img class="iconImg" src="images/logout.png" /></a>
    </div>
    <div class="menuItems">

        <div class="menuItem">
            <p>PRODUCTS</p>
            <input type="text" id="product" name="product" size="25" value="" placeholder="product" />
        </div>

        <div class="menuItem">
            <p>COLLECTION</p>
            <input type="text" id="collection" name="collection" size="25" value="" placeholder="collection" />
        </div>

        <div class="menuItem">
            <p>COLOR</p>
            <input type="text" id="color" name="color" size="25" value="" placeholder="color" />
        </div>

    </div>
    <div class="menuFooter">
        Kwa je.. Footer
    </div>
</section>

<div class="components" id="colorantsShowHide">
	<div class="row tableHeader">
		<div class="left compNameBig"><p>Component Name</p></div>
		<div class="left compAmount"><p>Amount</p></div>
		<div class="left compPrice"><p>Price/Unit</p></div>
	</div>
	<div class="colorantList">
		<div class='row'>
			<div class='left compColor'><div class='colorantColor'>&nbsp;</div></div>
			<div class='left compName'><p>Name</p></div>
			<div class='left compAmount'><p>Qantity</p></div>
			<div class='left compPrice'><p>Price/unit</p></div>
		</div>
	</div>
</div>

<div class="searchResults">
	<p>SEARCH RESULTS:</p>
	<ul id="pAndCSearchResults">
	</ul>
</div>

<div class="searchResultsForColor">
	<p>SEARCH RESULTS:</p>
	<p>PRODUCTS:</p>
	<ul id="colorPSearchResults">
	</ul>
	<p>COLLECTIONS:</p>
	<ul id="colorCSearchResults">
	</ul>
</div>



<!--    <div class="displayColors">-->
<!--        --><?php //echo $colorDetailView; ?>
<!---->
<!--        <div class="colorsList">-->
<!--            <ul>-->
<!--                --><?php //echo $colorsView; ?>
<!--            </ul>-->
<!--        </div>-->
<!--        <div class="components" id="colorantsShowHide">-->
<!--            <div class="btnSlider">-->
<!--                <img src="images/arrow.png">-->
<!--                Show/Hide Components View-->
<!--            </div>-->
<!--            <div class="row tableHeader">-->
<!--                <div class="left compNameBig"><p>Component Name</p></div>-->
<!--                <div class="left compAmount"><p>Amount</p></div>-->
<!--                <div class="left compPrice"><p>Price/Unit</p></div>-->
<!--            </div>-->
<!--            --><?php //echo $colorantView; ?>
<!--        </div>-->
<!--    </div>-->






<!--    <div>-->
<!--        <img src="images/icon-header-logoWhite.svg" alt="Jub Logo"/>-->
<!--        <ul>-->
<!--            <li class="icon"><img class="iconImg" src="images/mixer.svg" /></li>-->
<!--            <li class="icon"><img class="iconImg" src="images/print.svg" /></li>-->
<!--            <li class="icon"><a href="logout.php"><img class="iconImg" src="images/logout.png" /></a></li>-->
<!--        </ul>-->
<!--    </div>-->
<!--    <nav>-->
<!--        <div class="menuChooser">-->
<!--            <p id="search">Search</p>-->
<!--        </div>-->
<!--        <div class="menuChooser">-->
<!--            <p id="productPicker">PRODUCTS</p>-->
<!--        </div>-->
<!--        <div class="menuChooser">-->
<!--            <p id="collectionPicker">COLLECTION</p>-->
<!--        </div>-->
<!--    </nav>-->








<div class="overlayDarken search">
    <div class="overlayBackground">
        <div class="closeBtn right">X</div>
        SEARCHER




        <ul>
<!--            --><?php //echo $collectionsView ?>
        </ul>
    </div>
</div>

<div class="overlayDarken productPicker">
    <div class="overlayBackground">
        <div class="closeBtn right">X</div>
        PRODUCT PICKER
        <ul id="pSearchCollectionsResults">
        </ul>
    </div>
</div>

<div class="overlayDarken collectionPicker">
    <div class="overlayBackground">
        <div class="closeBtn right">X</div>
        COLLECTION PICKER
        <ul>
<!--            --><?php //echo $collectionsView ?>
        </ul>
    </div>
</div>

<!--Footer Row-->
<!--<footer>-->
<?php include("includes/footer.php"); ?>

