
<footer id="main-footer">
    <div class="container">
        <div class="row row-wrap">
            <div class="col-md-4">
                <a class="logo" href="<?php echo Yii::app()->createUrl("site/sign"); ?>">
                    <img src="<?php echo $p; ?>img/logo-invert.png" alt="Image Alternative text" title="Image Title" />
                </a>
                <p class="mb20">All the help you need, Anytime you need it!</p>
                <ul class="list list-horizontal list-space">
                    <li>
                        <a class="fa fa-facebook box-icon-normal round animate-icon-bottom-to-top" href="#"></a>
                    </li>
                    <li>
                        <a class="fa fa-twitter box-icon-normal round animate-icon-bottom-to-top" href="#"></a>
                    </li>
                    <li>
                        <a class="fa fa-google-plus box-icon-normal round animate-icon-bottom-to-top" href="#"></a>
                    </li>
                    <li>
                        <a class="fa fa-linkedin box-icon-normal round animate-icon-bottom-to-top" href="#"></a>
                    </li>
                    <li>
                        <a class="fa fa-pinterest box-icon-normal round animate-icon-bottom-to-top" href="#"></a>
                    </li>
                </ul>
            </div>


            <div class="col-md-4">
                <ul class="list list-footer">
                    <li><a href="<?php echo Yii::app()->createUrl("site/index"); ?>">Home</a>
                    </li>
                    <li><a href="<?php echo Yii::app()->createUrl("site/about"); ?>">About US</a>
                    </li>
                    <li><a href="<?php echo Yii::app()->createUrl("site/contact"); ?>">Contact Us</a>
                    </li>
                    <li><a href="<?php echo Yii::app()->createUrl("site/policy"); ?>">Privacy Policy</a>
                    </li>
                    <li><a href="<?php echo Yii::app()->createUrl("site/terms"); ?>">Terms of Use</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-4">
                <h4>Have Questions?</h4>
                <h4 class="text-color">+36-123-456-789</h4>
                <h4><a href="#" class="text-color">support@instanthelp.com</a></h4>
            </div>

        </div>
    </div>

    <div id="vid-box" class="video2">
        <div id="inCall" class="ptext">
            <button id="end" onclick="end()" >End</button>
            <button id="mute" onclick="mute()">Mute</button>
            <button id="pause" onclick="pause()">Pause</button>
        </div>
    </div>
    <div id="vid-thumb"></div>
    <div class="rating-form">
        <div class="rating-panel">
        <h4>Please give your rate, it is mandatory.</h4>
        <select class="form-control" name="rating-input" id="rating-input">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
        <button id="rating-btn" value="" class="btn btn-primary">Rate and close</button>
        </div>
    </div>
    <audio style="display: none;"  id="audio1" src="<?php echo Yii::app()->theme->baseUrl.'/assets/tones/ring.mp3'?>"></audio>
</footer>

<script src="<?php echo $p; ?>js/jquery.js"></script>
<script src="<?php echo $p; ?>js/bootstrap.js"></script>
<script src="<?php echo $p; ?>js/slimmenu.js"></script>
<script src="<?php echo $p; ?>js/bootstrap-datepicker.js"></script>
<script src="<?php echo $p; ?>js/bootstrap-timepicker.js"></script>
<script src="<?php echo $p; ?>js/nicescroll.js"></script>
<script src="<?php echo $p; ?>js/dropit.js"></script>
<script src="<?php echo $p; ?>js/ionrangeslider.js"></script>
<script src="<?php echo $p; ?>js/icheck.js"></script>
<script src="<?php echo $p; ?>js/fotorama.js"></script>
<script src="<?php echo $p; ?>js/typeahead.js"></script>
<script src="<?php echo $p; ?>js/card-payment.js"></script>
<script src="<?php echo $p; ?>js/magnific.js"></script>
<script src="<?php echo $p; ?>js/owl-carousel.js"></script>
<script src="<?php echo $p; ?>js/fitvids.js"></script>
<script src="<?php echo $p; ?>js/countdown.js"></script>
<script src="<?php echo $p; ?>js/gridrotator.js"></script>
<script src="<?php echo $p; ?>js/custom.js"></script>
<script src="<?php echo $p; ?>js/site.js"></script>
<?php if(!Yii::app()->user->isGuest){ ?>
<script src="https://cdn.pubnub.com/pubnub.min.js"></script>
<script src="<?php echo $p; ?>js/webrtc.js"></script>
<script src="<?php echo $p; ?>js/rtc-controller.js"></script>
<script src="<?php echo $p; ?>js/rtc.js"></script>
<?php } ?>
<?php //if(!Yii::app()->user->isGuest){
//    $user_model=Client::model()->findByAttributes(array('email'=>Yii::app()->user->name));
//    if($user_model->available==1){
//        echo '<script src="'.$p.'js/available.js"></script>';
//    }
//} ?>
</div>
</body>

</html>


