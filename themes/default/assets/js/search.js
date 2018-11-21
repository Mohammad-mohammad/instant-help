"use strict";
$(document).ready(function () {
    $(function(){
        $('#search-btn').click();
    });
});

$("#search-btn").click(function (e) {
    e.preventDefault();
    let clientType="";
    let checkBox=$('input[name="filter-client-type[]"]:checked');
    if(checkBox.length===1){
        clientType=checkBox.val();
    }
    $.ajax({
        url: apiUrl+"search/",
        data: {"city":$("#filter-city").val(), "clientType":clientType, "competence":$("#filter-competence").val(), "language":$("#filter-language").val()},
        dataType: "json",
        type: 'GET',
        beforeSend: function(xhr, obj){
            $("#search-list").empty();
            $("#result-summary").empty();
            $("#search-list-parent").css("text-align", "center");
            $("#search-list-parent").css("padding-top", "100px");
            $("#search-list-parent").append('<div class="lds-hourglass"></div>');

        },
        complete: function(xhr, obj){
            $("#search-list-parent").css("text-align", "");
            $("#search-list-parent").css("padding-top", "");
            $(".lds-hourglass").remove();
        },
        success: function (result, status, xhr) {
            console.log(result);
            let elements = $();
            $.each(result, function(k, v) {

                let languages=[]; let i=0;
                $.each(v.languages, function(k, n) {
                   languages[i]=n.name; i++;
                });
                languages=languages.join(", ");

                let competences=[]; i=0;
                $.each(v.competences, function(k, c) {
                    competences[i]=c.name; i++;
                });
                competences=competences.join(", ");

                let stars="";
                for (k=0; k<v.rating; k++){
                    stars=stars+'<li><i class="fa fa-star"></i></li>';
                }
                for (k=v.rating; k<5; k++){
                    stars=stars+'<li><i class="fa fa-star empty-star"></i></li>';
                }

                elements=elements.add('<li>\n' +
                    '                    <a class="booking-item" href="#">\n' +
                    '                        <div class="row">\n' +
                    '                            <div class="col-md-2">\n' +
                    '                                <div class="booking-item-img-wrap">\n' +
                    '                                    <img src="'+v.photo+'" alt="avatar" title="avatar" />\n' +
                    '                                </div>\n' +
                    '                                <div class="item-type">'+v.clientType+'</div>' +
                    '                            </div>\n' +
                    '                            <div class="col-md-7">\n' +
                    '                                <div class="booking-item-rating">\n' +
                    '                                    <ul class="icon-group booking-item-rating-stars">\n' +
                                                            stars+
                    '                                    </ul><span class="booking-item-rating-number"><b >'+v.rating+'</b> of 5</span>\n' +
                    '                                </div>\n' +
                    '                                <h5 class="booking-item-title">'+v.fname+' '+v.lname+'</h5>\n' +
                    '                                <p class="booking-item-address"><i class="fa fa-map-marker"></i> '+v.full_address+'</p>\n' +
                    '                                <ul class="booking-item-features booking-item-features-rentals booking-item-features-sign">\n' +
                    '                                    <li rel="tooltip" data-placement="top" title="Languages"><i class="fa fa-language"></i></li>\n' +
                    '                                    <li class="feature-content"> '+languages+'</li>\n' +
                    '                                </ul>\n' +
                    '                                <ul class="booking-item-features booking-item-features-rentals booking-item-features-sign">\n' +
                    '                                    <li rel="tooltip" data-placement="top" title="Competence"><i class="fa fa-puzzle-piece"></i></li>\n' +
                    '                                    <li class="feature-content"> '+competences+'</li>\n' +
                    '                                </ul>\n' +
                    '                            </div>\n' +
                    '                            <div class="col-md-3"><span class="booking-item-price">'+v.received_call_count+'</span><span>/received calls</span>' +
                    '                               <span data-gutter="'+v.email+'" data-id="'+v.id+'" class="call-now btn btn-primary">Call Now</span>\n' +
                    '                            </div>\n' +
                    '                        </div>\n' +
                    '                    </a>\n' +
                    '                </li>');
            });
            $("#search-list").append(elements);
            $("#result-summary").text(elements.length+" users found who can help you!");
        },
        error: function (result, xhr, status, error) {
            $("#result-summary").text(result.responseText);
        }
    });
})