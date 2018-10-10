<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo CHtml::encode(Yii::app()->name); ?> | <?php echo CHtml::encode($this->getPageTitle()); ?></title>
    <?php
    $p=Yii::app()->theme->baseUrl.(Yii::app()->language=='ar'?"/rtl_assets/":"/assets/");
    $this->renderPartial('webroot.themes.admin.views.layouts.scripts', array('p' => $p ));
    Yii::app()->bootstrap->register();
    ?>
    
    
</head>


<body class="nav-md">

<div class="container body">


<div class="main_container">

<div class="col-md-3 left_col">
    <div class="left_col scroll-view">

        <div class="navbar nav_title" style="border: 0;">
            <a href="#" class="site_title"><span style="font-size: 18px"><?php echo CHtml::encode(Yii::app()->name); ?></span></a>
            <img src="<?php echo $p; ?>images/logo.png" style="width: 90%">
        </div>
        <div class="clearfix"></div>

        <!-- menu prile quick info -->
        <?php /*
        <div class="profile">
            <div class="profile_pic">
                <i class="img-circle profile_img fa fa-user" style="font-size: 44px;padding:2px 10px 7px 10px;color: lightslategrey;"></i>
            </div>
            <div class="profile_info">
                <span><?php echo Yii::t('tx','Welcome'); ?>,</span>
                <h2><?php echo Yii::app()->user->name; ?></h2>
            </div>
        </div>
        */?>
        <!-- /menu prile quick info -->

        <br />

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

            <div class="menu_section">
                <?php /*<h3>Administration</h3> */?>
                <ul class="nav side-menu">
                    <?php $this->renderPartial('//layouts/menu'); ?>
                </ul>
            </div>

        </div>
        <!-- /sidebar menu -->
        <?php $u=User::model()->findByAttributes(array("name"=>Yii::app()->user->name)); ?>
        <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small">
            <?php
            $w="100%";
            if($u!==null){ $w="50%"; ?>
            <a style="width: 50%" data-toggle="tooltip" data-placement="top" title="<?php echo Yii::t('tx','Change your password'); ?>" href="<?php echo Yii::app()->createUrl('site/changepassword'); ?>">
                <span class="glyphicon glyphicon-wrench" aria-hidden="true"></span>
            </a>
            <?php } ?>

            <a style="width:<?php echo $w; ?>" data-toggle="tooltip" data-placement="top" title="<?php echo Yii::t('tx','Log Out'); ?>" href="<?php echo Yii::app()->createUrl('site/logout'); ?>">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
        </div>
        <!-- /menu footer buttons -->
    </div>
</div>

<!-- top navigation -->
<div class="top_nav">

    <div class="nav_menu">
        <nav class="" role="navigation">
            <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>

            <ul class="nav navbar-nav navbar-<?php echo Yii::app()->getLanguage()=="ar"?"left":"right"; ?>">
                <li class="">
                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-user" style="font-size: 26px;margin-<?php echo Yii::app()->getLanguage()=="ar"?"left":"right"; ?>: 8px;color: lightslategrey;"></i><?php echo Yii::app()->user->name; ?>
                        <span class=" fa fa-angle-down"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                        <?php if($u!==null){ ?>
                        <li>
                            <a href="<?php echo Yii::app()->createUrl('site/changepassword'); ?>"><?php echo Yii::t('tx','Change your password'); ?></a>
                        </li>
                        <?php } ?>
                        <li><a href="<?php echo Yii::app()->createUrl('site/logout'); ?>"><i class="fa fa-sign-out pull-right"></i> <?php echo Yii::t('tx','Log Out'); ?></a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>

</div>
<!-- /top navigation -->

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><?php if (isset($this->breadcrumbs)):
                        $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
                            'links' => $this->breadcrumbs,
                            'separator' => Yii::app()->language=='ar'?'<i class="icon-angle-left"></i>':'<i class="icon-angle-right"></i>',
                            'homeLink' => '<i class="icon-home"></i> ' . CHtml::link(Yii::t('tx', 'Home'), array('/')),
                        ));
                    endif ?>
                </h3>
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="row">

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel" style="height:auto">
                    <?php echo $content; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- footer content -->
    <footer>
        <div class="">
            <p class="pull-<?php echo Yii::app()->getLanguage()=="ar"?"left":"right"; ?>">
                <span class="lead"><a href="http://InstantHelp.net" target="_blank">InstantHelp</a></span>
            </p>
        </div>
        <div class="clearfix"></div>
    </footer>
    <!-- /footer content -->

</div>
<!-- /page content -->
</div>

</div>

<div id="custom_notifications" class="custom-notifications dsp_none">
    <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
    </ul>
    <div class="clearfix"></div>
    <div id="notif-group" class="tabbed_notifications"></div>
</div>
<?php /*
<script src="<?php echo $p; ?>js/bootstrap.min.js"></script>

<!-- chart js -->
<script src="<?php echo $p; ?>js/chartjs/chart.min.js"></script>
<!-- bootstrap progress js -->
<script src="<?php echo $p; ?>js/progressbar/bootstrap-progressbar.min.js"></script>
 */ ?>
<script src="<?php echo $p; ?>js/nicescroll/jquery.nicescroll.min.js"></script>
<!-- icheck -->
<script src="<?php echo $p; ?>js/icheck/icheck.min.js"></script>

<script src="<?php echo $p; ?>js/custom.js"></script>
<?php /*
<!-- moris js -->
<script src="<?php echo $p; ?>js/moris/raphael-min.js"></script>
<script src="<?php echo $p; ?>js/moris/morris.js"></script>
<script src="<?php echo $p; ?>js/moris/example.js"></script>
*/ ?>
</body>

</html>