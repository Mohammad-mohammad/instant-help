<?php if(Yii::app()->user->checkAccess('competencehasclient.create')||Yii::app()->user->checkAccess('competencehasclient.admin')||Yii::app()->user->checkAccess('competencehasclient.index')): ?>
<li <?php if ($this instanceof CompetenceHasClientController) echo 'class="active"'; ?>>
    <a><i class="fa fa-leaf"></i> <?php echo Yii::t('tx','Competence Has Clients');?> <span class="fa fa-chevron-down"></span></a>
    <ul class="nav child_menu" style="display: none">
        <?php if(Yii::app()->user->checkAccess('competencehasclient.create')): ?>
        <li  <?php if ($this instanceof CompetenceHasClientController && Yii::app()->controller->action->id == 'create') echo 'class="current-page"'; ?>>
         <?php echo CHtml::link(Yii::t('tx','Add')." ".Yii::t('tx','Competence Has Client'), Yii::app()->createUrl('competenceHasClient/create')); ?>
        </li>
        <?php endif; ?>
        <?php if(Yii::app()->user->checkAccess('competencehasclient.admin')): ?>
        <li  <?php if ($this instanceof CompetenceHasClientController && Yii::app()->controller->action->id == 'admin') echo 'class="current-page"'; ?>>
         <?php echo CHtml::link(Yii::t('tx','Manage')." ".Yii::t('tx','Competence Has Clients'), Yii::app()->createUrl('competenceHasClient/admin')); ?>
        </li>
        <?php endif; ?>
    </ul>
</li>
<?php endif; ?>