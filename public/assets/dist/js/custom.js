var actionData = {};
$(document).ready(function () {

    /* MESSAGE BOX */
    $(".mb-control").on("click", function () {
        var box = $($(this).data("box"));
        if (box.length > 0) {
            box.toggleClass("open");
        }
        return false;
    });
    $(".mb-control-close").on("click", function () {
        $(this).parents(".message-box").removeClass("open");
        return false;
    });
    /* END MESSAGE BOX */

    notify = function (type, text) {
        var n = noty({
            text: text,
            type: type,
            dismissQueue: true,
            layout: 'topCenter',
            closeWith: ['click'],
            theme: 'relax',
            maxVisible: 10,
            animation: {
                open: 'animated fadeIn',
                close: 'animated fadeOut',
                easing: 'swing',
                speed: 1000
            }
        });
    };//notify

    var message_box_url = "";
    var message_box_action = "";

    $(document).on("click", ".message_box", function (e) {
        message_box_url = $(this).attr('href');
        message_box_action = $(this).data("action");
        var box = $($(this).data("box"));
        if (box.length > 0) {
            box.toggleClass("open");
        }
        return false;
    });

    $(".mb-control-action").on("click", function () {
        $(this).parents(".message-box").removeClass("open");
        $.ajax({
            url: message_box_url,
            type: message_box_action,
            headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
            success: function (data) {
                actionData = data;
                if (data['success'])
                {
                    notify('success', data['success']);
                    $("#data_table").DataTable().ajax.reload();
                }

                if (data['error'])
                    notify('error', data['error']);
            },
            error: function (data) {
                alert(data.responseText);
            }
        });
        return false;
    });

    $("#card_number").mask("9999 9999 9999 9999");
    $("#expire_date").mask("99 / 99");
    $("#cvc").mask("999");
});