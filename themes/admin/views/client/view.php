<?php
$this->breadcrumbs=array(
	Yii::t('tx', 'Clients')=>array('admin'),
	$model->id,
);
?>

<div class="x_title">
    <h2><?php echo Yii::t('tx', 'View'); ?> <?php echo Yii::t('tx', 'Client'); ?> #<?php echo $model->id; ?></h2>
    <ul class="nav navbar-<?php echo Yii::app()->getLanguage()=="ar"?"left":"right"; ?> panel_toolbox">
        <?php if(Yii::app()->user->checkAccess('client.admin')): ?>
        <a href="<?php echo $this->createUrl('admin'); ?>" class="btn purple mini"><i class="icon-table"></i> <?php echo Yii::t('tx', 'Manage');echo " "; echo Yii::t('tx', 'Clients'); ?></a>
        <?php endif; ?>
        <?php if(Yii::app()->user->checkAccess('client.create')): ?>
        <a href="<?php echo $this->createUrl('create'); ?>" class="btn lightslategrey mini"><i class="icon-plus"></i> <?php echo Yii::t('tx', 'Add');echo " "; echo Yii::t('tx', 'Client'); ?></a>
        <?php endif; ?>
        <?php if(Yii::app()->user->checkAccess('client.update')): ?>
        <a href="<?php echo $this->createUrl('update', array('id' => $model->id)); ?>" class="btn blue mini"><i class="icon-pencil"></i> <?php echo Yii::t('tx', 'Update this'); ?></a>
        <?php endif; ?>
        <?php if(Yii::app()->user->checkAccess('client.delete')): ?>
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
				'guid',
				'fname',
				'lname',
				'email',
				'password',
				array(
                    'name' => 'photo',
                    'type' => 'image',
                    'value' => $model->_photo,
                ),
				'country',
				'city',
				'address',
					array(
                        'name'=>'clientStatus',
                        'value'=> Helpers::clientstatus($model->clientStatus),
                        'type'=>'raw',
                    ),
	'level',
				array(
                    'name' => 'available',
                    'value' => Helpers::booleanAsIcon($model, "available"),
                    'type' => 'raw',
                ),
					array(
                        'name'=>'clientType',
                        'value'=> Helpers::clienttype($model->clientType),
                        'type'=>'raw',
                    ),
				'bankaccount',
            ),
            )); ?>
                    </div>
    </div>
</div>