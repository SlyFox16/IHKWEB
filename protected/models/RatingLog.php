<?php

/**
 * This is the model class for table "rating_log".
 *
 * The followings are the available columns in table 'rating_log':
 * @property integer $id
 * @property integer $who_vote
 * @property integer $who_received
 * @property double $num
 *
 * The followings are the available model relations:
 * @property User $whoReceived
 * @property User $whoVote
 */
class RatingLog extends ActiveRecord
{
    public $htmlpurifier;
    public $count;
    public $id;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'rating_log';
	}

    public function init()
    {
        $this->htmlpurifier = new CHtmlPurifier();
    }

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('who_vote, who_received, num', 'required'),
			array('who_vote, who_received', 'numerical', 'integerOnly'=>true),
            array('description','filter','filter'=>array($this->htmlpurifier,'purify')),
            array('description', 'required', 'on' => 'retingDesc'),
			array('num, confirmed', 'numerical'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, who_vote, who_received, num', 'safe', 'on'=>'search'),
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
			'whoReceived' => array(self::BELONGS_TO, 'User', 'who_received'),
			'whoVote' => array(self::BELONGS_TO, 'User', 'who_vote'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'who_vote' => 'Who Voted',
			'who_received' => 'Who Received',
            'description' => Yii::t("base", 'Description'),
			'num' => 'Points',
		);
	}

    public function afterSave()
    {
        $user = $this->whoReceived;
        $ratingList = RatingLog::model()->findAll('who_received = :user && confirmed = 1', array(':user' => $user->id));
        $user->rating = 0;
        if($user && $ratingList) {
            $summ = 0;
            foreach($ratingList as $rating)
                $summ += $rating->num;

            $user->rating = round(($summ)/count($ratingList), 1);
        }
        $user->update();
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
	public function search($param = null)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

        if ($this->who_vote) {
            $queryTerms = explode(' ', $this->who_vote);

            $crt = new CDbCriteria;
            $crt->select = 't.id as id';
            $crt->with = array('whoVote');

            foreach ($queryTerms as $k => $req) {
                $tCriteria = new CDbCriteria();
                $tCriteria->condition = "whoVote.name LIKE :$k OR whoVote.surname LIKE :$k";
                $tCriteria->params[":$k"] = '%'.strtr($req, array('%'=>'\%', '_'=>'\_', '\\'=>'\\\\', '(' => '', ')' => '')).'%';
                $crt->mergeWith($tCriteria);
            }

            $info = RatingLog::model()->findAll($crt);
            $in = CHtml::listData($info, 'id', 'id');

            $criteria->addInCondition('id', $in);
        }

        if ($this->who_received) {
            $queryTerms = explode(' ', $this->who_received);

            $crt = new CDbCriteria;
            $crt->select = 't.id as id';
            $crt->with = array('whoReceived');

            foreach ($queryTerms as $k => $req) {
                $tCriteria = new CDbCriteria();
                $tCriteria->condition = "whoReceived.name LIKE :$k OR whoReceived.surname LIKE :$k";
                $tCriteria->params[":$k"] = '%'.strtr($req, array('%'=>'\%', '_'=>'\_', '\\'=>'\\\\', '(' => '', ')' => '')).'%';
                $crt->mergeWith($tCriteria);
            }

            $info = RatingLog::model()->findAll($crt);
            $in = CHtml::listData($info, 'id', 'id');

            $criteria->addInCondition('id', $in);
        }

		$criteria->compare('id',$this->id);
		$criteria->compare('num',$this->num);

        if($param == 'unconfirmed') {
            $criteria->addCondition('confirmed = 0');
        }

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'sort' => ['defaultOrder' => $this->getTableAlias() . '.id DESC'],
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RatingLog the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function getStatus() {
        $stat = array(0 => 'Unconfirmed', 1 => 'Confirmed');
        return $stat[$this->confirmed];
    }
}
