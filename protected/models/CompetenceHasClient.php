<?php

/**
 * This is the model class for table "competence_has_client".
 *
 * The followings are the available columns in table 'competence_has_client':
 * @property integer $id
 * @property integer $competence_id
 * @property integer $client_id
 *
 * The followings are the available model relations:
 * @property Client $client
 * @property Competence $competence
 */
class CompetenceHasClient extends CActiveRecord
{
    public $oldClientId;
    public $oldCompetence_id;

    /**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'competence_has_client';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('competence_id, client_id', 'required'),
			array('competence_id, client_id', 'numerical', 'integerOnly'=>true),
            array('competence_id', 'checkUniqueness'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, competence_id, client_id', 'safe', 'on'=>'search'),
		);
	}

    public function checkUniqueness($attribute,$params)
    {
        if($this->client_id !== $this->oldClientId && $this->competence_id !== $this->oldCompetence_id)
        {
            $model = CompetenceHasClient::model()->findAllByAttributes(array('competence_id'=>$this->competence_id, 'client_id'=>$this->client_id));
            if($model != null)
                $this->addError('competence_id','This competence is already exist');
        }
    }

    protected function afterFind()
    {
        parent::afterFind();
        $this->oldClientId = $this->client_id;
        $this->oldCompetence_id = $this->competence_id;
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
			'competence' => array(self::BELONGS_TO, 'Competence', 'competence_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('tx', 'ID'),
			'competence_id' => Yii::t('tx', 'Competence'),
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
		$criteria->compare('competence_id',$this->competence_id);
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
	 * @return CompetenceHasClient the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function getUrl() {
        return Yii::app()->createUrl('CompetenceHasClient/view', array('id' => $this->id));
    }
    public function getA_Url() {
        return Yii::app()->createAbsoluteUrl('CompetenceHasClient/view', array('id' => $this->id));
    }





}
