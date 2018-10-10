<?php


class ClientIdentity extends CUserIdentity {

    private $_id;

    public function authenticate() {

         $user = Client::model()->findByAttributes(array('email' => $this->username));
         if ($user === null)
             $this->errorCode = self::ERROR_USERNAME_INVALID;
         else if ($user->email!==$this->username)
             $this->errorCode = self::ERROR_USERNAME_INVALID;
         else if ($user->password !== md5($this->password))
             $this->errorCode = self::ERROR_PASSWORD_INVALID;
         else {
             $this->_id = $user->id;
             //$this->setState('lastLoginTime', $user->lastLoginTime);
             $this->errorCode = self::ERROR_NONE;
         }

        return !$this->errorCode;
    }

    public function getId() {
        return $this->_id;
    }
}