<?php

/**
 * This is the model class for table "album".
 *
 * The followings are the available columns in table 'album':
 * @property integer $id
 * @property string $title_ru
 * @property string $title_ro
 * @property string $slug_ru
 * @property string $slug_ro
 * @property string $created
 * @property string $is_active
 */
class Album extends ActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'album';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array('title_ru, title_ro', 'required', 'on' => 'insert, update'),
            array('title_ru', 'required', 'on' => 'insertRU, updateRU'),
            array('title_ro', 'required', 'on' => 'insertRO, updateRO'),
			array('title_ru, title_ro, slug_ru, slug_ro', 'length', 'max'=>255),
            array('image', 'file', 'types'=>'jpg, gif, png','allowEmpty'=>true),
			array('is_active', 'length', 'max'=>1),
			array('created, description_ru, description_ro', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title_ru, title_ro, slug_ru, slug_ro, created, is_active', 'safe', 'on'=>'search'),
            array('created', 'default', 'value' => new CDbExpression('NOW()'), 'setOnEmpty' => false, 'on' => 'insert, insertRU, insertRO'),
		);
	}

    public function beforeSave()
    {
        $this->slug_ru = transliterate($this->title_ru);
        $proverka = self::model()->findByAttributes(array('slug_ru' => $this->slug_ru));
        if($proverka && $proverka->id != $this->id)
            $this->slug_ru .= '_'.$this->id;

        $this->slug_ro = transliterate_ro($this->title_ro);
        $proverka = self::model()->findByAttributes(array('slug_ro' => $this->slug_ro));
        if($proverka && $proverka->id != $this->id)
            $this->slug_ro .= '_'.$this->id;

        return parent::beforeSave();
    }

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
            'albumImagesList' => array(self::HAS_MANY, 'AlbumImage', 'album_id', 'order' => 'id DESC'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title_ru' => 'Title Ru',
			'title_ro' => 'Title Ro',
			'slug_ru' => 'Slug Ru',
			'slug_ro' => 'Slug Ro',
			'created' => 'Created',
			'is_active' => 'Language Activity',
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
		$criteria->compare('title_ru',$this->title_ru,true);
		$criteria->compare('title_ro',$this->title_ro,true);
		$criteria->compare('slug_ru',$this->slug_ru,true);
		$criteria->compare('slug_ro',$this->slug_ro,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('is_active',$this->is_active,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function allAlbums()
    {
        $criteria = new CDbCriteria;
        $criteria->addInCondition("is_active", arr_language());

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination' => array('Pagesize' => Yii::app()->params['albumPageSize']),
        ));
    }

    public function albumImages()
    {
        return new CArrayDataProvider($this->albumImagesList,
            array(
                'sort' => array(
                    'defaultOrder' => "id DESC",
                ),
                'pagination' => array('Pagesize' => Yii::app()->params['albumPageSize']),
            ));
    }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Album the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function getTitle()
    {
        return $this->{'title_'.Yii::app()->language};
    }

    public function getDescription()
    {
        return $this->{'description_'.Yii::app()->language};
    }
}
