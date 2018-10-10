<?php
/* @var $this AssignmentController */
/* @var $model User */
/* @var $authItemDp AuthItemDataProvider */
/* @var $formModel AddAuthItemForm */
/* @var $form TbActiveForm */
/* @var $assignmentOptions array */

$this->breadcrumbs = array(
    Yii::t('AuthModule.main', 'Assignments') => array('index'),
    CHtml::value($model, $this->module->userNameColumn),
);
?>


<div class="x_title">
    <h2><?php echo Yii::t('AuthModule.main', 'Assignments'); ?>
        <small>: <?php echo CHtml::encode(CHtml::value($model, $this->module->userNameColumn)); ?></small></h2>
    <ul class="nav navbar-<?php echo Yii::app()->getLanguage()=="en"?"right":"left"; ?> panel_toolbox">
        <a href="<?php echo $this->createUrl('index'); ?>" class="btn red mini"><i class="icon-table"></i> <?php echo Yii::t('AuthModule.main', 'Assignments'); ?></a>
    </ul>
    <div class="clearfix"></div>
</div>
<div class="x_content" style="display: block;">
    <div class="row">
        <div class="col-md-12">
            <h3>
                <?php echo Yii::t('AuthModule.main', 'Permissions'); ?>
                <small><?php echo Yii::t('AuthModule.main', 'Items assigned to this user'); ?></small>
            </h3>
            <?php if (!empty($assignmentOptions)): ?>

                <h4><?php echo Yii::t('AuthModule.main', 'Assign permission'); ?></h4>

                <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                    'type' => 'inline',
                )); ?>

                <?php //echo $form->dropDownListRow($formModel, 'items', $assignmentOptions, array('label' => false)); ?>
                <?php $this->widget('ext.select2.ESelect2',array(
                    'model'=>$formModel,
                    'attribute'=>'items',
                    'data'=>$assignmentOptions ,
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
                    'buttonType' => 'submit',
                    'label' => Yii::t('AuthModule.main', 'Assign'),
                )); ?>

                <?php $this->endWidget(); ?>

            <?php endif; ?>

            <br/>

            <?php $this->widget('bootstrap.widgets.TbGridView', array(
                'type' => 'striped condensed hover',
                'dataProvider' => $authItemDp,
                'emptyText' => Yii::t('AuthModule.main', 'This user does not have any assignments.'),
                'hideHeader' => true,
                'template' => "{items}",
                'columns' => array(
                    array(
                        'class' => 'AuthItemDescriptionColumn',
                        'active' => true,
                    ),
                    array(
                        'class' => 'AuthItemTypeColumn',
                        'active' => true,
                    ),
                    array(
                        'class' => 'AuthAssignmentRevokeColumn',
                        'userId' => $model->{$this->module->userIdColumn},
                    ),
                ),
            )); ?>


        </div>
    </div>
</div>