<?php
$btn_txt= $model->isNewRecord ? '<i class="icon-plus"></i> '.Yii::t('tx','Adding...') : '<i class="icon-ok"></i> '.Yii::t('tx','Saving...');
$tt= "$('#calling-btn').click(function() { var btn = $(this); btn.html('".$btn_txt."'); });" ;
Yii::app()->clientScript->registerScript('loading',$tt,  CClientScript::POS_END);
?><?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'calling-form',
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
        <?php echo $form->labelEx($model, 'type',array('class'=>'control-label col-md-2 col-sm-2 col-xs-12')); ?>
        <div class="col-md-10 col-sm-10 col-xs-12">
			<?php echo $form->textField($model,'type',array('class' => 'form-control' ,'maxlength'=>5)); ?>
			<?php echo $form->error($model, 'type'); ?>
		</div>
    </div>

	<div class="form-group">
        <?php echo $form->labelEx($model, 'strat',array('class'=>'control-label col-md-2 col-sm-2 col-xs-12')); ?>
        <div class="col-md-10 col-sm-10 col-xs-12">
		<?php
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'name' => 'strat',
                    'language' => Yii::app()->language == 'et' ? 'et' : null,
                    'attribute' => 'strat',
                    'model' => $model,
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
			<?php echo $form->error($model, 'strat'); ?>
		</div>
    </div>

	<div class="form-group">
        <?php echo $form->labelEx($model, 'end',array('class'=>'control-label col-md-2 col-sm-2 col-xs-12')); ?>
        <div class="col-md-10 col-sm-10 col-xs-12">
		<?php
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'name' => 'end',
                    'language' => Yii::app()->language == 'et' ? 'et' : null,
                    'attribute' => 'end',
                    'model' => $model,
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
			<?php echo $form->error($model, 'end'); ?>
		</div>
    </div>

	<div class="form-group">
        <?php echo $form->labelEx($model, 'amount',array('class'=>'control-label col-md-2 col-sm-2 col-xs-12')); ?>
        <div class="col-md-10 col-sm-10 col-xs-12">
			<?php echo $form->textField($model,'amount',array('class' => 'form-control' )); ?>
			<?php echo $form->error($model, 'amount'); ?>
		</div>
    </div>

	<div class="form-group">
        <?php echo $form->labelEx($model, 'sender',array('class'=>'control-label col-md-2 col-sm-2 col-xs-12')); ?>
        <div class="col-md-10 col-sm-10 col-xs-12">
		<?php echo $form->dropDownList($model, 'sender', CHtml::listData(Client::model()->findAll(), 'id', 'email'), array('class' => 'form-control')); ?>
			<?php echo $form->error($model, 'sender'); ?>
		</div>
    </div>

	<div class="form-group">
        <?php echo $form->labelEx($model, 'receiver',array('class'=>'control-label col-md-2 col-sm-2 col-xs-12')); ?>
        <div class="col-md-10 col-sm-10 col-xs-12">
		<?php echo $form->dropDownList($model, 'receiver', CHtml::listData(Client::model()->findAll(), 'id', 'email'), array('class' => 'form-control')); ?>
			<?php echo $form->error($model, 'receiver'); ?>
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
                'htmlOptions' => array('id' => 'calling-btn', 'class' => 'lightslategrey')
		    )); ?>
        </div>
    </div>

<?php $this->endWidget(); ?>

