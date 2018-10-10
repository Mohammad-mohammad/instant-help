<?php
/**
 * The following variables are available in this template:
 * - $this: the BootCrudCode object
 */
?>
<?php
echo "<?php\n";
$label=$this->pluralize($this->class2name($this->modelClass));
$label1=strtolower($this->modelClass);
$label2=$this->modelClass;
echo "\$this->breadcrumbs=array(
	 Yii::t('tx', '$label')=>array('admin'),
	 Yii::t('tx', 'Add'),
);\n";
?>

?>

<div class="x_title">
    <h2><?php echo "<?php echo Yii::t('tx', 'Add');echo \" \"; echo Yii::t('tx', '$label2'); ?>"; ?></h2>
    <ul class="nav navbar-<?php echo "<?php echo Yii::app()->getLanguage()==\"ar\"?\"left\":\"right\"; ?>"; ?> panel_toolbox">
        <?php echo "<?php"; ?> if(Yii::app()->user->checkAccess('<?php echo $label1; ?>.admin')): ?>
        <a href="<?php echo "<?php echo \$this->createUrl('admin'); ?>"; ?>" class="btn purple mini"><i class="icon-table"></i> <?php echo "<?php echo Yii::t('tx', 'Manage');echo \" \"; echo Yii::t('tx', '$label'); ?>"; ?> </a>
        <?php echo "<?php"; ?> endif; ?>
    </ul>
    <div class="clearfix"></div>
</div>
<div class="x_content" style="display: block;">
    <div class="row">
        <div class="col-md-12">
            <?php echo "<?php echo \$this->renderPartial('_form', array('model'=>\$model)); ?>"; ?>
        </div>
    </div>
</div>
