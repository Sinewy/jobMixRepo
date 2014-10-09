/*
* Author : Ali Aboussebaba
* Email : bewebdeveloper@gmail.com
* Website : http://www.bewebdeveloper.com
* Subject : Autocomplete using PHP/MySQL and jQuery
*/

$(document).ready(function() {

//
//
//
// autocomplet : this function will be executed every time we change the text
//function autocomplet() {
//	var keyword = $('#country_id').val();
//	$.ajax({
//		url: 'ajax_refresh.php',
//		type: 'POST',
//		data: {keyword:keyword},
//		success:function(data){
//			$('#country_list_id').show();
//			$('#country_list_id').html(data);
//		}
//	});
//}
//
//// set_item : this function will be executed when we select an item
//function set_item(item) {
//	// change input value
//	$('#country_id').val(item);
//	// hide proposition list
//	$('#country_list_id').hide();
//}

//$( "#birds" ).autocomplete({
//    source: "getData.php",
//    minLength: 2,
//    select: function( event, ui ) {
//        log( ui.item ?
//            "Selected: " + ui.item.value + " aka " + ui.item.id :
//            "Nothing selected, input was " + this.value );
//    }
//});

//
//$('#country_name').autocomplete({
//
//    source: function( request, response ) {
//        console.log("autocomplete");
//        $.ajax({
//            url : 'getData.php',
//            dataType: "json",
//            data: {
//                searchString: request.term,
//                type: 'country'
//            },
//            success: function( data ) {
//                response( $.map( data, function( item ) {
//                    return {
//                        label: item,
//                        value: item
//                    }
//                }));
//            }
//        });
//    },
//    autoFocus: true,
//    minLength: 0
//});


    $.widget("ui.combobox", {
        options:{
            dataSource: "",
            dataType: ""
        },
        _create: function() {
            var self = this,
                select = this.element.hide(),
                selected = select.children(":selected"),
                value = selected.val() ? selected.text() : "";
            var input = this.input = $("<input>").insertAfter(select).val(value).autocomplete({
                delay: 0,
                minLength: 0,
                source: function(request, response) {
                    $.ajax({
                        url: self.options.dataSource,
                        type: "GET",
                        dataType: self.options.dataType,
                        data: {
                            featureClass: "P",
                            style: "full",
                            maxRows: 12,
                            name_startsWith: request.term
                        },
                        success: function(data) {
                            response($.map(data.geonames, function(item) {
                                return {
                                    label: item.name + (item.adminName1 ? ", " + item.adminName1 : "") + ", " + item.countryName,
                                    value: item.name
                                }
                            }));
                        }
                    })
                },
                //selected index
                select: function(event, ui) {
                    //debugger;
                    //alert(ui.item.value);
                }

            }).addClass("ui-widget ui-widget-content ui-corner-left");

            input.data("autocomplete")._renderItem = function(ul, item) {
                return $("<li></li>").data("item.autocomplete", item).append("<a>" + item.label + "</a>").appendTo(ul);
            };

            this.button = $("<button type='button'>&nbsp;</button>").attr("tabIndex", -1).attr("title", "Show All Items").insertAfter(input).button({
                icons: {
                    primary: "ui-icon-triangle-1-s"
                },
                text: false
            }).removeClass("ui-corner-all").addClass("ui-corner-right ui-button-icon").click(function() {
                // close if already visible
                if (input.autocomplete("widget").is(":visible")) {
                    input.autocomplete("close");
                    return;
                }

                // work around a bug (likely same cause as #5265)
                $(this).blur();

                // pass empty string as value to search for, displaying all results
                console.log($(this));
                console.log(input);
                //debugger;
                input.autocomplete("search", input.val());
                input.focus();
            });
        },

        destroy: function() {
            this.input.remove();
            this.button.remove();
            this.element.show();
            $.Widget.prototype.destroy.call(this);
        }
    });

//    $("#cbCity").combobox({
//        dataSource: "getData.php",
//        dataType: "json",
//        minLength: 2,
//        select: function(event, ui) {
//            log(ui.item ? "Selected: " + ui.item.value + " aka " + ui.item.id : "Nothing selected, input was " + this.value);
//        }
//
//    });

});