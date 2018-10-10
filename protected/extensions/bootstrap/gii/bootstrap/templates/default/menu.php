<?php
$modelName=$this->pluralize($this->class2name($this->modelClass));
$label1=$this->class2name($this->modelClass);
$label=$this->controllerClass;
$label2=strtolower($this->modelClass);
?>
<?php echo "<?php"; ?> if(Yii::app()->user->checkAccess('<?php echo $label2; ?>.create')||Yii::app()->user->checkAccess('<?php echo $label2; ?>.admin')||Yii::app()->user->checkAccess('<?php echo $label2; ?>.index')): ?>
<li <?php echo "<?php if (\$this instanceof $label) echo 'class=\"active\"'; ?>"; ?>>
    <a><i class="fa fa-leaf"></i> <?php echo "<?php echo Yii::t('tx','$modelName');?>"; ?> <span class="fa fa-chevron-down"></span></a>
    <ul class="nav child_menu" style="display: none">
        <?php echo "<?php"; ?> if(Yii::app()->user->checkAccess('<?php echo $label2; ?>.create')): ?>
        <li <?php echo " <?php"; ?> if ($this instanceof <?php echo $label; ?> && Yii::app()->controller->action->id == 'create') echo 'class="current-page"'; ?>>
        <?php echo " <?php"; ?> echo CHtml::link(Yii::t('tx','Add')." ".Yii::t('tx','<?php echo $label1; ?>'), Yii::app()->createUrl('<?php echo $this->controller; ?>/create')); ?>
        </li>
        <?php echo "<?php"; ?> endif; ?>
        <?php echo "<?php"; ?> if(Yii::app()->user->checkAccess('<?php echo $label2; ?>.admin')): ?>
        <li <?php echo " <?php"; ?> if ($this instanceof <?php echo $label; ?> && Yii::app()->controller->action->id == 'admin') echo 'class="current-page"'; ?>>
        <?php echo " <?php"; ?> echo CHtml::link(Yii::t('tx','Manage')." ".Yii::t('tx','<?php echo $modelName; ?>'), Yii::app()->createUrl('<?php echo $this->controller; ?>/admin')); ?>
        </li>
        <?php echo "<?php"; ?> endif; ?>
    </ul>
</li>
<?php echo "<?php"; ?> endif; ?>