<?php

/**
 * This is the model class for table "banner".
 *
 * The followings are the available columns in table 'banner':
 * @property integer $id
 * @property integer $banner_type_id
 * @property integer $banner_category_id
 * @property string $file
 * @property string $link
 * @property string $title_ro
 * @property string $title_ru
 * @property string $created
 * @property string $updated
 * @property integer $author
 * @property integer $is_active
 *
 * The followings are the available model relations:
 * @property BannerCategory $bannerCategory
 * @property BannerType $bannerType
 * @property User $author0
 * @property BannerCountry[] $bannerCountries
 * @property BannerStats[] $bannerStats
 */
class Banner extends ActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Banner the static model class
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
		return 'banner';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('banner_type_id, banner_category_id, position', 'required'),
			array('banner_type_id, banner_category_id, author, is_active, views', 'numerical', 'integerOnly'=>true),
			array('file, link, title_ro, title_ru', 'length', 'max'=>255),
			array('created, updated, reffer, custom_banner, rotate', 'safe'),
			array('file', 'file', 'types'=>'png, jpg, gif, swf','allowEmpty'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, banner_type_id, banner_category_id, position, file, link, title_ro, title_ru, views, reffer, created, updated, author, is_active', 'safe', 'on'=>'search'),
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
			'bannerCategory' => array(self::BELONGS_TO, 'BannerCategory', 'banner_category_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'banner_type_id' => 'Banner Type',
			'banner_category_id' => 'Banner Category',
			'position' => 'Banner Position',
			'file' => 'File',
			'link' => 'Link',
			'title_ro' => 'Title Ro',
			'title_ru' => 'Title Ru',
			'views' => 'Views',
			'reffer' => 'Reffer',
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
		$criteria->compare('banner_type_id',$this->banner_type_id);
		$criteria->compare('banner_category_id',$this->banner_category_id);
		$criteria->compare('position',$this->position,true);
		$criteria->compare('file',$this->file,true);
		$criteria->compare('link',$this->link,true);
		$criteria->compare('title_ro',$this->title_ro,true);
		$criteria->compare('title_ru',$this->title_ru,true);
		$criteria->compare('views',$this->views,true);
		$criteria->compare('reffer',$this->reffer,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('updated',$this->updated,true);
		$criteria->compare('author',$this->author);
		$criteria->compare('is_active',$this->is_active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function getTotalClicks()
	{
		$total = 0;
		if(is_array($this->bannerClicks) && count($this->bannerClicks) > 0)
			foreach ($this->bannerClicks as $value)
				$total += $value->clicks;
		return $total;
	}

    public function banner_type($id = null)
    {
        $arr = array(
            1 => 'Image Banner',
            2 => 'GIF Banner',
            3 => 'Flash Banner',
            4 => 'Custom Banner',
        );

        if(isset($id)) {
            if (is_array($arr)) {
                return $arr[$id];
            }
        }

        return $arr;
    }

    public function banner_position($id = null)
    {
        $arr = array(
            'right_top' => Yii::t("base", 'Справа наверху'),
            'right_center' => Yii::t("base", 'Справа посередине'),
            'right_bottom' => Yii::t("base", 'Справа внизу'),
        );

        if(isset($id)) {
            if (is_array($arr)) {
                return $arr[$id];
            }
        }

        return $arr;
    }

    public function getTitle()
    {
        return $this->{'title_'.Yii::app()->language};
    }
}