<?php
/**
 * The following variables are available in this template:
 * - $this: the BootCrudCode object
 */
?>
<?php
$label1=strtolower($this->modelClass);
$label2=$this->modelClass;
echo "<?php\n";
$nameColumn=$this->guessNameColumn($this->tableSchema->columns);
$label=$this->pluralize($this->class2name($this->modelClass));
echo "\$this->breadcrumbs=array(
	Yii::t('tx', '$label')=>array('admin'),
	\$model->{$nameColumn},
);\n";
?>
?>

<div class="x_title">
    <h2><?php echo "<?php echo Yii::t('tx', 'View'); ?> <?php echo Yii::t('tx', '$label2'); ?> #<?php echo \$model->{$this->tableSchema->primaryKey}; ?>"; ?></h2>
    <ul class="nav navbar-<?php echo "<?php echo Yii::app()->getLanguage()==\"ar\"?\"left\":\"right\"; ?>"; ?> panel_toolbox">
        <?php echo "<?php"; ?> if(Yii::app()->user->checkAccess('<?php echo $label1; ?>.admin')): ?>
        <a href="<?php echo "<?php echo \$this->createUrl('admin'); ?>"; ?>" class="btn purple mini"><i class="icon-table"></i> <?php echo "<?php echo Yii::t('tx', 'Manage');echo \" \"; echo Yii::t('tx', '$label'); ?>"; ?></a>
        <?php echo "<?php"; ?> endif; ?>
        <?php echo "<?php"; ?> if(Yii::app()->user->checkAccess('<?php echo $label1; ?>.create')): ?>
        <a href="<?php echo "<?php echo \$this->createUrl('create'); ?>"; ?>" class="btn lightslategrey mini"><i class="icon-plus"></i> <?php echo "<?php echo Yii::t('tx', 'Add');echo \" \"; echo Yii::t('tx', '$label2'); ?>"; ?></a>
        <?php echo "<?php"; ?> endif; ?>
        <?php echo "<?php"; ?> if(Yii::app()->user->checkAccess('<?php echo $label1; ?>.update')): ?>
        <a href="<?php echo "<?php echo \$this->createUrl('update', array('id' => \$model->id)); ?>"; ?>" class="btn blue mini"><i class="icon-pencil"></i> <?php echo "<?php echo Yii::t('tx', 'Update this'); ?>"; ?></a>
        <?php echo "<?php"; ?> endif; ?>
        <?php echo "<?php"; ?> if(Yii::app()->user->checkAccess('<?php echo $label1; ?>.delete')): ?>
        <?php echo "<?php echo"; ?> CHtml::link('<i class="icon-trash"></i> '.Yii::t('tx','delete this'), '#', array('submit' => array('delete', 'id' => $model->id), 'confirm' => Yii::t('tx','Are You Sure ...?'), 'class' => 'btn red mini')); ?>
        <?php echo "<?php"; ?> endif; ?>
    </ul>
    <div class="clearfix"></div>
</div>
<div class="x_content" style="display: block;">
    <div class="row">
        <div class="col-md-12">
            <?php echo "<?php"; ?> $this->widget('bootstrap.widgets.TbDetailView',array(
            'data'=>$model,
            'type' => 'striped bordered condensed',
            'attributes'=>array(
            <?php
            foreach($this->tableSchema->columns as $column)
                //echo "\t\t'".$column->name."',\n";
                $this->echoViewColumns($column);
            ?>
            ),
            )); ?>
            <?php
            if(InputTypes::checkGalleryExist($this->tableSchema)){
                echo "<h2><?php echo Yii::t('tx', 'The Gallery'); ?></h2>
            <?php if(\$model->galleryBehavior->getGallery() === null) {
                echo '<p>' . Yii::t('tx', 'You must save the item before add photos') . '</p>';
                } else {
                    \$this->widget('GalleryManager', array(
                        'gallery' => \$model->galleryBehavior->getGallery(),
                        'controllerRoute' => 'gallery'
                    ));
                }
            ?>\n";
            }
            ?>
        </div>
    </div>
</div>