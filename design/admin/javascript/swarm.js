$(document).ready(function() {
    if ($(".swarm-msg").length) {
        $(openidBaseField + "login").autocomplete({
            source: $.parseJSON(swarmUsers),
            select: function (event, ui) {
                event.preventDefault();
                $(openidBaseField + "login").val(ui.item.label);
                $.blockUI({
                    css: {
                        border: "none",
                        padding: "15px",
                        backgroundColor: "none"
                    },
                    message: $("#loading"),
                    overlayCSS: {
                        backgroundColor: "#000",
                        opacity: 0.1,
                        cursor: "wait"
                    }
                });
                $.ajax({
                    type    : "GET",
                    url     : swarmUserDataUrl + "/" + $(openidBaseField + "login").val(),
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
                        $.unblockUI();
                    }
                });
            }
        });
    }
});
