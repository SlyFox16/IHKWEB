<?php

/**
 * This is the model class for table "article".
 *
 * The followings are the available columns in table 'article':
 * @property integer $id
 * @property integer $category_id
 * @property string $title_ru
 * @property string $title_ro
 * @property string $slug_ru
 * @property string $slug_ro
 * @property string $preview_ru
 * @property string $preview_ro
 * @property string $description_ru
 * @property string $description_ro
 * @property string $image
 * @property string $video
 * @property string $created
 * @property string $updated
 * @property integer $author
 * @property string $is_active
 */
class Article extends ActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'article';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array('title_ru, title_ro, description_ru, description_ro', 'required', 'on' => 'insert, update'),
            array('title_ru, description_ru', 'required', 'on' => 'insertRU, updateRU'),
			array('title_ro, description_ro', 'required', 'on' => 'insertRO, updateRO'),
            array('image', 'file', 'types'=>'jpg, gif, png','allowEmpty'=>true),
            array('preview_ru, preview_ro','filter','filter'=>'strip_tags'),
			array('category_id, author', 'numerical', 'integerOnly'=>true),
			array('title_ru, title_ro, slug_ru, slug_ro, image, video', 'length', 'max'=>255),
			array('is_active', 'length', 'max'=>1),
            array('event_date', 'eventRule'),
			array('description_ru, video, video_surce, created, updated, slug_ru, slug_ro, preview_ru, preview_ro, article_category_id, event_date, eventDateFormat', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, category_id, title_ru, title_ro, slug_ru, slug_ro, preview_ru, preview_ro, description_ru, description_ro, image, video, created, updated, author, is_active', 'safe', 'on'=>'search'),
            array('updated', 'default', 'value' => new CDbExpression('NOW()'),'setOnEmpty' => false, 'on' => 'update, updateRU, updateRO, insert, insertRU, insertRO'),
            array('created, updated', 'default', 'value' => new CDbExpression('NOW()'), 'setOnEmpty' => false, 'on' => 'insert, insertRU, insertRO'),
		);
	}

    public function eventRule()
    {
        $error = false;
        if($this->category_id == 2) {
            if(empty($this->event_date))
                $error = true;
        }

        if ($error == true) {
            $this->addError('event_date', Yii::t('yii','{event_date} cannot be blank.', array('{event_date}' => $this->getAttributeLabel('event_date'))));
        }
    }

    /**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
            'articleCategory' => array(self::BELONGS_TO, 'ArticleCategory', 'article_category_id'),
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
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'category_id' => 'Category',
			'title_ru' => 'Title Ru',
			'title_ro' => 'Title Ro',
			'slug_ru' => 'Slug Ru',
			'slug_ro' => 'Slug Ro',
			'preview_ru' => 'Preview Ru',
			'preview_ro' => 'Preview Ro',
			'description_ru' => 'Description Ru',
			'description_ro' => 'Description Ro',
			'image' => 'Image',
			'video' => 'Video (Only the hash code)',
			'created' => 'Created',
			'updated' => 'Updated',
			'author' => 'Author',
			'is_active' => 'Language Activity',
            'event_date' => 'Event Date'
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
		$criteria->compare('category_id',$this->category_id);
		$criteria->compare('title_ru',$this->title_ru,true);
		$criteria->compare('title_ro',$this->title_ro,true);
		$criteria->compare('slug_ru',$this->slug_ru,true);
		$criteria->compare('slug_ro',$this->slug_ro,true);
		$criteria->compare('preview_ru',$this->preview_ru,true);
		$criteria->compare('preview_ro',$this->preview_ro,true);
		$criteria->compare('description_ru',$this->description_ru,true);
		$criteria->compare('description_ro',$this->description_ro,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('video',$this->video,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('updated',$this->updated,true);
		$criteria->compare('author',$this->author);
		$criteria->compare('is_active',$this->is_active,true);

        $criteria->addCondition("article_category_id <> 1");

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function searchVideo()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;

        $criteria->compare('id',$this->id);
        $criteria->compare('category_id',$this->category_id);
        $criteria->compare('title_ru',$this->title_ru,true);
        $criteria->compare('title_ro',$this->title_ro,true);
        $criteria->compare('slug_ru',$this->slug_ru,true);
        $criteria->compare('slug_ro',$this->slug_ro,true);
        $criteria->compare('preview_ru',$this->preview_ru,true);
        $criteria->compare('preview_ro',$this->preview_ro,true);
        $criteria->compare('description_ru',$this->description_ru,true);
        $criteria->compare('description_ro',$this->description_ro,true);
        $criteria->compare('image',$this->image,true);
        $criteria->compare('video',$this->video,true);
        $criteria->compare('created',$this->created,true);
        $criteria->compare('updated',$this->updated,true);
        $criteria->compare('author',$this->author);
        $criteria->compare('is_active',$this->is_active,true);

        $criteria->addCondition("category_id = 6 && article_category_id = 1");

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    public function searchInfographic()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;

        $criteria->compare('id',$this->id);
        $criteria->compare('category_id',$this->category_id);
        $criteria->compare('title_ru',$this->title_ru,true);
        $criteria->compare('title_ro',$this->title_ro,true);
        $criteria->compare('slug_ru',$this->slug_ru,true);
        $criteria->compare('slug_ro',$this->slug_ro,true);
        $criteria->compare('preview_ru',$this->preview_ru,true);
        $criteria->compare('preview_ro',$this->preview_ro,true);
        $criteria->compare('description_ru',$this->description_ru,true);
        $criteria->compare('description_ro',$this->description_ro,true);
        $criteria->compare('image',$this->image,true);
        $criteria->compare('video',$this->video,true);
        $criteria->compare('created',$this->created,true);
        $criteria->compare('updated',$this->updated,true);
        $criteria->compare('author',$this->author);
        $criteria->compare('is_active',$this->is_active,true);

        $criteria->addCondition("category_id = 4 && article_category_id = 5");

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    public function searchEvent()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;

        $criteria->compare('id',$this->id);
        $criteria->compare('category_id',$this->category_id);
        $criteria->compare('title_ru',$this->title_ru,true);
        $criteria->compare('title_ro',$this->title_ro,true);
        $criteria->compare('slug_ru',$this->slug_ru,true);
        $criteria->compare('slug_ro',$this->slug_ro,true);
        $criteria->compare('preview_ru',$this->preview_ru,true);
        $criteria->compare('preview_ro',$this->preview_ro,true);
        $criteria->compare('description_ru',$this->description_ru,true);
        $criteria->compare('description_ro',$this->description_ro,true);
        $criteria->compare('image',$this->image,true);
        $criteria->compare('video',$this->video,true);
        $criteria->compare('created',$this->created,true);
        $criteria->compare('updated',$this->updated,true);
        $criteria->compare('author',$this->author);
        $criteria->compare('is_active',$this->is_active,true);

        $criteria->addCondition("category_id = 2 && article_category_id = 6");

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Article the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function category_type($id = null)
    {
        $arr = array(
            1 => 'Article',
            2 => 'Event',
            3 => 'Report',
            4 => 'Infographics',
            6 => 'Video material',
        );

        if(isset($id)) {
            if (is_array($arr)) {
                return $arr[$id];
            }
        }

        return $arr;
    }

    public function article_icon()
    {
        switch($this->category_id) {
            case '4':
                    return CHtml::tag('span', array('class' => 'icon gallery'), '');
                break;
            case '6':
                    return CHtml::tag('span', array('class' => 'icon video'), '');
                break;
            default:
                return '';
        }
    }

    public function video_type($id = null)
    {
        $arr = array(
            'youtube' => 'Youtube',
            'vimeo' => 'Vimeo',
        );

        if(isset($id)) {
            if (is_array($arr)) {
                return $arr[$id];
            }
        }

        return $arr;
    }

    public function getArticleCategory()
    {
        $criteria = new CDbCriteria;
        $criteria->condition = "id IN (2,3,4)";
        $criteria->addInCondition("is_active", arr_language());

        return CHtml::listData(ArticleCategory::model()->findAll($criteria), 'id', 'name_'.Yii::app()->language);
    }

    public function infografArticles()
    {
        $criteria = new CDbCriteria;
        $criteria->condition = 'category_id = 4 && article_category_id = 6';
        $criteria->addInCondition("is_active", arr_language());

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'sort' => array(
                'defaultOrder' => "id DESC",
            ),
            'pagination' => array('Pagesize' => Yii::app()->params['defaultPageSize']),
        ));
    }

    public function videoArticles()
    {
        $criteria = new CDbCriteria;
        $criteria->condition = 'category_id = 6 && article_category_id = 1';
        $criteria->addInCondition("is_active", arr_language());

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'sort' => array(
                'defaultOrder' => "id DESC",
            ),
            'pagination' => array('Pagesize' => Yii::app()->params['defaultPageSize']),
        ));
    }

    public function getEventImage()
    {
        if(isset($this->image))
            return $this->image;
        else
            return 'static/images/Kalendar.jpg';
    }

    public function getTitle()
    {
        return $this->{'title_'.Yii::app()->language};
    }

    public function getPreview()
    {
        return $this->{'preview_'.Yii::app()->language};
    }

    public function getDescription()
    {
        return $this->{'description_'.Yii::app()->language};
    }

    public function getSlug()
    {
        return $this->{'slug_'.Yii::app()->language};
    }

    public function getEventDateFormat()
    {
        if(!empty($this->event_date))
            return Yii::app()->format->dateTime($this->event_date);
        else
            return $this->event_date;
    }

    public function setEventDateFormat($value)
    {
        $this->event_date = $value;
    }
}
