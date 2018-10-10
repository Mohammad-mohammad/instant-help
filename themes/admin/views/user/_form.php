<?php
$btn_txt= $model->isNewRecord ? '<i class="icon-plus"></i> '.Yii::t('tx','Adding...') : '<i class="icon-ok"></i> '.Yii::t('tx','Saving...');
$tt= "$('#user-btn').click(function() { var btn = $(this); btn.html('".$btn_txt."'); });" ;
Yii::app()->clientScript->registerScript('loading',$tt,  CClientScript::POS_END);
?>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array('enctype' => 'multipart/form-data', 'class' => 'form-horizontal form-label-left'),
)); ?>

<div class="alert alert-note">
    <ul class="fa-ul">
        <li>
            <i class="fa fa-info-circle fa-lg fa-li"></i> <?php echo Yii::t('tx', 'Fields with'); ?>  <code> *</code> <?php echo Yii::t('tx','are required.'); ?>
        </li>
    </ul>
</div>

    <?php echo $form->errorSummary($model); ?>



    <div class="form-group">
        <?php echo $form->labelEx($model, 'name', array('class' => 'control-label col-md-2 col-sm-2 col-xs-12')); ?>
        <div class="col-md-10 col-sm-10 col-xs-12">
            <?php echo $form->textField($model,'name',array('class' => 'form-control')); ?>
            <?php echo $form->error($model, 'name'); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'password', array('class' => 'control-label col-md-2 col-sm-2 col-xs-12')); ?>
        <div class="col-md-10 col-sm-10 col-xs-12">
            <?php //echo $form->passwordField($model,'password',array('class' => 'form-control', 'size' => 45)); ?>
            <?php echo $form->textField($model,'password',array('class' => 'form-control')); ?>
            <?php echo $form->error($model, 'password'); ?>
        </div>
    </div>

<div class="form-group">
    <?php echo $form->labelEx($model, 'image',array('class'=>'control-label col-md-2 col-sm-2 col-xs-12')); ?>
    <div class="col-md-10 col-sm-10 col-xs-12">
        <?php if(!$model->isNewRecord): ?>
            <div class="controls">
                <div class="fileupload fileupload-new" data-provides="fileupload">
                    <div class="fileupload-new thumbnail" style="width: <?php echo Yii::app()->params['thumb_w'] ;?>px;height: <?php echo Yii::app()->params['thumb_h'] ;?>px;">
                        <!--<img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />-->
                        <img src="<?php echo $model->_image; ?>"  alt=""/>
                    </div>
                </div>

            </div>
        <?php endif; ?>
        <?php echo $form->fileField($model,'image',array('class' => 'form-control')); ?>
        <?php echo $form->error($model, 'image'); ?>
    </div>
</div>

    <div class="form-group">
        <label class="control-label col-md-2 col-sm-2 col-xs-12"><?php echo Yii::t('tx','Role'); ?></label>
        <div class="col-md-10 col-sm-10 col-xs-12">
            <select name="authItem" class="form-control">
            <?php
            $options = array();
            $am = Yii::app()->authManager;
            $authItems = $am->getAuthItems();
            foreach ($authItems as $itemName => $item)
            {
                if($item->type==CAuthItem::TYPE_ROLE)
                    echo '<option value="'.$item->name.'">'.$item->description.'</option>';
            }
            ?>
            </select>
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
            'htmlOptions' => array('id' => 'user-btn', 'class' => 'lightslategrey')
            )); ?>
        </div>
    </div>

    <?php $this->endWidget(); ?>
