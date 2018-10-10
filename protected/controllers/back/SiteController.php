<?php

class SiteController extends Controller
{

    /**
     * Declares class-based actions.
     */
    public function actions()
    {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex()
    {
        $this->layout="//layouts/main";
        if (!Yii::app()->user->isGuest)
            $this->render('admin-dashboard');
        else
            $this->redirect(array('login'));
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError()
    {
        $this->layout="//layouts/main";
        if ($error = Yii::app()->errorHandler->error)
        {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * Displays the contact page
     */
    public function actionContact()
    {
        $model = new ContactForm;
        if (isset($_POST['ContactForm']))
        {
            $model->attributes = $_POST['ContactForm'];
            if ($model->validate())
            {
                $name = '=?UTF-8?B?' . base64_encode($model->name) . '?=';
                $subject = '=?UTF-8?B?' . base64_encode($model->subject) . '?=';
                $headers = "From: $name <{$model->email}>\r\n" .
                        "Reply-To: {$model->email}\r\n" .
                        "MIME-Version: 1.0\r\n" .
                        "Content-type: text/plain; charset=UTF-8";

                mail(Yii::app()->params['adminEmail'], $subject, $model->body, $headers);
                Yii::app()->user->setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');
                $this->refresh();
            }
        }
        $this->render('contact', array('model' => $model));
    }

    /**
     * Displays the login page
     */
    public function actionLogin()
    {
        $this->pageTitle=Yii::app()->name . ' - '.Yii::t('tx','Login') ;
        $this->layout=FALSE;
        if (!Yii::app()->user->isGuest)
            $this->redirect('backend.php?r=site/index');
        $model = new LoginForm;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['LoginForm']))
        {
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login())
                $this->redirect(Yii::app()->user->returnUrl);
        }
        // display the login form
        $this->render('login', array('model' => $model));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout()
    {
        Yii::app()->user->logout();
        $url=Yii::app()->createUrl('site/login');
        $this->redirect($url);
    }

    public function actionDownload($name) {
        $upload_path = Yii::app()->basePath . '/../upload/';

        if (file_exists($upload_path . $name)) {
            Yii::app()->getRequest()->sendFile($name, file_get_contents($upload_path . $name));
        } else {
            $this->render('download404');
        }
    }

    public function actionUpfile()
    {
        if($_FILES) // check if file upload exist
        {
            $fecha = date('YmdHms');
            $target_path = Yii::app()->basePath.'/../upload/';  // directory in your server
            $ext_name=explode('.',basename($_FILES['upload']['name']));  // get extension from file upload
            $fname=$fecha.'.'.$ext_name[1];  // set your file name,
            $target_path = $target_path.$fname;  // save path and name file

            if(!file_exists("$target_path"))// if we have set target path
            {
                $message='';  // message variable, use to show message after upload file
                $url='';   // url variable, use to set url image in your editor
                $lower_ext=strtolower($ext_name[1]);  // check extension, validate type file
                if ($lower_ext!='jpg' && $lower_ext!='jpeg' && $lower_ext!='png' && $lower_ext!='gif')
                {
                    // if type file not allow
                    $message = Yii::t('tx','file type not allowed.');
                }
                else
                {
                    // upload file to server
                    move_uploaded_file($_FILES['upload']['tmp_name'], $target_path);
                    echo Yii::t('tx','uploading successed');
                    // url will save directory. Note it, url is different with target path
                    // url will use in your editor, it will direct access to the path
                    $url=Yii::app()->baseUrl.'/upload/'.$fname;
                }
                $funcNum = $_GET['CKEditorFuncNum'] ;
                // after save data, run code to call ckeditor function
                echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($funcNum, '$url', '$message');</script>";
            }
            else
            {
                echo 'file uploading error';
            }
        }
    }

    public function actionChangepassword()
    {
        $this->layout="//layouts/main";
        /*$fullAccessUsers=Yii::app()->components['authManager']->behaviors['auth']['admins'];
        foreach($fullAccessUsers as $u)
            if(Yii::app()->user->name===$u) return;*/

        $model=new ChangePasswordForm();
        if(isset($_POST['ChangePasswordForm']))
        {
            $model->attributes=$_POST['ChangePasswordForm'];
            if($model->validate()){
                $current_user=User::model()->findByAttributes(array("name"=>Yii::app()->user->name));
                if($current_user->password===$model->old_password){
                    $current_user->password=$model->new_password;
                    if($current_user->save()){
                        Yii::app()->user->setFlash('success', 'Your Password has changed successfully.');
                        $this->refresh();
                    }
                }else{
                    $model->addError('old_password',Yii::t('tx','Old Password is wrong.'));
                }
            }
        }
        $this->render('changepassword',array(
            'model'=>$model,
        ));
    }



}