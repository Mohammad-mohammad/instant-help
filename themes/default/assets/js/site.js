"use strict";
let apiUrl= "/instant_help/api/";
function animateScroll(target){
    $('html, body').animate({scrollTop: $(target).offset().top }, 500);
}

$('#register-btn').click(function (e) {
    $('#register-status').empty();
    e.preventDefault();
    $.ajax({
        url: apiUrl+"register/",
        data: $("#register-form").serialize(),
        //cache: false,
        //processData: false,
        //contentType: "application/json; charset=utf-8",
        dataType: "html",
        type: 'POST',
        success: function (result, status, xhr) {
            $("#register-form")[0].reset();
            $('#register-status').html(result).removeClass('alert alert-danger').addClass('alert alert-success');
            animateScroll('#register-status');
        },
        error: function (result, xhr, status, error) {
            $('#register-status').html(result.responseText).addClass('alert alert-danger');
            animateScroll('#register-status');
        }
    });
});

$('#login-btn').click(function (e) {
    $('#login-status').empty();
    e.preventDefault();
    $.ajax({
        url: apiUrl+"login/",
        data: $("#login-form").serialize(),
        dataType: "html",
        type: 'POST',
        success: function (result, status, xhr) {
            $("#login-form")[0].reset();
            $('#login-status').html(result+ " Redirecting to your profile...").removeClass('alert alert-danger').addClass('alert alert-success');
            //animateScroll('#login-status');
            window.setTimeout(function(){
                 window.location.href = "/instant_help/profile/";
             }, 2000);
        },
        error: function (result, xhr, status, error) {
            $('#login-status').html(result.responseText).addClass('alert alert-danger');
            //animateScroll('#login-status');
        }
    });
});

$('#logout-btn').click(function (e) {
    e.preventDefault();
    $.ajax({
        url: apiUrl+"logout/",
        dataType: "html",
        type: "POST",
        success: function (result, status, xhr) {
            window.setTimeout(function(){
                window.location.href = "/instant_help/login-register/";
            }, 500);
        },
        error: function (result, xhr, status, error) {
            alert(result.responseText);
        }
    });
});
