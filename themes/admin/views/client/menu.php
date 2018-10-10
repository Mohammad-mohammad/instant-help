<?php if(Yii::app()->user->checkAccess('client.create')||Yii::app()->user->checkAccess('client.admin')||Yii::app()->user->checkAccess('client.index')): ?>
<li <?php if ($this instanceof ClientController) echo 'class="active"'; ?>>
    <a><i class="fa fa-leaf"></i> <?php echo Yii::t('tx','Clients');?> <span class="fa fa-chevron-down"></span></a>
    <ul class="nav child_menu" style="display: none">
        <?php if(Yii::app()->user->checkAccess('client.create')): ?>
        <li  <?php if ($this instanceof ClientController && Yii::app()->controller->action->id == 'create') echo 'class="current-page"'; ?>>
         <?php echo CHtml::link(Yii::t('tx','Add')." ".Yii::t('tx','Client'), Yii::app()->createUrl('client/create')); ?>
        </li>
        <?php endif; ?>
        <?php if(Yii::app()->user->checkAccess('client.admin')): ?>
        <li  <?php if ($this instanceof ClientController && Yii::app()->controller->action->id == 'admin') echo 'class="current-page"'; ?>>
         <?php echo CHtml::link(Yii::t('tx','Manage')." ".Yii::t('tx','Clients'), Yii::app()->createUrl('client/admin')); ?>
        </li>
        <?php endif; ?>
    </ul>
</li>
<?php endif; ?>