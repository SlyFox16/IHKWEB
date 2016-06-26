<?php

/**
 * This is the model class for table "completed_projects".
 *
 * The followings are the available columns in table 'completed_projects':
 * @property integer $id
 * @property integer $user_id
 * @property string $name
 * @property string $description
 * @property string $date
 * @property string $link
 */
class CompletedProjects extends ActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'completed_projects';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, description, date, link', 'required'),
			array('user_id', 'numerical', 'integerOnly'=>true),
			array('name, link', 'length', 'max'=>255),
            array('link', 'url'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, name, description, date, link', 'safe', 'on'=>'search'),
            array('user_id', 'default', 'value' => Yii::app()->user->id,'setOnEmpty' => false, 'on' => 'insert'),
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

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => Yii::t("base", 'User'),
			'name' => Yii::t("base", 'Name'),
			'description' => Yii::t("base", 'Description'),
			'date' => Yii::t("base", 'Date'),
			'link' => Yii::t("base", 'Link'),
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('link',$this->link,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CompletedProjects the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function afterFind()
    {
        $this->date = Yii::app()->dateFormatter->format("dd/MM/yyyy", CDateTimeParser::parse($this->date, 'yyyy-MM-dd'));
        parent::afterFind();
    }

    public function beforeSave()
    {
        $this->date = Yii::app()->dateFormatter->format("yyyy-MM-dd", CDateTimeParser::parse($this->date, 'dd/MM/yyyy'));
        return parent::beforeSave();
    }
}
