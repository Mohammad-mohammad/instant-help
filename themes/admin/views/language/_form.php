<?php
$btn_txt= $model->isNewRecord ? '<i class="icon-plus"></i> '.Yii::t('tx','Adding...') : '<i class="icon-ok"></i> '.Yii::t('tx','Saving...');
$tt= "$('#language-btn').click(function() { var btn = $(this); btn.html('".$btn_txt."'); });" ;
Yii::app()->clientScript->registerScript('loading',$tt,  CClientScript::POS_END);
?><?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'language-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array('enctype' => 'multipart/form-data', 'class' => 'form-horizontal form-label-left'),
)); ?>
	<div class="alert alert-note">
        <ul class="fa-ul">
            <li>
                <i class="fa fa-info-circle fa-lg fa-li"></i> <?php echo Yii::t('tx', 'Fields with'); ?>  <code> *</code> <?php echo Yii::t('tx','are required.'); ?>            </li>
        </ul>
    </div>

	<?php echo $form->errorSummary($model); ?>

	<div class="form-group">
        <?php echo $form->labelEx($model, 'name',array('class'=>'control-label col-md-2 col-sm-2 col-xs-12')); ?>
        <div class="col-md-10 col-sm-10 col-xs-12">
			<?php echo $form->textField($model,'name',array('class' => 'form-control' ,'maxlength'=>45)); ?>
			<?php echo $form->error($model, 'name'); ?>
		</div>
    </div>

	<div class="form-group">
        <?php echo $form->labelEx($model, 'code',array('class'=>'control-label col-md-2 col-sm-2 col-xs-12')); ?>
        <div class="col-md-10 col-sm-10 col-xs-12">
			<?php echo $form->textField($model,'code',array('class' => 'form-control' ,'maxlength'=>45)); ?>
			<?php echo $form->error($model, 'code'); ?>
		</div>
    </div>

    <div class="ln_solid"></div>

    <div class="form-group">
        <div class="col-md-10 col-sm-10 col-xs-12 col-md-offset-2">
            <a href="<?php echo $this->createUrl('admin'); ?>" class="btn btn-primary"><i class="fa fa-rotate-left"></i> <?php echo Yii::t('tx','Cancel'); ?></a>
            <?php $this->widget('bootstrap.widgets.TbButton', array(
			    'buttonType'=>'submit',
			    'encodeLabel' => false,
			    'label' => $model->isNewRecord ? '<i class="icon-plus"></i> ' . Yii::t('tx','Add') : '<i class="icon-ok"></i> ' . Yii::t('tx','Save'),
                'htmlOptions' => array('id' => 'language-btn', 'class' => 'lightslategrey')
		    )); ?>
        </div>
    </div>

<?php $this->endWidget(); ?>

