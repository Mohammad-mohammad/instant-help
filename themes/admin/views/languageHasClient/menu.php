<?php if(Yii::app()->user->checkAccess('languagehasclient.create')||Yii::app()->user->checkAccess('languagehasclient.admin')||Yii::app()->user->checkAccess('languagehasclient.index')): ?>
<li <?php if ($this instanceof LanguageHasClientController) echo 'class="active"'; ?>>
    <a><i class="fa fa-leaf"></i> <?php echo Yii::t('tx','Language Has Clients');?> <span class="fa fa-chevron-down"></span></a>
    <ul class="nav child_menu" style="display: none">
        <?php if(Yii::app()->user->checkAccess('languagehasclient.create')): ?>
        <li  <?php if ($this instanceof LanguageHasClientController && Yii::app()->controller->action->id == 'create') echo 'class="current-page"'; ?>>
         <?php echo CHtml::link(Yii::t('tx','Add')." ".Yii::t('tx','Language Has Client'), Yii::app()->createUrl('languageHasClient/create')); ?>
        </li>
        <?php endif; ?>
        <?php if(Yii::app()->user->checkAccess('languagehasclient.admin')): ?>
        <li  <?php if ($this instanceof LanguageHasClientController && Yii::app()->controller->action->id == 'admin') echo 'class="current-page"'; ?>>
         <?php echo CHtml::link(Yii::t('tx','Manage')." ".Yii::t('tx','Language Has Clients'), Yii::app()->createUrl('languageHasClient/admin')); ?>
        </li>
        <?php endif; ?>
    </ul>
</li>
<?php endif; ?>