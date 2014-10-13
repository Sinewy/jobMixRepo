$(document).ready(function() {

    var selectedProduct = -1;
    var selectedCollection = -1;
    var selectedColor = -1;

    $("#product").autocomplete({
        source: function( request, response ) {
            $.ajax({
                url: "includes/findProduct.php",
                dataType: "json",
                data: {
                    term: request.term
                },
                success: function( data ) {
                    response( data );
                }
            });
        },
        minLength: 0,
        select: function( event, ui ) {
            selectedProduct = -1;
            selectedCollection = -1;
            selectedColor = -1;
            var postForPID = $.post("includes/getSelectedPID.php", {searchString: ui.item.label});
            postForPID.success(function(data) {
                selectedProduct = data;
                console.log(selectedProduct);
                var postForPSearchResults = $.post("includes/getProdustSearchResults.php", {pid: selectedProduct});
                postForPSearchResults.success(function(data) {
                    var resultData = $.parseJSON(data);


                    if(resultData.length == 1) {
                        $("#collection").val(resultData[0].name);
                        selectedCollection = resultData[0].id;
                        updateColorsView(selectedProduct, selectedCollection, null);
                    } else {
                        $("#pAndCSearchResults").html(prepareSearchResults(resultData, "sColl"));
                        $(".searchResultLink").click(function() {
                            doOnResultLinkClick(this);
                        });
                        $(".searchResults").toggle( "slide", {direction: "right"} );
                    }
                });
            });
        }
    });

    $("#collection").autocomplete({
        source: function( request, response ) {
            $.ajax({
                url: "includes/findCollection.php",
                dataType: "json",
                data: {
                    term: request.term
                },
                success: function( data ) {
                    response( data );
                }
            });
        },
        minLength: 0,
        select: function( event, ui ) {
            selectedProduct = -1;
            selectedCollection = -1;
            selectedColor = -1;
            var postForCID = $.post("includes/getSelectedCID.php", {searchString: ui.item.label});
            postForCID.success(function(data) {
                selectedCollection = data;
                var postForCSearchResults = $.post("includes/getCollectionSearchResults.php", {cid: selectedCollection});
                postForCSearchResults.success(function(data) {
                    var resultData = $.parseJSON(data);
                    if(resultData.length == 1) {
                        $("#product").val(resultData[0].name);
                        selectedProduct = resultData[0].id;
                        updateColorsView(selectedProduct, selectedCollection, null);
                    } else {
                        $("#pAndCSearchResults").html(prepareSearchResults(resultData, "sProd"));
                        $(".searchResultLink").click(function() {
                            doOnResultLinkClick(this);
                        });
                        $(".searchResults").toggle( "slide", {direction: "right"} );
                    }
                });
            });
        }
    });

    $( "#color" ).autocomplete({
        source: function( request, response ) {
            $.ajax({
                url: "includes/findColor.php",
                dataType: "json",
                data: {
                    term: request.term
                },
                success: function( data ) {
                    console.log(data);
                    response( data );
                }
            });
        },
        minLength: 0,
        select: function( event, ui ) {
//            var postForColorId = $.post("includes/getSelectedColorId.php", {searchString: ui.item.label});
            selectedProduct = -1;
            selectedCollection = -1;
            selectedColor = -1;

            selectedColor = extractColorId(ui.item.label);

//            postForColorId.success(function(data) {
//                selectedColor = data;
                console.log(selectedColor);

                var postForProductsAndCollections = $.post("includes/getProductsAndCollectionsForColor.php", {scid: selectedColor});
                postForProductsAndCollections.success(function(data) {
                    var resultData = $.parseJSON(data);

                    console.log(resultData[0].length);
                    console.log(resultData[1].length);

                    if(resultData[0].length == 1 && resultData[1].length == 1) {
                        console.log("ONE productds and ONE collections");
                        $("#product").val(resultData[0][0].name);
                        $("#collection").val(resultData[1][0].name);
                        selectedProduct = resultData[0][0].id;
                        selectedCollection = resultData[1][0].id;
                        updateColorsView(selectedProduct, selectedCollection, selectedColor);
                    } else if(resultData[0].length == 1 && resultData[1].length > 1) {
                        console.log("ONE productds and more collections");
                        selectedProduct = resultData[0][0].id;
                        $("#colorPSearchResults").html("<li>" + resultData[0][0].name + "</li>");
                        $("#colorCSearchResults").html(prepareSearchResults(resultData[1], "sColl"));
                        $(".searchResultLink").click(function() {
                            doOnColorResultLinkClick(this);
                        });
                        $(".searchResultsForColor").toggle( "slide", {direction: "right"} );

                    } else if(resultData[0].length > 1 && resultData[1].length == 1) {
                        console.log("more productds and ONE collections");
                        selectedCollection = resultData[1][0].id;
                        $("#colorPSearchResults").html(prepareSearchResults(resultData[0], "sProd"));
                        $("#colorCSearchResults").html("<li>" + resultData[1][0].name + "</li>");
                        $(".searchResultLink").click(function() {
                            doOnColorResultLinkClick(this);
                        });
                        $(".searchResultsForColor").toggle( "slide", {direction: "right"} );
                    } else if(resultData[0].length == 0 && resultData[1].length == 0) {
                        $(".searchResultsForColor").html("<p>This color doeas not exist in any collection or product. Choose anoter color.</p><div class='closeSearchResultsForColorBtn'> OK - Close </div>");
                        $(".closeSearchResultsForColorBtn").click(function() {
                            $(".searchResultsForColor").toggle( "slide", {direction: "right"} );
                            $(".searchResultsForColor").html("<p>SEARCH RESULTS:</p><p>PRODUCTS:</p><ul id='colorPSearchResults'></ul><p>COLLECTIONS:</p><ul id='colorCSearchResults'></ul>");
                        });
                        $(".searchResultsForColor").toggle( "slide", {direction: "right"} );
                    } else {
                        console.log("more productds and more collections");
                        $("#colorPSearchResults").html(prepareSearchResults(resultData[0], "sProd"));
                        $("#colorCSearchResults").html(prepareSearchResults(resultData[1], "sColl"));
                        $(".searchResultLink").click(function() {
                            doOnColorResultLinkClick(this);
                        });
                        $(".searchResultsForColor").toggle( "slide", {direction: "right"} );

                    }
                    console.log(typeof resultData);
                    console.log(resultData);
                    console.log(resultData.length);
                });
//            });
        }
    });

    function extractColorId(cName) {
        var startIndex = cName.indexOf("(");
        var endIndex = cName.indexOf(")");
        var cId = cName.substring(startIndex + 1, endIndex);
        return cId;

    }

    function doOnColorResultLinkClick(thisLink) {

        console.log("1 selected Product: " + selectedProduct);
        console.log("1 selected Collection: " + selectedCollection);
        console.log("1 selected Color: " + selectedColor);


        var corp = thisLink.id.substr(0, 5);
        if(corp == "sColl") {
            $("#collection").val(thisLink.innerText);
            selectedCollection = thisLink.id.substr(5);

            console.log("2 selected Product: " + selectedProduct);
            console.log("2 selected Collection: " + selectedCollection);
            console.log("2 selected Color: " + selectedColor);

            if(selectedProduct > -1 && selectedCollection > -1 && selectedColor > -1) {
                $(".searchResultsForColor").toggle( "slide", {direction: "right"} );
                updateColorsView(selectedProduct, selectedCollection, selectedColor);
                return true;
            }
            var postForProductsByColorAndCollection = $.post("includes/getProductsByColorAndCollection.php", {colorid: selectedColor, collectionid: selectedCollection});
            postForProductsByColorAndCollection.success(function(data) {
                var resultData = $.parseJSON(data);
                if(resultData.length == 1) {
                    selectedProduct = resultData[0].id;
                    $("#product").val(resultData[0].name);
                    $(".searchResultsForColor").toggle( "slide", {direction: "right"} );
                    updateColorsView(selectedProduct, selectedCollection, selectedColor);
                }
                $("#colorPSearchResults").html(prepareSearchResults(resultData, "sProd"));
                $(".searchResultLink").click(function() {
                    doOnColorResultLinkClick(this);
                });
            });
        } else if (corp == "sProd") {

            console.log("sProd1 selected Product: " + selectedProduct);
            console.log("sProd1 selected Collection: " + selectedCollection);
            console.log("sProd1 selected Color: " + selectedColor);

            $("#product").val(thisLink.innerText);
            selectedProduct = thisLink.id.substr(5);

            console.log("sProd2 selected Product: " + selectedProduct);
            console.log("sProd2 selected Collection: " + selectedCollection);
            console.log("sProd2 selected Color: " + selectedColor);

            if(selectedProduct > -1 && selectedCollection > -1 && selectedColor > -1) {
                $(".searchResultsForColor").toggle( "slide", {direction: "right"} );
                updateColorsView(selectedProduct, selectedCollection, selectedColor);
                return true;
            }
            var postForCollectionByColorAndProduct = $.post("includes/getCollectionsByColorAndProduct.php", {colorid: selectedColor, productid: selectedProduct});
            postForCollectionByColorAndProduct.success(function(data) {

                console.log(data);

                var resultData = $.parseJSON(data);
                if(resultData.length == 1) {
                    selectedCollection = resultData[0].id;
                    $("#collection").val(resultData[0].name);
                    $(".searchResultsForColor").toggle( "slide", {direction: "right"} );
                    updateColorsView(selectedProduct, selectedCollection, selectedColor);
                }
                $("#colorCSearchResults").html(prepareSearchResults(resultData, "sColl"));
                $(".searchResultLink").click(function() {
                    doOnColorResultLinkClick(this);
                });
            });
        }




    }

    function updateColorsView(productId, collectionId, colorId) {

        console.log("selected color id: " + colorId);
        console.log("selected prod id: " + productId);
        console.log("selected coll id: " + collectionId);

        var postForAvailableColors = $.post("includes/getAvailableColors.php", {pid: productId, cid: collectionId});
        postForAvailableColors.success(function(data) {

            console.log(data);

            var resultData = $.parseJSON(data);

            console.log("postForAvailableColors:" + resultData);


            $(".colorsAvailable").html(displayAvailableColors(resultData, colorId));
            $(".colorSwatchBtn").click(function() {
                var cid = $(this).attr("href").substr(1);
                updateColorsDetailVew(cid, $(".colorName", this).html())
                $(".selectedColorSwatch").removeClass("selectedColorSwatch");
                $(".colorSwatch", this).addClass("selectedColorSwatch");
            });

        });
    }

    function prepareSearchResults(data, selectedItem) {
        var out = "";
        for(var i = 0; i < data.length; i++) {
            out += "<li><a href='#" + data[i].id + "' class='searchResultLink' id='" + selectedItem + data[i].id + "'>" + data[i].name + "</a></li>";
        }
        return out;
    }

    function doOnResultLinkClick(thisLink) {
        var corp = thisLink.id.substr(0, 5);
        if(corp == "sColl") {
            $("#collection").val(thisLink.innerText);
            selectedCollection = thisLink.id.substr(5);
        } else if (corp == "sProd") {
            $("#product").val(thisLink.innerText);
            selectedProduct = thisLink.id.substr(5);
        }
        $(".searchResults").toggle( "slide", {direction: "right"} );
        updateColorsView(selectedProduct, selectedCollection, null);
    }

    function displayAvailableColors(data, selectedColorId) {
//        console.log(data);
        var out = "";
        for(var i = 0; i < data.length; i++) {
//            console.log(data[i]);
            out += "<a href='#" + data[i].id + "' class='colorSwatchBtn'>";
            if(selectedColorId == null && i == 0) {
                out += "<div class='colorSwatch selectedColorSwatch left' style='background: #" + makeHexColorFromRgb(data[i].rgb) + "'>";
                selectedColor = data[i].id;
                updateColorsDetailVew(data[i].id, data[i].name);
//                $(".displayColor").click(function() {
//                    console.log("called toggle from THE SECOND link");
//                    $("#colorantsShowHide").toggle( "slide", {direction: "up"} );
//                });
            } else if(selectedColorId == data[i].colorId) {
                out += "<div class='colorSwatch selectedColorSwatch left' style='background: #" + makeHexColorFromRgb(data[i].rgb) + "'>";
                selectedColor = data[i].id;
                updateColorsDetailVew(data[i].id, data[i].name);

            } else {
                out += "<div class='colorSwatch left' style='background: #" + makeHexColorFromRgb(data[i].rgb) + "'>";
            }
            out += "<div class='colorName'>" + data[i].name + "</div>";
            out += "</div>";
            out += "</a>";
        }
        return out;
    }

    function makeHexColorFromRgb(rgbValue) {
        var hexColor = parseInt(rgbValue).toString(16);
        if(hexColor.length < 6) {
            var diff = 6 - hexColor.length;
            for (var i = 0; i < diff; i++) {
                hexColor = "0" + hexColor;
            }
        }
        return hexColor;
    }

    function randomIntFromInterval(min,max) {
        return (Math.random()*(max-min+1)+min).toFixed(2);
        //return Math.floor(Math.random()*(max-min+1)+min);
    }

    function updateColorsDetailVew(colorId, name) {
        var postForSelectedColor = $.post("includes/getSelectedColor.php", {scid: colorId});
        postForSelectedColor.success(function(data) {
            var myData = $.parseJSON(data);
            var randPrice = randomIntFromInterval(40, 90);
            var colorDetail = "<div class='priceAndInfo left'>";
            colorDetail += "<p>$" + randPrice + "</p>";
            colorDetail += "<p>" + $("#product").val() + "</p>";
            colorDetail += " <div class='priceDetails right'>";
            colorDetail += "<table><tr><td class='rowTitle'>Excluding VAT</td><td class='rowValue'>";
            colorDetail += "$" + (randPrice * 0.8).toFixed(2) + "</td></tr>";
            colorDetail += "<tr><td class='rowTitle'>VAT</td><td class='rowValue'>";
            colorDetail += "$" + (randPrice * 0.2).toFixed(2) + "</td></tr>";
            colorDetail += "<tr><td class='rowTitle'>Price Group</td><td class='rowValue'>";
            colorDetail +=  myData.price_group_description + "</td></tr>";
            colorDetail += "<tr><td class='rowTitle'>Price List</td><td class='rowValue'>";
            colorDetail +=  "Price + 10%</td></tr>";
            colorDetail +=  "</table></div></div>";
            colorDetail +=  "<div class='displayColor left' style='background-color: #" + makeHexColorFromRgb(myData.rgb) + "'>";
            colorDetail +=  "<div class='showComponents'>";
            colorDetail +=  "<p>" + name + "</p>";
            colorDetail +=  "<p>SHOW COMPONENTS</p>";
            colorDetail +=  "</div></div>";
            $(".selectedColorDetails").html(colorDetail);
            $(".displayColor").click(function() {
                console.log("called toggle from THE SECOND2 link");
                $("#colorantsShowHide").toggle( "slide", {direction: "up"} );
            });
        });
        var postForColorants = $.post("includes/getColorantsForColor.php", {scid: colorId});
        postForColorants.success(function(data) {
            var myData = $.parseJSON(data);
            var componentView = "";
            for(var i = 0; i < myData.length; i++) {
                componentView += "<div class='row'>";
                componentView += "<div class='left compColor'><div class='colorantColor' style='background:#" + makeHexColorFromRgb(myData[i].rgb) + "'>&nbsp;</div></div>";
                componentView += "<div class='left compName'><p>" + myData[i].name + "</p></div>"
                var qty = parseFloat(myData[i].quantity);
                componentView += "<div class='left compAmount'><p>" + qty.toFixed(2) + "</p></div>";
                var price = parseFloat(myData[i].price_per_unit);
                componentView += "<div class='left compPrice'><p>" + price.toFixed(2) + "</p></div>";
                componentView += "</div>";
            }
            $(".colorantList").html(componentView);

        });
    }

//    var componentViewState = "down";
//
//    $( ".btnSlider" ).click(function() {
//        if(componentViewState == "down") {
//            componentViewState = "up";
//            var topPosition = 650 - $( "#colorantsShowHide").height() + 10;
//            $( "#colorantsShowHide" ).animate(
//                { top: topPosition }, {
//                    duration: 600,
//                    easing: 'easeOutBack'
//                })
//            $( ".btnSlider img" ).animateRotate(0, 90, 400, "swing");
//        } else {
//            componentViewState = "down";
//            $( "#colorantsShowHide" ).animate(
//                { top:  820}, {
//                    duration: 600,
//                    easing: 'swing'
//                })
//            $( ".btnSlider img" ).animateRotate(90, 0, 400, "swing");
//        }
//    });
//
//    $.fn.animateRotate = function(angleFrom, angleTo, duration, easing, complete) {
//        var args = $.speed(duration, easing, complete);
//        var step = args.step;
//        return this.each(function(i, e) {
//            args.step = function(now) {
//                $.style(e, 'transform', 'rotate(' + now + 'deg)');
//                if (step) return step.apply(this, arguments);
//            };
//
//            $({deg: angleFrom}).animate({deg: angleTo}, args);
//        });
//    };
//
//    $("#search").click(function() {
//        $(".search").fadeIn("slow");
//    });
//
//    $("#productPicker").click(function() {
//        $(".productPicker").fadeIn("slow");
//        $( ".productPicker" ).toggle( "slide" );
//        $(".productPicker").effect("slide", {}, "slow");
//    });
//
//    $("#collectionPicker").click(function() {
//        $(".collectionPicker").fadeIn("slow");
//    });
//
//    $(".productPicker").click(function(event) {
//        if(event.target == this) {
//            $(".overlayDarken").fadeOut("slow");
//            $(".overlayDarken").effect("slide", {}, "slow");
//            $( ".productPicker" ).toggle( "slide" );
//        }
//    });
//
//    $(".closeBtn, .overlayDarken").click(function(event) {
//        if(event.target == this) {
//            $(".overlayDarken").fadeOut("slow");
//        }
//    });

});