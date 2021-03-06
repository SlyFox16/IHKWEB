<?php

/**
 * This is the model class for table "feedback".
 *
 * The followings are the available columns in table 'feedback':
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $feedback
 */
class Feedback extends ActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'feedback';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, email, feedback', 'required'),
			array('name', 'length', 'max'=>80),
			array('email', 'length', 'max'=>255),
            array('email', 'email', 'message' => 'Email is not valid.'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, email, feedback', 'safe', 'on'=>'search'),
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
		);
	}

    public function requiredClass($attr) {
        return $this->isAttributeRequired($attr) ? 'class="required"' : '';
    }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'email' => 'Email',
			'feedback' => 'Feedback',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('feedback',$this->feedback,true);

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
	 * @return Feedback the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
