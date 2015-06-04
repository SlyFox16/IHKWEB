<?php

/**
 * This is the model class for table "article_category".
 *
 * The followings are the available columns in table 'article_category':
 * @property integer $id
 * @property string $name_ro
 * @property string $name_ru
 * @property string $slug_ru
 * @property string $slug_ro
 * @property integer $is_active
 */
class ArticleCategory extends ActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'article_category';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array('name_ru, name_ro', 'required', 'on' => 'insert, update'),
            array('name_ru', 'required', 'on' => 'insertRU, updateRU'),
            array('name_ro', 'required', 'on' => 'insertRO, updateRO'),
			array('is_active', 'numerical', 'integerOnly'=>true),
            array('show_main', 'safe'),
			array('name_ro, name_ru, slug_ru, slug_ro', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name_ro, name_ru, slug_ru, slug_ro, is_active', 'safe', 'on'=>'search'),
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
            'articles' => array(self::HAS_MANY, 'Article', 'article_category_id', 'condition'=>'is_active IN '.arr_language(true), 'order' => 'id DESC'),
        );
	}

    public function beforeSave()
    {
        $this->slug_ru = transliterate($this->name_ru);
        $proverka = self::model()->findByAttributes(array('slug_ru' => $this->slug_ru));
        if($proverka && $proverka->id != $this->id)
            $this->slug_ru .= '_'.$this->id;

        $this->slug_ro = transliterate_ro($this->name_ro);
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
			'name_ro' => 'Name Ro',
			'name_ru' => 'Name Ru',
			'slug_ru' => 'Slug Ru',
			'slug_ro' => 'Slug Ro',
            'show_main' => 'Show on main page',
			'is_active' => 'Is Active',
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
		$criteria->compare('name_ro',$this->name_ro,true);
		$criteria->compare('name_ru',$this->name_ru,true);
		$criteria->compare('slug_ru',$this->slug_ru,true);
		$criteria->compare('slug_ro',$this->slug_ro,true);
		$criteria->compare('is_active',$this->is_active);

        $criteria->condition = 'id IN (2,3,4)';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function categoryArticles()
    {
        return new CArrayDataProvider($this->articles,
            array(
                'sort' => array(
                    'defaultOrder' => "id DESC",
                ),
                'pagination' => array('Pagesize' => Yii::app()->params['defaultPageSize']),
            ));
    }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ArticleCategory the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function mainPageShowType($id = null)
    {
        $arr = array(
            1 => 'Do not show on the main page',
            2 => '4 articles',
            3 => '1 big 3 little',
            4 => '2 big articles',
        );

        if(isset($id)) {
            if (is_array($arr)) {
                return $arr[$id];
            }
        }

        return $arr;
    }

    public function getName()
    {
        return $this->{'name_'.Yii::app()->language};
    }

    public function getMenuname()
    {
        return $this->{'menuname_'.Yii::app()->language};
    }

    public function getSlug()
    {
        return $this->{'slug_'.Yii::app()->language};
    }
}
