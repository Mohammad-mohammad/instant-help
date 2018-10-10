<?php

class UserController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/main';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			//'accessControl', // perform access control for CRUD operations
            array('auth.filters.AuthFilter'),
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index', 'view', 'ajaxupdate','create','update','admin', 'delete'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new User;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
            $model->password=md5($model->password);
            $model->image = CUploadedFile::getInstance($model, 'image');
            Helpers::uploadFile($model, 'image');
            if($model->save()){
                Yii::import('application.modules.auth.models.AddAuthItemForm');
                $am = Yii::app()->getAuthManager();
                $fModel = new AddAuthItemForm();
                $fModel->items = $_POST['authItem'];
                if ($fModel->validate())
                {
                    if (!$am->isAssigned($fModel->items, $model->id))
                    {
                        $am->assign($fModel->items, $model->id);
                        if ($am instanceof CPhpAuthManager)
                            $am->save();

                        if ($am instanceof ICachedAuthManager)
                            $am->flushAccess($fModel->items, $model->id);
                    }
                }
                $this->redirect(array('view','id'=>$model->id));
            }

		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model=$this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['User']))
        {
            $changePass=false;
            if($_POST['User']['password']!=$model->password) $changePass=true;
            $model->attributes=$_POST['User'];
            if($changePass) $model->password=  md5($model->password);
            $model2 = $this->loadModel($id);
            $model->image = CUploadedFile::getInstance($model, 'image');
            Helpers::updateFile($model, $model2, 'image');

            if($model->save()){
                Yii::import('application.modules.auth.models.AddAuthItemForm');
                $am = Yii::app()->getAuthManager();
                $fModel = new AddAuthItemForm();
                $fModel->items = $_POST['authItem'];
                if ($fModel->validate())
                {
                    if (!$am->isAssigned($fModel->items, $model->id))
                    {
                        $am->assign($fModel->items, $model->id);
                        if ($am instanceof CPhpAuthManager)
                            $am->save();

                        if ($am instanceof ICachedAuthManager)
                            $am->flushAccess($fModel->items, $model->id);
                    }
                }
                $this->redirect(array('view','id'=>$model->id));
            }

        }

        $this->render('update',array(
            'model'=>$model,
        ));
    }

    /**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,Yii::t('tx','Invalid request. Please do not repeat this request again.'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('User');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new User('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['User']))
			$model->attributes=$_GET['User'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=User::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,Yii::t('tx','The requested page does not exist.'));
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

    public function actionAjaxupdate() {
        $act = $_GET['act'];
        $autoIdAll = $_POST['selectedIds'];
        if (count($autoIdAll) > 0) {
                    if ($act == 'doDelete'){
                foreach ($autoIdAll as $autoId) {
                    $model = $this->loadModel($autoId);
                    $model->delete();
                }
            }
        }
    }
}
