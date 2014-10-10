$(document).ready(function() {

    var selectedProduct, selectedCollection, selectedColor;



    $(".displayColor").click(function() {
        console.log("opening components")
    });


    var availableTags =[
        "ActionScript",
        "AppleScript",
        "Asp",
        "BASIC",
        "C",
        "C++",
        "Clojure",
        "COBOL",
        "ColdFusion",
        "Erlang",
        "Fortran",
        "Groovy",
        "Haskell",
        "Java",
        "JavaScript",
        "Lisp",
        "Perl",
        "PHP",
        "Python",
        "Ruby",
        "Scala",
        "Scheme"
    ];

//    $( "#product" ).autocomplete({
//        source: "includes/findProduct.php",
//        minLength: 3
//    });

    $( "#product" ).autocomplete({
        source: function( request, response ) {
            $.ajax({
                url: "includes/findProduct.php",
                dataType: "json",
                data: {
                    term: request.term
                },
                success: function( data ) {
                    console.log(data);
//                    console.log(data.keys());
//                    var pNames = [], pIds = [];
//                    for(var key in data) {
//                        pNames.push(data[key]);
//                        pIds.push(key);
//                    }
//                    var myData = [{
//                        label: data["name"],
//                        label: data.name,
//                        value: data.code,
//                        value: data["name"],
//                        id: data["id"]
//                    }];

                    response( data );
//                    response( $.map( data, function( item ) {
//                        //alert(item.label);
//                        console.log(item);
//                        return {
//                            label: item.label,
//                            value: item.value     // EDIT
//                        }
//                    }));
                }
            });
        },
        minLength: 0,
        select: function( event, ui ) {

            var postForPID = $.post("includes/getSelectedPID.php", {searchString: ui.item.label});
            postForPID.success(function(data) {
                selectedProduct = data;
                var postForPSearchResults = $.post("includes/getProdustSearchResults.php", {pid: selectedProduct});
                postForPSearchResults.success(function(data) {
                    $("#productSearchResults").html(data);
                    console.log(data);

//                    selectedProduct = data;

                });
            });

            $(".searchResults").toggle( "slide", {direction: "right"} );
            $("#product").prop("disabled", true);
            console.log(ui.item);

//            if(ui.item) {
//                console.log(ui.item);
//            } else {
//                console.log("Nothing selected");
//            }

//            log( ui.item ?
//                "Selected: " + ui.item.label :
//                "Nothing selected, input was " + this.value);
        },
        open: function() {
//            $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
//            console.log("open drop down")
        },
        close: function() {
//            $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
//            console.log("close drop down")
        },
        focus: function() {
//            $("#collection :input").prop("disabled", true);
//            $("#color :input").prop("disabled", true);
        }
    });



    $( "#collection" ).autocomplete({
        source: function( request, response ) {
            $.ajax({
                url: "includes/findCollection.php",
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
        minLength: 0
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
        minLength: 0
    });



    var componentViewState = "down";

    $( ".btnSlider" ).click(function() {
        if(componentViewState == "down") {
            componentViewState = "up";
            var topPosition = 650 - $( "#colorantsShowHide").height() + 10;
            $( "#colorantsShowHide" ).animate(
                { top: topPosition }, {
                    duration: 600,
                    easing: 'easeOutBack'
                })
            $( ".btnSlider img" ).animateRotate(0, 90, 400, "swing");
        } else {
            componentViewState = "down";
            $( "#colorantsShowHide" ).animate(
                { top:  620}, {
                    duration: 600,
                    easing: 'swing'
                })
            $( ".btnSlider img" ).animateRotate(90, 0, 400, "swing");
        }
    });

    $.fn.animateRotate = function(angleFrom, angleTo, duration, easing, complete) {
        var args = $.speed(duration, easing, complete);
        var step = args.step;
        return this.each(function(i, e) {
            args.step = function(now) {
                $.style(e, 'transform', 'rotate(' + now + 'deg)');
                if (step) return step.apply(this, arguments);
            };

            $({deg: angleFrom}).animate({deg: angleTo}, args);
        });
    };

    $("#search").click(function() {
        $(".search").fadeIn("slow");
    });

    $("#productPicker").click(function() {
//        $(".productPicker").fadeIn("slow");
        $( ".productPicker" ).toggle( "slide" );
//        $(".productPicker").effect("slide", {}, "slow");
    });

    $("#collectionPicker").click(function() {
        $(".collectionPicker").fadeIn("slow");
    });

    $(".productPicker").click(function(event) {
        if(event.target == this) {
//            $(".overlayDarken").fadeOut("slow");
//            $(".overlayDarken").effect("slide", {}, "slow");
            $( ".productPicker" ).toggle( "slide" );
        }
    });

//    $(".closeBtn, .overlayDarken").click(function(event) {
//        if(event.target == this) {
//            $(".overlayDarken").fadeOut("slow");
//        }
//    });






});