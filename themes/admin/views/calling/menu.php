<?php if(Yii::app()->user->checkAccess('calling.create')||Yii::app()->user->checkAccess('calling.admin')||Yii::app()->user->checkAccess('calling.index')): ?>
<li <?php if ($this instanceof CallingController) echo 'class="active"'; ?>>
    <a><i class="fa fa-leaf"></i> <?php echo Yii::t('tx','Callings');?> <span class="fa fa-chevron-down"></span></a>
    <ul class="nav child_menu" style="display: none">
        <?php if(Yii::app()->user->checkAccess('calling.create')): ?>
        <li  <?php if ($this instanceof CallingController && Yii::app()->controller->action->id == 'create') echo 'class="current-page"'; ?>>
         <?php echo CHtml::link(Yii::t('tx','Add')." ".Yii::t('tx','Calling'), Yii::app()->createUrl('calling/create')); ?>
        </li>
        <?php endif; ?>
        <?php if(Yii::app()->user->checkAccess('calling.admin')): ?>
        <li  <?php if ($this instanceof CallingController && Yii::app()->controller->action->id == 'admin') echo 'class="current-page"'; ?>>
         <?php echo CHtml::link(Yii::t('tx','Manage')." ".Yii::t('tx','Callings'), Yii::app()->createUrl('calling/admin')); ?>
        </li>
        <?php endif; ?>
    </ul>
</li>
<?php endif; ?>