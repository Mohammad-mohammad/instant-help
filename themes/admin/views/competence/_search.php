<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'htmlOptions' => array('class' => 'well'),
)); ?>

    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
        <div class="col-md-3 col-sm-12 col-xs-12 form-group">
            <?php echo $form->label($model, 'id'); ?>
			<?php echo $form->textField($model,'id',array('class' => 'form-control' ,'maxlength'=>11)); ?>
		</div>
        <div class="col-md-3 col-sm-12 col-xs-12 form-group">
            <?php echo $form->label($model, 'name'); ?>
			<?php echo $form->textField($model,'name',array('class' => 'form-control' ,'maxlength'=>45)); ?>
		</div>
        <div class="col-md-3 col-sm-12 col-xs-12 form-group">
            <?php echo $form->label($model, 'description'); ?>
			<?php echo $form->textField($model,'description',array('class' => 'form-control' )); ?>
		</div>

    </div>

    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
    <?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>Yii::t('tx', 'Search'),
		)); ?>
    </div>

<?php $this->endWidget(); ?>
