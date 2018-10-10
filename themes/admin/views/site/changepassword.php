<?php
$this->breadcrumbs=array(
	Yii::t('tx', 'Change Your Password'),
);
?>
<div class="x_title">
    <h2><?php echo Yii::t('tx', 'Change Your Password'); ?></h2>
    <ul class="nav navbar-right panel_toolbox">

    </ul>
    <div class="clearfix"></div>
</div>
<div class="x_content" style="display: block;">
    <div class="row">
        <div class="col-md-12">
            <?php
            $btn_txt= '<i class="icon-ok"></i> '.Yii::t('tx','Changing...');
            $tt= "$('#user-btn').click(function() { var btn = $(this); btn.html('".$btn_txt."'); });" ;
            Yii::app()->clientScript->registerScript('loading',$tt,  CClientScript::POS_END);
            ?>
            <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
                'id'=>'user-form',
                'enableAjaxValidation'=>false,
                'htmlOptions' => array('class' => 'form-horizontal form-label-left'),
            )); ?>

            <p class="help-block"><?php echo Yii::t('tx', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('tx','are required.'); ?></p>

            <?php echo $form->errorSummary($model); ?>

            <?php if(Yii::app()->user->hasFlash('success')){?>
                <div class="alert alert-success">
                    <a class="close" data-dismiss="alert" href="#">×</a>
                    <strong><?php echo Yii::t('tx', 'Success'); ?>.</strong> <?php echo Yii::app()->user->getFlash('success');?>
                </div>
            <?php } ?>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'old_password', array('class' => 'control-label col-md-2 col-sm-2 col-xs-12')); ?>
                <div class="col-md-10 col-sm-10 col-xs-12">
                    <?php //echo $form->passwordField($model,'password',array('class' => 'form-control', 'size' => 45)); ?>
                    <?php echo $form->textField($model,'old_password',array('class' => 'form-control', 'size' => 45)); ?>
                    <?php echo $form->error($model, 'old_password'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($model, 'new_password', array('class' => 'control-label col-md-2 col-sm-2 col-xs-12')); ?>
                <div class="col-md-10 col-sm-10 col-xs-12">
                    <?php //echo $form->passwordField($model,'password',array('class' => 'form-control', 'size' => 45)); ?>
                    <?php echo $form->textField($model,'new_password',array('class' => 'form-control', 'size' => 45)); ?>
                    <?php echo $form->error($model, 'new_password'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($model, 're_password', array('class' => 'control-label col-md-2 col-sm-2 col-xs-12')); ?>
                <div class="col-md-10 col-sm-10 col-xs-12">
                    <?php //echo $form->passwordField($model,'password',array('class' => 'form-control', 'size' => 45)); ?>
                    <?php echo $form->textField($model,'re_password',array('class' => 'form-control', 'size' => 45)); ?>
                    <?php echo $form->error($model, 're_password'); ?>
                </div>
            </div>

            <div class="ln_solid"></div>

            <div class="form-group">
                <div class="col-md-10 col-sm-10 col-xs-12 col-md-offset-2">
                    <?php $this->widget('bootstrap.widgets.TbButton', array(
                        'buttonType'=>'submit',
                        'encodeLabel' => false,
                        'label' => '<i class="icon-ok"></i> ' . Yii::t('tx','Change'),
                        'htmlOptions' => array('id' => 'user-btn', 'class' => 'lightslategrey')
                    )); ?>
                </div>
            </div>


            <?php $this->endWidget(); ?>
            <!-- END FORM-->
        </div>
        </div>
    </div>
</div>
