<?php

class SiteController extends Controller
{
    public $layout='//layouts/main';

    public function actions()
    {
        return array(
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            
        );
    }

    public function actionIndex()
    {

        $this->pageTitle = "Home";
        $this->render('index' );
    }

    public function actionSign(){
        if (!Yii::app()->user->isGuest){
            $this->redirect(array('site/profile'));
        }
        $this->pageTitle="Login - Register";
        $this->render('sign');
    }

    public function actionSearch(){
        if (Yii::app()->user->isGuest){
            $this->redirect(array('site/index'));
        }
        $this->pageTitle= "Search for help";
        $this->render('search' );
    }

    public function actionProfile(){
        if (Yii::app()->user->isGuest){
            $this->redirect(array('site/index'));
        }
        $this->pageTitle="My Profile";
        $this->render('profile');
    }

    public function actionCallhistory(){
        $this->pageTitle="Call History";
        $this->render('callhistory');
    }

    public function actionCompetences(){
        $this->pageTitle="Edit Competences";
        $this->render('competences');
    }

    public function actionLanguages(){
        $this->pageTitle="Edit Languages";
        $this->render('languages');
    }

    public function actionCards(){
        $this->pageTitle="Edit Bank Cards";
        $this->render('cards');
    }

    public function actionContact(){
        $this->pageTitle="Contact";
        $this->render('contact');
    }

    public function actionAbout(){
        $this->pageTitle="About us";
        $this->render('about');
    }

    public function actionPolicy(){
        $this->pageTitle="Privacy Policy";
        $this->render('policy');
    }

    public function actionTerms(){
        $this->pageTitle="Terms of Use";
        $this->render('terms');
    }


    public function actionError()
    {
        $this->pageTitle = "Error";
        $this->layout="main";
        Yii::app()->language = 'en';
        if ($error = Yii::app()->errorHandler->error)
        {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    public function actionDownload($name){

        $upload_path = Yii::app()->basePath . '/../upload/';

        if (file_exists($upload_path . $name)) {
            Yii::app()->getRequest()->sendFile($name, file_get_contents($upload_path . $name));
        } else {
            $this->render('error');
        }
    }
        
}