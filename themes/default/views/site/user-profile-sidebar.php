<?php
$temp=Yii::app()->language == "en"?"/":"_rtl/";
$p=Yii::app()->theme->baseUrl.'/assets'.$temp;
?>

<aside class="user-profile-sidebar">
    <div class="user-profile-avatar text-center">
        <img src="<?php echo $p; ?>img/300x300.png" alt="Image Alternative text" title="AMaze" />
        <h5>John Doe</h5>
        <p>status</p>
        <p>level</p>
        <p>Type</p>
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