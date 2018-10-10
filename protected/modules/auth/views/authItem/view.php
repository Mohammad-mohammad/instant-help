<?php
/* @var $this OperationController|TaskController|RoleController */
/* @var $item CAuthItem */
/* @var $ancestorDp AuthItemDataProvider */
/* @var $descendantDp AuthItemDataProvider */
/* @var $formModel AddAuthItemForm */
/* @var $form TbActiveForm */
/* @var $childOptions array */

$this->breadcrumbs = array(
	$this->capitalize($this->getTypeText(true)) => array('index'),
	$item->description,
);
?>


<div class="x_title">
    <h2><?php echo $this->getTypeText(); ?>
        <small>: <?php echo CHtml::encode($item->description); ?></small></h2>
    <ul class="nav navbar-<?php echo Yii::app()->getLanguage()=="en"?"right":"left"; ?> panel_toolbox">
        <a href="<?php echo $this->createUrl('create'); ?>" class="btn green mini"><i class="icon-plus"></i> <?php echo Yii::t('tx', 'Add');echo " ".$this->capitalize($this->getTypeText(true)); ?></a>
        <?php echo CHtml::link('<i class="icon-trash"></i> '.Yii::t('tx','delete'), array('delete', 'name'=>$item->name), array('confirm' => Yii::t('AuthModule.main', 'Are you sure you want to delete this item?'), 'class' => 'btn blue mini')); ?>
        <a href="<?php echo $this->createUrl('update', array('name'=>$item->name)); ?>" class="btn purple mini"><i class="icon-pencil"></i> <?php echo Yii::t('AuthModule.main', 'Edit'); ?></a>
        <a href="<?php echo $this->createUrl('index'); ?>" class="btn red mini"><i class="icon-table"></i> <?php echo $this->capitalize($this->getTypeText(true)); ?></a>
    </ul>
    <div class="clearfix"></div>
</div>
<div class="x_content" style="display: block;">
    <div class="row">
        <div class="col-md-12">
            <?php $this->widget('bootstrap.widgets.TbDetailView', array(
                'data' => $item,
                'type' => 'striped bordered condensed',
                'attributes' => array(
                    array(
                        'name' => 'name',
                        'label' => Yii::t('AuthModule.main', 'System name'),
                    ),
                    array(
                        'name' => 'description',
                        'label' => Yii::t('AuthModule.main', 'Description'),
                    ),
                    /*
                    array(
                        'name' => 'bizrule',
                        'label' => Yii::t('AuthModule.main', 'Business rule'),
                    ),
                    array(
                        'name' => 'data',
                        'label' => Yii::t('AuthModule.main', 'Data'),
                    ),
                    */
                ),
            )); ?>

            <?php if (!empty($childOptions)): ?>

                <h4><?php echo Yii::t('AuthModule.main', 'Add child'); ?></h4>

                <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                    'type'=>'inline',
                )); ?>

                <?php //echo $form->dropDownListRow($formModel, 'items', $childOptions, array('label'=>false)); ?>
                <?php $this->widget('ext.select2.ESelect2',array(
                    'model'=>$formModel,
                    'attribute'=>'items',
                    'data'=>$childOptions ,
                    'htmlOptions'=>array(
                        'multiple'=>'multiple',
                        'class'=>'span5',
                        'style'=>'width:94%',
                    ),
                    'options'=>array(
                        'placeholder'=>Yii::t('AuthModule.main', 'Select item') . ' ...',
                        'allowClear'=>true,
                    ),
                )); ?>

                <?php $this->widget('bootstrap.widgets.TbButton', array(
                    'buttonType'=>'submit',
                    'label'=>Yii::t('AuthModule.main', 'Add'),
                )); ?>

                <?php $this->endWidget(); ?>

            <?php endif; ?>

            <div class="ln_solid"></div>
            <h3>
                <?php echo Yii::t('AuthModule.main', 'Ancestors'); ?>
                <small><?php echo Yii::t('AuthModule.main', 'Permissions that inherit this item'); ?></small>
            </h3>

            <?php $this->widget('bootstrap.widgets.TbGridView', array(
                'type' => 'striped condensed hover',
                'dataProvider'=>$ancestorDp,
                'emptyText'=>Yii::t('AuthModule.main', 'This item does not have any ancestors.'),
                'template'=>"{items}",
                'hideHeader'=>true,
                'columns'=>array(
                    array(
                        'class'=>'AuthItemDescriptionColumn',
                        'itemName'=>$item->name,
                    ),
                    array(
                        'class'=>'AuthItemTypeColumn',
                        'itemName'=>$item->name,
                    ),
                    array(
                        'class'=>'AuthItemRemoveColumn',
                        'itemName'=>$item->name,
                    ),
                ),
            )); ?>



            <h3>
                <?php echo Yii::t('AuthModule.main', 'Descendants'); ?>
                <small><?php echo Yii::t('AuthModule.main', 'Permissions granted by this item'); ?></small>
            </h3>

            <?php $this->widget('bootstrap.widgets.TbGridView', array(
                'type' => 'striped condensed hover',
                'dataProvider'=>$descendantDp,
                'emptyText'=>Yii::t('AuthModule.main', 'This item does not have any descendants.'),
                'hideHeader'=>true,
                'template'=>"{items}",
                'columns'=>array(
                    array(
                        'class'=>'AuthItemDescriptionColumn',
                        'itemName'=>$item->name,
                    ),
                    array(
                        'class'=>'AuthItemTypeColumn',
                        'itemName'=>$item->name,
                    ),
                    array(
                        'class'=>'AuthItemRemoveColumn',
                        'itemName'=>$item->name,
                    ),
                ),
            )); ?>

        </div>
    </div>
</div>


