<?php

/**
 * This is the model class for table "language_has_client".
 *
 * The followings are the available columns in table 'language_has_client':
 * @property integer $id
 * @property integer $language_id
 * @property integer $client_id
 *
 * The followings are the available model relations:
 * @property Client $client
 * @property Language $language
 */
class LanguageHasClient extends CActiveRecord
{
    public $oldClientId;
    public $oldLanguageId;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'language_has_client';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('language_id, client_id', 'required'),
			array('language_id, client_id', 'numerical', 'integerOnly'=>true),
            array('language_id', 'checkUniqueness'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, language_id, client_id', 'safe', 'on'=>'search'),
		);
	}

    public function checkUniqueness($attribute,$params)
    {
        if($this->client_id !== $this->oldClientId && $this->language_id !== $this->oldLanguageId)
        {
            $model = LanguageHasClient::model()->findAllByAttributes(array('language_id'=>$this->language_id, 'client_id'=>$this->client_id));
            if($model != null)
                $this->addError('language_id','This language is already exist');
        }
    }

    protected function afterFind()
    {
        parent::afterFind();
        $this->oldClientId = $this->client_id;
        $this->oldLanguageId = $this->language_id;
    }
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'client' => array(self::BELONGS_TO, 'Client', 'client_id'),
			'language' => array(self::BELONGS_TO, 'Language', 'language_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('tx', 'ID'),
			'language_id' => Yii::t('tx', 'Language'),
			'client_id' => Yii::t('tx', 'Client'),
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
		$criteria->compare('language_id',$this->language_id);
		$criteria->compare('client_id',$this->client_id);

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
	 * @return LanguageHasClient the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function getUrl() {
        return Yii::app()->createUrl('LanguageHasClient/view', array('id' => $this->id));
    }
    public function getA_Url() {
        return Yii::app()->createAbsoluteUrl('LanguageHasClient/view', array('id' => $this->id));
    }





}
