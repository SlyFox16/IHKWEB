<?php

/**
 * This is the model class for table "menu".
 *
 * The followings are the available columns in table 'menu':
 * @property integer $id
 * @property string $image
 * @property string $link_ru
 * @property string $link_ro
 * @property string $target
 * @property string $title_ru
 * @property string $title_ro
 * @property string $description_ru
 * @property string $description_ro
 * @property string $created
 * @property string $is_active
 * @property integer $root
 * @property integer $lft
 * @property integer $rgt
 * @property integer $level
 * @property integer $priority
 *
 * The followings are the available model relations:
 * @property User $author0
 * @property Menu $root0
 * @property Menu[] $menus
 */
class Slider extends ActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Menu the static model class
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
		return 'slider';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title_ru, title_ro, description_ru, description_ro', 'required'),
            array('image', 'file', 'types'=>'jpg, gif, png','allowEmpty'=>true),
			array('root, lft, rgt, level, priority', 'numerical', 'integerOnly'=>true),
			array('image, link_ru, link_ro, description_ro, description_ru', 'length', 'max'=>255),
            array('link_ru, link_ro', 'url'),
			array('created, target', 'safe'),
            array('created', 'default', 'value' => new CDbExpression('NOW()'),
                'setOnEmpty' => false, 'on' => 'insert')
		);
	}

	public function behaviors()
    {
        return array(
            'nestedSetBehavior' => array(
                'class' => 'ext.yiiext.behaviors.model.trees.NestedSetBehavior',
                'hasManyRoots' => true,
                'leftAttribute' => 'lft',
                'rightAttribute' => 'rgt',
                'levelAttribute' => 'level',
                'rootAttribute' => 'root',
            ),
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
			'image' => 'Image',
			'link_ru' => 'Slide link RU',
            'link_ro' => 'Slide link RO',
			'target' => 'Where to open slide link',
			'title_ru' => 'Title RU',
            'title_ro' => 'Title RO',
			'description_ru' => 'Description RU',
            'description_ro' => 'Description RO',
			'created' => 'Date',
			'is_active' => 'Site version slide visibility',
			'root' => 'Root',
			'lft' => 'Lft',
			'rgt' => 'Rgt',
			'level' => 'Level',
			'priority' => 'Priority',
		);
	}

    public function getTitle()
    {
        return $this->{'title_'.Yii::app()->language};
    }

    public function getLink()
    {
        return $this->{'link_'.Yii::app()->language};
    }

    public function getDescription()
    {
        return $this->{'description_'.Yii::app()->language};
    }
}