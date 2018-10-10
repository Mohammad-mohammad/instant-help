<?php
$this->breadcrumbs=array(
	Yii::t('tx', 'Balances')=>array('admin'),
	$model->id,
);
?>

<div class="x_title">
    <h2><?php echo Yii::t('tx', 'View'); ?> <?php echo Yii::t('tx', 'Balance'); ?> #<?php echo $model->id; ?></h2>
    <ul class="nav navbar-<?php echo Yii::app()->getLanguage()=="ar"?"left":"right"; ?> panel_toolbox">
        <?php if(Yii::app()->user->checkAccess('balance.admin')): ?>
        <a href="<?php echo $this->createUrl('admin'); ?>" class="btn purple mini"><i class="icon-table"></i> <?php echo Yii::t('tx', 'Manage');echo " "; echo Yii::t('tx', 'Balances'); ?></a>
        <?php endif; ?>
        <?php if(Yii::app()->user->checkAccess('balance.create')): ?>
        <a href="<?php echo $this->createUrl('create'); ?>" class="btn lightslategrey mini"><i class="icon-plus"></i> <?php echo Yii::t('tx', 'Add');echo " "; echo Yii::t('tx', 'Balance'); ?></a>
        <?php endif; ?>
        <?php if(Yii::app()->user->checkAccess('balance.update')): ?>
        <a href="<?php echo $this->createUrl('update', array('id' => $model->id)); ?>" class="btn blue mini"><i class="icon-pencil"></i> <?php echo Yii::t('tx', 'Update this'); ?></a>
        <?php endif; ?>
        <?php if(Yii::app()->user->checkAccess('balance.delete')): ?>
        <?php echo CHtml::link('<i class="icon-trash"></i> '.Yii::t('tx','delete this'), '#', array('submit' => array('delete', 'id' => $model->id), 'confirm' => Yii::t('tx','Are You Sure ...?'), 'class' => 'btn red mini')); ?>
        <?php endif; ?>
    </ul>
    <div class="clearfix"></div>
</div>
<div class="x_content" style="display: block;">
    <div class="row">
        <div class="col-md-12">
            <?php $this->widget('bootstrap.widgets.TbDetailView',array(
            'data'=>$model,
            'type' => 'striped bordered condensed',
            'attributes'=>array(
            	'id',
	'amount',
				'depositedate',
				array(
                    'name' => 'client_id',
                    'value' => $model->client->email,
                    'type' => 'raw',
                ),
            ),
            )); ?>
                    </div>
    </div>
</div>