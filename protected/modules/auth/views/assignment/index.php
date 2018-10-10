<?php
/* @var $this AssignmentController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    Yii::t('AuthModule.main', 'Assignments'),
);
?>


<div class="x_title">
    <h2><?php echo Yii::t('AuthModule.main', 'Assignments'); ?></h2>
    <ul class="nav navbar-<?php echo Yii::app()->getLanguage()=="en"?"right":"left"; ?> panel_toolbox">

    </ul>
    <div class="clearfix"></div>
</div>
<div class="x_content" style="display: block;">
    <div class="row">
        <div class="col-md-12">
            <ul class="list-unstyled timeline">
                <?php $this->widget('bootstrap.widgets.TbGridView', array(
                    'type' => 'striped bordered condensed',
                    'dataProvider' => $dataProvider,
                    'emptyText' => Yii::t('AuthModule.main', 'No assignments found.'),
                    'template'=>"{items}\n{pager}",
                    'columns' => array(
                        array(
                            'header' => Yii::t('AuthModule.main', 'User'),
                            'class' => 'AuthAssignmentNameColumn',
                        ),
                        array(
                            'header' => Yii::t('AuthModule.main', 'Assigned items'),
                            'class' => 'AuthAssignmentItemsColumn',
                        ),
                        array(
                            'class' => 'AuthAssignmentViewColumn',
                        ),
                    ),
                )); ?>
            </ul>
        </div>
    </div>
</div>