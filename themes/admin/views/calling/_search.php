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
            <?php echo $form->label($model, 'type'); ?>
			<?php echo $form->textField($model,'type',array('class' => 'form-control' ,'maxlength'=>5)); ?>
		</div>
        <div class="col-md-3 col-sm-12 col-xs-12 form-group">
            <?php echo $form->label($model, 'strat'); ?>
			<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'name' => 'strat',
                    'language' => Yii::app()->language == 'et' ? 'et' : null,
                    'attribute' => 'strat',
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
            <?php echo $form->label($model, 'end'); ?>
			<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'name' => 'end',
                    'language' => Yii::app()->language == 'et' ? 'et' : null,
                    'attribute' => 'end',
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
    </div>
    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
        <div class="col-md-3 col-sm-12 col-xs-12 form-group">
            <?php echo $form->label($model, 'amount'); ?>
			<?php echo $form->textField($model,'amount',array('class' => 'form-control' )); ?>
		</div>
        <div class="col-md-3 col-sm-12 col-xs-12 form-group">
            <?php echo $form->label($model, 'status'); ?>
			<?php echo $form->textField($model,'status',array('class' => 'form-control' ,'maxlength'=>11)); ?>
		</div>
        <div class="col-md-3 col-sm-12 col-xs-12 form-group">
            <?php echo $form->label($model, 'sender'); ?>
		<?php echo $form->dropDownList($model, 'sender', CHtml::listData(Client::model()->findAll(), 'id', 'email'), array('class' => 'form-control')); ?>
		</div>
        <div class="col-md-3 col-sm-12 col-xs-12 form-group">
            <?php echo $form->label($model, 'receiver'); ?>
		<?php echo $form->dropDownList($model, 'receiver', CHtml::listData(Client::model()->findAll(), 'id', 'email'), array('class' => 'form-control')); ?>
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
