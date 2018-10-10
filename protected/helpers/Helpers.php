<?php

class Helpers {
	
	public static function notNull($str){
        if(!is_null($str) & trim($str)!="")
            return true;
        else return false;
    }

    public static function clientStatus($id=null){
        $temp=array(ClientStatus::Active =>'Active',ClientStatus::InActive=>'Inactive',ClientStatus::Blocked=>'Blocked');
        return $id==null?$temp:$temp[$id];
    }
    public static function clientType($id=null){
        $temp=array(ClientType::Normal=>'Normal',ClientType::PreExpert=>'PreExpert',ClientType::Expert=>'Expert');
        return $id==null?$temp:$temp[$id];
    }

    public static function language($id=null){
        $temp=array(1=>'English',2=>'Français‎',3=>'English & Français‎');
        return $id==null?$temp:$temp[$id];
    }
    public static function orderstatus($id=null){
        $temp=array(1=>'Done',2=>'Pending',3=>'Canceled');
        return $id==null?$temp:$temp[$id];
    }

	public static function uploadFile($model, $imageAttrName) {
        if ($model->validate(Null) && $model->$imageAttrName) {
            $newName = date('YmdHms').'_'.$model->$imageAttrName;
            $src = Yii::app()->basePath . '/../upload/'.$newName;
            $model->$imageAttrName->saveAs($src);
            $model->$imageAttrName = $newName;
        }
        return;
    }
    public static function uploadFiles($model, $attributes) {
        foreach($attributes as $attribute){
            $model->$attribute = CUploadedFile::getInstance($model, $attribute);
        }
        foreach($attributes as $attribute){
            if ($model->validate() && $model->$attribute) {
                $newName = date('YmdHms').'_'.$model->$attribute;
                $src = Yii::app()->basePath . '/../upload/'.$newName;
                $model->$attribute->saveAs($src);
                $model->$attribute = $newName;
            }
        }
    }
    public static function updateFiles($model, $model2, $attributes) {
        foreach($attributes as $attribute){
            $model->$attribute = CUploadedFile::getInstance($model, $attribute);
        }
        foreach($attributes as $attribute){
            $filename = Yii::app()->basePath . '/../upload/' . $model2->$attribute;
            $newName = date('YmdHms'). '_' . $model->$attribute;
            if(is_null($model->$attribute)){
                if(isset($_POST[$attribute.'_delete'])){
                    if(file_exists($filename) && $model2->$attribute) unlink($filename);
                }else{
                    $model->$attribute=$model2->$attribute;
                    $model->setScenario('except_'.$attribute);
                }
            }elseif($model->validate()){
                if(file_exists($filename) && $model2->$attribute) unlink($filename);
                $src = Yii::app()->basePath.'/../upload/'.$newName;
                $model->$attribute->saveAs($src);
                $model->$attribute = $newName;
            }
        }
    }

    public static function updateFile($model, $model2, $imageAttrName) {
        $filename = Yii::app()->basePath . '/../upload/' . $model2->$imageAttrName;
        $newName = date('YmdHms'). '_' . $model->$imageAttrName;
        if (!$model->$imageAttrName) {
            if (!isset($_POST['file_delete']))
                $model->$imageAttrName = $model2->$imageAttrName;
            else {
                if (file_exists($filename) && $model2->$imageAttrName)
                    unlink($filename);
            }
        }else {
            if (file_exists($filename) && $model2->$imageAttrName) unlink($filename);
            $src = Yii::app()->basePath.'/../upload/'.$newName;
            $model->$imageAttrName->saveAs($src);
            $model->$imageAttrName = $newName;
        }
    }

    public static function contentHelper($data, $length) {
        return mb_substr(strip_tags(trim($data)), 0, $length, "UTF-8") . (strlen(strip_tags(trim($data))) >= $length ? "..." : "");
    }

    public static function dateHelper($data) {

        return date('d', strtotime($data)) . '-' . date('m', strtotime($data)) . '-' . '20' . date('y', strtotime($data));
    }

    public static function imageHelper($data) {
        if($data==Null) return Yii::app()->language=="ar"?"لا يوجد صورة":"image not found";
        $src = Yii::app()->baseUrl . "/upload/$data";
        return "<img src='$src' style='max-width:707px' alt='image'/>";
    }

    public static function thumb($data) {
        if($data==Null) return Yii::app()->language=="ar"?"لا يوجد صورة":"image not found";
        $src =Yii::app()->easyImage->thumbSrcOf($data, array('resize' => array('width' => 100, 'height' => 75,'master'=>EasyImage::RESIZE_NONE)));
        return "<img src='$src' alt='image'/>";
    }

    public static function attachHelper($data) {
        if (!isset($data))
            return "<span style='color:red;'>" . "لايوجد " . "</span>";
        $src = Yii::app()->baseUrl . "/upload/$data";
        return "<span style='color:green;'>" . "تحميل : </span><a href='$src'>$data</a>";
    }

    public static function booleanAsIcon($data, $attrName) {
        $icon_class = $data->$attrName == 0 ? "icon-remove" : "icon-ok";
        $ul_class = $data->$attrName == 0 ? "label label-important" : "label label-success";
        return "<ul class='$ul_class'><li class='$icon_class'></li></ul></span>";
    }

    public static function getGUID() {
        if (function_exists('com_create_guid')) {
            return trim(com_create_guid(), '{}');
        } else {
            mt_srand((double) microtime() * 10000); //optional for php 4.2.0 and up.
            $charid = strtoupper(md5(uniqid(rand(), true)));
            $hyphen = chr(45); // "-"
            $uuid = chr(123)// "{"
                    . substr($charid, 0, 8) . $hyphen
                    . substr($charid, 8, 4) . $hyphen
                    . substr($charid, 12, 4) . $hyphen
                    . substr($charid, 16, 4) . $hyphen
                    . substr($charid, 20, 12)
                    . chr(125); // "}"
            return trim($uuid, '{}');
        }
    }
    
    public static function getDays() {
        return array('السبت'=>'السبت', 'الأحد'=>'الأحد', 'الأثنين'=>'الأثنين', 'الثلاثاء'=>'الثلاثاء', 'الأربعاء'=>'الأربعاء', 'الخميس'=>'الخميس', 'الجمعة'=>'الجمعة');
    }

    public static function customArabicDate($date){
        return Helpers::month(date("M", strtotime($date))).date(" j, Y", strtotime($date));
    }

    public static function month($m){
        $month=array(
            "Jan" => "كانون2",
            "Feb" => "شباط",
            "Mar" => "أذار",
            "Apr" => "نيسان",
            "May" => "أيار",
            "Jun" => "حزيران",
            "Jul" => "تموز",
            "Aug" => "آب",
            "Sep" => "أيلول",
            "Oct" => "تشرين1",
            "Nov" => "تشرين2",
            "Dec" => "كانون1"
        );
        return Yii::app()->language == "ar" ? $month[$m]:$m;
    }

}

?>