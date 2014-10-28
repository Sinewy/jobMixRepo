<?php
/**
 * Created by IntelliJ IDEA.
 * User: jurez
 * Date: 10/14/14
 * Time: 10:01
 */
require_once("dbc.php");
require_once("globalFunctions.php");
require_once("../libraries/printipp/CupsPrintIPP.php");
require_once("../libraries/tcpdf/tcpdf.php");

//if(isset($_POST["printSticker"]) && isset($_POST["prodName"]) && isset($_POST["collName"]) && isset($_POST["colorName"])) {
if(isset($_POST["printSticker"]) && isset($_POST["productId"]) && isset($_POST["collectionId"]) && isset($_POST["formulaId"]) && isset($_POST["cansizeId"]) && isset($_POST["cansizeValue"])) {
    $printSticker = $_POST["printSticker"];
    $productId = $_POST["productId"];
    $collectionId = $_POST["collectionId"];
    $formulaId = $_POST["formulaId"];
    $cansizeId = $_POST["cansizeId"];
    $cansizeValue = $_POST["cansizeValue"];

    $productName = findProductById($productId)["name"];
    $collectionName = findCollectionById($collectionId)["name"];
    $colorData = findColorNameByFormulaId($formulaId);
    $colorName = $colorData["name"];
    $baseId = $colorData["bases_id"];
    $colorantListObj = findAllColorantsForFormula($formulaId);
    $baseInfoObj = findBaseDetails($baseId, $productId, $cansizeId);

    $colorantList = [];
    foreach($colorantListObj as $key => $value) {
        $colorantList[$key] = $value;
    }

    $baseInfo = [];
    foreach($baseInfoObj as $key => $value) {
        $baseInfo[$key] = $value;
    }

    if($printSticker == "yes") {
        printFileViaIpp1();
        printFileViaIpp2();
    }
//    echo $productName . " " .  $collectionName . " " . $colorName;
    echo "success";
}


function printFileViaIpp1() {
    preparePDFforPrint1();
    $ipp = new ExtendedPrintIPP();
    $ipp->setHost( 'localhost' );
    $ipp->setPrinterURI( '/printers/Brother_QL-570');
    $ipp->resumePrinter();
    $ipp->setData( '../files/testSticker.pdf' );
    $ipp->setAttribute("orientation-requested", "landscape");
    $ipp->printJob();
}

function preparePDFforPrint1() {
    global $productName;
    global $collectionName;
    global $colorName;

    $pdfLayout = array(95, 90); // brother dimensions
    $pdf = new TCPDF("L", "mm", $pdfLayout, true, "UTF-8", false);

    $pdf->SetCreator("RPi");
    $pdf->SetAuthor("Pi User");
    $pdf->SetTitle("Test pdf print");
    $pdf->SetSubject("Print test");
    $pdf->SetKeywords("barcode, test, print, rpi, raspberry, demo");

    // remove default header/footer
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);

    // add a page
    $pdf->AddPage();

    $imgSize = "15";

    $html = '<img src="../images/can.png" border="0" height="' . $imgSize . '" width="' . $imgSize . '" />';
    $pdf->writeHTMLCell(20, 0, 12, 20,  $html, 0, 1, 0, true, '', true);

    $html = '<img src="../images/color.png" border="0" height="' . $imgSize . '" width="' . $imgSize . '" />';
    $pdf->writeHTMLCell(20, 0, 12, 28,  $html, 0, 1, 0, true, '', true);

    $html = '<img src="../images/warning.png" border="0" height="' . $imgSize . '" width="' . $imgSize . '" />';
    $pdf->writeHTMLCell(20, 0, 12, 34,  $html, 0, 1, 0, true, '', true);

    $html = '<img src="../images/cart.png" border="0" height="' . $imgSize . '" width="' . $imgSize . '" />';
    $pdf->writeHTMLCell(20, 0, 12, 46,  $html, 0, 1, 0, true, '', true);

    $pdf->SetFont('helvetica', '', 10);
    $html = '<span><b>' . $productName . '</b></span>';
    $pdf->writeHTMLCell(90, 0, 21, 20,  $html, 0, 0, 0, true, '', true);

    $pdf->SetFont('helvetica', '', 8);
    $html = '<span><b>' . $collectionName . ': ' . $colorName . '</b></span>';
    $pdf->writeHTMLCell(90, 0, 21, 28,  $html, 0, 0, 0, true, '', true);

    $pdf->SetFont('helvetica', '', 9);
    $date = date("d.m.Y, ");
    $hour = date("H") + 2;
    $date .= $hour . date(":i");
    $html = '<span><b>Opozorilo: obvezen 2x nanos barve!</b><br>Datum proizvodnje: ' . $date . '</span>';
    $pdf->writeHTMLCell(90, 0, 21, 34,  $html, 0, 0, 0, true, '', true);

    $pdf->SetFont('helvetica', '', 9);
    $html = '<span><b>JUMIX Trade d.o.o.</b></span>';
    $pdf->writeHTMLCell(90, 0, 21, 46,  $html, 0, 1, 0, true, '', true);

    $pdf->SetFont('helvetica', '', 8);
    $html = '<span>Dol pri Ljubljani 28, 1262 Dol pri Ljubljani<br>T: 01 5884 330; M: 051 669 348;<br>E: jumix@jub.eu</span>';
    $pdf->writeHTMLCell(90, 0, 21, 50,  $html, 0, 1, 0, true, '', true);

    $pdf->SetFont('helvetica', '', 6);
    $html = '<span><i>HVALA ZA NAKUP! ŽELIMO VAM BARVITO UGODJE BIVANJA.</i></span>';
    $pdf->writeHTMLCell(90, 0, 21, 64,  $html, 0, 1, 0, true, '', true);

    $pdf->writeHTMLCell(80, 50, 10, 18,  '', 1, 1, 0, true, '', true);

    $pdf->Output("../files/testSticker.pdf", 'F');
}

function printFileViaIpp2() {
    preparePDFforPrint2();
    $ipp = new ExtendedPrintIPP();
    $ipp->setHost( 'localhost' );
    $ipp->setPrinterURI( '/printers/Brother_QL-570');
    $ipp->resumePrinter();
    $ipp->setData( '../files/testSticker2.pdf' );
    $ipp->setAttribute("orientation-requested", "landscape");
    $ipp->printJob();
}

function preparePDFforPrint2() {
    global $productName;
    global $collectionName;
    global $colorName;
    global $colorantList;
    global $baseInfo;
    global $cansizeValue;

    $pdfLayout = array(95, 90); // brother dimensions
    $pdf = new TCPDF("L", "mm", $pdfLayout, true, "UTF-8", false);

    $pdf->SetCreator("RPi");
    $pdf->SetAuthor("Pi User");
    $pdf->SetTitle("Test pdf print");
    $pdf->SetSubject("Print test");
    $pdf->SetKeywords("barcode, test, print, rpi, raspberry, demo");

    // remove default header/footer
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);

    // add a page
    $pdf->AddPage();

    $pdf->SetFont('helvetica', '', 10);
    $html = '<span><b>' . $productName . ' ' . $cansizeValue . '</b></span>';
    $pdf->writeHTMLCell(90, 0, 12, 20,  $html, 0, 0, 0, true, '', true);

    $pdf->SetFont('helvetica', '', 8);
    $html = '<span><b>' . $collectionName . ': ' . $colorName . '</b></span>';
    $pdf->writeHTMLCell(90, 0, 12, 25,  $html, 0, 0, 0, true, '', true);

    $pdf->SetFont('helvetica', '', 8);
    $html = '<table border="1" cellpadding="2" align="center">';
    $html .= '<tr>';
    $html .= '<td width="100">' . $baseInfo[0]["name"] . '</td>';
    $html .= '<td width="100">' . $cansizeValue . '</td>';
    $html .= '</tr>';
    foreach($colorantList as $key => $value) {
        $html .= "<tr>";
        $html .= "<td>" . $value["name"] . "</td>";
        $html .= "<td>" . $value["quantity"] . "</td>";
        $html .= "</tr>";
    }
    $html .= "</table>";
    $pdf->setPageMark();
    $pdf->writeHTMLCell(90, 0, 12, 30,  $html, 0, 0, 0, true, '', true);

    $pdf->writeHTMLCell(80, 50, 10, 18,  '', 1, 1, 0, true, '', true);

    $pdf->Output("../files/testSticker2.pdf", 'F');
}