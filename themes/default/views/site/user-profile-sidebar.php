<?php
$temp=Yii::app()->language == "en"?"/":"_rtl/";
$p=Yii::app()->theme->baseUrl.'/assets'.$temp;
//Yii::app()->clientScript->registerScriptFile('https://cdn.pubnub.com/pubnub.min.js', CClientScript::POS_END);
//Yii::app()->clientScript->registerScriptFile($p . 'js/webrtc.js', CClientScript::POS_END);
//Yii::app()->clientScript->registerScriptFile($p . 'js/rtc-controller.js', CClientScript::POS_END);
//Yii::app()->clientScript->registerScriptFile($p . 'js/rtc.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile($p . 'js/profile.js', CClientScript::POS_END);
?>

<aside class="user-profile-sidebar">
    <div id="image_profile_container" class="user-profile-avatar text-center">
        <form id="profile_image_upload" method="post" enctype="multipart/form-data">
            <label id="button_profile_image_upload" for="profile_image" title="update photo" class="custom-file-upload">
                <i class="fa fa-pencil"></i>
            </label>
            <input id="profile_image" name="profile_image" class="sme_profile_image" type="file">
        </form>
        <img class="profile_img" src="<?php echo Yii::app()->baseUrl."/upload/default.png"; ?>" alt="avatar" title="avatar">

        <h5 id="profile-name">...</h5>
        <p  id="profile-status">...</p>
        <p  id="profile-level">...</p>
        <p  id="profile-type">...</p>
        <?php
        $user_model=null;
        $btn_text="Make me available";
        $btn_class="btn-danger";
        if(!Yii::app()->user->isGuest){
            $user_model=Client::model()->findByAttributes(array('email'=>Yii::app()->user->name));
            if($user_model->available==1){
                $btn_text="Make me unavailable";
                $btn_class="btn-success";
            }
        } ?>
        <button data-status="<?php echo $user_model->available; ?>" id="make-available" class="btn <?php echo $btn_class; ?>"><?php echo $btn_text; ?></button>
    </div>
    <ul class="list user-profile-nav">
        <li><a href="<?php echo Yii::app()->createUrl("site/profile"); ?>"><i class="fa fa-cog"></i>Settings</a>
        </li>
        <li><a href="<?php echo Yii::app()->createUrl("site/callhistory"); ?>"><i class="fa fa-phone"></i>Call's History</a>
        </li>
        <li><a href="<?php echo Yii::app()->createUrl("site/languages"); ?>"><i class="fa fa-language"></i>Languages</a>
        </li>
        <li><a href="<?php echo Yii::app()->createUrl("site/competences"); ?>"><i class="fa fa-puzzle-piece"></i>Competences</a>
        </li>
        <li><a href="<?php echo Yii::app()->createUrl("site/cards"); ?>"><i class="fa fa-credit-card"></i>Credit/Debit Cards</a>
        </li>
    </ul>
</aside>