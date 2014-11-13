$(document).ready(function() {

    function hasCanSize() {
        if($.trim($("#customCanSize").val()) == "" && $("#selectCanSize").prop("selectedIndex") == 0) {
            return false;
        } else {
            return true;
        }
    }

//    Navigation bar - clearinf all fields
    $("#resetAllSearchFields").click(function() {
        console.log("clear all fields");
        $("#color").val("");
        $("#selectProduct")[0].selectedIndex = 0;
        $("#selectCollection")[0].selectedIndex = 0;
    });

    $("#clearColorsSearch").click(function() {
        $("#color").val("");
    });

//    Show and set key settings
    $("#showSettingsWindow").click(function() {
        $(".setSettings").toggle( "slide", {direction: "left"} );
    });

    $("#cancelSettings, #closeSettingsWithArrow").click(function() {
        $(".setSettings").toggle( "slide", {direction: "left"} );
    });

    $("#saveSettings").click(function() {
        $(".setSettings").toggle( "slide", {direction: "left"} );
    });

//    Show extra price information
    $("#showPriceInfoPopup").click(function() {
        $("#priceInfoPopup").fadeIn();
    });

    $("#closePriceInfoPopup").click(function() {
        $("#priceInfoPopup").fadeOut();
    });

//    Run mixer/tinting machine
    $("#runTintingMachine").click(function() {
        if(hasCanSize()) {
            $("#runTintingMachinePopup").fadeIn();
        }else {
            $("#selectCanSizeError").fadeIn();
        }
    });

    $("#closeRunTintingMachinePopup").click(function() {
        $("#runTintingMachinePopup").fadeOut();
    });

//    Printing popups and functions
    $("#printLabel").click(function() {
        console.log($("#selectCanSize").prop("selectedIndex"));
        if(hasCanSize()) {
            $("#printInfoPopup").fadeIn();
            console.log("show choose number of cans");
        } else {
            $("#selectCanSizeError").fadeIn();
            console.log("error - choose can size");
        }
    });

    $("#closeSelectCanSizeError").click(function() {
        $("#selectCanSizeError").fadeOut();
    });

    $("#closePrintInfoPopup").click(function() {
        $("#printInfoPopup").fadeOut();
    });

    $("#printLabelToPrinter").click(function() {
        $("#printInfoPopup").fadeOut();
        $("#printInfoPrintingToPrinter").fadeIn();
    });

    $("#closePrintInfoPrintingToPrinter").click(function() {
        $("#printInfoPrintingToPrinter").fadeOut();
    });

//    Selecting appropriate can size
    $("#customCanSize").change(function() {
        if($.trim($("#customCanSize").val()) != "") {
            $("#selectCanSize").prop("selectedIndex", 0);
        } else {
            $("#customCanSize").val("");
        }
    });

    $("#selectCanSize").change(function() {
        if($("#selectCanSize").prop("selectedIndex") != 0) {
            $("#customCanSize").val("");
        }
    });

    $("#clearCansize").click(function() {
        $("#customCanSize").val("");
    });


});