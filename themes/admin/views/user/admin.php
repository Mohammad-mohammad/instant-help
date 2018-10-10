<?php
$this->breadcrumbs=array(
	Yii::t('tx', 'Users')=>array('index'),
	Yii::t('tx', 'Manage'),
);
Yii::app()->clientScript->registerScript(Yii::t('tx', 'search'), "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('user-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<div class="x_title">
    <h2><?php echo Yii::t('tx', 'Manage');echo " "; echo Yii::t('tx', 'Users'); ?></h2>
    <ul class="nav navbar-<?php echo Yii::app()->getLanguage()=="ar"?"left":"right"; ?> panel_toolbox">
        <?php if(Yii::app()->user->checkAccess('user.create')): ?>
            <a href="<?php echo $this->createUrl('create'); ?>" class="btn lightslategrey mini"><i class="icon-plus"></i> <?php echo Yii::t('tx', 'Add');echo " "; echo Yii::t('tx', 'User'); ?></a>
        <?php endif; ?>
    </ul>
    <div class="clearfix"></div>
</div>
<div class="x_content" style="display: block;">
    <div class="row">
        <div class="col-md-12">
            <?php /*
            <p>
                <?php echo Yii::t('tx', 'You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b> or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.'); ?>
            </p>

            <?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn lightslategrey')); ?>
            <div class="search-form" style="display:none">
                <?php $this->renderPartial('_search',array(
                    'model'=>$model,
                )); ?>
            </div><!-- search-form -->
            */ ?>
            <?php $form=$this->beginWidget('CActiveForm', array(
                'enableAjaxValidation'=>true,
            )); ?>

            <?php $this->widget('bootstrap.widgets.TbGridView',array(
                'id'=>'user-grid',
                'type' => 'striped bordered condensed',
                'dataProvider'=>$model->search(),
                'filter'=>$model,
                'columns'=>array(
                    array(
                        'id' => 'selectedIds',
                        'class' => 'CCheckBoxColumn',
                        'selectableRows' => '50',
                    ),
                    array(
                        'name' => 'id',
                        'headerHtmlOptions' => array('style' => 'width: 60px'),
                    ),
                    'name',
                    'password',
                    array(
                        'name' => 'image',
                        'type' => 'HTML',
                        'value' => 'Helpers::thumb($data->absoluteimage)',
                        'filter' => false,
                        'sortable' => false,
                    ),
                    array(
                        'name' => 'authName',
                        'filter' => false,
                    ),

                    /*'lastLoginTime',
                    'salt',
                    'email',
                    'profile',*/
                    array(
                        'class'=>'CButtonColumn',
                        'template'=>'{delete} {update} {view}',

                        'htmlOptions'=>array('style'=>'width:217px'),
                        'deleteButtonImageUrl'=>false,
                        'deleteButtonLabel'=>'<i class="icon-trash"></i>  '.Yii::t('tx', 'delete'),
                        'deleteButtonOptions'=>array('class'=>'btn default red-stripe mini'),

                        'updateButtonImageUrl'=>false,
                        'updateButtonLabel'=>'<i class="icon-pencil"></i>  '.Yii::t('tx', 'update'),
                        'updateButtonOptions'=>array('class'=>'btn default blue-stripe mini'),

                        'viewButtonImageUrl'=>false,
                        'viewButtonLabel'=>'<i class="icon-eye-open"></i> '.Yii::t('tx', 'view'),
                        'viewButtonOptions'=>array('class'=>'btn default green-stripe mini'),

                        'buttons'=>array
                        (
                            'delete' => array('visible'=>'Yii::app()->user->checkAccess(\'user.delete\')'),
                            'update' => array('visible'=>'Yii::app()->user->checkAccess(\'user.update\')'),
                            'view' => array('visible'=>'Yii::app()->user->checkAccess(\'user.view\')'),
                        ),
                    ),
                ),
            )); ?>
            <?php
            Yii::app()->clientScript->registerScript('re-install-date-picker', "
function reinstallDatePicker(id, data) {
}
");
            ?>
            <script>
                function reloadGrid(data) {
                    $.fn.yiiGridView.update('user-grid');
                }
            </script>
            <div class="actions">
                <?php echo CHtml::ajaxSubmitButton('Filter',array('ajaxupdate'), array(),array("style"=>"display:none;")); ?>
                &nbsp;      &nbsp;<?php echo CHtml::ajaxSubmitButton(Yii::t('tx', 'Delete'),array('ajaxupdate','act'=>'doDelete'), array('beforeSend'=>'function() { if(confirm("'.Yii::t('tx', 'Are You Sure ...?').'")) return true; return false; }','success'=>'reloadGrid'),array('class'=>'btn lightslategrey mini')); ?>
            </div>
            <?php $this->endWidget(); ?>

        </div>
    </div>
</div>