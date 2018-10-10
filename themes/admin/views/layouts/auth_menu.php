<?php if(Yii::app()->user->checkAccess('auth')): ?>
<li <?php if ($this instanceof AuthController) echo 'class="active"'; ?>>
    <li <?php if ($this instanceof AuthController) echo 'class="active"'; ?>>
        <a><i class="fa fa-lock"></i> <?php echo Yii::t('tx','System Role');?> <span class="fa fa-chevron-down"></span></a>

        <ul class="nav child_menu" style="display: none">
        <?php if(Yii::app()->user->checkAccess('auth.assignment.index')): ?>
        <li  <?php if ($this instanceof AssignmentController && Yii::app()->controller->action->id == 'index') echo 'class="active"'; ?>>
            <?php echo CHtml::link(Yii::t('AuthModule.main','Assignments'), Yii::app()->createUrl('auth/assignment/index')); ?>
        </li>
        <?php endif; ?>
        <?php if(Yii::app()->user->checkAccess('auth.rol.index')): ?>
        <li  <?php if ($this instanceof RoleController && Yii::app()->controller->action->id == 'index') echo 'class="active"'; ?>>
            <?php echo CHtml::link(Yii::t('AuthModule.main','roles'), Yii::app()->createUrl('auth/role/index')); ?>
        </li>
        <?php endif; ?>
        <?php if(Yii::app()->user->checkAccess('auth.task.index')): ?>
        <li  <?php if ($this instanceof TaskController && Yii::app()->controller->action->id == 'index') echo 'class="active"'; ?>>
            <?php echo CHtml::link(Yii::t('AuthModule.main','tasks'), Yii::app()->createUrl('auth/task/index')); ?>
        </li>
        <?php endif; ?>
        <?php if(Yii::app()->user->checkAccess('auth.operation.index')): ?>
        <li  <?php if ($this instanceof OperationController && Yii::app()->controller->action->id == 'index') echo 'class="active"'; ?>>
            <?php echo CHtml::link(Yii::t('AuthModule.main','operations'), Yii::app()->createUrl('auth/operation/index')); ?>
        </li>
        <?php endif; ?>
    </ul>
</li>
<?php endif; ?>