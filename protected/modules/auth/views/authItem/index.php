<?php
/* @var $this OperationController|TaskController|RoleController */
/* @var $dataProvider AuthItemDataProvider */

$this->breadcrumbs = array(
	$this->capitalize($this->getTypeText(true)),
);
?>



<div class="x_title">
    <h2> <?php echo $this->capitalize($this->getTypeText(true)); ?>  </h2>
    <ul class="nav navbar-<?php echo Yii::app()->getLanguage()=="en"?"right":"left"; ?> panel_toolbox">

    </ul>
    <div class="clearfix"></div>
</div>
<div class="x_content" style="display: block;">
    <div class="row">
        <div class="col-md-12">
            <ul class="list-unstyled timeline">

                <?php $this->widget('bootstrap.widgets.TbButton', array(
                    'type' => 'primary',
                    'label' => '<i class="icon-plus"></i> ' .Yii::t('AuthModule.main', 'Add {type}', array('{type}' => $this->getTypeText())),
                    'url' => array('create'),
                    'encodeLabel' => false,
                    'htmlOptions' => array('class' => 'btn red')
                )); ?>

                <?php $this->widget('bootstrap.widgets.TbGridView', array(
                    'type' => 'striped hover bordered condensed',
                    'dataProvider' => $dataProvider,
                    'emptyText' => Yii::t('AuthModule.main', 'No {type} found.', array('{type}'=>$this->getTypeText(true))),
                    'template'=>"{items}\n{pager}",
                    'columns' => array(
                        array(
                            'name' => 'name',
                            'type'=>'raw',
                            'header' => Yii::t('AuthModule.main', 'System name'),
                            'htmlOptions' => array('class'=>'item-name-column'),
                            'value' => "CHtml::link(\$data->name, array('view', 'name'=>\$data->name))",
                        ),
                        array(
                            'name' => 'description',
                            'header' => Yii::t('AuthModule.main', 'Description'),
                            'htmlOptions' => array('class'=>'item-description-column'),
                        ),
                        array(
                            'class'=>'CButtonColumn',
                            'htmlOptions'=>array('style'=>'width:217px'),

                            'viewButtonImageUrl'=>false,
                            'viewButtonOptions'=>array('class'=>'btn default green-stripe mini'),
                            'viewButtonLabel' => '<i class="icon-eye-open"></i> '.Yii::t('AuthModule.main', 'View'),
                            'viewButtonUrl' => "Yii::app()->controller->createUrl('view', array('name'=>\$data->name))",

                            'updateButtonImageUrl'=>false,
                            'updateButtonOptions'=>array('class'=>'btn default blue-stripe mini'),
                            'updateButtonLabel' => '<i class="icon-pencil"></i>  '.Yii::t('AuthModule.main', 'Edit'),
                            'updateButtonUrl' => "Yii::app()->controller->createUrl('update', array('name'=>\$data->name))",

                            'deleteButtonImageUrl'=>false,
                            'deleteButtonOptions'=>array('class'=>'btn default red-stripe mini'),
                            'deleteButtonLabel' => '<i class="icon-trash"></i>  '.Yii::t('AuthModule.main', 'Delete'),
                            'deleteButtonUrl' => "Yii::app()->controller->createUrl('delete', array('name'=>\$data->name))",
                            'deleteConfirmation' => Yii::t('AuthModule.main', 'Are you sure you want to delete this item?'),
                        ),
                    ),
                )); ?>

            </ul>
        </div>
    </div>
</div>