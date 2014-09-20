$(document).ready(function() {
    if ($(openidBaseField + "login").length) {
        $(openidBaseField + "login").autocomplete({
//            source: $.parseJSON(swarmUsers),
            source: function(request, response) {
                response($.map($.parseJSON(swarmUsers), function( item ){
                    return {
                        label: item.label,
                        fullname : item.fullname
                    }
                }));
            },
            select: function (event, ui) {
                event.preventDefault();
                $(openidBaseField + "login").val(ui.item.label);
                $.ajax({
                    type: "GET",
                    url: swarmUserDataUrl + "/" + $(openidBaseField + "login").val(),
                    dataType: 'json',
                    success: function (data, textStatus, jqXHR) {
                        var json = eval(data);
                        if (json.hasOwnProperty("notif")) {
                            $(".openid-msg .element").text(json.notif);
                            $(".swarm-msg").show();
                        } else if (json.hasOwnProperty("account")) {
                            $(".openid-msg").hide();
                            var fields = $.parseJSON(swarmFieldsMapping);
                            for (var key in fields) {
                                $(key).val(json.account[fields[key]]);
                            }
                        }
                    }
                });
            }
        }).data( "ui-autocomplete" )._renderItem = function(ul, item) {
            return $("<li></li>")
                .data( "ui-autocomplete-item", item )
                .append("<a><strong>" + item.label + "</strong> (" + item.fullname + ")</a>")
                .appendTo( ul );
        };
    }
});
