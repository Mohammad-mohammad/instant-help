var video_out = document.getElementById("vid-box");
var vid_thumb = document.getElementById("vid-thumb");
var vidCount  = 0;
let ctrl=null;
let CallStatus = Object.freeze({"NotHandled":0, "Canceled":1, "Rejected":2, "Accepted":3, "Running":4})
let tone=document.getElementById('audio1');

$('#rating-btn').click(function () {
    $(".rating-form").css('display','none');
    $.ajax({
        url: apiUrl+"call-rating/",
        data: {'id':$('#rating-btn').val(), 'rate':$('#rating-input').val()},
        dataType: "json",
        type: "POST",
        success: function (result, status, xhr) {
            alert("Thank you :)")
        },
        error: function (result, xhr, status, error) {
            alert(result.responseText);
        }
    });
});

$(document.body).on('click', '.call-now', function (e) {
    let thisButton=$(this);
    e.preventDefault();
    $.ajax({
        url: apiUrl+"make-call/",
        data: {"id": $(this).attr('data-id')},
        dataType: "json",
        type: 'POST',
        success: function (result, status, xhr) {
            //console.log(result);
            thisButton.text("Calling, wait..");
            (function worker() {
                $.ajax({
                    url: apiUrl+"get-response-call/",
                    data: {"id":result.id},
                    dataType: 'json',
                    type: 'POST',
                    success: function(data) {
                        console.log(data);
                        console.log($("#logged-email").val());
                        console.log(thisButton.attr("data-gutter"));
                        if(data.status==CallStatus.Running){
                            thisButton.text("Calling");
                            $("#rating-btn").val(data.id);
                            login($("#logged-email").val());
                            setTimeout(function() {
                                makeCall(thisButton.attr("data-gutter"));
                                $("#inCall").css('display','block');
                            }, 5000);
                        }else if(data.status==CallStatus.Rejected){
                            alert('Rejected');
                            thisButton.text("Call Now");
                        }
                    },
                    complete: function(data, status) {
                        if(data.responseJSON.status==CallStatus.NotHandled){
                            // Schedule the next request when the current one's complete
                            setTimeout(worker, 1000);
                        }
                    }
                });
            })();
        },
        error: function (result, xhr, status, error) {
            alert(result.responseText);
        }
    });
});



(function worker() {
    $.ajax({
        url: apiUrl+"get-calls/",
        dataType: 'json',
        type: 'GET',
        success: function(data) {
            if(data!=null && $('#calling-panel').length==0){
                console.log(data);
                //$('#calling-panel').remove();
                $('body').append('<div id="calling-panel">' +
                    '<div><img src="'+data.type+'"/></div>'+
                    '<div><p>'+data.sender+'</p><p><i>calling you..</i></p></div>'+
                    '<div>' +
                    '<button class="btn-round" id="answer-call" data-id="'+data.id+'">Answer</button>'+
                    '<button class="btn-round" id="reject-call" data-id="'+data.id+'">Reject</button>'+
                    '</div>'+
                    '</div>');
                if (tone.paused) {
                    tone.play();
                }else{
                    tone.currentTime = 0
                }
            }
        },
        complete: function() {
            // Schedule the next request when the current one's complete
            setTimeout(worker, 1000);
        }
    });
})();

$(document.body).on('click', '#reject-call', function (e) {
    e.preventDefault();
    $.ajax({
        url: apiUrl+"reject-call/",
        data: {"id": $("#reject-call").attr('data-id')},
        dataType: "html",
        type: 'POST',
        success: function (result, status, xhr) {
            tone.pause();
            $('#calling-panel').remove();
        },
        error: function (result, xhr, status, error) {
            alert(result.responseText);
        }
    });
});

$(document.body).on('click', '#answer-call', function (e) {
    e.preventDefault();
    $.ajax({
        url: apiUrl+"answer-call/",
        data: {"id": $("#answer-call").attr('data-id')},
        dataType: "json",
        type: 'POST',
        success: function (result, status, xhr) {
            tone.pause();
            $('#calling-panel').remove();
            login(result.email);
        },
        error: function (result, xhr, status, error) {
            alert(result.responseText);
        }
    });
});

function login(myNumber) {
    var phone = window.phone = PHONE({
        number        : myNumber,
        publish_key   : 'pub-c-561a7378-fa06-4c50-a331-5c0056d0163c', // Your Pub Key
        subscribe_key : 'sub-c-17b7db8a-3915-11e4-9868-02ee2ddab7fe', // Your Sub Key
    });
    ctrl = window.ctrl = CONTROLLER(phone);
    ctrl.ready(function(){
        //form.username.style.background="#55ff5b";
        //form.login_submit.hidden="true";
        ctrl.addLocalStream(vid_thumb);
        console.log("Logged in as " + myNumber);
    });
    ctrl.receive(function(session){
        session.connected(function(session){ video_out.appendChild(session.video);
        console.log(session.number + " has joined.");
        vidCount++; });
        session.ended(function(session) { ctrl.getVideoElement(session.number).remove();
        console.log(session.number + " has left.");
        vidCount--;});
    });
    ctrl.videoToggled(function(session, isEnabled){
        ctrl.getVideoElement(session.number).toggle(isEnabled);
        console.log(session.number+": video enabled - " + isEnabled);
    });
    ctrl.audioToggled(function(session, isEnabled){
        ctrl.getVideoElement(session.number).css("opacity",isEnabled ? 1 : 0.75);
        console.log(session.number+": audio enabled - " + isEnabled);
    });
    return false;
}

function makeCall(email){
    if (!window.phone) alert("Login First!");
    var num = email;
    if (phone.number()==num) return false; // No calling yourself!
    ctrl.isOnline(num, function(isOn){
        if (isOn) ctrl.dial(num);
        else alert("User if Offline");
    });
    return false;
}

function mute(){
    var audio = ctrl.toggleAudio();
    if (!audio) $("#mute").html("Unmute");
    else $("#mute").html("Mute");
}

function end(){
    ctrl.hangup();
    $("#inCall").css('display','none');
    $('.call-now').text('Call Now');
    $(".rating-form").css('display','block');
}

function pause(){
    var video = ctrl.toggleVideo();
    if (!video) $('#pause').html('Unpause');
    else $('#pause').html('Pause');
}

function getVideo(number){
    return $('*[data-number="'+number+'"]');
}

function addLog(log){
    $('#logs').append("<p>"+log+"</p>");
}

function errWrap(fxn, form){
    try {
        return fxn(form);
    } catch(err) {
        alert("WebRTC is currently only supported by Chrome, Opera, and Firefox");
        return false;
    }
}
