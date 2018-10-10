<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'htmlOptions' => array('class' => 'well'),
)); ?>

		<?php echo $form->label($model, 'id'); ?>
		<?php echo $form->textField($model,'id'); ?>

		<?php echo $form->label($model, 'name'); ?>
		<?php echo $form->textField($model,'name'); ?>

		<?php echo $form->label($model, 'lastLoginTime'); ?>
		<?php echo $form->textField($model,'lastLoginTime'); ?>

		<?php echo $form->label($model, 'salt'); ?>
		<?php echo $form->textField($model,'salt'); ?>

		<?php echo $form->label($model, 'email'); ?>
		<?php echo $form->textField($model,'email'); ?>

		<?php echo $form->label($model, 'profile'); ?>
		<?php echo $form->textField($model,'profile'); ?>

	<div class="control-group">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>Yii::t('tx', 'Search'),
		)); ?>
	</div>

<?php $this->endWidget(); ?>
