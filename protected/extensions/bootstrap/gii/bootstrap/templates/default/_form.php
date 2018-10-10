<?php
/**
 * The following variables are available in this template:
 * - $this: the BootCrudCode object
 */
?>
<?php
echo "<?php
\$btn_txt= \$model->isNewRecord ? '<i class=\"icon-plus\"></i> '.Yii::t('tx','Adding...') : '<i class=\"icon-ok\"></i> '.Yii::t('tx','Saving...');
\$tt= \"\$('#".$this->class2id($this->modelClass)."-btn').click(function() { var btn = \$(this); btn.html('\".\$btn_txt.\"'); });\" ;
Yii::app()->clientScript->registerScript('loading',\$tt,  CClientScript::POS_END);
?>";
?>
<?php echo "<?php \$form=\$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'".$this->class2id($this->modelClass)."-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array('enctype' => 'multipart/form-data', 'class' => 'form-horizontal form-label-left'),
)); ?>\n"; ?>
	<div class="alert alert-note">
        <ul class="fa-ul">
            <li>
                <i class="fa fa-info-circle fa-lg fa-li"></i> <?php echo "<?php echo Yii::t('tx', 'Fields with'); ?> "; ?> <code> *</code> <?php echo "<?php echo Yii::t('tx','are required.'); ?>"; ?>
            </li>
        </ul>
    </div>

	<?php echo "<?php echo \$form->errorSummary(\$model); ?>\n"; ?>

<?php
foreach($this->tableSchema->columns as $column)
{
	if($column->autoIncrement ||
        InputTypes::checkColumnType($column)== InputTypes::slugColumn ||
        InputTypes::checkColumnType($column)== InputTypes::gallery)
		continue;
    $this->generateFieldRow($column);
}
?>
    <div class="ln_solid"></div>

    <div class="form-group">
        <div class="col-md-10 col-sm-10 col-xs-12 col-md-offset-2">
            <a href="<?php echo "<?php echo \$this->createUrl('admin'); ?>"; ?>" class="btn btn-primary"><i class="fa fa-rotate-left"></i> <?php echo "<?php echo Yii::t('tx','Cancel'); ?>"; ?></a>
            <?php echo "<?php \$this->widget('bootstrap.widgets.TbButton', array(
			    'buttonType'=>'submit',
			    'encodeLabel' => false,
			    'label' => \$model->isNewRecord ? '<i class=\"icon-plus\"></i> ' . Yii::t('tx','Add') : '<i class=\"icon-ok\"></i> ' . Yii::t('tx','Save'),
                'htmlOptions' => array('id' => '".$this->class2id($this->modelClass)."-btn', 'class' => 'lightslategrey')
		    )); ?>\n"; ?>
        </div>
    </div>

<?php echo "<?php \$this->endWidget(); ?>\n"; ?>

<?php
foreach($this->tableSchema->columns as $column)
{
    if(InputTypes::checkColumnType($column)== InputTypes::manyToManyR ){
        $table_field=substr($column->comment, strpos($column->comment, ":") + 1);
        $tags=explode(',',$table_field);
        $model_name=ucfirst($tags[0]);
        echo "<?php if(!\$model->isNewRecord){?>
        <script>
            <?php
            \$data=explode(' , ',\$model->{$column->name});
            \$i=1; \$temp=\"\";
            foreach(\$data as \$value) {
                if(\$i==1){
                    \$temp='\"'.trim(\$value).'\"';
                } else {
                   \$temp=\$temp.',\"'.trim(\$value).'\"';
                }
                \$i++;
            }
            ?>
            \$(document).ready(function(){
                \$(\"#{$column->name}\").val([<?php echo \$temp;?>]).select2();
            });
        </script>
    <?php } ?>";
    }
} ?>