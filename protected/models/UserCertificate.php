<?php

/**
 * This is the model class for table "user_certificate".
 *
 * The followings are the available columns in table 'user_certificate':
 * @property integer $id
 * @property integer $user_id
 * @property integer $certificate_id
 *
 * The followings are the available model relations:
 * @property Certificates $certificate
 * @property User $user
 */
class UserCertificate extends ActiveRecord
{
    public $tebleDescr;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user_certificate';
	}

    protected function beforeValidate()
    {
        if (!empty($this->date))
            $this->date = Yii::app()->dateFormatter->format("yyyy-MM-dd", CDateTimeParser::parse($this->date, 'dd/MM/yyyy'));
        return parent::beforeValidate();
    }

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, certificate_id, date', 'required', 'except' => 'check'),
            array('certificate_id, date', 'required', 'on'=>'check'),
			array('user_id, certificate_id', 'numerical', 'integerOnly'=>true),
            array('date', 'type', 'type' => 'date', 'message' => '{attribute}: in wrong format!', 'dateFormat' => 'yyyy-MM-dd'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, certificate_id', 'safe', 'on'=>'search'),
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
			'certificate' => array(self::BELONGS_TO, 'Certificates', 'certificate_id'),
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
		);
	}

    public function scopes()
    {
        return array(
            'confirmed'=>array('condition'=>"confirm = 1"),
        );
    }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => Yii::t("base", 'User'),
			'certificate_id' => Yii::t("base", 'Certificate'),
            'tebleDescr' => Yii::t("base", 'Certificate description'),
            'date' => Yii::t("base", 'Date'),
            'uDate' => Yii::t("base", 'Date')
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('certificate_id',$this->certificate_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UserCertificate the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function getAllCertificates() {
        $certificates = Certificates::model()->findAll();
        return CHtml::listData($certificates, 'id', 'name');
    }

    public function setUDate($value) {
        $this->date = Yii::app()->dateFormatter->format("yyyy-MM-dd", CDateTimeParser::parse($value, 'dd/MM/yyyy'));
    }

    public function getUDate() {
        return Yii::app()->dateFormatter->format("dd/MM/yyyy", $this->date);
    }

    public function getStatus() {
        $stat = array(0 => 'Unconfirmed', 1 => 'Confirmed');
        return $stat[$this->confirm];
    }
}
