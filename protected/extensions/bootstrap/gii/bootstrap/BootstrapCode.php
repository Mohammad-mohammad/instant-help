<?php
/**
 * BootstrapCode class file.
 * @author Christoffer Niska <ChristofferNiska@gmail.com>
 * @copyright Copyright &copy; Christoffer Niska 2011-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */

Yii::import('gii.generators.crud.CrudCode');
Yii::import('bootstrap.gii.InputTypes');
Yii::import('bootstrap.gii.MXmodel.MXModelCode');

class BootstrapCode extends CrudCode
{
    public function successMessage(){
        $data="<?php \$this->renderPartial(\"webroot.themes.admin.views.$this->controller.menu\"); ?>";
        $file_path=Yii::getpathOfAlias('webroot')."/themes/admin/views/layouts/menu.php";
        $contentF=file_get_contents($file_path);
        if(strpos($contentF,$data)===false)
            file_put_contents($file_path,$data."\n\n",FILE_APPEND);

        Yii::import('application.modules.auth.models.AuthItemForm');
        $actions=array('create','update','view','admin','delete','ajaxupdate');
        $roleName=$this->controller;
        foreach ($actions as $op) {
            $model = new AuthItemForm('create');
            $model->name=$this->controller.".".$op;
            $model->description=Yii::t('tx',$roleName.' '.$op);
            $model->type=CAuthItem::TYPE_OPERATION;
            $am = Yii::app()->getAuthManager();
            if (($item = $am->getAuthItem($model->name)) === null){
                $item = $am->createAuthItem($model->name, $model->type, $model->description);
                if ($am instanceof CPhpAuthManager) $am->save();
            }
        }
        $model = new AuthItemForm('create');
        $model->name=$this->controller;
        $model->description=Yii::t('tx', $roleName.' Control');
        $model->type=CAuthItem::TYPE_TASK;
        $am = Yii::app()->getAuthManager();
        if (($item = $am->getAuthItem($model->name)) === null){
            $item = $am->createAuthItem($model->name, $model->type, $model->description);
            if ($am instanceof CPhpAuthManager) $am->save();
        }

        Yii::import('application.modules.auth.models.AddAuthItemForm');
        foreach ($actions as $op){
            $formModel = new AddAuthItemForm();
            $formModel->items=$roleName.".".$op;
            $am = Yii::app()->getAuthManager();
            if (!$am->hasItemChild($roleName, $formModel->items)){
               $am->addItemChild($roleName, $formModel->items);
               if ($am instanceof CPhpAuthManager) $am->save();
            }
        }

        echo parent::successMessage();
    }

    public function getRelationModelName($col_name,$ModelName){
        $m= new $ModelName;
        $r=$m->relations();
        foreach($r as $name=>$relation){
            if($relation[2]==$col_name) return $relation[1];
        }
    }

    public function generateActiveRow($modelClass, $column)
	{
		if ($column->type === 'boolean')
			return "\$form->checkBoxRow(\$model,'{$column->name}')";
		else if (stripos($column->dbType,'text') !== false)
			return "\$form->textAreaRow(\$model,'{$column->name}',array('rows'=>6, 'cols'=>50, 'class'=>'span8'))";
		else
		{
			if (preg_match('/^(password|pass|passwd|passcode)$/i',$column->name))
				$inputField='passwordFieldRow';
			else
				$inputField='textFieldRow';

			if ($column->type!=='string' || $column->size===null)
				return "\$form->{$inputField}(\$model,'{$column->name}',array('class'=>'span5'))";
			else
				return "\$form->{$inputField}(\$model,'{$column->name}',array('class'=>'span5','maxlength'=>$column->size))";
		}
	}

    public function generateFieldRow($column)
    {
        $comment = mb_strtolower($column->comment);
        if (preg_match('/^(password|pass|passwd|passcode)$/i',$column->name))
            $inputField='passwordField';
        else
            $inputField='textField';

        echo "\t<div class=\"form-group\">
        <?php echo \$form->labelEx(\$model, '{$column->name}',array('class'=>'control-label col-md-2 col-sm-2 col-xs-12')); ?>
        <div class=\"col-md-10 col-sm-10 col-xs-12\">\n";

        if(InputTypes::checkColumnType($column)== InputTypes::boolean){
            $tags=explode(',',$comment);
            $tags[0]=trim($tags[0]);
            $tags[1]=trim($tags[1]);
            echo "\t\t\t<div class='radio'>\n";
            echo "<?php echo \$form->radioButtonList(\$model,'{$column->name}',
                array(1=>Yii::t('tx','".$tags[0]."'), 0=>Yii::t('tx','".$tags[1]."')) ,
                array('class'=>'flat', 'separator'=>\"</div><div class='radio'>\")
                    );
                ?>";
            echo "</div>\n";
        }
        elseif(InputTypes::checkColumnType($column)== InputTypes::image) {
            echo "\t\t\t<?php if(!\$model->isNewRecord && \$model->{$column->name}){ ?>
                <div class=\"controls\">
                    <div class=\"fileupload fileupload-new\" data-provides=\"fileupload\">
                        <div class=\"fileupload-new thumbnail\" style=\"width: <?php echo Yii::app()->params['thumb_w'] ;?>px;height: <?php echo Yii::app()->params['thumb_h'] ;?>px;\">
                            <!--<img src=\"http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image\" alt=\"\" />-->
                            <img src=\"<?php echo \$model->_{$column->name}; ?>\"  alt=\"\"/>
                        </div>
                    </div>
                    <?php if(!\$model->isAttributeRequired('{$column->name}')) { ?>
                    <div>
                        <span><?php echo '&nbsp;<input type=\"checkbox\" name=\"{$column->name}_delete\" id=\"{$column->name}_delete\" value=\"{$column->name}_delete\"/>'; ?></span>
                        <?php  echo Yii::t('tx','Check this to delete this photo');  ?>
                    </div>
                    <?php } ?>
                </div>
            <?php } ?>\n";
            echo "\t\t\t<?php echo \$form->fileField(\$model,'{$column->name}',array('class' => 'form-control')); ?>\n";
        }
        elseif(InputTypes::checkColumnType($column)== InputTypes::imageAjax){
            echo "\t\t\t<?php if(!\$model->isNewRecord && \$model->{$column->name}){ ?>
                <div class=\"controls\">
                    <div class=\"fileupload fileupload-new\" data-provides=\"fileupload\">
                        <div class=\"fileupload-new thumbnail\" style=\"width: <?php echo Yii::app()->params['thumb_w'] ;?>px;height: <?php echo Yii::app()->params['thumb_h'] ;?>px;\">
                            <!--<img src=\"http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image\" alt=\"\" />-->
                            <img src=\"<?php echo \$model->_{$column->name}; ?>\"  alt=\"\"/>
                        </div>
                    </div>
                    <?php if(!\$model->isAttributeRequired('{$column->name}')) { ?>
                    <div>
                        <span><?php echo '&nbsp;<input type=\"checkbox\" name=\"{$column->name}_delete\" id=\"{$column->name}_delete\" value=\"{$column->name}_delete\"/>'; ?></span>
                        <?php  echo Yii::t('tx','Check this to delete this photo');  ?>
                    </div>
                    <?php } ?>
                </div>
            <?php } ?>\n";
            echo "\t\t\t<?php echo \$form->fileField(\$model,'{$column->name}',array('class' => 'form-control')); ?>\n";
        }
        elseif(InputTypes::checkColumnType($column)== InputTypes::file){
            echo "\t\t\t<div class='row' class='file_up_mx'>
                <?php if (!\$model->isNewRecord && \$model->{$column->name}) {
                    echo Yii::t('tx','There is');
                    echo CHtml::link(Yii::t('tx',' file '),Yii::app()->baseUrl.'/upload/'.\$model->{$column->name});
                    echo Yii::t('tx','already uploaded.');
                if (!\$model->isAttributeRequired('{$column->name}')) {
                    echo '&nbsp;<input type=\"checkbox\" name=\"{$column->name}_delete\" id=\"{$column->name}_delete\" value=\"{$column->name}_delete\"/>';
                    echo Yii::t('tx',' Check this to delete this attachment file or replace it by uploading another one or let this file by doing nothing.');
                } } ?>
            </div>\n";
            echo "\t\t\t<?php echo \$form->fileField(\$model,'{$column->name}',array('class' => 'form-control')); ?>\n";
        }
        elseif(InputTypes::checkColumnType($column)== InputTypes::fileAjax){
            echo "\t\t\t<div class='row' class='file_up_mx'>
                <?php if (!\$model->isNewRecord && \$model->{$column->name}) {
                    echo Yii::t('tx','There is');
                    echo CHtml::link(Yii::t('tx',' file '),Yii::app()->baseUrl.'/upload/'.\$model->{$column->name});
                    echo Yii::t('tx','already uploaded.');
                if (!\$model->isAttributeRequired('{$column->name}')) {
                    echo '&nbsp;<input type=\"checkbox\" name=\"{$column->name}_delete\" id=\"{$column->name}_delete\" value=\"{$column->name}_delete\"/>';
                    echo Yii::t('tx',' Check this to delete this attachment file or replace it by uploading another one or let this file by doing nothing.');
                } } ?>
            </div>\n";
            echo "\t\t\t<?php echo \$form->fileField(\$model,'{$column->name}',array('class' => 'form-control')); ?>\n";
        }
        elseif(InputTypes::checkColumnType($column)== InputTypes::radioButtonGroup){
            $values=substr($comment, strpos($comment, ":") + 1);
            $tags=explode(',',$values);
            $ar="";
            foreach($tags as $tag){
                $tag=trim($tag);
                $ar.="'{$tag}'=>'{$tag}', ";
            }
            echo "\t\t\t<div class='radio'>\n\t\t\t\t<label>";
            echo "<?php echo \$form->radioButtonList(\$model,'{$column->name}',array($ar),array('class'=>'flat')); ?>";
            echo "</label>\n\t\t\t</div>\n";
        }
        elseif(InputTypes::checkColumnType($column)== InputTypes::checkBoxGroup){
            $values=substr($comment, strpos($comment, ":") + 1);
            $tags=explode(',',$values);
            $ar="";
            foreach($tags as $tag){
                $tag=trim($tag);
                $ar.="'{$tag}'=>'{$tag}', ";
            }
            echo "\t\t\t<div class='radio'>\n\t\t\t\t<label>";
            echo "<?php echo \$form->checkBoxList(\$model,'{$column->name}',array($ar),array('class'=>'flat')); ?>";
            echo "</label>\n\t\t\t</div>\n";
        }
        elseif(InputTypes::checkColumnType($column)== InputTypes::dropDownList){
            $values=substr($comment, strpos($comment, ":") + 1);
            $tags=explode(',',$values);
            $array_value="array(";
            foreach($tags as $tag){
                $tag=trim($tag);
                $array_value.="'{$tag}' => Yii::t('tx', '{$tag}'),";
            }
            $array_value.=") ";
            echo "\t\t\t<?php echo \$form->dropDownList(\$model,'{$column->name}', {$array_value}, array('class' => 'form-control')); ?>\n";
        }
        elseif(InputTypes::checkColumnType($column)== InputTypes::dropDownAsArray){
            $value=trim(substr($comment, strpos($comment, ":") + 1));
            echo "\t\t\t<?php echo \$form->dropDownList(\$model,'{$column->name}', Helpers::{$value}() , array('class' => 'form-control')); ?>\n";
        }
        elseif(InputTypes::checkColumnType($column)== InputTypes::oneToManyR){
            $table_field=substr($comment, strpos($comment, ":") + 1);
            $table_field=explode(',',$table_field);
            $m=new MXModelCode(); $m->tableName=trim($table_field[0]);  $m->init();
            echo "\t\t<?php echo \$form->dropDownList(\$model, '{$column->name}', CHtml::listData(".$m->generateClassName($m->tableName)."::model()->findAll(), 'id', '{$table_field[1]}'), array('class' => 'form-control')); ?>\n";
        }
        elseif(InputTypes::checkColumnType($column)== InputTypes::manyToManyR){
            $table_field=substr($comment, strpos($comment, ":") + 1);
            $table_field=explode(',',$table_field);
            $m=new MXModelCode(); $m->tableName=trim($table_field[0]);  $m->init();
            $id=$this->getTableSchema($m->tableName)->primaryKey;
            //$model_name=ucfirst($tags[0]);
            echo "\t\t<?php \$this->widget('ext.select2.ESelect2',array(
                'model'=>\$model,
                'attribute'=>'{$column->name}',
                'data'=>CHtml::listData({$m->generateClassName($m->tableName)}::model()->findAll(), '{$id}', '$table_field[1]'),
                'htmlOptions'=>array(
                    'multiple'=>'multiple',
                    'class'=>'form-control',
                    'style'=>'width:100%',
                    'id'=>'{$column->name}',
                ),
                'options'=>array(
                    'placeholder'=>Yii::t('tx','Choose {$column->name}'),
                    'allowClear'=>true,
                ),
            )); ?>\n";
        }
        elseif(InputTypes::checkColumnType($column)== InputTypes::editor){
            echo  "\t\t\t<?php \$this->widget('ext.editMe.widgets.ExtEditMe', array(
                    'model'=>\$model,
                    'attribute'=>'".$column->name."',
                    'autoLanguage'=>FALSE,
                    'filebrowserImageUploadUrl'=>Yii::app()->createUrl('site/upfile'),
                    'htmlOptions' => array('class' => 'form-control'),
            )); ?>\n";
        }
        elseif(InputTypes::checkColumnType($column)== InputTypes::textArea){
            $s=$column->size!==null?",'maxlength'=>{$column->size}":"";
            echo  "\t\t<?php echo \$form->textArea(\$model,'{$column->name}',array('class' => 'form-control', 'rows'=>'3', 'placeholder'=>'' {$s} )); ?>\n";
        }
        elseif(InputTypes::checkColumnType($column)== InputTypes::dateBox){
            echo "\t\t<?php
                \$this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'name' => '$column->name',
                    'language' => Yii::app()->language == 'et' ? 'et' : null,
                    'attribute' => '$column->name',
                    'model' => \$model,
                    'skin' => 'redmond',
                    'options' => array(
                        'dateFormat' => 'yy-mm-dd',
                        'changeMonth' => 'true',
                        'changeYear' => 'true',
                        'showButtonPanel' => 'true',
                        'constrainInput' => 'false',
                        'duration' => 'fast',
                        'showAnim' => 'slide',
                    ),
                    'htmlOptions' => array(
                        'style' => 'width:245px;vertical-align:top',
                        'class' =>'form-control',
                    ),
                ));
                ?>\n";
        }
        elseif(InputTypes::checkColumnType($column)== InputTypes::dateTimeBox){
            echo "\t\t<?php
                \$this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'name' => '$column->name',
                    'language' => Yii::app()->language == 'et' ? 'et' : null,
                    'attribute' => '$column->name',
                    'model' => \$model,
                    'skin' => 'redmond',
                    'options' => array(
                        'dateFormat' => 'yy-mm-dd',
                        'changeMonth' => 'true',
                        'changeYear' => 'true',
                        'showButtonPanel' => 'true',
                        'constrainInput' => 'false',
                        'duration' => 'fast',
                        'showAnim' => 'slide',
                    ),
                    'htmlOptions' => array(
                        'style' => 'width:245px;vertical-align:top',
                        'class' =>'form-control',
                    ),
                ));
                ?>\n";
        }
        elseif(InputTypes::checkColumnType($column)== InputTypes::textBox){
            $s=$column->size!==null?",'maxlength'=>{$column->size}":"";
            echo "\t\t\t<?php echo \$form->{$inputField}(\$model,'{$column->name}',array('class' => 'form-control' {$s})); ?>\n";
        }
        else{
            $s=$column->size!==null?",'maxlength'=>{$column->size}":"";
            echo "\t\t\t<?php echo \$form->{$inputField}(\$model,'{$column->name}',array('class' => 'form-control' {$s})); ?>\n";
        }
        echo "\t\t\t<?php echo \$form->error(\$model, '$column->name'); ?>\n";
        echo "\t\t</div>
    </div>\n\n";
    }

    public function echoAdminColumns($column){

        $comment = mb_strtolower($column->comment);
        if(InputTypes::checkColumnType($column)==InputTypes::primary){
            echo "array(
                        'name' => '{$column->name}',
                        'headerHtmlOptions' => array('style' => 'width: 60px'),
                    ),\n";
        }
        elseif(InputTypes::checkColumnType($column)==InputTypes::gallery){
            //echo "\t\t\t//'{$column->name}',\n";
        }
        elseif(InputTypes::checkColumnType($column)==InputTypes::slugColumn){
            echo "\t\t\t//'{$column->name}',\n";
        }
        elseif(InputTypes::checkColumnType($column)==InputTypes::image || InputTypes::checkColumnType($column)==InputTypes::imageAjax){
            echo "\t\t\t\t\tarray(
                        'name' => '{$column->name}',
                        'type' => 'HTML',
                        'value' => 'Helpers::thumb(\$data->absolute{$column->name})',
                        'filter' => false,
                        'sortable' => false,
                    ),\n";
        }
        elseif(InputTypes::checkColumnType($column)==InputTypes::file || InputTypes::checkColumnType($column)==InputTypes::fileAjax){
            echo "\t\t\t\t\tarray(
                        'name' => '{$column->name}',
                        'type' => 'HTML',
                        'value' => 'is_null(\$data->{$column->name})?\"<span class=\'label label-important\'>'.Yii::t('tx','Not Found').'</span>\":CHtml::link(\"<span class=\'label label-success\'>'.Yii::t('tx','Download').'</span>\",Yii::app()->createUrl(\"site/download\",array(\"name\"=>\$data->{$column->name})))',
                        'filter' => false,
                        'sortable' => false,
                    ),\n";
        }
        elseif(InputTypes::checkColumnType($column)==InputTypes::textArea || InputTypes::checkColumnType($column)==InputTypes::editor){
            echo "\t\t\t\t\tarray(
                        'name' => '{$column->name}',
                        'value' => 'Helpers::contentHelper(\$data->".$column->name.",40)',
                    ),\n";
        }
        elseif(InputTypes::checkColumnType($column)==InputTypes::dateTimeBox || InputTypes::checkColumnType($column)==InputTypes::dateBox){
            echo "\t\t\t\t\tarray(
                    'name' => '".$column->name."',
                    'filter' => \$this->widget('zii.widgets.jui.CJuiDatePicker',
                            array(
                                'model'=>\$model,
                                'attribute'=>'".$column->name."',
                                'language'=>Yii::app()->language=='et' ? 'et' : null,
                                'htmlOptions' => array(
                                    'id' => 'datepicker_for_".$column->name."',
                                    'size' => '10',
                                ),
                                'skin'=>'redmond',
                                'options'=>array(
                                        'dateFormat'=>'yy-mm-dd',
                                        'changeMonth' => 'true',
                                        'changeYear' => 'true',
                                        'showButtonPanel' => 'true',
                                        'constrainInput' => 'false',
                                        'duration'=>'fast',
                                        'showAnim' =>'slide',
                                ),
                                ),
                            true),
                    ),\n";
        }
        elseif(InputTypes::checkColumnType($column)== InputTypes::radioButtonGroup){
            $values=substr($comment, strpos($comment, ":") + 1);
            $tags=explode(',',$values);
            $filter="array(";
            foreach ($tags as $t){ $t=trim($t); $filter.="'{$t}'=>'{$t}', ";}
            $filter.=")";
            echo "\t\t\t\t\tarray(
                        'name'=>'{$column->name}',
                        'value'=>'(\$data->{$column->name})',
                        'type'=>'raw',
                        'filter' =>$filter,
                        'headerHtmlOptions'=>array('style'=>'width:100px;'),
                    ),\n";
        }
        elseif(InputTypes::checkColumnType($column)== InputTypes::dropDownList){
            $values=substr($comment, strpos($comment, ":") + 1);
            $tags=explode(',',$values);
            $filter="array(";
            foreach ($tags as $t){ $t=trim($t); $filter.="'{$t}'=>'{$t}', ";}
            $filter.=")";
           echo "\t\t\t\t\tarray(
                        'name'=>'{$column->name}',
                        'value'=>'(\$data->{$column->name})',
                        'type'=>'raw',
                        'filter' =>$filter,
                        'headerHtmlOptions'=>array('style'=>'width:100px;'),
                    ),\n";
        }
        elseif(InputTypes::checkColumnType($column)== InputTypes::dropDownAsArray){
           $value=trim(substr($comment, strpos($comment, ":") + 1));
           echo "\t\t\t\t\tarray(
                        'name'=>'{$column->name}',
                        'value'=>'Helpers::{$value}(\$data->{$column->name})',
                        'type'=>'raw',
                        'filter' =>Helpers::{$value}(),
                    ),\n";
        }
        elseif(InputTypes::checkColumnType($column)==InputTypes::oneToManyR){
            $table_field=substr($comment, strpos($comment, ":") + 1);
            $table_field=explode(',',$table_field);
            $m=new MXModelCode(); $m->tableName=trim($table_field[0]);  $m->init();
            echo "\t\t\t\t\tarray(
			        'name'=>'".$column->name."',
			        'value'=>'(\$data->".$m->generateRelationName($this->getTableSchema()->name,$column->name,false)."->{$table_field[1]})',
			        'type'=>'raw',
                    'filter' =>CHtml::listData({$m->generateClassName($m->tableName)}::model()->findAll(), 'id', '{$table_field[1]}'),
                    'headerHtmlOptions'=>array('style'=>'width:100px;'),
		        ),\n";
        }
        elseif(InputTypes::checkColumnType($column)==InputTypes::manyToManyR){
            $table_field=substr($comment, strpos($comment, ":") + 1);
            $table_field=explode(',',$table_field);
            $m=new MXModelCode(); $m->tableName=trim($table_field[0]);  $m->init();
            $id=$this->getTableSchema($m->tableName)->primaryKey;
            echo "\t\t\t\t\tarray(
                    'name' => '{$column->name}',
                    'value' =>'implode(\" , \",CHtml::listData({$m->generateClassName($m->tableName)}::model()->findAllByAttributes(array(\"{$id}\"=>explode(\" , \",\$data->{$column->name}))),\"{$id}\",\"{$table_field[1]}\"))',
                    'type'=>'raw',
                ),\n";
        }
        elseif(InputTypes::checkColumnType($column)==InputTypes::boolean){
            $tags=explode(',',$comment);
            $tags[0]=trim($tags[0]);
            $tags[1]=trim($tags[1]);
            echo "\t\t\t\t\tarray(
                        'name' => '$column->name',
                        'type' => 'html',
                        'value' => 'Helpers::booleanAsIcon(\$data, \"$column->name\")',
                        'filter' => array('1' => Yii::t('tx', '$tags[0]'), '0' => Yii::t('tx', '$tags[1]')),
                        'headerHtmlOptions' => array('style' => 'width:60px;'),
                    ),\n";
        }
        elseif(InputTypes::checkColumnType($column)==InputTypes::checkBoxGroup){
            echo "\t\t\t\t\t'".$column->name."',\n";
        }
        else{
            echo "\t\t\t\t\t'".$column->name."',\n";
        }
    }

    public function echoViewColumns($column){

        $comment = mb_strtolower($column->comment);
        if(InputTypes::checkColumnType($column)==InputTypes::primary){
            echo "\t'".$column->name."',\n";
        }
        elseif(InputTypes::checkColumnType($column)==InputTypes::gallery){
            //echo "\t\t//'{$column->name}',\n";
        }
        elseif(InputTypes::checkColumnType($column)==InputTypes::slugColumn){
            echo "\t\t\t//'{$column->name}',\n";
        }
        elseif(InputTypes::checkColumnType($column)==InputTypes::image || InputTypes::checkColumnType($column)==InputTypes::imageAjax){
            echo "\t\t\t\tarray(
                    'name' => '{$column->name}',
                    'type' => 'image',
                    'value' => \$model->_{$column->name},
                ),\n";
        }
        elseif(InputTypes::checkColumnType($column)==InputTypes::file || InputTypes::checkColumnType($column)==InputTypes::fileAjax){
            echo "\t\t\t\tarray(
                    'name' => '{$column->name}',
                    'type' => 'HTML',
                    'value' => is_null(\$model->{$column->name})?\"<span class='label label-important'>\".Yii::t('tx','Not Found').\"</span>\":CHtml::link(\"<span class='label label-success'>\".Yii::t('tx','Download').\"</span>\",Yii::app()->createUrl(\"site/download\",array(\"name\"=>\$model->{$column->name}))),
                ),\n";
        }
        elseif(InputTypes::checkColumnType($column)==InputTypes::textArea || InputTypes::checkColumnType($column)==InputTypes::editor){
            echo "\t\t\t\tarray(
                    'name' => '{$column->name}',
                    'value' => \$model->{$column->name},
                    'type' => 'raw',
                ),\n";
        }
        elseif(InputTypes::checkColumnType($column)==InputTypes::dateTimeBox || InputTypes::checkColumnType($column)==InputTypes::dateBox){
            echo "\t\t\t\t'".$column->name."',\n";
        }
        elseif(InputTypes::checkColumnType($column)== InputTypes::radioButtonGroup){
            echo "\t\t\t\t'".$column->name."',\n";
        }
        elseif(InputTypes::checkColumnType($column)== InputTypes::dropDownList){
            echo "\t\t\t\t'".$column->name."',\n";
        }
        elseif(InputTypes::checkColumnType($column)== InputTypes::dropDownAsArray){
            $value=trim(substr($comment, strpos($comment, ":") + 1));
            echo "\t\t\t\t\tarray(
                        'name'=>'{$column->name}',
                        'value'=> Helpers::{$value}(\$model->{$column->name}),
                        'type'=>'raw',
                    ),\n";
        }
        elseif(InputTypes::checkColumnType($column)==InputTypes::oneToManyR){
            $table_field=substr($comment, strpos($comment, ":") + 1);
            $table_field=explode(',',$table_field);
            $m=new MXModelCode(); $m->tableName=trim($table_field[0]);  $m->init();
            echo "\t\t\t\tarray(
                    'name' => '{$column->name}',
                    'value' => \$model->".$m->generateRelationName($this->getTableSchema()->name,$column->name,false)."->{$table_field[1]},
                    'type' => 'raw',
                ),\n";
        }
        elseif(InputTypes::checkColumnType($column)==InputTypes::manyToManyR){
            $table_field=substr($comment, strpos($comment, ":") + 1);
            $table_field=explode(',',$table_field);
            $m=new MXModelCode(); $m->tableName=trim($table_field[0]);  $m->init();
            $id=$this->getTableSchema($m->tableName)->primaryKey;
            echo "\t\t\t\tarray(
                'name' => '{$column->name}',
                'value' =>implode(\" , \",CHtml::listData({$m->generateClassName($m->tableName)}::model()->findAllByAttributes(array(\"{$id}\"=>explode(\" , \",\$model->{$column->name}))),\"{$id}\",\"{$table_field[1]}\")),
                'type' => 'raw',
            ),\n";
        }
        elseif(InputTypes::checkColumnType($column)==InputTypes::boolean){
            $tags=explode(',',$comment);
            echo "\t\t\t\tarray(
                    'name' => '{$column->name}',
                    'value' => Helpers::booleanAsIcon(\$model, \"{$column->name}\"),
                    'type' => 'raw',
                ),\n";
        }
        elseif(InputTypes::checkColumnType($column)==InputTypes::checkBoxGroup){
            echo "\t\t\t\t'".$column->name."',\n";
        }
        else{
            echo "\t\t\t\t'".$column->name."',\n";
        }
    }

    public function echoSearchForm($column){
        $comment = mb_strtolower($column->comment);
        if(InputTypes::checkColumnType($column)== InputTypes::password ||
           InputTypes::checkColumnType($column)== InputTypes::gallery ||
           InputTypes::checkColumnType($column)== InputTypes::slugColumn ||
           InputTypes::checkColumnType($column)== InputTypes::image ||
           InputTypes::checkColumnType($column)== InputTypes::imageAjax ||
           InputTypes::checkColumnType($column)== InputTypes::file ||
           InputTypes::checkColumnType($column)== InputTypes::fileAjax){
           return;
        }

        if (preg_match('/^(password|pass|passwd|passcode)$/i',$column->name))
            $inputField='passwordField';
        else
            $inputField='textField';

        echo "<div class=\"col-md-3 col-sm-12 col-xs-12 form-group\">
            <?php echo \$form->label(\$model, '{$column->name}'); ?>\n";

        if(InputTypes::checkColumnType($column)== InputTypes::boolean){
            $tags=explode(',',$comment);
            $tags[0]=trim($tags[0]);
            $tags[1]=trim($tags[1]);
            echo "\t\t\t<div>\n\t\t\t\t<label>";
            echo "<?php echo \$form->radioButton(\$model,'{$column->name}',array('class'=>'flat','value'=>1)).\" \".Yii::t('tx','$tags[0]'); ?>";
            echo "</label>\n\t\t\t</div>\n";
            echo "\t\t\t<div>\n\t\t\t\t<label>";
            echo "<?php echo \$form->radioButton(\$model,'{$column->name}',array('class'=>'flat','value'=>0)).\" \".Yii::t('tx','$tags[1]'); ?>";
            echo "</label>\n\t\t\t</div>\n";
        }
        elseif(InputTypes::checkColumnType($column)== InputTypes::radioButtonGroup){
            $values=substr($comment, strpos($comment, ":") + 1);
            $tags=explode(',',$values);
            $ar="";
            foreach($tags as $tag){
                $tag=trim($tag);
                $ar.="'{$tag}'=>'{$tag}', ";
            }
            echo "\t\t\t<div>\n\t\t\t\t<label>";
            echo "<?php echo \$form->radioButtonList(\$model,'{$column->name}',array($ar),array('class'=>'flat')); ?>";
            echo "</label>\n\t\t\t</div>\n";
        }
        elseif(InputTypes::checkColumnType($column)== InputTypes::checkBoxGroup){
            $values=substr($comment, strpos($comment, ":") + 1);
            $tags=explode(',',$values);
            $ar="";
            foreach($tags as $tag){
                $tag=trim($tag);
                $ar.="'{$tag}'=>'{$tag}', ";
            }
            echo "\t\t\t<div>\n\t\t\t\t<label>";
            echo "<?php echo \$form->checkBoxList(\$model,'{$column->name}',array($ar),array('class'=>'flat')); ?>";
            echo "</label>\n\t\t\t</div>\n";
        }
        elseif(InputTypes::checkColumnType($column)== InputTypes::dropDownList){
            $values=substr($comment, strpos($comment, ":") + 1);
            $tags=explode(',',$values);
            $array_value="array(";
            foreach($tags as $tag){
                $tag=trim($tag);
                $array_value.="'{$tag}' => Yii::t('tx', '{$tag}'),";
            }
            $array_value.=") ";
            echo "\t\t\t<?php echo \$form->dropDownList(\$model,'{$column->name}', {$array_value}, array('class' => 'form-control')); ?>\n";
        }
        elseif(InputTypes::checkColumnType($column)== InputTypes::dropDownAsArray){
            $value=trim(substr($comment, strpos($comment, ":") + 1));
            echo "\t\t\t<?php echo \$form->dropDownList(\$model,'{$column->name}', Helpers::{$value}() , array('class' => 'form-control')); ?>\n";
        }
        elseif(InputTypes::checkColumnType($column)== InputTypes::oneToManyR){
            $table_field=substr($comment, strpos($comment, ":") + 1);
            $table_field=explode(',',$table_field);
            $m=new MXModelCode(); $m->tableName=trim($table_field[0]);  $m->init();
            echo "\t\t<?php echo \$form->dropDownList(\$model, '{$column->name}', CHtml::listData(".$m->generateClassName($m->tableName)."::model()->findAll(), 'id', '{$table_field[1]}'), array('class' => 'form-control')); ?>\n";
        }
        elseif(InputTypes::checkColumnType($column)== InputTypes::manyToManyR){
            $table_field=substr($comment, strpos($comment, ":") + 1);
            $table_field=explode(',',$table_field);
            $m=new MXModelCode(); $m->tableName=trim($table_field[0]);  $m->init();
            $id=$this->getTableSchema($m->tableName)->primaryKey;
            //$model_name=ucfirst($tags[0]);
            echo "\t\t<?php \$this->widget('ext.select2.ESelect2',array(
                'model'=>\$model,
                'attribute'=>'{$column->name}',
                'data'=>CHtml::listData({$m->generateClassName($m->tableName)}::model()->findAll(), '{$id}', '$table_field[1]'),
                'htmlOptions'=>array(
                    'multiple'=>'multiple',
                    'class'=>'form-control',
                    'style'=>'width:100%',
                    'id'=>'{$column->name}',
                ),
                'options'=>array(
                    'placeholder'=>Yii::t('tx','Choose {$column->name}'),
                    'allowClear'=>true,
                ),
            )); ?>\n";
        }
        elseif(InputTypes::checkColumnType($column)== InputTypes::editor){
            $s=$column->size!==null?",'maxlength'=>{$column->size}":"";
            echo "\t\t\t<?php echo \$form->textField(\$model,'{$column->name}',array('class' => 'form-control' {$s})); ?>\n";
        }
        elseif(InputTypes::checkColumnType($column)== InputTypes::textArea){
            $s=$column->size!==null?",'maxlength'=>{$column->size}":"";
            echo "\t\t\t<?php echo \$form->textField(\$model,'{$column->name}',array('class' => 'form-control' {$s})); ?>\n";
        }
        elseif(InputTypes::checkColumnType($column)== InputTypes::dateBox){
            echo "\t\t\t<?php \$this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'name' => '$column->name',
                    'language' => Yii::app()->language == 'et' ? 'et' : null,
                    'attribute' => '$column->name',
                    'model' => \$model,
                    //'themeUrl'=>Yii::app()->request->baseUrl.'/css/redmond/jquery.ui.datepicker.css',
                    'skin' => 'redmond',
                    'options' => array(
                        'dateFormat' => 'yy-mm-dd',
                        'changeMonth' => 'true',
                        'changeYear' => 'true',
                        'showButtonPanel' => 'true',
                        'constrainInput' => 'false',
                        'duration' => 'fast',
                        'showAnim' => 'slide',
                    ),
                    'htmlOptions' => array(
                        'style' => 'width:245px;vertical-align:top',
                        'class' =>'form-control',
                    ),
                ));
                ?>\n";
        }
        elseif(InputTypes::checkColumnType($column)== InputTypes::dateTimeBox){
            echo "\t\t\t<?php \$this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'name' => '$column->name',
                    'language' => Yii::app()->language == 'et' ? 'et' : null,
                    'attribute' => '$column->name',
                    'model' => \$model,
                    //'themeUrl'=>Yii::app()->request->baseUrl.'/css/redmond/jquery.ui.datepicker.css',
                    'skin' => 'redmond',
                    'options' => array(
                        'dateFormat' => 'yy-mm-dd',
                        'changeMonth' => 'true',
                        'changeYear' => 'true',
                        'showButtonPanel' => 'true',
                        'constrainInput' => 'false',
                        'duration' => 'fast',
                        'showAnim' => 'slide',
                    ),
                    'htmlOptions' => array(
                        'style' => 'vertical-align:top',
                        'class' =>'form-control',
                    ),
                ));
                ?>\n";
        }
        elseif(InputTypes::checkColumnType($column)== InputTypes::textBox){
            $s=$column->size!==null?",'maxlength'=>{$column->size}":"";
            echo "\t\t\t<?php echo \$form->{$inputField}(\$model,'{$column->name}',array('class' => 'form-control' {$s})); ?>\n";
        }
        else{
            $s=$column->size!==null?",'maxlength'=>{$column->size}":"";
            echo "\t\t\t<?php echo \$form->{$inputField}(\$model,'{$column->name}',array('class' => 'form-control' {$s})); ?>\n";
        }

        echo   "\t\t</div>";
    }

}
