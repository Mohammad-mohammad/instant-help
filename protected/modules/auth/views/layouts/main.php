<?php /* @var $this AuthController */ ?>

<?php
$dir=Yii::app()->getLanguage()=="ar"?"right":"left";
$this->beginContent($this->module->appLayout); ?>

<div class="auth-module">

	<?php $this->widget('bootstrap.widgets.TbMenu', array(
		'type' => 'tabs',
		'items' => array(
			array(
				'label' => Yii::t('AuthModule.main', 'Assignments'),
				'url' => array('/auth/assignment/index'),
				'active' => $this instanceof AssignmentController,
			),
			array(
				'label' => $this->capitalize($this->getItemTypeText(CAuthItem::TYPE_ROLE, true)),
				'url' => array('/auth/role/index'),
				'active' => $this instanceof RoleController,
			),
			array(
				'label' => $this->capitalize($this->getItemTypeText(CAuthItem::TYPE_TASK, true)),
				'url' => array('/auth/task/index'),
				'active' => $this instanceof TaskController,
			),
			array(
				'label' => $this->capitalize($this->getItemTypeText(CAuthItem::TYPE_OPERATION, true)),
				'url' => array('/auth/operation/index'),
				'active' => $this instanceof OperationController,
			),
		),
        'htmlOptions'=>array('class'=>"nav nav-tabs bar_tabs $dir"),
	));?>

	<?php echo $content; ?>

</div>

<?php $this->endContent(); ?>