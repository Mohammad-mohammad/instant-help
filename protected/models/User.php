<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $name
 * @property string $password
 * @property string $lastLoginTime
 * @property string $salt
 * @property string $email
 * @property string $image
 * @property string $profile
 */
class User extends CActiveRecord
{
    const WEAK = 0;
    const STRONG = 1;

    /**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, password', 'required'),
			array('name, password, lastLoginTime, salt, email, profile', 'length', 'max'=>100),
            array('name','unique', 'message'=>Yii::t('tx','This Name is already exists.')),
            array('name', 'NotSuperAdmin'),
            array('image', 'length', 'max'=>200),
            array('image', 'file', 'types' => 'jpeg, png, gif, jpg', 'allowEmpty' => TRUE, 'on' => 'update'),
            array('image', 'file', 'types' => 'jpeg, png, gif, jpg', 'allowEmpty' => FALSE, 'on' => 'create'),
            //array('password', 'passwordStrength', 'strength'=>self::STRONG),
            // The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, password, lastLoginTime, salt, email, profile', 'safe', 'on'=>'search'),
		);
	}

    public function passwordStrength($attribute,$params)
    {
        if ($params['strength'] === self::WEAK)
            $pattern = '/^(?=.*[a-zA-Z0-9]).{5,}$/';
        elseif ($params['strength'] === self::STRONG)
            $pattern = '/^(?=.*\d(?=.*\d))(?=.*[a-zA-Z](?=.*[a-zA-Z])).{5,}$/';

        if(!preg_match($pattern, $this->$attribute))
            $this->addError($attribute, Yii::t('tx','The password is not strong enough!'));
    }

    public function NotSuperAdmin($attribute,$params){
        $fullAccessUsers=Yii::app()->components['authManager']->behaviors['auth']['admins'];
        foreach($fullAccessUsers as $fu)
            if($fu===$this->$attribute)
                $this->addError($attribute, Yii::t('tx','Name cannot be '.$fu.'.'));
    }

    public function getAuthName(){
        $am = Yii::app()->getAuthManager();
        $roles=$am->getRoles($this->id);
        $results=array();
        foreach ($roles as $itemR)
        {
            $results[]=$itemR->description;
        }
        return implode(' , ',$results);
    }

    /**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('tx', 'ID'),
			'name' => Yii::t('tx', 'Name'),
			'password' => Yii::t('tx', 'Password'),
			'lastLoginTime' => Yii::t('tx', 'Last Login Time'),
			'salt' => Yii::t('tx', 'Salt'),
			'image' => Yii::t('tx', 'Image'),
			'authName' => Yii::t('tx', 'authName'),
			'email' => Yii::t('tx', 'Email'),
			'profile' => Yii::t('tx', 'Profile'),
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('lastLoginTime',$this->lastLoginTime,true);
		$criteria->compare('salt',$this->salt,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('profile',$this->profile,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'sort' => array('defaultOrder' => 'id DESC'),
            'pagination' => array('pageSize' => 25),
		));
	}

    public function getUrl() {
        return Yii::app()->createUrl('User/view', array('id' => $this->id));
    }
    public function getA_Url() {
        return Yii::app()->createAbsoluteUrl('User/view', array('id' => $this->id));
    }



    public function get_image() {
        return Yii::app()->baseUrl . "/upload/" . $this->image;
    }

    public function getAbsoluteimage(){
        return Yii::getpathOfAlias('webroot')."/upload/".$this->image;
    }

    public function afterDelete() {
        parent::afterDelete();
        $img_image = Yii::app()->basePath . '/../upload/' . $this->image;
        if (file_exists($img_image) && $this->image)
            unlink($img_image);
    }


}