<?php
$temp=Yii::app()->language == "en"?"/":"_rtl/";
$p=Yii::app()->theme->baseUrl.'/assets'.$temp;


$this->renderPartial('webroot.themes.default.views.layouts.header', array('p' => $p));
echo $content;
$this->renderPartial('webroot.themes.default.views.layouts.footer', array('p' => $p));

?>

