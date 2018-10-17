<?php
function is_current($controlle,$action=null){
    $c=Yii::app()->controller->id;
    $a=Yii::app()->controller->action->id;
    if(mb_strtolower($c)===mb_strtolower($controlle)) {
        if($action==null) echo ' selected';
        elseif(mb_strtolower($a)===mb_strtolower($action)) echo ' selected';
    }
}
?>
<div class="nav">
    <ul class="slimmenu" id="slimmenu">
        <li class="active"><a href="<?php echo Yii::app()->createUrl("site/index"); ?>">Home</a></li>
        <li><a href="<?php echo Yii::app()->createUrl("site/search"); ?>">Get Help</a></li>
        <li><a href="<?php echo Yii::app()->createUrl("site/profile"); ?>">My Profile</a></li>
        <li><a href="<?php echo Yii::app()->createUrl("site/contact"); ?>">Contact Us</a></li>
        <li><a href="<?php echo Yii::app()->createUrl("site/about"); ?>">About Us</a></li>
        <li><a href="<?php echo Yii::app()->createUrl("site/policy"); ?>">Privacy Policy</a></li>
        <li><a href="<?php echo Yii::app()->createUrl("site/terms"); ?>">Terms of Use</a></li>
    </ul>
</div>
