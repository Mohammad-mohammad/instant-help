function loadLanguageData(){
    $.ajax({
        url: apiUrl+"languages/",
        //data: "",
        dataType: "json",
        type: 'GET',
        success: function (result, status, xhr) {
            $("#languages-list").empty();
            $("#available-languages").empty();
            $.each(result.languages, function(k, v) {
                $("#languages-list").append("<div class=\"alert alert-info\">\n" +
                    "                        <button data-id='"+v.id+"' class=\"close delete-language-client\" type=\"button\" data-dismiss=\"alert\"><span aria-hidden=\"true\">&times;</span>\n" +
                    "                        </button>\n" +
                    "                        <p class=\"text-small\">"+v.name+"</p>\n" +
                    "                    </div>");

            });
            $.each(result.available, function(k, v) {
                var o = new Option(v.name, v.id);
                $(o).html(v.name);
                $("#available-languages").append(o);
            });
        },
        error: function (result, xhr, status, error) {
            alert(result.responseText);
        }
    });
}

function loadCompetenceData(){
    $.ajax({
        url: apiUrl+"competences/",
        //data: "",
        dataType: "json",
        type: 'GET',
        success: function (result, status, xhr) {
            $("#competences-list").empty();
            $("#available-competences").empty();
            $.each(result.competences, function(k, v) {
                $("#competences-list").append("<div class=\"alert alert-info\">\n" +
                    "                        <button data-id='"+v.id+"' class=\"close delete-competence-client\" type=\"button\" data-dismiss=\"alert\"><span aria-hidden=\"true\">&times;</span>\n" +
                    "                        </button>\n" +
                    "                        <p class=\"text-small\">"+v.name+"</p>\n" +
                    "                    </div>");

            });
            $.each(result.available, function(k, v) {
                var o = new Option(v.name, v.id);
                $(o).html(v.name);
                $("#available-competences").append(o);
            });
        },
        error: function (result, xhr, status, error) {
            alert(result.responseText);
        }
    });
}

function loadCallHistory(){
    $.ajax({
        url: apiUrl+"calls-history/",
        dataType: "json",
        type: 'GET',
        success: function (result, status, xhr) {
            callsList="";
            $.each(result.calls, function(k, v) {
                callsList=callsList+"<tr>\n" +
                    "                    <td class=\"booking-history-type\">"+v.icon+"</td>\n" +
                    "                    <td class=\"booking-history-title\">"+v.sender+"</td>\n" +
                    "                    <td class=\"booking-history-title\">"+v.receiver+"</td>\n" +
                    "                    <td>"+v.type+"</td>\n" +
                    "                    <td>"+v.start+"</td>\n" +
                    "                    <td>"+v.end+"</td>\n" +
                    "                    <td>"+v.amount+"</td>\n" +
                    "                </tr>";
            });
            $("#call-history-table").empty();
            $("#call-history-table").append(callsList);
        },
        error: function (result, xhr, status, error) {
            alert(result.responseText);
        }
    });
}

function imageHover() {
    $('#image_profile_container').mouseenter(function(){
        $('#button_profile_image_upload').addClass('btn_show');
    });
    $('#image_profile_container').mouseleave(function(){
        $('#button_profile_image_upload').removeClass('btn_show');
    });
}

function uploadImage(){
    $("#profile_image").change(function(e){
        e.preventDefault();
        var PIForm=document.getElementById("profile_image_upload");
        $.ajax({
            'url': apiUrl+"upload-image-profile/",
            'type':'POST',
            'dataType':'json',
            'data':  new FormData(PIForm),
            'contentType': false,
            'cache': false,
            'processData':false,
            'success': function(html) {
                if(html==null){
                    alert('Error');
                }else{
                    var obj = eval(html);
                    if(obj['error']==null){
                        if(obj['image_url']!=null){
                            $imgURL = obj['image_url'];
                            $(".profile_img").fadeOut(400,function(){ $(".profile_img").attr('src',$imgURL); }).fadeIn(400);
                            console.log($("#login-image").fadeOut(400,function(){ $("#login-image").attr('src',$imgURL); }).fadeIn(400));
                        }
                    }else{
                        alert(obj['error']);
                    }
                }
            },
            'error':function(html) {
                console.log(html);
                alert('Error');
            }
        });
    });
};



$(document).ready(function () {
    let apiUrl= "/instant_help/api/";
    $.ajax({
        url: apiUrl+"profile/",
        //data: "",
        dataType: "json",
        type: 'GET',
        success: function (result, status, xhr) {
            $("#profile-name").text(result.fname+' '+result.lname);
            $("#profile-status").text(result.clientStatus);
            $("#profile-level").text(result.level);
            $("#profile-type").text(result.clientType);
            $("#profile-form-fname").val(result.fname);
            $("#profile-form-lname").val(result.lname);
            $("#profile-form-email").val(result.email);
            $("#profile-form-country").val(result.country);
            $("#profile-form-city").val(result.city);
            $("#profile-form-address").val(result.address);
            $(".profile_img").attr("src",result.photo);
        },
        error: function (result, xhr, status, error) {
            alert(result.responseText);
        }
    });

    imageHover();

    loadLanguageData();

    loadCompetenceData();

    loadCallHistory();

    uploadImage();

    $('#add-language-btn').click(function (e) {
        e.preventDefault();
        $.ajax({
            url: apiUrl+"add-language/",
            data: {"id":$("#available-languages").val()},
            dataType: "html",
            type: 'POST',
            success: function (result, status, xhr) {
                console.log(result);
                loadLanguageData();
            },
            error: function (result, xhr, status, error) {
                alert(result.responseText);
            }
        });
    });

    $('#add-competence-btn').click(function (e) {
        e.preventDefault();
        $.ajax({
            url: apiUrl+"add-competence/",
            data: {"id":$("#available-competences").val()},
            dataType: "html",
            type: 'POST',
            success: function (result, status, xhr) {
                console.log(result);
                loadCompetenceData();
            },
            error: function (result, xhr, status, error) {
                alert(result.responseText);
            }
        });
    });

    $(document.body).on('click', '.delete-language-client', function (e) {
        e.preventDefault();
        $.ajax({
            url: apiUrl+"delete-language/",
            data: {"id": $(this).attr('data-id')},
            dataType: "html",
            type: 'DELETE',
            success: function (result, status, xhr) {
                loadLanguageData();
            },
            error: function (result, xhr, status, error) {
                alert(result.responseText);
            }
        });
    });

    $(document.body).on('click', '.delete-competence-client', function (e) {
        e.preventDefault();
        $.ajax({
            url: apiUrl+"delete-competence/",
            data: {"id": $(this).attr('data-id')},
            dataType: "html",
            type: 'DELETE',
            success: function (result, status, xhr) {
                loadCompetenceData();
            },
            error: function (result, xhr, status, error) {
                alert(result.responseText);
            }
        });
    });

    $("#update-profile-info").click(function (e) {
       e.preventDefault();
       $.ajax({
           url: apiUrl+"setting-update/",
           data: $("#profile-info-form").serialize(),
           dataType: "html",
           type: 'PUT',
           success: function (result, status, xhr) {
               $('#update-profile-status').html(result).removeClass('alert alert-danger').addClass('alert alert-success');
           },
           error: function (result, xhr, status, error) {
               $('#update-profile-status').html(result.responseText).addClass('alert alert-danger');
           }
       });
    });


    $("#make-available").click(function (e) {
        let status=$("#make-available").attr("data-status");
        $.ajax({
            url: apiUrl+"change-availability/",
            dataType: "json",
            data: {"status":status},
            type: 'POST',
            success: function (result, status, xhr) {
                $("#make-available").attr("data-status", result.status);
                if(result.status===1) {
                    $("#make-available").text("Make me unavailable").removeClass("btn-danger").addClass("btn-success");
                }else{
                    $("#make-available").text("Make me available").removeClass("btn-success").addClass("btn-danger");
                }
            },
            error: function (result, xhr, status, error) {
                alert(result.responseText);
            }
        });
    });

});
