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

<body style="background:#F7F7F7;">

<div class="">
    <a class="hiddenanchor" id="toregister"></a>
    <a class="hiddenanchor" id="tologin"></a>

    <div id="wrapper">
        <div id="login" class="animate form">
            <img src="<?php echo $p; ?>images/logo.png">
            <section class="login_content">
                <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                    'id'=>'login-form',
                    'enableClientValidation'=>true,
                    'clientOptions'=>array(
                        'validateOnSubmit'=>true,
                    ),
                )); ?>
                    <h1><?php echo Yii::t('tx', 'Admin Site Login')?></h1>
                        <?php echo $form->errorSummary($model); ?>
                    <div>
                        <?php echo $form->textField($model,'username',array("class"=>"form-control","required"=>"","autocomplete"=>"off","placeholder"=>$model->getAttributeLabel('username'))); ?>
                    </div>
                    <div>
                        <?php echo $form->passwordField($model,'password',array("class"=>"form-control","required"=>"", "autocomplete"=>"off", "placeholder"=>$model->getAttributeLabel('password'))); ?>
                    </div>
                    <di>
                        <?php echo $form->checkBoxRow($model,'rememberMe'); ?>
                    </di>
                    <div>
                        <?php $this->widget('bootstrap.widgets.TbButton', array(
                            'buttonType'=>'submit',
                            //'type'=>'primary',
                            'encodeLabel' => false,
                            'label'=>  Yii::t('tx', 'Login'),
                            'htmlOptions'=>array("class"=>"btn btn-default submit"),
                        )); ?>
                    </div>
                    <div class="clearfix"></div>
                    <div class="separator">
                        <div class="clearfix"></div>
                        <br />
                        <div>
                            <h1>
                                <?php //echo CHtml::image(Yii::app()->theme->baseUrl.'/assets/img/logo.png','logo')?>
                                <?php /*<i class="fa fa-leaf" style="font-size: 26px;"></i> */ ?>
                                <?php echo CHtml::encode(Yii::app()->name); ?>
                            </h1>

                        </div>
                    </div>
                <?php $this->endWidget(); ?>
                <!-- form -->
            </section>

        </div>
    </div>
</div>

</body>

</html>