<?php

/**
 * This is the model class for table "client".
 *
 * The followings are the available columns in table 'client':
 * @property integer $id
 * @property string $guid
 * @property string $fname
 * @property string $lname
 * @property string $email
 * @property string $password
 * @property string $photo
 * @property string $country
 * @property string $city
 * @property string $address
 * @property integer $clientStatus
 * @property integer $level
 * @property integer $available
 * @property integer $clientType
 * @property string $bankaccount
 *
 * The followings are the available model relations:
 * @property Balance[] $balances
 * @property Calling[] $callings
 * @property Calling[] $callings1
 * @property CompetenceHasClient[] $competenceHasClients
 * @property LanguageHasClient[] $languageHasClients
 */
class Client extends CActiveRecord
{
    public $re_password;
    public $received_call_count;
    /**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'client';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('guid, fname, lname, email, password, re_password, clientStatus, clientType', 'required'),
			array('clientStatus, level, available, clientType', 'numerical', 'integerOnly'=>true),
			array('guid', 'length', 'max'=>100),
            array('email', 'email'),
            array('email', 'unique'),
            array('password', 'compare', 'compareAttribute' => 're_password'),
            array('clientType', 'compare', 'compareValue' => 1, 'operator' => '>='),
            array('clientType', 'compare', 'compareValue' => 3, 'operator' => '<='),
            array('fname, lname, email, password, photo, country, city, address, bankaccount', 'length', 'max'=>45),
			array('photo', 'file', 'types' => 'jpeg, png, gif, jpg, mpg', 'allowEmpty' => true, 'except'=>'except_photo'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, guid, fname, lname, email, password, photo, country, city, address, clientStatus, level, available, clientType, bankaccount', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'balances' => array(self::HAS_MANY, 'Balance', 'client_id'),
			'callings' => array(self::HAS_MANY, 'Calling', 'sender'),
			'callings1' => array(self::HAS_MANY, 'Calling', 'receiver'),
			'competenceHasClients' => array(self::HAS_MANY, 'CompetenceHasClient', 'client_id'),
			'languageHasClients' => array(self::HAS_MANY, 'LanguageHasClient', 'client_id'),
		);
	}

	public function getSearchAttribute(){
	    $result = array_filter($this->attributes);
	    $result['full_address'] = $this->getFull_address();
	    $result['rating']= $this->getRating();
	    $result['clientType']= Helpers::clientType($this->clientType);
	    $result['competences']=$this->getCompetences();
	    $result['languages']=$this->getLanguages();
	    $result['received_call_count']=$this->received_call_count;
        return $result;
    }
    public function getCompetences(){
	    $criteria= new CDbCriteria();
	    $criteria->select="t.name";
	    $criteria->join='LEFT JOIN competence_has_client chc ON chc.competence_id=t.id';
	    $criteria->addCondition('chc.client_id='.$this->id);
	    $models= Competence::model()->findAll($criteria);
	    $result=array();
        foreach ($models as $model){
            $result[]=$model->name;
        }
	    return $result;
    }
    public function getLanguages(){
        $criteria= new CDbCriteria();
        $criteria->select="t.name";
        $criteria->join='LEFT JOIN language_has_client lhc ON lhc.language_id=t.id';
        $criteria->addCondition('lhc.client_id='.$this->id);
        $models= Language::model()->findAll($criteria);
        $result=array();
        foreach ($models as $model){
            $result[]=$model->name;
        }
        return $result;
    }
    public function getFull_address(){
        $model= Client::model()->findByPk($this->id);
        $result=array();
        $result[]=$model->country;
        $result[]=$model->city;
        $result[]=$model->address;
        $result=array_filter($result);
        return implode(', ',$result);
    }
    public function getRating(){
	    $models=Calling::model()->findAllByAttributes(array('receiver'=>$this->id));
	    $count=0;
	    $result=0;
	    foreach ($models as $model){
	        $count++;
	        $result=$result+$model->amount;
        }
        $this->received_call_count=$count;
        return $count===0?0:round($result/$count, 1);
    }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('tx', 'ID'),
			'guid' => Yii::t('tx', 'Guid'),
			'fname' => Yii::t('tx', 'Fname'),
			'lname' => Yii::t('tx', 'Lname'),
			'email' => Yii::t('tx', 'Email'),
			'password' => Yii::t('tx', 'Password'),
			'photo' => Yii::t('tx', 'Photo'),
			'country' => Yii::t('tx', 'Country'),
			'city' => Yii::t('tx', 'City'),
			'address' => Yii::t('tx', 'Address'),
			'clientStatus' => Yii::t('tx', 'Client Status'),
			'level' => Yii::t('tx', 'Level'),
			'available' => Yii::t('tx', 'Available'),
			'clientType' => Yii::t('tx', 'Client Type'),
			'bankaccount' => Yii::t('tx', 'Bankaccount'),
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('guid',$this->guid,true);
		$criteria->compare('fname',$this->fname,true);
		$criteria->compare('lname',$this->lname,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('photo',$this->photo,true);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('clientStatus',$this->clientStatus);
		$criteria->compare('level',$this->level);
		$criteria->compare('available',$this->available);
		$criteria->compare('clientType',$this->clientType);
		$criteria->compare('bankaccount',$this->bankaccount,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'sort' => array('defaultOrder' => 'id DESC'),
            'pagination' => array('pageSize' => 25),
		    ));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Client the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function getUrl() {
        return Yii::app()->createUrl('Client/view', array('id' => $this->id));
    }
    public function getA_Url() {
        return Yii::app()->createAbsoluteUrl('Client/view', array('id' => $this->id));
    }



    public function get_photo() {
        return Yii::app()->baseUrl . "/upload/" . $this->photo;
    }

    public function getAbsolutephoto(){
        return Yii::getpathOfAlias('webroot')."/upload/".$this->photo;
    }

    public function afterDelete() {
        parent::afterDelete();
        $img_photo = Yii::app()->basePath . '/../upload/' . $this->photo;
        if (file_exists($img_photo) && $this->photo)
            unlink($img_photo);
    }

}
