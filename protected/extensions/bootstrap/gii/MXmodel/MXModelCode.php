<?php

Yii::import('gii.generators.model.ModelCode');
Yii::import('bootstrap.gii.InputTypes');

class MXModelCode extends ModelCode
{
    public function generateClassName($tableName){
        $tableName=$this->removePrefix($tableName,false);
        if(($pos=strpos($tableName,'.'))!==false) // remove schema part (e.g. remove 'public2.' from 'public2.post')
            $tableName=substr($tableName,$pos+1);
        $className='';
        foreach(explode('_',$tableName) as $name)
        {
            if($name!=='')
                $className.=ucfirst($name);
        }
        return $className;
    }

    public function generateRelationName($tableName, $fkName, $multiple){
        return parent::generateRelationName($tableName, $fkName, $multiple);
    }

}
