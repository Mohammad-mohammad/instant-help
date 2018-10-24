<?php

class ApiController extends Controller
{
	//public $layout='//layouts/main';

    Const APPLICATION_ID = 'INSTHP';

    private $format = 'json';


    public function actionLogin()
    {
        if (!Yii::app()->user->isGuest){
            $this->_sendResponse(400, sprintf('You have been already logged in.'));
            Yii::app()->end();
        }
        $model = new ClientLoginForm;

        if(!(isset($_POST['email']) && isset($_POST['password'])))
        {
            $this->_sendResponse(401, sprintf('Error: Email or Password is invalid.'));

        }else{
            $model->email = $_POST['email'];
            $model->password= $_POST['password'];
            if ($model->validate()&& $model->login()){
                $this->_sendResponse(200, sprintf('You logged in successfully.'));
            }else {
                $this->_sendResponse(401, sprintf('Error: Email or Password is invalid.'));
            }
        }
        Yii::app()->end();
    }

    public function actionLogout()
    {
        if (!Yii::app()->user->isGuest){
            Yii::app()->user->logout();
            $this->_sendResponse(200, sprintf('Logged out successfully.'));
            Yii::app()->end();
        }
        else{
            $this->_sendResponse(401, sprintf('You are not logged in.'));

        }
        Yii::app()->end();
    }


    public function actionRegister()
    {
        /*switch($_GET['model'])
        {
            case 'client':
                $model = new Client();
                break;
            default:
                $this->_sendResponse(501, sprintf('Mode <b>create</b> is not implemented for model <b>%s</b>', $_GET['model']) );
                Yii::app()->end();
        }*/
        $model = new Client();
        foreach($_POST as $var=>$value) {
            if($var=="re_password"||$model->hasAttribute($var))
                $model->$var = $value;
            else
                $this->_sendResponse(500, sprintf('Parameter <b>%s</b> is not allowed for model <b>%s</b>', $var, 'user register.') );
        }
        if($model->validate(array('fname', 'lname','email','password', 're_password','clientType'))){
            $model->guid=Helpers::getGUID();
            //should be inActive here then send an activation email but for now we let it active
            $model->clientStatus=ClientStatus::Active;
            $model->password= md5($model->password);
            $model->save();
            //send activation email to the user
            $this->_sendResponse(200, CJSON::encode("An account has been created successfully."));
        }else {
            $msg = "<h1>Error</h1>";
            $msg .= sprintf("Couldn't create model <b>%s</b>", 'user');
            $msg .= "<ul>";
            foreach($model->errors as $attribute=>$attr_errors) {
                $msg .= "<li>Attribute: $attribute</li>";
                $msg .= "<ul>";
                foreach($attr_errors as $attr_error)
                    $msg .= "<li>$attr_error</li>";
                $msg .= "</ul>";
            }
            $msg .= "</ul>";
            $this->_sendResponse(400, $msg );
        }
    }


    public function actionSearch()
    {
        $criteria = new CDbCriteria();

        $criteria->select='t.id, t.fname, t.lname, t.email, t.photo, clientType';

        isset($_GET['city'])?
            $criteria->addSearchCondition('city', $_GET['city']):'';

        if(isset($_GET['competence'])&& $_GET['competence']!=="undefined" && $_GET['competence']!==""){
            $criteria->join='LEFT JOIN competence_has_client chc ON chc.client_id=t.id';
            $criteria->addCondition('chc.competence_id='.$_GET['competence']);
        }
        if(isset($_GET['language'])&& $_GET['language']!=="undefined" && $_GET['language']!==""){
            $criteria->join=$criteria->join.' LEFT JOIN language_has_client lhc ON lhc.client_id=t.id';
            $criteria->addCondition('lhc.language_id='.$_GET['language']);
        }

        isset($_GET['service_type'])? $criteria->addCondition('clientType='.$_GET['service_type']):'';

        isset($_GET['quality'])? $criteria->addSearchCondition('city', $_GET['city']):'';

        $criteria->addCondition('clientStatus='.ClientStatus::Active); //not Blocked or inactive
        $criteria->addCondition('available=1'); //is available
        $criteria->order="level DESC";

        $models = Client::model()->findAll($criteria);

        if(empty($models)) {
            $this->_sendResponse(200, sprintf('No items where found for this search.') );
        } else {
            $rows = array();
            foreach($models as $model){
                $rows[] = $model->getSearchAttribute();
            }
            $this->_sendResponse(200, CJSON::encode($rows));
        }
    }


    public function actionProfile(){
        if(Yii::app()->user->isGuest)
            $this->_sendResponse(401, 'Error: You are not logged in.' );

        $id=Yii::app()->user->id;
        $criteria= new CDbCriteria();
        $criteria->select="fname, lname, email, country, city, address, level, clientStatus, clientType";
        $criteria->condition="id={$id}";
        $model = Client::model()->find($criteria);

        if(is_null($model))
            $this->_sendResponse(404, 'No Item found.');
        else{
            $result=array_filter($model->attributes);
            $result['clientStatus']= Helpers::clientStatus($model->clientStatus);
            $result['clientType']=Helpers::clientType($model->clientType);
            $this->_sendResponse(200, CJSON::encode($result));
        }

    }
    public function actionCalls_history(){
        if(Yii::app()->user->isGuest)
            $this->_sendResponse(401, 'Error: You are not logged in.' );

        $model = Client::model()->findByPk(Yii::app()->user->id);
        $calls = Calling::model()->findAllByAttributes(array('receiver'=>$model->id));

        if(is_null($calls))
            $this->_sendResponse(404, 'No Item found.');
        else{
            $result=$calls;
            $result['count']= count($calls);
            $this->_sendResponse(200, CJSON::encode($result));
        }

    }
    public function actionLanguages(){
        if(Yii::app()->user->isGuest)
            $this->_sendResponse(401, 'Error: You are not logged in.' );

        $model = Client::model()->findByPk(Yii::app()->user->id);

        if(is_null($model->getLanguages()))
            $this->_sendResponse(404, 'No Item found.');
        else{
            $this->_sendResponse(200, CJSON::encode($model->getLanguages()));
        }

    }
    public function actionCompetences(){
        if(Yii::app()->user->isGuest)
            $this->_sendResponse(401, 'Error: You are not logged in.' );

        $model = Client::model()->findByPk(Yii::app()->user->id);

        if(is_null($model->getCompetences()))
            $this->_sendResponse(404, 'No Item found.');
        else{
            $this->_sendResponse(200, CJSON::encode($model->getCompetences()));
        }

    }

    
    private function _sendResponse($status = 200, $body = '', $content_type = 'text/html')
    {
        $status_header = 'HTTP/1.1 ' . $status . ' ' . $this->_getStatusCodeMessage($status);
        header($status_header);
        header('Content-type: ' . $content_type);
        if($body != '')
        {
            echo $body;
        }else
        {
            $message = '';
            switch($status)
            {
                case 401:
                    $message = 'You must be authorized to view this page.';
                    break;
                case 404:
                    $message = 'The requested URL ' . $_SERVER['REQUEST_URI'] . ' was not found.';
                    break;
                case 500:
                    $message = 'The server encountered an error processing your request.';
                    break;
                case 501:
                    $message = 'The requested method is not implemented.';
                    break;
            }

            $signature = ($_SERVER['SERVER_SIGNATURE'] == '') ? $_SERVER['SERVER_SOFTWARE'] . ' Server at ' . $_SERVER['SERVER_NAME'] . ' Port ' . $_SERVER['SERVER_PORT'] : $_SERVER['SERVER_SIGNATURE'];
            $body = '
                <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
                <html>
                <head>
                    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
                    <title>' . $status . ' ' . $this->_getStatusCodeMessage($status) . '</title>
                </head>
                <body>
                    <h1>' . $this->_getStatusCodeMessage($status) . '</h1>
                    <p>' . $message . '</p>
                    <hr />
                    <address>' . $signature . '</address>
                </body>
                </html>';
            echo $body;
        }
        Yii::app()->end();
    }

    private function _getStatusCodeMessage($status)
    {
        $codes = Array(
            200 => 'OK',
            400 => 'Bad Request',
            401 => 'Unauthorized',
            402 => 'Payment Required',
            403 => 'Forbidden',
            404 => 'Not Found',
            500 => 'Internal Server Error',
            501 => 'Not Implemented',
        );
        return (isset($codes[$status])) ? $codes[$status] : '';
    }

    private function _checkAuth()
    {
        if(!(isset($_SERVER['PHP_AUTH_USER']) and isset($_SERVER['PHP_AUTH_PW']))) {
            // Error: Unauthorized
            $this->_sendResponse(401);
        }
        $username = $_SERVER['PHP_AUTH_USER'];
        $password = $_SERVER['PHP_AUTH_PW'];

        $user=Client::model()->find('LOWER(email)=?',array(strtolower($username)));
        if($user===null) {
            $this->_sendResponse(401, 'Error: User Name is invalid');
        } else if($user->password!==md5($password)) {
            $this->_sendResponse(401, 'Error: User Password is invalid');
        }
    }

}
