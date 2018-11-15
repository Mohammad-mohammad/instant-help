$(document).ready(function () {
    $.ajax({
        url: apiUrl+"get-email/",
        dataType: "json",
        type: 'GET',
        success: function (result, status, xhr) {
            login(result.email);
        },
        error: function (result, xhr, status, error) {
            alert(result.responseText);
        }
    });
});