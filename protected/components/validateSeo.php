<?php
class validateSeo extends CValidator{

    /**
     * Validates a single attribute.
     * This method should be overridden by child classes.
     * @param CModel $object the data object being validated
     * @param string $attribute the name of the attribute to be validated.
     */
    protected function validateAttribute($object, $attribute)
    {
        $pattern1 = '/([\p{Arabic}])+/u';
        $pattern2='/^[a-z0-9 \-]+$/i';
        $pattern3='/^[0-9]+$/';
        $value=$object->$attribute;
        if(preg_match($pattern3,$value))
            $this->addError($object,$attribute, Yii::t('tx','"Seo Name" field cannot contain only digits.'));
        if(preg_match($pattern1, $value)|| !preg_match($pattern2, $value))
            $this->addError($object,$attribute, Yii::t('tx','"Seo Name" field must contain only spaces, alpha and numeric. and dash(-).'));
    }
}