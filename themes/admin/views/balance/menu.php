<?php if(Yii::app()->user->checkAccess('balance.create')||Yii::app()->user->checkAccess('balance.admin')||Yii::app()->user->checkAccess('balance.index')): ?>
<li <?php if ($this instanceof BalanceController) echo 'class="active"'; ?>>
    <a><i class="fa fa-leaf"></i> <?php echo Yii::t('tx','Balances');?> <span class="fa fa-chevron-down"></span></a>
    <ul class="nav child_menu" style="display: none">
        <?php if(Yii::app()->user->checkAccess('balance.create')): ?>
        <li  <?php if ($this instanceof BalanceController && Yii::app()->controller->action->id == 'create') echo 'class="current-page"'; ?>>
         <?php echo CHtml::link(Yii::t('tx','Add')." ".Yii::t('tx','Balance'), Yii::app()->createUrl('balance/create')); ?>
        </li>
        <?php endif; ?>
        <?php if(Yii::app()->user->checkAccess('balance.admin')): ?>
        <li  <?php if ($this instanceof BalanceController && Yii::app()->controller->action->id == 'admin') echo 'class="current-page"'; ?>>
         <?php echo CHtml::link(Yii::t('tx','Manage')." ".Yii::t('tx','Balances'), Yii::app()->createUrl('balance/admin')); ?>
        </li>
        <?php endif; ?>
    </ul>
</li>
<?php endif; ?>