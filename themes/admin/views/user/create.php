<?php
$this->breadcrumbs=array(
	Yii::t('tx', 'Users')=>array('index'),
	Yii::t('tx', 'Add'),
);
?>
<div class="x_title">
    <h2><?php echo Yii::t('tx', 'Add');echo " "; echo Yii::t('tx', 'User'); ?></h2>
    <ul class="nav navbar-<?php echo Yii::app()->getLanguage()=="ar"?"left":"right"; ?> panel_toolbox">
        <?php if(Yii::app()->user->checkAccess('user.admin')): ?>
            <a href="<?php echo $this->createUrl('admin'); ?>" class="btn purple mini"><i class="icon-table"></i> <?php echo Yii::t('tx', 'Manage');echo " "; echo Yii::t('tx', 'Users'); ?> </a>
        <?php endif; ?>
    </ul>
    <div class="clearfix"></div>
</div>
<div class="x_content" style="display: block;">
    <div class="row">
        <div class="col-md-12">
            <?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
        </div>
    </div>
</div>
