<?php

/**
 * This is the model class for table "settings".
 *
 * The followings are the available columns in table 'settings':
 * @property integer $id
 * @property string $name
 * @property string $value
 */
class Settings extends ActiveRecord
{
    public $data;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Settings the static model class
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
		return 'settings';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
        return array(
            // array('name, value', 'required'),
            array('name', 'length', 'max'=>255),
            array('value, title, data, sender_email', 'safe'),
            array('value', 'file', 'types'=>'jpg, gif, png','allowEmpty'=>true, 'on' => 'img'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, name, value', 'safe', 'on'=>'search'),
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
			'name' => 'Name',
			'value' => 'Value',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('value',$this->value,true);

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

    public function tt ($index)
    {
        if ($index == 1)
        {
            return 'class="middle"';
        }
        elseif ($index == 2)
        {
            return 'class="middle2"';
        }
        else
        {
            $index2 = $index - 1;
            if (($index2%4) == 0)
            {
                return 'class="middle"';
            }
            else
            {
                $index3 = $index - 2;
                if (($index3%4) == 0)
                {
                    return 'class="middle2"';
                }
                else
                {
                    return '';
                }
            }
        }
    }
}