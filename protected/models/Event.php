<?php

/**
 * This is the model class for table "event".
 *
 * The followings are the available columns in table 'event':
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $facebook_url
 * @property string $twitter_url
 * @property string $xing_url
 * @property string $image
 * @property string $location
 */
class Event extends ActiveRecord
{
    public $temp_id;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'event';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, description, country_id, date, city_id', 'required'),
			array('title, facebook_url, twitter_url, xing_url, image, location', 'length', 'max'=>255),
            array('image', 'file', 'types'=>'png, jpg, gif, jpeg', 'safe' => false,'allowEmpty'=>true),
            array('facebook_url, twitter_url, xing_url, active, user_id, temp_id, site_url', 'safe'),
            array('facebook_url, twitter_url, xing_url, site_url', 'url'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, description, facebook_url, twitter_url, xing_url, image, location', 'safe', 'on'=>'search'),
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
            'connectedUsers' => array(self::MANY_MANY, 'User', 'event_members(event_id, user_id)'),
		);
	}

    public function beforeSave()
    {
        if (!empty($this->date))
            $this->date = YHelper::formatDate('yyyy-MM-dd', $this->date, 'dd/MM/yyyy');

        return parent::beforeSave();
    }

    protected function afterFind()
    {
        parent::afterFind();
        $this->date = YHelper::formatDate('dd/MM/yyyy', $this->date, 'yyyy-MM-dd');
    }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => Yii::t("base", 'Title'),
			'description' => Yii::t("base", 'Description'),
			'facebook_url' => Yii::t("base", 'Facebook Url'),
			'twitter_url' => Yii::t("base", 'Twitter Url'),
			'xing_url' => Yii::t("base", 'Xing Url'),
            'site_url' => Yii::t("base", 'Site Url'),
			'image' => Yii::t("base", 'Image'),
			'location' => Yii::t("base", 'Location'),
            'country_id' => Yii::t("base","Country"),
            'city_id' => Yii::t("base","City"),
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('facebook_url',$this->facebook_url,true);
		$criteria->compare('twitter_url',$this->twitter_url,true);
		$criteria->compare('xing_url',$this->xing_url,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('location',$this->location,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function getSelectedCity() {
        $model = Cities::model()->find(array('condition' => 'geonameid = :id', 'params' => array(':id' => $this->city_id)));
        if($model) {
            $ret_arr = array('id' => $model->geonameid, 'value' => $model->city_name_UTF8);
            return json_encode($ret_arr);
        } else {
            return json_encode(array());
        }
    }

    protected function afterSave()
    {
        Yii::log($this->temp_id."qwerty", "error");
        EventMembers::model()->updateAll(array('event_id' => $this->id),'event_id = :event_id', array(':event_id' => $this->temp_id));
        parent::afterSave();
    }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Event the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function getTempId() {
        if ($this->id) return $this->id;
        elseif ($this->tempID) return $this->tempID;
        elseif (empty($this->id) && empty($this->tempID)) return YHelper::generateStr(32);
    }
}
