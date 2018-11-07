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
                //make available field 1
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
            //make available field 0
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
        $model->guid=Helpers::getGUID();
        //should be inActive here then send an activation email but for now we let it active
        $model->clientStatus=ClientStatus::Active;
        $model->password= md5($model->password);
        $model->re_password= md5($model->re_password);

        if($model->validate(array('fname', 'lname','email','password', 're_password','clientType'))){
            $model->save();
            $this->_sendResponse(200, CJSON::encode("An account has been created successfully."));
        }else {
            $msg = "<h1>Error</h1>";
            $msg .= sprintf("Couldn't register your account.");
            $msg .= "<ul>";
            foreach($model->errors as $attribute=>$attr_errors) {
                $msg .= "<li>Field: $attribute</li>";
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


        (isset($_GET['city'])&&$_GET['city']!=="undefined"&&$_GET['city']!=="")?
            $criteria->addSearchCondition('city', $_GET['city']):'';

        if(isset($_GET['clientType'])&&$_GET['clientType']!=="undefined"&&$_GET['clientType']!==""){
            if($_GET['clientType']==0) { //free
                $criteria->addCondition('clientType=1');
            }else{
                $criteria->addInCondition('clientType', array(2,3));
            }
        }

        if(isset($_GET['competence'])&& $_GET['competence']!=="undefined" && $_GET['competence']!==""){
            $criteria->join='INNER JOIN competence_has_client chc ON chc.client_id=t.id';
            $criteria->addCondition('chc.competence_id='.$_GET['competence']);
        }
        if(isset($_GET['language'])&& $_GET['language']!=="undefined" && $_GET['language']!==""){
            $criteria->join=$criteria->join.' INNER JOIN language_has_client lhc ON lhc.client_id=t.id';
            $criteria->addCondition('lhc.language_id='.$_GET['language']);
        }

        //isset($_GET['quality'])? $criteria->addSearchCondition('quality', $_GET['quality']):'';

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
        $criteria->select="fname, lname, email, photo, country, city, address, level, clientStatus, clientType";
        $criteria->condition="id={$id}";
        $model = Client::model()->find($criteria);

        if(is_null($model))
            $this->_sendResponse(404, 'No Item found.');
        else{
            $result=array_filter($model->attributes);
            $result['photo']=$model->get_photo();
            $result['clientStatus']= Helpers::clientStatus($model->clientStatus);
            $result['clientType']=Helpers::clientType($model->clientType);
            $this->_sendResponse(200, CJSON::encode($result));
        }

    }
    public function actionCalls_history(){
        if(Yii::app()->user->isGuest)
            $this->_sendResponse(401, 'Error: You are not logged in.' );

        $model = Client::model()->findByPk(Yii::app()->user->id);
        $criteria=new CDbCriteria();
        $criteria->condition="sender="+$model->id+" or receiver="+$model->id;
        $calls = Calling::model()->findAll($criteria);

        if(is_null($calls))
            $this->_sendResponse(404, 'No Item found.');
        else{
            $returnedResult=array();
            foreach ($calls as $call){
                $sender=Client::model()->findByPk($call->sender);
                $receiver=Client::model()->findByPk($call->receiver);
                $icon=(Yii::app()->user->id==$call->sender?"<i class=\"fa fa-level-up green-color\"></i><small class=\"green-color\">Out-coming</small>":"<i class=\"fa fa-level-down red-color\"></i><small class=\"red-color\">Incoming</small>");
                $returnedResult[]=array(
                    "icon"=>$icon,
                    "id"=>$call->id,
                    "type"=>$call->type,
                    "start"=>$call->strat,
                    "end"=>$call->end,
                    "amount"=>$call->amount+"$",
                    "sender"=>$sender->fname,
                    "receiver"=>$receiver->fname
                );
            }
            $result['calls']=$returnedResult;
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
            $result=array("languages"=>$model->getLanguages(), "available"=>$model->getAvailableLanguage());
            $this->_sendResponse(200, CJSON::encode($result));
        }

    }
    public function actionCompetences(){
        if(Yii::app()->user->isGuest)
            $this->_sendResponse(401, 'Error: You are not logged in.' );

        $model = Client::model()->findByPk(Yii::app()->user->id);

        if(is_null($model->getCompetences()))
            $this->_sendResponse(404, 'No Item found.');
        else{
            $result=array("competences"=>$model->getCompetences(), "available"=>$model->getAvailableCompetences());
            $this->_sendResponse(200, CJSON::encode($result));
        }

    }


    public function actionSetting_update(){
        if(Yii::app()->user->isGuest)
            $this->_sendResponse(401, 'Error: You are not logged in.' );

        parse_str(file_get_contents("php://input"),$put_vars);

        $model = Client::model()->findByPk(Yii::app()->user->id);

        if($model === null)
            $this->_sendResponse(400,  sprintf("Error: something went wrong! Try later." ));

        $toUpdateAttributes=array('fname', 'lname','country','city','address');
        foreach($put_vars as $var=>$value) {
            if($model->hasAttribute($var)&& in_array($var,$toUpdateAttributes))
                $model->$var = $value;
            else {
                $this->_sendResponse(500,sprintf('Parameter <b>%s</b> is not allowed to edit.', $var) );
            }
        }
        if($model->saveAttributes($toUpdateAttributes))
            $this->_sendResponse(200, CJSON::encode("Updated successfully."));
        else{
            if(empty($model->getErrors())){
                $this->_sendResponse(200, CJSON::encode("Nothing change!"));
            }else{
                $msg = "<h1>Error</h1>";
                $msg .= "<ul>";
                foreach($model->errors as $attribute=>$attr_errors) {
                    $msg .= "<li>Attribute: $attribute</li>";
                    $msg .= "<ul>";
                    foreach($attr_errors as $attr_error)
                        $msg .= "<li>$attr_error</li>";
                    $msg .= "</ul>";
                }
                $msg .= "</ul>";
                $this->_sendResponse(500, $msg );
            }
        }

    }
    public function actionDelete_call(){
        if(Yii::app()->user->isGuest)
            $this->_sendResponse(401, 'Error: You are not logged in.' );
        $model = Calling::model()->findByPk($_GET['id']);

        if($model === null)
            $this->_sendResponse(400, sprintf("Error: item not found.") );

        if(Yii::app()->user->id===$model->receiver){
            $num = $model->delete();
            if($num>0)
                $this->_sendResponse(200, "Deleted successfully.");
            else
                $this->_sendResponse(500, sprintf("Error: Couldn't delete this item."));
        }else
            $this->_sendResponse(403, sprintf("Error: Couldn't delete this item."));
    }
    public function actionAdd_language(){
        if(Yii::app()->user->isGuest)
            $this->_sendResponse(401, 'Error: You are not logged in.' );

        if(!isset($_POST['id'])){
            $this->_sendResponse(401, 'Error: Language id is missing!' );
        }else{
            $language = Language::model()->findByPk($_POST['id']);
            if(empty($language)){
                $this->_sendResponse(401, 'Error: Wrong language id!' );
            }else{
                $model = new LanguageHasClient();
                $model->client_id = Yii::app()->user->id;
                $model->language_id = $_POST['id'];
                if($model->save())
                    $this->_sendResponse(200, CJSON::encode("Language added successfully."));
                else {
                    $msg = "<h1>Error</h1>";
                    $msg .= sprintf("Couldn't add the Language.");
                    $msg .= "<ul>";
                    foreach($model->errors as $attribute=>$attr_errors) {
                        $msg .= "<li>Attribute: $attribute</li>";
                        $msg .= "<ul>";
                        foreach($attr_errors as $attr_error)
                            $msg .= "<li>$attr_error</li>";
                        $msg .= "</ul>";
                    }
                    $msg .= "</ul>";
                    $this->_sendResponse(500, $msg );
                }
            }
        }
    }
    public function actionDelete_language(){
        if(Yii::app()->user->isGuest)
            $this->_sendResponse(401, 'Error: You are not logged in.' );

        $method = $_SERVER['REQUEST_METHOD'];
        $model=null;
        if ('DELETE' === $method) {
            parse_str(file_get_contents('php://input'), $_DELETE);
            $model = LanguageHasClient::model()->findByPk($_DELETE['id']);
        }

        if($model === null)
            $this->_sendResponse(400, sprintf("Error: item not found.") );

        if(Yii::app()->user->id===$model->client_id){
            $num = $model->delete();
            if($num>0)
                $this->_sendResponse(200, "Deleted successfully.");
            else
                $this->_sendResponse(500, sprintf("Error: Couldn't delete this item."));
        }else
            $this->_sendResponse(403, sprintf("Error: Couldn't delete this item."));
    }
    public function actionAdd_competence(){
        if(Yii::app()->user->isGuest)
            $this->_sendResponse(401, 'Error: You are not logged in.' );

        if(!isset($_POST['id'])){
            $this->_sendResponse(401, 'Error: competence id is missing!' );
        }else{
            $competence = Competence::model()->findByPk($_POST['id']);
            if(empty($competence)){
                $this->_sendResponse(401, 'Error: Wrong competence id!' );
            }else{
                $model = new CompetenceHasClient();
                $model->client_id = Yii::app()->user->id;
                $model->competence_id = $_POST['id'];
                if($model->save())
                    $this->_sendResponse(200, CJSON::encode("Competence added successfully."));
                else {
                    $msg = "<h1>Error</h1>";
                    $msg .= sprintf("Couldn't add the competence.");
                    $msg .= "<ul>";
                    foreach($model->errors as $attribute=>$attr_errors) {
                        $msg .= "<li>Attribute: $attribute</li>";
                        $msg .= "<ul>";
                        foreach($attr_errors as $attr_error)
                            $msg .= "<li>$attr_error</li>";
                        $msg .= "</ul>";
                    }
                    $msg .= "</ul>";
                    $this->_sendResponse(500, $msg );
                }
            }
        }
    }
    public function actionDelete_competence(){
        if(Yii::app()->user->isGuest)
            $this->_sendResponse(401, 'Error: You are not logged in.' );
        $method = $_SERVER['REQUEST_METHOD'];
        $model=null;
        if ('DELETE' === $method) {
            parse_str(file_get_contents('php://input'), $_DELETE);
            $model = CompetenceHasClient::model()->findByPk($_DELETE['id']);
        }

        if($model === null)
            $this->_sendResponse(400, sprintf("Error: item not found.") );

        if(Yii::app()->user->id===$model->client_id){
            $num = $model->delete();
            if($num>0)
                $this->_sendResponse(200, "Deleted successfully.");
            else
                $this->_sendResponse(500, sprintf("Error: Couldn't delete this item."));
        }else
            $this->_sendResponse(403, sprintf("Error: Couldn't delete this item."));
    }


    public function actionProfile_image_upload(){
        if(Yii::app()->request->isPostRequest && !Yii::app()->user->isGuest) {
            $returned = array();
            $max_size=2097152;
            if(isset($_FILES['profile_image'])) {
                $model=Client::model()->findByPk(Yii::app()->user->id);
                if($model!=null){
                    $valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp');
                    $path = Yii::app()->basePath."/../upload/";
                    $doc = $_FILES['profile_image']['name'];
                    $tmp = $_FILES['profile_image']['tmp_name'];
                    $size= $_FILES['profile_image']['size'];
                    $ext = strtolower(pathinfo($doc, PATHINFO_EXTENSION));
                    $final_doc = rand(1000,1000000).$doc;
                    if(in_array($ext, $valid_extensions)&&$size<=$max_size)
                    {
                        $path = $path.strtolower($final_doc);
                        if(move_uploaded_file($tmp,$path))
                        {
                            $model->photo=strtolower($final_doc);
                            $returned['image_url']= $model->_photo;
                        }
                    }else{
                        $returned = array();
                        $message="";
                        if(!in_array($ext, $valid_extensions)) $message="Not accept image type!";
                        if(!in_array($ext, $valid_extensions)&&$size>$max_size) $message.=" and ";
                        if($size>$max_size) $message.="file size must be less than 2 MB";
                        $returned['error'] = $message;
                        echo CJSON::encode($returned);
                        Yii::app()->end();
                    }
                    if ($model->save(false,array('photo'))) {
                        $returned['success'] = 'Success';
                    } else {
                        $temp = '';
                        foreach ($model->getErrors() as $key => $value)
                            $temp .= '<li>' . $value[0] . '</li>';
                        $returned['error'] = '<ul>' . $temp . '</ul>';
                    }
                    echo CJSON::encode($returned);
                    Yii::app()->end();
                }else{
                    $returned = array();
                    $returned['error'] = "Your Account is not Activated yet!";
                    echo CJSON::encode($returned);
                    Yii::app()->end();
                }
            }else {
                $returned = array();
                $returned['error'] = "Invalid request. Please do not repeat this request again.";
                echo CJSON::encode($returned);
                Yii::app()->end();
            }
        }else
            throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
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
