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
            <?php echo $form->label($model, 'guid'); ?>
			<?php echo $form->textField($model,'guid',array('class' => 'form-control' ,'maxlength'=>100)); ?>
		</div>
        <div class="col-md-3 col-sm-12 col-xs-12 form-group">
            <?php echo $form->label($model, 'fname'); ?>
			<?php echo $form->textField($model,'fname',array('class' => 'form-control' ,'maxlength'=>45)); ?>
		</div>
        <div class="col-md-3 col-sm-12 col-xs-12 form-group">
            <?php echo $form->label($model, 'lname'); ?>
			<?php echo $form->textField($model,'lname',array('class' => 'form-control' ,'maxlength'=>45)); ?>
		</div>
    </div>
    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
        <div class="col-md-3 col-sm-12 col-xs-12 form-group">
            <?php echo $form->label($model, 'email'); ?>
			<?php echo $form->textField($model,'email',array('class' => 'form-control' ,'maxlength'=>45)); ?>
		</div>
        <div class="col-md-3 col-sm-12 col-xs-12 form-group">
            <?php echo $form->label($model, 'password'); ?>
			<?php echo $form->passwordField($model,'password',array('class' => 'form-control' ,'maxlength'=>45)); ?>
		</div>
            <div class="col-md-3 col-sm-12 col-xs-12 form-group">
            <?php echo $form->label($model, 'country'); ?>
			<?php echo $form->textField($model,'country',array('class' => 'form-control' ,'maxlength'=>45)); ?>
		</div>
        <div class="col-md-3 col-sm-12 col-xs-12 form-group">
            <?php echo $form->label($model, 'city'); ?>
			<?php echo $form->textField($model,'city',array('class' => 'form-control' ,'maxlength'=>45)); ?>
		</div>
    </div>
    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
        <div class="col-md-3 col-sm-12 col-xs-12 form-group">
            <?php echo $form->label($model, 'address'); ?>
			<?php echo $form->textField($model,'address',array('class' => 'form-control' ,'maxlength'=>45)); ?>
		</div>
        <div class="col-md-3 col-sm-12 col-xs-12 form-group">
            <?php echo $form->label($model, 'clientStatus'); ?>
			<?php echo $form->dropDownList($model,'clientStatus', Helpers::clientstatus() , array('class' => 'form-control')); ?>
		</div>
        <div class="col-md-3 col-sm-12 col-xs-12 form-group">
            <?php echo $form->label($model, 'level'); ?>
			<?php echo $form->textField($model,'level',array('class' => 'form-control' ,'maxlength'=>11)); ?>
		</div>
        <div class="col-md-3 col-sm-12 col-xs-12 form-group">
            <?php echo $form->label($model, 'available'); ?>
			<div>
				<label><?php echo $form->radioButton($model,'available',array('class'=>'flat','value'=>1))." ".Yii::t('tx','yes'); ?></label>
			</div>
			<div>
				<label><?php echo $form->radioButton($model,'available',array('class'=>'flat','value'=>0))." ".Yii::t('tx','no'); ?></label>
			</div>
		</div>
    </div>
    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
        <div class="col-md-3 col-sm-12 col-xs-12 form-group">
            <?php echo $form->label($model, 'clientType'); ?>
			<?php echo $form->dropDownList($model,'clientType', Helpers::clienttype() , array('class' => 'form-control')); ?>
		</div>
        <div class="col-md-3 col-sm-12 col-xs-12 form-group">
            <?php echo $form->label($model, 'bankaccount'); ?>
			<?php echo $form->textField($model,'bankaccount',array('class' => 'form-control' ,'maxlength'=>45)); ?>
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
