<?php
$this->breadcrumbs=array(
	Yii::t('tx', 'Competence Has Clients')=>array('admin'),
	$model->id=>array('view','id'=>$model->id),
	Yii::t('tx', 'Update'),
);
?>

<div class="x_title">
    <h2><?php echo Yii::t('tx', 'Update'); ?> <?php echo Yii::t('tx', 'CompetenceHasClient'); ?> #<?php echo $model->id; ?></h2>
    <ul class="nav navbar-<?php echo Yii::app()->getLanguage()=="ar"?"left":"right"; ?> panel_toolbox">
        <?php if(Yii::app()->user->checkAccess('competencehasclient.admin')): ?>
        <a href="<?php echo $this->createUrl('admin'); ?>" class="btn purple mini"><i class="icon-table"></i> <?php echo Yii::t('tx', 'Manage');echo " "; echo Yii::t('tx', 'Competence Has Clients'); ?></a>
        <?php endif; ?>
        <?php if(Yii::app()->user->checkAccess('competencehasclient.create')): ?>
        <a href="<?php echo $this->createUrl('create'); ?>" class="btn lightslategrey mini"><i class="icon-plus"></i> <?php echo Yii::t('tx', 'Add');echo " "; echo Yii::t('tx', 'Competence Has Client'); ?></a>
        <?php endif; ?>
        <?php if(Yii::app()->user->checkAccess('competencehasclient.view')): ?>
        <a href="<?php echo $this->createUrl('view',array('id'=>$model->id)); ?>" class="btn green mini"><i class="icon-eye-open"></i> <?php echo Yii::t('tx', 'View this'); ?></a>
        <?php endif; ?>
    </ul>
    <div class="clearfix"></div>
</div>
<div class="x_content" style="display: block;">
    <div class="row">
        <div class="col-md-12">
            <?php echo $this->renderPartial('_form',array('model'=>$model)); ?>        </div>
    </div>
</div>