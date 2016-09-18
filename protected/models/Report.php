<?php

/**
 * This is the model class for table "report".
 *
 * The followings are the available columns in table 'report':
 * @property integer $id
 * @property integer $initiator
 * @property integer $receiver
 * @property string $text
 * @property string $date
 */
class Report extends ActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'report';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('receiver, text', 'required'),
			array('initiator, receiver', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, initiator, receiver, text, date', 'safe', 'on'=>'search'),
            array('initiator', 'default', 'value' => Yii::app()->user->id, 'setOnEmpty' => false, 'on' => 'insert'),
            array('date', 'default', 'value' => date("Y-m-d H:i:s"), 'setOnEmpty' => false, 'on' => 'insert')
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
            'userInitiator' => array(self::BELONGS_TO, 'User', 'initiator'),
            'userReceiver' => array(self::BELONGS_TO, 'User', 'receiver'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'initiator' => 'Initiator',
			'receiver' => 'Receiver',
			'text' => Yii::t("base", 'Reason'),
			'date' => 'Date',
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

        if ($this->initiator) {
            $queryTerms = explode(' ', $this->initiator);

            $crt = new CDbCriteria;
            $crt->select = 't.id as id';
            $crt->with = array('userInitiator');

            foreach ($queryTerms as $k => $req) {
                $tCriteria = new CDbCriteria();
                $tCriteria->condition = "userInitiator.name LIKE :$k OR userInitiator.surname LIKE :$k";
                $tCriteria->params[":$k"] = '%'.strtr($req, array('%'=>'\%', '_'=>'\_', '\\'=>'\\\\', '(' => '', ')' => '')).'%';
                $crt->mergeWith($tCriteria);
            }

            $info = Report::model()->findAll($crt);
            $in = CHtml::listData($info, 'id', 'id');

            $criteria->addInCondition('id', $in);
        }

        if ($this->receiver) {
            $queryTerms = explode(' ', $this->receiver);

            $crt = new CDbCriteria;
            $crt->select = 't.id as id';
            $crt->with = array('userReceiver');

            foreach ($queryTerms as $k => $req) {
                $tCriteria = new CDbCriteria();
                $tCriteria->condition = "userReceiver.name LIKE :$k OR userReceiver.surname LIKE :$k";
                $tCriteria->params[":$k"] = '%'.strtr($req, array('%'=>'\%', '_'=>'\_', '\\'=>'\\\\', '(' => '', ')' => '')).'%';
                $crt->mergeWith($tCriteria);
            }

            $info = Report::model()->findAll($crt);
            $in = CHtml::listData($info, 'id', 'id');

            $criteria->addInCondition('id', $in);
        }

		$criteria->compare('id',$this->id);
		$criteria->compare('text',$this->text,true);
		$criteria->compare('date',$this->date,true);

        $key = get_class($this) . '_page'; // e.g. Model_page

        if (isset($_GET['ajax']) && !isset($_GET[$key])) {
            Yii::app()->session[get_class($this) . '_page'] = 1;
        }

        if (!empty($_GET[$key])) {
            Yii::app()->session[get_class($this) . '_page'] = $_GET[$key]; // update current active page
        } elseif (isset(Yii::app()->session[get_class($this) . '_page'])) {
            $_GET[$key] = Yii::app()->session[get_class($this) . '_page']; // set latest active page
        }

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Report the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
