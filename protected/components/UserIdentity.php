<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity {

    private $_id;

    public function authenticate() {
        $fullAccessUsers=Yii::app()->components['authManager']->behaviors['auth']['admins'];
        if(count($fullAccessUsers)!=0)
            if($this->username===$fullAccessUsers[0]){
                if($this->password !== Yii::app()->params['superAdmin']){
                    $this->errorCode = self::ERROR_PASSWORD_INVALID;
                }else {
                    $this->_id = $fullAccessUsers[0];
                    $this->errorCode = self::ERROR_NONE;
                }
            }else{
                $user = User::model()->findByAttributes(array('name' => $this->username));
                if ($user === null)
                    $this->errorCode = self::ERROR_USERNAME_INVALID;
                else if ($user->name!==$this->username)
                    $this->errorCode = self::ERROR_USERNAME_INVALID;
                else if ($user->password !== md5($this->password))
                    $this->errorCode = self::ERROR_PASSWORD_INVALID;
                else {
                    $this->_id = $user->id;
                    $this->setState('lastLoginTime', $user->lastLoginTime);
                    $this->errorCode = self::ERROR_NONE;
                }
            }
        return !$this->errorCode;
    }

    public function getId() {
        return $this->_id;
    }

    /**
     * Authenticates a user.
     * The example implementation makes sure if the username and password
     * are both 'demo'.
     * In practical applications, this should be changed to authenticate
     * against some persistent user identity storage (e.g. database).
     * @return boolean whether authentication succeeds.

    public function authenticate()
    {
    $users=array(
    // username => password
    'demo'=>'demo',
    'admin'=>'admin',
    );
    if(!isset($users[$this->username]))
    $this->errorCode=self::ERROR_USERNAME_INVALID;
    else if($users[$this->username]!==$this->password)
    $this->errorCode=self::ERROR_PASSWORD_INVALID;
    else
    $this->errorCode=self::ERROR_NONE;
    return !$this->errorCode;
    } */
}