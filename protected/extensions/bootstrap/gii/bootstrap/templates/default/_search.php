<?php
/**
 * The following variables are available in this template:
 * - $this: the BootCrudCode object
 */
?>
<?php echo "<?php \$form=\$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl(\$this->route),
	'method'=>'get',
	'htmlOptions' => array('class' => 'well'),
)); ?>\n"; ?>

    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
<?php
$i=1;
$c=count($this->tableSchema->columns);
foreach($this->tableSchema->columns as $column): ?>
    <?php
    //$field=$this->generateInputField($this->modelClass,$column);
    //if(strpos($field,'password')!==false)
        //continue;
    if(InputTypes::checkColumnType($column)== InputTypes::password ||
        InputTypes::checkColumnType($column)== InputTypes::gallery ||
        InputTypes::checkColumnType($column)== InputTypes::slugColumn ||
        InputTypes::checkColumnType($column)== InputTypes::image ||
        InputTypes::checkColumnType($column)== InputTypes::imageAjax ||
        InputTypes::checkColumnType($column)== InputTypes::file ||
        InputTypes::checkColumnType($column)== InputTypes::fileAjax){
        continue;
    }
    ?>
    <?php $this->echoSearchForm($column);
    if($i%4==0 && $i!=$c)
        echo '
    </div>
    <div class="col-md-12 col-sm-12 col-xs-12 form-group">';
    $i++; ?>

<?php endforeach; ?>

    </div>

    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
    <?php echo "<?php \$this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>Yii::t('tx', 'Search'),
		)); ?>\n"; ?>
    </div>

<?php echo "<?php \$this->endWidget(); ?>\n"; ?>
