<?php
$btn_txt= $model->isNewRecord ? '<i class="icon-plus"></i> '.Yii::t('tx','Adding...') : '<i class="icon-ok"></i> '.Yii::t('tx','Saving...');
$tt= "$('#competence-has-client-btn').click(function() { var btn = $(this); btn.html('".$btn_txt."'); });" ;
Yii::app()->clientScript->registerScript('loading',$tt,  CClientScript::POS_END);
?><?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'competence-has-client-form',
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
        <?php echo $form->labelEx($model, 'competence_id',array('class'=>'control-label col-md-2 col-sm-2 col-xs-12')); ?>
        <div class="col-md-10 col-sm-10 col-xs-12">
		<?php echo $form->dropDownList($model, 'competence_id', CHtml::listData(Competence::model()->findAll(), 'id', 'name'), array('class' => 'form-control')); ?>
			<?php echo $form->error($model, 'competence_id'); ?>
		</div>
    </div>

	<div class="form-group">
        <?php echo $form->labelEx($model, 'client_id',array('class'=>'control-label col-md-2 col-sm-2 col-xs-12')); ?>
        <div class="col-md-10 col-sm-10 col-xs-12">
		<?php echo $form->dropDownList($model, 'client_id', CHtml::listData(Client::model()->findAll(), 'id', 'email'), array('class' => 'form-control')); ?>
			<?php echo $form->error($model, 'client_id'); ?>
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
                'htmlOptions' => array('id' => 'competence-has-client-btn', 'class' => 'lightslategrey')
		    )); ?>
        </div>
    </div>

<?php $this->endWidget(); ?>

