<?php
$temp=Yii::app()->language == "en"?"/":"_rtl/";
$p=Yii::app()->theme->baseUrl.'/assets'.$temp;
?>
<!-- TOP AREA -->
<div class="top-area show-onload">
    <div class="bg-holder full">
        <div class="bg-front full-height bg-front-mob-rel">
            <div class="container full-height">
                <div class="rel full-height">
                    <div class="tagline visible-lg" id="tagline"><span>Get help in </span>
                        <ul>
                            <li class="active">IT</li>
                            <li>Medicin</li>
                            <li>Architecture</li>
                            <li>XXX</li>
                            <li>YYY</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="owl-carousel owl-slider owl-carousel-area visible-lg" id="owl-carousel-slider" data-nav="false">
            <div class="bg-holder full">
                <div class="bg-mask"></div>
                <div class="bg-img" style="background-image:url(img/home/bg-intro-5-990x660.jpeg);"></div>
            </div>

            <div class="bg-holder full">
                <div class="bg-mask"></div>
                <div class="bg-img" style="background-image:url(img/home/lbs-telemedicine-connect-with-a-doctor-via-video-chat.png);"></div>
            </div>
        </div>
        <div class="bg-img hidden-lg" style="background-image:url(img/home/gmail-customer-service.png);"></div>
        <div class="bg-mask hidden-lg"></div>
    </div>
</div>

<div class="bg-color text-white">
    <div class="container">
        <div class="gap"></div>
        <div class="row row-wrap" data-gutter="120">
            <div class="col-md-4">
                <div class="thumb">
                    <header class="thumb-header">
                        <i class="fa fa-thumbs-o-up box-icon-border round box-icon-white box-icon-big"></i>
                    </header>
                    <div class="thumb-caption">
                        <h4 class="thumb-title">Best Travel Agent</h4>
                        <p class="thumb-desc">Eleifend tortor himenaeos mollis facilisis ligula sed himenaeos massa vivamus nulla posuere posuere</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="thumb">
                    <header class="thumb-header">
                        <i class="fa fa-send box-icon-border round box-icon-white box-icon-big"></i>
                    </header>
                    <div class="thumb-caption">
                        <h4 class="thumb-title">Best Destinations</h4>
                        <p class="thumb-desc">Lectus ipsum eu elementum fames et fames vehicula montes sapien malesuada dictum nullam</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="thumb">
                    <header class="thumb-header">
                        <i class="fa fa-dollar box-icon-border round box-icon-white box-icon-big"></i>
                    </header>
                    <div class="thumb-caption">
                        <h4 class="thumb-title">Best Price Guarantee</h4>
                        <p class="thumb-desc">Auctor bibendum risus mauris porta ridiculus bibendum placerat rhoncus sagittis varius condimentum
                            tempor
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="gap gap-small"></div>
    </div>
</div>

<div id="team" name="team">
    <div class="container">
        <div class="row centered">
            <h2 class="centered">TEAM MEMBERS</h2>
            <hr>
            <div class="col-lg-4 teamborder team-md">
                <img class="img img-circle" src="<?php echo $p; ?>img//team/wisam.jpg" height="120px" width="120px" alt="">
                <h5>Wisam Darwish</h5>
                <p>Here is a short description to explain the profile of the member.</p>
                <a href="#">
                    <i class="fa fa-twitter "></i>
                </a>
                <a href="#">
                    <i class="fa fa-facebook"></i>
                </a>
                <a href="#">
                    <i class="fa fa-linkedin"></i>
                </a>
            </div>
            <div class="col-lg-4 teamborder team-md">
                <img class="img img-circle" src="<?php echo $p; ?>img//team/mohammad.jpg" height="120px" width="120px" alt="">
                <h5>Mohammad Mohammad</h5>
                <p>Here is a short description to explain the profile of the member.</p>
                <a href="#">
                    <i class="fa fa-twitter"></i>
                </a>
                <a href="#">
                    <i class="fa fa-facebook"></i>
                </a>
                <a href="#">
                    <i class="fa fa-linkedin"></i>
                </a>
            </div>

            <div class="col-lg-4 teamborder team-md">
                <img class="img img-circle" src="<?php echo $p; ?>img//team/rami.jpg" height="120px" width="120px" alt="">
                <h5>Rami Mourani</h5>
                <p>Here is a short description to explain the profile of the member.</p>
                <a href="#">
                    <i class="fa fa-twitter"></i>
                </a>
                <a href="#">
                    <i class="fa fa-facebook"></i>
                </a>
                <a href="#">
                    <i class="fa fa-linkedin"></i>
                </a>
            </div>
        </div>
    </div>
</div>