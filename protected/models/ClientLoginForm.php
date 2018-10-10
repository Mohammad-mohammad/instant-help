<?php


class ClientLoginForm extends CFormModel
{
	public $email;
	public $password;

	private $_identity;


	public function rules()
	{
		return array(
			array('email, password', 'required'),
			array('email', 'email'),
			array('password', 'authenticate'),
		);
	}


	public function attributeLabels()
	{
		return array(
            'email'=>  Yii::t('tx','email'),
            'password'=>  Yii::t('tx', 'password'),

		);
	}


	public function authenticate($attribute,$params)
	{
		if(!$this->hasErrors())
		{
			$this->_identity=new ClientIdentity($this->email,$this->password);
			if(!$this->_identity->authenticate())
				//$this->addError('password',Yii::t('tx','Incorrect email or password.'));
				$this->addError('password',$this->_identity->errorCode);
		}
	}


	public function login()
	{
		if($this->_identity===null)
		{
			$this->_identity=new ClientIdentity($this->email,$this->password);
			$this->_identity->authenticate();
		}
		if($this->_identity->errorCode===ClientIdentity::ERROR_NONE)
		{
			//$duration=$this->rememberMe ? 3600*24*30 : 0; // 30 days
			$duration= 3600*24*30; // 30 days
			Yii::app()->user->login($this->_identity,$duration);
			return true;
		}
		else
			return false;
	}
}
