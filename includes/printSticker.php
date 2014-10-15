<?php
/**
 * Created by IntelliJ IDEA.
 * User: jurez
 * Date: 10/14/14
 * Time: 10:01
 */

require_once("../libraries/printipp/CupsPrintIPP.php");
require_once("../libraries/tcpdf/tcpdf.php");

if(isset($_POST["printSticker"]) && isset($_POST["prodName"]) && isset($_POST["collName"]) && isset($_POST["colorName"])) {
    $printSticker = $_POST["printSticker"];
    $productName = $_POST["prodName"];
    $collectionName = $_POST["collName"];
    $colorName = $_POST["colorName"];
    if($printSticker == "yes") {
        printFileViaIpp();
    }
    echo "success";
}


function printFileViaIpp() {
    preparePDFforPrint();
    $ipp = new ExtendedPrintIPP();
    $ipp->setHost( 'localhost' );
    $ipp->setPrinterURI( '/printers/Brother_QL-570');
    $ipp->resumePrinter();
    $ipp->setData( '../files/testSticker.pdf' );
    $ipp->setAttribute("orientation-requested", "landscape");
    $ipp->printJob();
}

function preparePDFforPrint() {
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
    $html = '<span><b>Opozorilo: obvezen 2x nanos barve!</b><br>Datum proizvodnje: 26.09.2014, 13:36</span>';
    $pdf->writeHTMLCell(90, 0, 21, 34,  $html, 0, 0, 0, true, '', true);

    $pdf->SetFont('helvetica', '', 9);
    $html = '<span><b>JUMIX Trade d.o.o.</b></span>';
    $pdf->writeHTMLCell(90, 0, 21, 46,  $html, 0, 1, 0, true, '', true);

    $pdf->SetFont('helvetica', '', 8);
    $html = '<span>Dol pti Ljubljani 28, 1262 Dol pri Ljubljani<br>T: 01 5884 330; M: 051 669 348;<br>E: jumix@jub.eu</span>';
    $pdf->writeHTMLCell(90, 0, 21, 50,  $html, 0, 1, 0, true, '', true);

    $pdf->SetFont('helvetica', '', 6);
    $html = '<span><i>HVALA ZA NAKUP! ŽELIMO VAM BARVITO UGODJE BIVANJA.</i></span>';
    $pdf->writeHTMLCell(90, 0, 21, 64,  $html, 0, 1, 0, true, '', true);

    $pdf->writeHTMLCell(80, 50, 10, 18,  '', 1, 1, 0, true, '', true);

    $pdf->Output("../files/testSticker.pdf", 'F');
}