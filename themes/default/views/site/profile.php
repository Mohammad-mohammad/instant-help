<?php
$temp=Yii::app()->language == "en"?"/":"_rtl/";
$p=Yii::app()->theme->baseUrl.'/assets'.$temp;
?>

<div class="container">
    <h1 class="page-title">Account Settings</h1>
</div>


<div class="container">
    <div class="row">
        <div class="col-md-3">
            <?php $this->renderPartial('webroot.themes.default.views.site.user-profile-sidebar'); ?>
        </div>

        <div class="col-md-9">
            <div class="row">
                <div class="col-md-5">
                    <form id="profile-info-form">
                        <h4>Personal Infomation</h4>
                        <div class="form-group form-group-icon-left"><i class="fa fa-user input-icon"></i>
                            <label>First Name</label>
                            <input id="profile-form-fname" name="fname" class="form-control" value="" type="text" />
                        </div>
                        <div class="form-group form-group-icon-left"><i class="fa fa-user input-icon"></i>
                            <label>Last Name</label>
                            <input id="profile-form-lname" name="lname" class="form-control" value="" type="text" />
                        </div>
                        <div class="form-group form-group-icon-left"><i class="fa fa-envelope input-icon"></i>
                            <label>E-mail</label>
                            <input id="profile-form-email" disabled="disabled" class="form-control" value="" type="text" />
                        </div>

                        <div class="gap gap-small"></div>
                        <h4>Location</h4>
                        <div class="form-group">
                            <label>Country</label>
                            <input id="profile-form-country" name="country" class="form-control" value="" type="text" />
                        </div>
                        <div class="form-group">
                            <label>City</label>
                            <input id="profile-form-city" name="city" class="form-control" value="" type="text" />
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <input id="profile-form-address" name="address" class="form-control" value="" type="text" />
                        </div>

                        <hr>
                        <div id="update-profile-status"></div>
                        <input type="submit" id="update-profile-info" class="btn btn-primary" value="Save Changes">
                    </form>
                </div>
                <div class="col-md-4 col-md-offset-1">
                    <h4>Change Password</h4>
                    <form>
                        <div class="form-group form-group-icon-left"><i class="fa fa-lock input-icon"></i>
                            <label>Current Password</label>
                            <input class="form-control" type="password" />
                        </div>
                        <div class="form-group form-group-icon-left"><i class="fa fa-lock input-icon"></i>
                            <label>New Password</label>
                            <input class="form-control" type="password" />
                        </div>
                        <div class="form-group form-group-icon-left"><i class="fa fa-lock input-icon"></i>
                            <label>New Password Again</label>
                            <input class="form-control" type="password" />
                        </div>
                        <hr />
                        <input class="btn btn-primary" type="submit" value="Change Password" />
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>



<div class="gap"></div>
