<?php

/**
 * This is the model class for table "album_image".
 *
 * The followings are the available columns in table 'album_image':
 * @property integer $id
 * @property integer $album_id
 * @property string $title_ro
 * @property string $title_ru
 * @property string $path
 */
class AlbumImage extends ActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'album_image';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('album_id', 'numerical', 'integerOnly'=>true),
            array('author', 'length', 'max'=>80),
			array('title_ro, title_ru, path', 'length', 'max'=>255),
            array('path', 'file', 'types'=>'jpg, gif, png','allowEmpty'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, album_id, title_ro, title_ru, path, author', 'safe', 'on'=>'search'),
		);
	}

    public function afterSave()
    {
        if (isset($_POST['AlbumImage']['tags'])) {
            //print_r($_POST['AlbumImage']['tags']); die();
            $param = $_POST['AlbumImage']['tags'];

            ContypeTags::model()->deleteAll('content_type = :contentType AND item_id = :item_id' , array(':contentType' => content_id("AlbumImage"), ':item_id' => $this->id));

            foreach ($param as $value) {
                $tag = Tags::model()->find('id = :value OR tag = :value', array(':value' => $value));

                if(!$tag) {
                    $tag = new Tags();
                    $tag->tag = $value;
                    if($tag->validate()) {
                        $tag->save();
                    }
                }

                $contype_tags = new ContypeTags();
                $contype_tags->content_type = content_id('AlbumImage');
                $contype_tags->item_id = $this->id;
                $contype_tags->tag_id = $tag->id;
                $contype_tags->save();
            }
        }

        return parent::afterSave();
    }

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
            'tags'=>array(self::MANY_MANY, 'Tags', 'contype_tags(item_id, tag_id)', 'condition' => 'content_type = :type', 'params' => array(':type' => content_id('AlbumImage'))),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'album_id' => 'Album',
			'title_ro' => 'Title Ro',
			'title_ru' => 'Title Ru',
			'path' => 'Path',
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
		$criteria->compare('album_id',$this->album_id);
		$criteria->compare('title_ro',$this->title_ro,true);
		$criteria->compare('title_ru',$this->title_ru,true);
		$criteria->compare('path',$this->path,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AlbumImage the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function getTitle()
    {
        return $this->{'title_'.Yii::app()->language};
    }

    public function getAllTags()
    {
        $tags = $this->tags;
        return CHtml::listData($tags,'id','tag');

        return $returnTags;
    }

    public function tags()
    {
        $allTags = $this->tags;
        $returnLink = '';

        if($allTags) {
            foreach($allTags as $value) {
                $returnLink[] = '#'.$value->tag;
            }
            $returnLink = implode(' ', $returnLink);
        }

        return $returnLink;
    }

    public function getImageDescription()
    {
        $return = '';

        if(!empty($this->title)) {
            $return .= '<br /><br /><br />';
            $return .= '<span class="imageP">'.$this->title.'</span>';
        }

        if(!empty($this->author)) {
            if(empty($this->title)) $return .= '<br /><br /><br />';

            $return .= ' <span class="imageP">('.$this->author.')</span>';
        }

        if($this->tags())
            $return .= '<span class="imageP"> - '.$this->tags().'</span>';

        return $return;
    }
}
