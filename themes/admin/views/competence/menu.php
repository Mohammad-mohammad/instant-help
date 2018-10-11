<?php if(Yii::app()->user->checkAccess('competence.create')||Yii::app()->user->checkAccess('competence.admin')||Yii::app()->user->checkAccess('competence.index')): ?>
<li <?php if ($this instanceof CompetenceController) echo 'class="active"'; ?>>
    <a><i class="fa fa-leaf"></i> <?php echo Yii::t('tx','Competences');?> <span class="fa fa-chevron-down"></span></a>
    <ul class="nav child_menu" style="display: none">
        <?php if(Yii::app()->user->checkAccess('competence.create')): ?>
        <li  <?php if ($this instanceof CompetenceController && Yii::app()->controller->action->id == 'create') echo 'class="current-page"'; ?>>
         <?php echo CHtml::link(Yii::t('tx','Add')." ".Yii::t('tx','Competence'), Yii::app()->createUrl('competence/create')); ?>
        </li>
        <?php endif; ?>
        <?php if(Yii::app()->user->checkAccess('competence.admin')): ?>
        <li  <?php if ($this instanceof CompetenceController && Yii::app()->controller->action->id == 'admin') echo 'class="current-page"'; ?>>
         <?php echo CHtml::link(Yii::t('tx','Manage')." ".Yii::t('tx','Competences'), Yii::app()->createUrl('competence/admin')); ?>
        </li>
        <?php endif; ?>
    </ul>
</li>
<?php endif; ?>