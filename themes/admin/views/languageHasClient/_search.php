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
            <?php echo $form->label($model, 'language_id'); ?>
		<?php echo $form->dropDownList($model, 'language_id', CHtml::listData(Language::model()->findAll(), 'id', 'name'), array('class' => 'form-control')); ?>
		</div>
        <div class="col-md-3 col-sm-12 col-xs-12 form-group">
            <?php echo $form->label($model, 'client_id'); ?>
		<?php echo $form->dropDownList($model, 'client_id', CHtml::listData(Client::model()->findAll(), 'id', 'email'), array('class' => 'form-control')); ?>
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
