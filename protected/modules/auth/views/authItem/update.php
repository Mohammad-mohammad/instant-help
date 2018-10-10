<?php
/* @var $this OperationController|TaskController|RoleController */
/* @var $model AuthItemForm */
/* @var $item CAuthItem */
/* @var $form TbActiveForm */

$this->breadcrumbs = array(
	$this->capitalize($this->getTypeText(true)) => array('index'),
	$item->description => array('view', 'name' => $item->name),
	Yii::t('AuthModule.main', 'Edit'),
);
?>


<div class="x_title">
    <h2><?php echo CHtml::encode($item->description); ?>
        <small><?php echo $this->getTypeText(); ?></small></h2>
    <ul class="nav navbar-<?php echo Yii::app()->getLanguage()=="en"?"right":"left"; ?> panel_toolbox">
        <a href="<?php echo $this->createUrl('view',array('name' => $item->name)); ?>" class="btn red mini"><i class="icon-table"></i> <?php echo $this->capitalize($this->getTypeText(true)); ?></a>
    </ul>
    <div class="clearfix"></div>
</div>
<div class="x_content" style="display: block;">
    <div class="row">
        <div class="col-md-12">
            <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                'type'=>'horizontal',
            )); ?>

            <?php echo $form->hiddenField($model, 'type'); ?>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'name', array('class' => 'control-label col-md-2 col-sm-2 col-xs-12')); ?>
                <div class="col-md-10 col-sm-10 col-xs-12">
                    <?php echo $form->textField($model,'name',array(
                        'class' => 'form-control', 'maxlength'=>100,
                        'disabled'=>true,
                        'title'=>Yii::t('AuthModule.main', 'System name cannot be changed after creation.'),
                    )); ?>
                    <?php echo $form->error($model, 'name'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($model, 'description', array('class' => 'control-label col-md-2 col-sm-2 col-xs-12')); ?>
                <div class="col-md-10 col-sm-10 col-xs-12">
                    <?php echo $form->textField($model,'description',array('class' => 'form-control', 'maxlength'=>100)); ?>
                    <?php echo $form->error($model, 'description'); ?>
                </div>
            </div>

            <div class="ln_solid"></div>
            <div class="form-group">
                <div class="col-md-10 col-sm-10 col-xs-12 col-md-offset-2">
                    <?php $this->widget('bootstrap.widgets.TbButton', array(
                        'buttonType' => 'submit',
                        'type' => 'primary',
                        'label' => '<i class="icon-ok"></i> ' . Yii::t('AuthModule.main', 'Save'),
                        'encodeLabel' => false,
                        'htmlOptions' => array('class' =>'lightslategrey')
                    )); ?>
                    <?php $this->widget('bootstrap.widgets.TbButton', array(
                        'type' => 'link',
                        'label' => '<i class="fa fa-rotate-left"></i> ' .Yii::t('AuthModule.main', 'Cancel'),
                        'url' => array('view', 'name' => $item->name),
                        'encodeLabel' => false,
                        'htmlOptions' => array('class' =>'btn btn-primary')
                    )); ?>
                </div>
            </div>

            <?php $this->endWidget(); ?>
        </div>
    </div>
</div>