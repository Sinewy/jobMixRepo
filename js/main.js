$(document).ready(function() {


    $(".displayColor").click(function() {
        console.log("opening components")
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