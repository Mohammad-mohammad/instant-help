<?php
$btn_txt= $model->isNewRecord ? '<i class="icon-plus"></i> '.Yii::t('tx','Adding...') : '<i class="icon-ok"></i> '.Yii::t('tx','Saving...');
$tt= "$('#balance-btn').click(function() { var btn = $(this); btn.html('".$btn_txt."'); });" ;
Yii::app()->clientScript->registerScript('loading',$tt,  CClientScript::POS_END);
?><?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'balance-form',
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
        <?php echo $form->labelEx($model, 'amount',array('class'=>'control-label col-md-2 col-sm-2 col-xs-12')); ?>
        <div class="col-md-10 col-sm-10 col-xs-12">
			<?php echo $form->textField($model,'amount',array('class' => 'form-control' )); ?>
			<?php echo $form->error($model, 'amount'); ?>
		</div>
    </div>

	<div class="form-group">
        <?php echo $form->labelEx($model, 'depositedate',array('class'=>'control-label col-md-2 col-sm-2 col-xs-12')); ?>
        <div class="col-md-10 col-sm-10 col-xs-12">
		<?php
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'name' => 'depositedate',
                    'language' => Yii::app()->language == 'et' ? 'et' : null,
                    'attribute' => 'depositedate',
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
			<?php echo $form->error($model, 'depositedate'); ?>
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
                'htmlOptions' => array('id' => 'balance-btn', 'class' => 'lightslategrey')
		    )); ?>
        </div>
    </div>

<?php $this->endWidget(); ?>

