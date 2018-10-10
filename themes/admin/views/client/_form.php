<?php
$btn_txt= $model->isNewRecord ? '<i class="icon-plus"></i> '.Yii::t('tx','Adding...') : '<i class="icon-ok"></i> '.Yii::t('tx','Saving...');
$tt= "$('#client-btn').click(function() { var btn = $(this); btn.html('".$btn_txt."'); });" ;
Yii::app()->clientScript->registerScript('loading',$tt,  CClientScript::POS_END);
?><?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'client-form',
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
        <?php echo $form->labelEx($model, 'guid',array('class'=>'control-label col-md-2 col-sm-2 col-xs-12')); ?>
        <div class="col-md-10 col-sm-10 col-xs-12">
			<?php echo $form->textField($model,'guid',array('class' => 'form-control' ,'maxlength'=>100)); ?>
			<?php echo $form->error($model, 'guid'); ?>
		</div>
    </div>

	<div class="form-group">
        <?php echo $form->labelEx($model, 'fname',array('class'=>'control-label col-md-2 col-sm-2 col-xs-12')); ?>
        <div class="col-md-10 col-sm-10 col-xs-12">
			<?php echo $form->textField($model,'fname',array('class' => 'form-control' ,'maxlength'=>45)); ?>
			<?php echo $form->error($model, 'fname'); ?>
		</div>
    </div>

	<div class="form-group">
        <?php echo $form->labelEx($model, 'lname',array('class'=>'control-label col-md-2 col-sm-2 col-xs-12')); ?>
        <div class="col-md-10 col-sm-10 col-xs-12">
			<?php echo $form->textField($model,'lname',array('class' => 'form-control' ,'maxlength'=>45)); ?>
			<?php echo $form->error($model, 'lname'); ?>
		</div>
    </div>

	<div class="form-group">
        <?php echo $form->labelEx($model, 'email',array('class'=>'control-label col-md-2 col-sm-2 col-xs-12')); ?>
        <div class="col-md-10 col-sm-10 col-xs-12">
			<?php echo $form->textField($model,'email',array('class' => 'form-control' ,'maxlength'=>45)); ?>
			<?php echo $form->error($model, 'email'); ?>
		</div>
    </div>

	<div class="form-group">
        <?php echo $form->labelEx($model, 'password',array('class'=>'control-label col-md-2 col-sm-2 col-xs-12')); ?>
        <div class="col-md-10 col-sm-10 col-xs-12">
			<?php echo $form->passwordField($model,'password',array('class' => 'form-control' ,'maxlength'=>45)); ?>
			<?php echo $form->error($model, 'password'); ?>
		</div>
    </div>

	<div class="form-group">
        <?php echo $form->labelEx($model, 'photo',array('class'=>'control-label col-md-2 col-sm-2 col-xs-12')); ?>
        <div class="col-md-10 col-sm-10 col-xs-12">
			<?php if(!$model->isNewRecord && $model->photo){ ?>
                <div class="controls">
                    <div class="fileupload fileupload-new" data-provides="fileupload">
                        <div class="fileupload-new thumbnail" style="width: <?php echo Yii::app()->params['thumb_w'] ;?>px;height: <?php echo Yii::app()->params['thumb_h'] ;?>px;">
                            <!--<img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />-->
                            <img src="<?php echo $model->_photo; ?>"  alt=""/>
                        </div>
                    </div>
                    <?php if(!$model->isAttributeRequired('photo')) { ?>
                    <div>
                        <span><?php echo '&nbsp;<input type="checkbox" name="photo_delete" id="photo_delete" value="photo_delete"/>'; ?></span>
                        <?php  echo Yii::t('tx','Check this to delete this photo');  ?>
                    </div>
                    <?php } ?>
                </div>
            <?php } ?>
			<?php echo $form->fileField($model,'photo',array('class' => 'form-control')); ?>
			<?php echo $form->error($model, 'photo'); ?>
		</div>
    </div>

	<div class="form-group">
        <?php echo $form->labelEx($model, 'country',array('class'=>'control-label col-md-2 col-sm-2 col-xs-12')); ?>
        <div class="col-md-10 col-sm-10 col-xs-12">
			<?php echo $form->textField($model,'country',array('class' => 'form-control' ,'maxlength'=>45)); ?>
			<?php echo $form->error($model, 'country'); ?>
		</div>
    </div>

	<div class="form-group">
        <?php echo $form->labelEx($model, 'city',array('class'=>'control-label col-md-2 col-sm-2 col-xs-12')); ?>
        <div class="col-md-10 col-sm-10 col-xs-12">
			<?php echo $form->textField($model,'city',array('class' => 'form-control' ,'maxlength'=>45)); ?>
			<?php echo $form->error($model, 'city'); ?>
		</div>
    </div>

	<div class="form-group">
        <?php echo $form->labelEx($model, 'address',array('class'=>'control-label col-md-2 col-sm-2 col-xs-12')); ?>
        <div class="col-md-10 col-sm-10 col-xs-12">
			<?php echo $form->textField($model,'address',array('class' => 'form-control' ,'maxlength'=>45)); ?>
			<?php echo $form->error($model, 'address'); ?>
		</div>
    </div>

	<div class="form-group">
        <?php echo $form->labelEx($model, 'clientStatus',array('class'=>'control-label col-md-2 col-sm-2 col-xs-12')); ?>
        <div class="col-md-10 col-sm-10 col-xs-12">
			<?php echo $form->dropDownList($model,'clientStatus', Helpers::clientstatus() , array('class' => 'form-control')); ?>
			<?php echo $form->error($model, 'clientStatus'); ?>
		</div>
    </div>

	<div class="form-group">
        <?php echo $form->labelEx($model, 'level',array('class'=>'control-label col-md-2 col-sm-2 col-xs-12')); ?>
        <div class="col-md-10 col-sm-10 col-xs-12">
			<?php echo $form->textField($model,'level',array('class' => 'form-control' ,'maxlength'=>11)); ?>
			<?php echo $form->error($model, 'level'); ?>
		</div>
    </div>

	<div class="form-group">
        <?php echo $form->labelEx($model, 'available',array('class'=>'control-label col-md-2 col-sm-2 col-xs-12')); ?>
        <div class="col-md-10 col-sm-10 col-xs-12">
			<div class='radio'>
<?php echo $form->radioButtonList($model,'available',
                array(1=>Yii::t('tx','yes'), 0=>Yii::t('tx','no')) ,
                array('class'=>'flat', 'separator'=>"</div><div class='radio'>")
                    );
                ?></div>
			<?php echo $form->error($model, 'available'); ?>
		</div>
    </div>

	<div class="form-group">
        <?php echo $form->labelEx($model, 'clientType',array('class'=>'control-label col-md-2 col-sm-2 col-xs-12')); ?>
        <div class="col-md-10 col-sm-10 col-xs-12">
			<?php echo $form->dropDownList($model,'clientType', Helpers::clienttype() , array('class' => 'form-control')); ?>
			<?php echo $form->error($model, 'clientType'); ?>
		</div>
    </div>

	<div class="form-group">
        <?php echo $form->labelEx($model, 'bankaccount',array('class'=>'control-label col-md-2 col-sm-2 col-xs-12')); ?>
        <div class="col-md-10 col-sm-10 col-xs-12">
			<?php echo $form->textField($model,'bankaccount',array('class' => 'form-control' ,'maxlength'=>45)); ?>
			<?php echo $form->error($model, 'bankaccount'); ?>
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
                'htmlOptions' => array('id' => 'client-btn', 'class' => 'lightslategrey')
		    )); ?>
        </div>
    </div>

<?php $this->endWidget(); ?>

