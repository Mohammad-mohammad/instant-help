<?php
/**
 * The following variables are available in this template:
 * - $this: the BootCrudCode object
 */
?>
<?php
echo "<?php\n";
$label=$this->pluralize($this->class2name($this->modelClass));
$label3=$this->class2name($this->modelClass);
echo "\$this->breadcrumbs=array(
	Yii::t('tx', 'Manage'),
);\n";
$label1=strtolower($this->modelClass);
$label2=$this->modelClass;
?>

$this->menu=array(
	array('label'=>'List <?php echo $this->modelClass; ?>','url'=>array('index')),
	array('label'=>'Create <?php echo $this->modelClass; ?>','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('<?php echo $this->class2id($this->modelClass); ?>-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<div class="x_title">
    <h2><?php echo "<?php echo Yii::t('tx', 'Manage');echo \" \"; echo Yii::t('tx', '$label'); ?>"; ?></h2>
    <ul class="nav navbar-<?php echo "<?php echo Yii::app()->getLanguage()==\"ar\"?\"left\":\"right\"; ?>"; ?> panel_toolbox">
        <?php echo "<?php"; ?> if(Yii::app()->user->checkAccess('<?php echo $label1; ?>.create')): ?>
        <a href="<?php echo "<?php echo \$this->createUrl('create'); ?>"; ?>" class="btn lightslategrey mini"><i class="icon-plus"></i> <?php echo "<?php echo Yii::t('tx', 'Add');echo \" \"; echo Yii::t('tx', '$label3'); ?>"; ?></a>
        <?php echo "<?php"; ?> endif; ?>
    </ul>
    <div class="clearfix"></div>
</div>
<div class="x_content" style="display: block;">
    <div class="row">
        <div class="col-md-12">
            <p>
                <?php echo "<?php echo Yii::t('tx', 'You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b> or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.'); ?>\n"; ?>
            </p>

            <?php echo "<?php echo CHtml::link(Yii::t('tx','Advanced Search'),'#',array('class'=>'search-button btn lightslategrey')); ?>"; ?>

            <div class="search-form" style="display:none">
                <?php echo "<?php  \$this->renderPartial('_search',array(
	                            'model'=>\$model,
                            )); ?>\n"; ?>
            </div><!-- search-form -->

            <?php echo "<?php"; ?> $form=$this->beginWidget('CActiveForm', array(
                'enableAjaxValidation'=>true,
            )); ?>

            <?php echo "<?php"; ?> $this->widget('bootstrap.widgets.TbGridView',array(
                'id'=>'<?php echo $this->class2id($this->modelClass); ?>-grid',
                'type' => 'striped bordered condensed',
                'dataProvider'=>$model->search(),
                'filter'=>$model,
<?php if(InputTypes::checkColumnsDateExist($this->tableSchema)) echo "\t\t\t\t'afterAjaxUpdate' => 'reinstallDatePicker',\n"; ?>
                'columns'=>array(
                    array(
                        'id' => 'selectedIds',
                        'class' => 'CCheckBoxColumn',
                        'selectableRows' => '50',
                    ),
                    <?php
                    $count=0;
                    foreach($this->tableSchema->columns as $column)
                    {
                        //if(++$count==7)	echo "\t\t/*\n";
                        //echo "\t\t'".$column->name."',\n";
                        $this->echoAdminColumns($column);
                    }
                    //if($count>=7) echo "\t\t*/\n";
                    ?>
                    array(
                        'class'=>'CButtonColumn',
<?php if(InputTypes::checkGalleryExist($this->tableSchema)){?>
                        'template'=>'{delete} {update} {view} {gallery}',
                        'htmlOptions'=>array('style'=>'min-width: 300px;'),
<?php }else { ?>
                        'template'=>'{delete} {update} {view}',
                        'htmlOptions'=>array('style'=>'min-width:200px'),
<?php } ?>
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
                            'delete' => array('visible'=>'Yii::app()->user->checkAccess(\'<?php echo $label1; ?>.delete\')'),
                            'update' => array('visible'=>'Yii::app()->user->checkAccess(\'<?php echo $label1; ?>.update\')'),
                            'view' => array('visible'=>'Yii::app()->user->checkAccess(\'<?php echo $label1; ?>.view\')'),
<?php if(InputTypes::checkGalleryExist($this->tableSchema)){?>
                            'gallery' => array(
                                    'label' => '<i class="icon-picture"></i> '.Yii::t('tx', 'gallery'),
                                    'imageUrl'=>false,
                                    'url' => 'Yii::app()->createUrl("<?php echo $label1; ?>/view", array("id"=>$data->id, "#"=>"yw1"))',
                                    'options'=>array('class'=>'btn default yellow-stripe mini'),
                            ),
<?php } ?>
                        ),
                ),
                ),
            )); ?>
            <?php
            echo "<?php
            Yii::app()->clientScript->registerScript('re-install-date-picker', \"
            function reinstallDatePicker(id, data) {\n";
            foreach($this->tableSchema->columns as $column){
                if(InputTypes::checkColumnType($column)==InputTypes::dateTimeBox || InputTypes::checkColumnType($column)==InputTypes::dateBox)
                    echo "$('#datepicker_for_{$column->name}').datepicker({'dateFormat':'yy-mm-dd','changeMonth':'true','changeYear':'true','showButtonPanel':'true','constrainInput':'false','duration':'fast','showAnim':'slide'});\n";
            }
            echo "}
            \");
            ?>\n";
            ?>
            <script>
                function reloadGrid(data) {
                    $.fn.yiiGridView.update('<?php echo $this->class2id($this->modelClass); ?>-grid');
                }
            </script>
            <?php echo "<?php"; ?> if(Yii::app()->user->checkAccess('<?php echo $label1; ?>.ajaxupdate')): ?>
            <div class="actions">
                <?php echo "<?php echo CHtml::ajaxSubmitButton('Filter',array('ajaxupdate'), array(),array(\"style\"=>\"display:none;\")); ?>\n"; ?>
                <?php foreach($this->tableSchema->columns as $column){
                    if(InputTypes::checkColumnType($column)==InputTypes::boolean){
                        $tags=explode(',',$column->comment);
                        $t0=trim($this->class2id($tags[0]), " ");
                        $t1=trim($this->class2id($tags[1]), " ");
                        echo "<?php echo CHtml::ajaxSubmitButton(Yii::t('tx', '{$column->name}').': '.Yii::t('tx', '{$t0}'),array('ajaxupdate','act'=>'do{$t0}'), array('success'=>'reloadGrid'),array('class'=>'btn default green-stripe mini')); ?>&nbsp;\n";
                        echo "\t\t\t\t<?php echo CHtml::ajaxSubmitButton(Yii::t('tx', '{$column->name}').': '.Yii::t('tx', '{$t1}'),array('ajaxupdate','act'=>'doIn{$t1}'), array('success'=>'reloadGrid'),array('class'=>'btn default red-stripe mini')); ?>&nbsp;\n";
                    }
                } ?>
                <?php echo "<?php echo CHtml::ajaxSubmitButton(Yii::t('tx', 'Delete'),array('ajaxupdate','act'=>'doDelete'), array('beforeSend'=>'function() { if(confirm(\"'.Yii::t('tx', 'Are You Sure ...?').'\")) return true; return false; }','success'=>'reloadGrid'),array('class'=>'btn lightslategrey mini')); ?>\n"; ?>
            </div>
            <?php echo "<?php"; ?> endif; ?>
            <?php echo "<?php \$this->endWidget(); ?>\n"; ?>
        </div>
    </div>
</div>