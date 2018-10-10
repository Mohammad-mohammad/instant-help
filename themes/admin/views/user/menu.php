<?php if(Yii::app()->user->checkAccess('user.create')||Yii::app()->user->checkAccess('user.admin')||Yii::app()->user->checkAccess('user.index')): ?>
   <li <?php if ($this instanceof UserController) echo 'class="active"'; ?>>
      <a><i class="fa fa-user"></i> <?php echo Yii::t('tx','Users');?> <span class="fa fa-chevron-down"></span></a>

    <ul class="nav child_menu" style="display: none">
    <?php if(Yii::app()->user->checkAccess('user.create')): ?>
    <li  <?php if ($this instanceof UserController && Yii::app()->controller->action->id == 'create') echo 'class="active"'; ?>>
         <?php echo CHtml::link(Yii::t('tx','Add')." ".Yii::t('tx','User'), Yii::app()->createUrl('user/create')); ?>
    </li>
    <?php endif; ?>
    <?php if(Yii::app()->user->checkAccess('user.admin')): ?>
    <li  <?php if ($this instanceof UserController && Yii::app()->controller->action->id == 'admin') echo 'class="active"'; ?>>
         <?php echo CHtml::link(Yii::t('tx','Manage')." ".Yii::t('tx','Users'), Yii::app()->createUrl('user/admin')); ?>
    </li>
    <?php endif; ?>
    </ul>
</li>
<?php endif; ?>