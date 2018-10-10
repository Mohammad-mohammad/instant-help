<?php
/* @var $this OperationController|TaskController|RoleController */
/* @var $model AuthItemForm */
/* @var $form TbActiveForm */

$this->breadcrumbs = array(
	$this->capitalize($this->getTypeText(true)) => array('index'),
	Yii::t('AuthModule.main', 'New {type}', array('{type}' => $this->getTypeText())),
);
?>


<div class="x_title">
    <h2><?php echo Yii::t('AuthModule.main', 'New {type}', array('{type}' => $this->getTypeText())); ?></h2>
    <ul class="nav navbar-<?php echo Yii::app()->getLanguage()=="en"?"right":"left"; ?> panel_toolbox">
        <a href="<?php echo $this->createUrl('index'); ?>" class="btn red mini"><i class="icon-table"></i> <?php echo $this->capitalize($this->getTypeText(true)); ?></a>
    </ul>
    <div class="clearfix"></div>
</div>
<div class="x_content" style="display: block;">
    <div class="row">
        <div class="col-md-12">

                <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                    //'type'=>'horizontal',
                    'htmlOptions' => array('class' => 'form-horizontal form-label-left'),
                )); ?>

                <?php echo $form->hiddenField($model, 'type'); ?>
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'name', array('class' => 'control-label col-md-2 col-sm-2 col-xs-12')); ?>
                    <div class="col-md-10 col-sm-10 col-xs-12">
                        <?php echo $form->textField($model,'name',array('class' => 'form-control', 'size' => 45,'maxlength'=>100)); ?>
                        <?php echo $form->error($model, 'name'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'description', array('class' => 'control-label col-md-2 col-sm-2 col-xs-12')); ?>
                    <div class="col-md-10 col-sm-10 col-xs-12">
                        <?php echo $form->textField($model,'description',array('class' => 'form-control', 'size' => 45,'maxlength'=>100)); ?>
                        <?php echo $form->error($model, 'description'); ?>
                    </div>
                </div>

                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-10 col-sm-10 col-xs-12 col-md-offset-2">
                    <?php $this->widget('bootstrap.widgets.TbButton', array(
                        'buttonType' => 'submit',
                        'type' => 'primary',
                        'label' => '<i class="icon-plus"></i> ' . Yii::t('AuthModule.main', 'Create'),
                        'encodeLabel' => false,
                        'htmlOptions' => array('class' =>'lightslategrey')
                    )); ?>
                    <?php $this->widget('TbButton', array(
                        'type' => 'link',
                        'label' => '<i class="fa fa-rotate-left"></i> ' .Yii::t('AuthModule.main', 'Cancel'),
                        'url' => array('index'),
                        'encodeLabel' => false,
                        'htmlOptions' => array('class' =>'btn btn-primary')
                    )); ?>
                    </div>
                </div>

                <?php $this->endWidget(); ?>

        </div>
    </div>
</div>