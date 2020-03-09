$(document).ready(function () {
    $(".role_access_rights").on('dblclick', 'option', function (event) {
        var select = $(event.target).parent();
        var id = $(event.target).parent().attr('id');
        id = id.split("_").pop();
        //if element exists already don't copy
        $("#role_access_rights_" + id + " option:selected").clone().appendTo('#user_access_rights_' + id);

    });
    $(".user_access_rights").on('dblclick', 'option', function (event) {
        var select = $(event.target).parent();
        var id = $(event.target).parent().attr('id');
        id = id.split("_").pop();
        $("#user_access_rights_" + id + " option:selected").remove();

    });
});

function submit_form(form) {
    event.preventDefault();
    console.log($(form).serialize());
    var type = $('input[id="type"]').val();
    var error = $('.error');
    var message = $('.message');

    if(type === "multiple") {
        var id = $(form).find('input[name="user_id"]').val();
        error = $('#error_' + id);
        message = $('#message_' + id);
    }
    error.html("");
    message.html("");
    $.ajax({
        type: "POST",
        url: $(form).attr('action'),
        data: $(form).serialize(),
        success: function (response) {
            var data = jQuery.parseJSON(response); 
            if(data.redirect) {
                window.location.href = data.redirect;
            } else if(data.error){
                error.html(data.error);    
            } else if(data.message) {
                message.html(data.message);
                $(form).find("input[type=text], input[type=password], textarea").val("");
            }
        }
    });
    return false;
}

function update_select_data(obj) {
    var app_id = $(obj).children("option:selected").attr('id');

    $('#roles_container').show();
    var roles = $('#roles').children();
    $(roles).each( function() {
        $(this).hide();
        //console.log($(this).attr('app_id'));
        var role_app_id = $(this).attr('app_id');
        if(role_app_id === app_id) {
            $(this).show();
        } else {
             $(this).hide();
        }
    });
}