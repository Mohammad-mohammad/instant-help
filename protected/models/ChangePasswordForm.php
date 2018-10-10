<?php

class ChangePasswordForm extends CFormModel
{
    public $old_password;
    public $new_password;
    public $re_password;


    public function rules()
    {
        return array(
            array('old_password, new_password, re_password', 'required'),
            array('re_password', 'compare', 'compareAttribute'=>'new_password'),
        );
    }


    public function attributeLabels()
    {
        return array(
            'old_password'=>Yii::t('tx','Old Password'),
            'new_password'=>Yii::t('tx','New password'),
            're_password'=>Yii::t('tx','Repeat Password'),
        );
    }
}