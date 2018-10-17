<!DOCTYPE HTML>
<html>

<head>
    <title>Instant Help - <?php echo CHtml::encode($this->pageTitle); ?></title>


    <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
    <meta name="keywords" content="Instant Help"/>
    <meta name="description" content="Instant Help">
    <meta name="author" content="Ambitious Team">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- GOOGLE FONTS -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,600' rel='stylesheet'
          type='text/css'>
    <!-- /GOOGLE FONTS -->
    <link rel="stylesheet" href="<?php echo $p; ?>css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo $p; ?>css/font-awesome.css">
    <link rel="stylesheet" href="<?php echo $p; ?>css/icomoon.css">
    <link rel="stylesheet" href="<?php echo $p; ?>css/styles.css">
    <link rel="stylesheet" href="<?php echo $p; ?>css/custom.css">
    <link rel="stylesheet" href="<?php echo $p; ?>css/mystyles.css">
    <script src="<?php echo $p; ?>js/modernizr.js"></script>


</head>

<body>

<div class="global-wrap">
    <header id="main-header">
        <div class="header-top">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <a class="logo" href="<?php echo Yii::app()->createUrl("site/index"); ?>">
                            <img src="<?php echo $p; ?>img/logo-invert.png" alt="Image Alternative text" title="Image Title"/>
                        </a>
                    </div>
                    <div class="col-md-9">
                        <div class="top-user-area clearfix">
                            <ul class="top-user-area-list list list-horizontal list-border">
                                <li class="top-user-area-avatar">
                                    <a href="user-profile.html">
                                        <img class="origin round" src="<?php echo $p; ?>img/40x40.png" alt="Image Alternative text"
                                             title="AMaze"/>Hi, John</a>
                                </li>
                                <li><a href="#">Sign Out</a>
                                <li><a href="<?php echo Yii::app()->createUrl("site/sign"); ?>">Login</a>
                                <li><a href="<?php echo Yii::app()->createUrl("site/sign"); ?>">Register</a>
                                </li>
                                <li class="nav-drop"><a href="#">USD $<i class="fa fa-angle-down"></i><i
                                                class="fa fa-angle-up"></i></a>
                                    <ul class="list nav-drop-menu">
                                        <li><a href="#">EUR<span class="right">€</span></a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="top-user-area-lang nav-drop">
                                    <a href="#">
                                        <img src="<?php echo $p; ?>img/flags/32/uk.png" alt="Image Alternative text"
                                             title="Image Title"/>ENG<i class="fa fa-angle-down"></i><i
                                                class="fa fa-angle-up"></i>
                                    </a>
                                    <ul class="list nav-drop-menu">
                                        <li>
                                            <a title="German" href="#">
                                                <img src="<?php echo $p; ?>img/flags/32/hu.png" alt="Image Alternative text"
                                                     title="Image Title"/><span class="right">HU</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a title="Japanise" href="#">
                                                <img src="<?php echo $p; ?>img/flags/32/sy.png" alt="Image Alternative text"
                                                     title="Image Title"/><span class="right">Ar</span>
                                            </a>
                                        </li>

                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <?php $this->renderPartial('webroot.themes.default.views.layouts.menu', array('p' => $p)); ?>
        </div>
    </header>
