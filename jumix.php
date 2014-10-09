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
$colorsView = colorsListSwipeView();
$colorantView = colorantListView();
$colorDetailView = colorDetialDataView($selectedColorHEX, $selectedColorPrice, $selectedColorName, $selectedColorPriceGroup, $selectedColorPriceList, $selectedCanSize);

?>

<?php include("includes/header.php"); ?>

<section class="mainSection left">
    <div class="selectedColorDetails">
        <div class="priceAndInfo left">
            <?php echo "<p>$1.234,44</p>>"; ?>
            <?php echo "<p>Product name is displayed here</p>>"; ?>
            <div class="priceDetails">

            </div>
        </div>
        <div class="displayColor left">
            <div class="showComponents">
                <?php echo "<p>COLORNAME_ACH2394</p>"; ?>
                <p>SHOW COMPONENTS</p>
            </div>
        </div>

    </div>
    <div class="colorAvailable">
        <div class="menuHeader"></div>
        <div class="menuItems"></div>
        <div class="menuFooter"></div>
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
</section>

<section class="menuSection left">

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
</section>




<div class="overlayDarken search">
    <div class="overlayBackground">
        <div class="closeBtn right">X</div>
        SEARCHER




        <ul>
            <?php echo $collectionsView ?>
        </ul>
    </div>
</div>

<div class="overlayDarken productPicker">
    <div class="overlayBackground">
        <div class="closeBtn right">X</div>
        PRODUCT PICKER
        <ul>
            <?php echo $collectionsView ?>
        </ul>
    </div>
</div>

<div class="overlayDarken collectionPicker">
    <div class="overlayBackground">
        <div class="closeBtn right">X</div>
        COLLECTION PICKER
        <ul>
            <?php echo $collectionsView ?>
        </ul>
    </div>
</div>

<!--Footer Row-->
<!--<footer>-->
<?php include("includes/footer.php"); ?>

