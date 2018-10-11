<?php

/**
 * This is the model class for table "calling".
 *
 * The followings are the available columns in table 'calling':
 * @property integer $id
 * @property string $type
 * @property string $strat
 * @property string $end
 * @property double $amount
 * @property integer $sender
 * @property integer $receiver
 *
 * The followings are the available model relations:
 * @property Client $sender0
 * @property Client $receiver0
 */
class Calling extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'calling';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('type, strat, sender, receiver', 'required'),
			array('sender, receiver', 'numerical', 'integerOnly'=>true),
			array('amount', 'numerical'),
			array('type', 'length', 'max'=>5),
			array('end', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, type, strat, end, amount, sender, receiver', 'safe', 'on'=>'search'),
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
			'sender0' => array(self::BELONGS_TO, 'Client', 'sender'),
			'receiver0' => array(self::BELONGS_TO, 'Client', 'receiver'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('tx', 'ID'),
			'type' => Yii::t('tx', 'Type'),
			'strat' => Yii::t('tx', 'Strat'),
			'end' => Yii::t('tx', 'End'),
			'amount' => Yii::t('tx', 'Amount'),
			'sender' => Yii::t('tx', 'Sender'),
			'receiver' => Yii::t('tx', 'Receiver'),
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
		$criteria->compare('type',$this->type,true);
		$criteria->compare('strat',$this->strat,true);
		$criteria->compare('end',$this->end,true);
		$criteria->compare('amount',$this->amount);
		$criteria->compare('sender',$this->sender);
		$criteria->compare('receiver',$this->receiver);

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
	 * @return Calling the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function getUrl() {
        return Yii::app()->createUrl('Calling/view', array('id' => $this->id));
    }
    public function getA_Url() {
        return Yii::app()->createAbsoluteUrl('Calling/view', array('id' => $this->id));
    }





}
