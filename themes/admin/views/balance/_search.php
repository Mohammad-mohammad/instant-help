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
            <?php echo $form->label($model, 'amount'); ?>
			<?php echo $form->textField($model,'amount',array('class' => 'form-control' )); ?>
		</div>
        <div class="col-md-3 col-sm-12 col-xs-12 form-group">
            <?php echo $form->label($model, 'depositedate'); ?>
			<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'name' => 'depositedate',
                    'language' => Yii::app()->language == 'et' ? 'et' : null,
                    'attribute' => 'depositedate',
                    'model' => $model,
                    //'themeUrl'=>Yii::app()->request->baseUrl.'/css/redmond/jquery.ui.datepicker.css',
                    'skin' => 'redmond',
                    'options' => array(
                        'dateFormat' => 'yy-mm-dd',
                        'changeMonth' => 'true',
                        'changeYear' => 'true',
                        'showButtonPanel' => 'true',
                        'constrainInput' => 'false',
                        'duration' => 'fast',
                        'showAnim' => 'slide',
                    ),
                    'htmlOptions' => array(
                        'style' => 'width:245px;vertical-align:top',
                        'class' =>'form-control',
                    ),
                ));
                ?>
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
