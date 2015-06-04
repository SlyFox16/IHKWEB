<?php

/**
 * This is the model class for table "banner_category".
 *
 * The followings are the available columns in table 'banner_category':
 * @property integer $id
 * @property string $slug
 * @property string $title_ro
 * @property string $title_ru
 * @property string $created
 * @property string $updated
 * @property integer $author
 * @property integer $is_active
 *
 * The followings are the available model relations:
 * @property Banner[] $banners
 */
class BannerCategory extends ActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return BannerCategory the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'banner_category';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('slug, title_ro, title_ru', 'required'),
			array('author, is_active', 'numerical', 'integerOnly'=>true),
			array('slug, title_ro, title_ru', 'length', 'max'=>255),
			array('created, updated', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, slug, title_ro, title_ru, created, updated, author, is_active', 'safe', 'on'=>'search'),
			array('updated', 'default', 'value' => new CDbExpression('NOW()'),'setOnEmpty' => false, 'on' => 'update'),
            array('created, updated', 'default', 'value' => new CDbExpression('NOW()'),
                'setOnEmpty' => false, 'on' => 'insert')
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
			'banners' => array(self::HAS_MANY, 'Banner', 'banner_category_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'slug' => 'Slug',
			'title_ro' => 'Title Ro',
			'title_ru' => 'Title Ru',
			'created' => 'Created',
			'updated' => 'Updated',
			'author' => 'Author',
			'is_active' => 'Is Active',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('slug',$this->slug,true);
		$criteria->compare('title_ro',$this->title_ro,true);
		$criteria->compare('title_ru',$this->title_ru,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('updated',$this->updated,true);
		$criteria->compare('author',$this->author);
		$criteria->compare('is_active',$this->is_active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}