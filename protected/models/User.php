<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $identity
 * @property string $network
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $salt
 * @property string $country_id
 * @property integer $city_id
 * @property integer $is_active
 * @property integer $is_staff
 * @property string $last_login
 * @property string $date_joined
 *
 *
 */
class User extends ActiveRecord
{
    public $levelUp = false;
    public $levelDown = false;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return User the static model class
     */
    public $comment;
    public $password_repeat;
    public $htmlpurifier;

    public function init()
    {
        /*$options = array(
            'AutoFormat.AutoParagraph' => TRUE,
        );*/
        $this->htmlpurifier = new CHtmlPurifier();
        /*$this->htmlpurifier->options = $options;*/
    }

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'user';
    }

    /**
     * @return array validation rules for model attributes.
     */

    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('username, name, surname, email, password, password_repeat, address, country_id, city_id', 'required', 'on' => 'insert'),
            array('username, name, surname, email, password, password_repeat', 'required', 'on' => 'seeker'),
            array('username, name, surname, email, password, password_repeat', 'required', 'on' => 'backendcreate'),
            array('username, name, surname, email', 'required', 'on' => 'update, socials'),
            array('username', 'required', 'on' => 'userupdate'),
            array('password, password_repeat', 'required', 'on' => 'updatepassword'),
            array('username, name, surname, address, position','filter','filter'=>'strip_tags', 'except' => 'userupdate'),
            array('username', 'match', 'pattern' => '/^[a-zA-Z0-9\._-]+$/', 'message' => 'Wrong format!'),
            array('description','filter','filter'=>array($this->htmlpurifier,'purify')),
            array('email', 'noEmail', 'on' => 'changepassword'),
            array('is_active', 'numerical', 'integerOnly' => true),
            array('avatar', 'file', 'types'=>'png, jpg, gif, jpeg', 'safe' => false,'allowEmpty'=>true),
            array('vcf', 'file', 'types'=>'pdf', 'safe' => false,'allowEmpty'=>true),
            array('password', 'length', 'min' => 5),
            array('name', 'length', 'max' => 80, 'except' => 'userupdate'),
            array('password, identity, network', 'length', 'max' => 512),
            array('title, zip', 'length', 'max' => 20),
            array('phone', 'match', 'pattern'=>'/^[-+()0-9 ]+$/', 'message' => Yii::t("base",'Wrong phone format')),
            array('facebook_url, twitter_url, xing_url', 'url'),
            array('salt, username, phone, address', 'length', 'max' => 255, 'except' => 'userupdate'),
            array('email, username', 'unique', 'except' => 'changepassword, userupdate'),
            array('email', 'email', 'message' => 'Email is not valid.', 'except' => 'userupdate'),
            array('password', 'compare', 'on' => 'insert, updatepassword, register, seeker'),
            array('password_repeat, certificates, facebook_url, twitter_url, last_login, xing_url, date_joined, is_staff, identity, network, comment, position, description, expert_confirm, new_level, seeker_pass', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, name, surname, email, password, salt, is_active, is_staff, last_login, date_joined', 'safe', 'on' => 'search'),
            array('is_active', 'default', 'value' => 1,'setOnEmpty' => false, 'on' => 'insert'),
            array('date_joined', 'default', 'value' => date("Y-m-d H:i:s"), 'setOnEmpty' => false, 'on' => 'insert, register, socials')
        );
    }

    public function scopes()
    {
        return array(
            'user'=>array('condition'=>"is_staff = 0"),
            'staff'=>array('condition'=>"is_staff = 1"),
            'expert_confirm'=>array('condition'=>"expert_confirm = 1"),
            'is_active'=>array('condition'=>"is_active = '1'"),
            'search_active' => array(
                'condition' => '(is_active = 1 && expert_confirm = 1) OR is_staff = 1'
            ),
        );
    }

    public function getRatingLog() {
        return RatingLog::model()->find('who_vote = :who_vote AND who_received = :who_received', array(':who_vote' => Yii::app()->user->id, ':who_received' => $this->id));
    }

    public function noEmail()
    {
        $error = true;
        $model = self::model()->find(array(
                'condition'=>'email = :id',
                'params'=>array('id'=>$this->email),
            )
        );

        if(isset($model) && empty($model->identity)) {
            $error = false;
        }

        if ($error == true) {
            $this->addError('email', 'This email-a is not in the database.');
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
            'userCertificates' => array(self::MANY_MANY, 'Certificates', 'user_certificate(user_id, certificate_id)'),
            'certificates' => array(self::HAS_MANY, 'UserCertificate', 'user_id'),
            'completed' => array(self::HAS_MANY, 'CompletedProjects', 'user_id'),
            'pdf' => array(self::HAS_MANY, 'MultipleImages', 'item_id', 'condition' => 'content_type = :type', 'params' => array(':type' => $this->getClass())),
            'cities0' => array(self::BELONGS_TO, 'Cities', 'city_id'),
            'speciality' => array(self::MANY_MANY, 'Speciality', 'user_speciality(user_id, speciality_id)'),
            'userspeciality' => array(self::HAS_MANY, 'UserSpeciality', 'user_id'),
            'connectedUsers' => array(self::MANY_MANY, 'User', 'user_reference(user_initiator, user_receiver)'),
            'connectedAssoc' => array(self::MANY_MANY, 'AssociationMembership', 'user_association(user_id, association_id)'),
        );
    }

    public function validatePassword($password)
    {
        return $this->hashPassword($password, $this->salt) === $this->password;
    }

    /**
     * Generates the password hash.
     * @param string password
     * @param string salt
     * @return string hash
     */
    public function hashPassword($password, $salt)
    {
        return md5($salt . $password);
    }

    /**
     * Generates a salt that can be used to generate a password hash.
     * @return string the salt
     */
    public function generateSalt()
    {
        return uniqid('', true);
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'identity' => Yii::t("base", 'Identity'),
            'network' => Yii::t("base", 'Network'),
            'name' => Yii::t("base","Name"),
            'surname' => Yii::t("base","Second Name"),
            'email' => Yii::t("base","Email"),
            'password' => Yii::t("base","Password"),
            'password_repeat' => Yii::t("base","Repeat Password"),
            'salt' => 'Salt',
            'fullName' => Yii::t("base", 'Full Name'),
            'is_active' => 'Is Active',
            'is_staff' => 'Is Staff',
            'last_login' => 'Last Login',
            'date_joined' => 'Date Joined',
            'avatar' => Yii::t("base","Avatar"),
            'phone' => Yii::t("base","phone"),
            'address' => Yii::t("base","address"),
            'country_id' => Yii::t("base","Country"),
            'city_id' => Yii::t("base","City"),
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */

    public function getIsUserOnline()
    {
        // select five minutes ago
        $five_minutes_ago = mktime(date("H"), date("i") - 5, date("s"), date("m"), date("d"), date("Y"));

        if ($this->last_login > $five_minutes_ago)
            return true;
        else
            return false;
    }

    public function findMember()
    {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('username', $this->username, true);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('surname', $this->surname, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('city_id', $this->city_id);
        $criteria->compare('rating', $this->rating);
        $criteria->compare('level', $this->level);
        $criteria->compare('password', $this->password, true);
        $criteria->compare('salt', $this->salt, true);
        $criteria->compare('is_active', $this->is_active);
        $criteria->compare('is_staff', $this->is_staff);
        $criteria->compare('last_login', $this->last_login, true);
        $criteria->compare('date_joined', $this->date_joined, true);

        $criteria->scopes = 'search_active';
        //$criteria->addCondition('is_active = 1 && is_staff = 0 && expert_confirm = 1');

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => "RAND()",
            ),
            'pagination' => array('Pagesize' => Yii::app()->params['defaultPageSize']),
        ));
    }

    public function searchMember($param)
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('username', $this->username, true);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('surname', $this->surname, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('expert_confirm', $this->expert_confirm);
        $criteria->compare('password', $this->password, true);
        $criteria->compare('salt', $this->salt, true);
        $criteria->compare('is_active', $this->is_active);
        $criteria->compare('is_staff', $this->is_staff);
        $criteria->compare('last_login', $this->last_login, true);
        $criteria->compare('date_joined', $this->date_joined, true);

        $key = get_class($this) . '_page'; // e.g. Model_page

        if (isset($_GET['ajax']) && !isset($_GET[$key])) {
            Yii::app()->session[get_class($this) . '_page'] = 1;
        }

        if (!empty($_GET[$key])) {
            Yii::app()->session[get_class($this) . '_page'] = $_GET[$key]; // update current active page
        } elseif (isset(Yii::app()->session[get_class($this) . '_page'])) {
            $_GET[$key] = Yii::app()->session[get_class($this) . '_page']; // set latest active page
        }

        $criteria->addCondition('is_staff = 0');

        if($param == 'new')
            $criteria->addCondition('is_seen = 0 AND is_staff = 0 AND is_seeker = 0');
        elseif($param == 'newlevel')
            $criteria->addCondition('level <> new_level');

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function searchStaff()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('username', $this->username, true);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('surname', $this->surname, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('expert_confirm', $this->expert_confirm);
        $criteria->compare('password', $this->password, true);
        $criteria->compare('salt', $this->salt, true);
        $criteria->compare('is_active', $this->is_active);
        $criteria->compare('is_staff', $this->is_staff);
        $criteria->compare('last_login', $this->last_login, true);
        $criteria->compare('date_joined', $this->date_joined, true);

        $key = get_class($this) . '_page'; // e.g. Model_page

        if (isset($_GET['ajax']) && !isset($_GET[$key])) {
            Yii::app()->session[get_class($this) . '_page'] = 1;
        }

        if (!empty($_GET[$key])) {
            Yii::app()->session[get_class($this) . '_page'] = $_GET[$key]; // update current active page
        } elseif (isset(Yii::app()->session[get_class($this) . '_page'])) {
            $_GET[$key] = Yii::app()->session[get_class($this) . '_page']; // set latest active page
        }

        $criteria->addCondition('is_staff = 1');

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function beforeSave()
    {
        if ($this->isNewRecord) {
            $this->salt = $this->generateSalt();
            $this->password = $this->hashPassword($this->password, $this->salt);
        }

        return parent::beforeSave();
    }

    public function todayRegistrations()
    {
        $crt = new CDbCriteria();
        $day_ago = date("Y-m-d H:i:s", mktime(date("H"), date("i"), date("s"), date("m"), date("d") - 1, date("Y")));
        $crt->select = '*, UNIX_TIMESTAMP(date_joined) as date_joined';
        $crt->condition = 'date_joined > :param';
        $crt->params = array(':param' => $day_ago);
        return self::model()->findAll($crt);
    }

    public function existsOrders()
    {
        $crt = new CDbCriteria();
        $crt->condition = 'customer = :uid && is_saved = 1';
        $crt->params = array(':uid'=>Yii::app()->user->id);;
        return Order::model()->count($crt);
    }

    public function getUDescription()
    {
        if(empty($this->description))
            return 'no description';

        return nl2br($this->description);
    }

    public function sendEmail($subject, $body, $to) {
        $mailer = Yii::createComponent('application.extensions.mailer.EMailer');
        $mailer->From = Yii::app()->name;
        $mailer->AddReplyTo(Yii::app()->params['no-replyEmail']);
        $mailer->AddAddress($to);
        $mailer->FromName = Yii::app()->name;
        $mailer->CharSet = 'UTF-8';
        $mailer->Subject = $subject;
        $mailer->IsHTML(true);  // set email format to HTML
        $mailer->Body = $body;

        if($mailer->Send()) {
            return true;
        } else {
            return false;
        }
    }

    public function getFullName() {
        return $this->name.' '.$this->surname;
    }

    public function requiredClass($attr) {
        return $this->isAttributeRequired($attr) ? 'class="required"' : '';
    }

    public function afterSave()
    {
        Yii::log('level', "error");
        if (isset($_POST['UserCertificate'])) {
            UserCertificate::model()->deleteAll('user_id = :user', array(':user' => Yii::app()->user->id));
            $param = $_POST['UserCertificate'];

            foreach ($param as $i => $item) {
                if (isset($_POST['UserCertificate'][$i]) && !empty($_POST['UserCertificate'][$i])) {
                    $modelParam = new UserCertificate();
                    $modelParam->user_id = Yii::app()->user->id;
                    $modelParam->certificate_id = $_POST['UserCertificate'][$i]["certificate_id"];

                    $modelParam->date = Yii::app()->dateFormatter->format("yyyy-MM-dd", CDateTimeParser::parse($_POST['UserCertificate'][$i]["uDate"], 'dd/MM/yyyy'));
                    if(!$modelParam->save()) {
                        Yii::log(CHtml::errorSummary($modelParam), "error");
                    }
                }
            }
        }

        if($this->scenario == 'userupdate') {
            $certs = UserCertificate::model()->findAllByAttributes(array('user_id' => Yii::app()->user->id));

            $this->new_level = 0;
            foreach($certs as $cert) {
                $this->new_level += $cert->certificate->points;
            }

            if($this->saveAttributes(array('new_level'))) {
                Yii::app()->user->setFlash('project_success1', 'Your level have been changed to '.$this->new_level);
            }
        }

        UserSpeciality::model()->deleteAllByAttributes(array('user_id'=>$this->id));
        if (isset($_POST['User']['speciality'])) {
            foreach ($_POST['User']['speciality'] as $value) {
                $categoryAttribute = new UserSpeciality();
                $categoryAttribute->user_id = $this->id;
                $categoryAttribute->speciality_id = $value;
                $categoryAttribute->save();

                $categories[] = $value;
            }
        }

        return parent::afterSave();
    }

    public function GenerateStr($length = 16)
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789";
        $code = "";
        $clen = strlen($chars) - 1;

        while (strlen($code) < $length)
            $code .= $chars[mt_rand(0, $clen)];

        return $code;
    }

    public function seenCheck()
    {
        if($this->is_seen == 0) {
            $this->is_seen = 1;
            $this->update();
        }
    }

    public function checkReport()
    {
        $alreadyExisis = Report::model()->findByAttributes(array('initiator' => Yii::app()->user->id, 'receiver' => $this->id));
        if($alreadyExisis) return false;

        return true;
    }

    public function suggestTag($keyword){
        /*$users = User::model()->with('cities0')->findAll(array(
            'condition'=>'name LIKE :keyword OR surname LIKE :keyword OR cities0.city_name_ASCII LIKE :keyword',
            'params'=>array(
                ':keyword'=>'%'.strtr($keyword,array('%'=>'\%', '_'=>'\_', '\\'=>'\\\\')).'%',
            ),
            'scopes' => 'search_active',
        ));*/

        $keyword = htmlspecialchars($keyword);
        $keyword = addslashes($keyword);
        $keyword = mb_strtolower($keyword, 'UTF-8');

        $users = User::model()->findAll($this->searchCriteria($keyword));
        return $users;
    }

    public function searchCriteria($q) {
        $queryTerms = explode(' ', $q);

        $crt = new CDbCriteria;
        $crt->with=array(
            'speciality',
            'cities0'
        );

        foreach ($queryTerms as $k => $req) {
            $tCriteria = new CDbCriteria();

            $tCriteria->condition = "name LIKE :$k OR surname LIKE :$k OR cities0.city_name_ASCII LIKE :$k OR speciality.speciality LIKE :$k";
            $tCriteria->params[":$k"] = '%'.strtr($req, array('%'=>'\%', '_'=>'\_', '\\'=>'\\\\', '(' => '', ')' => '')).'%';

            $crt->mergeWith($tCriteria);
        }
        $crt->scopes = 'search_active';
        $crt->order = 't.id DESC';

        return $crt;
    }

    public function getAssocList()
    {
        $models = Countries::model()->findAll(array('order'=>'country_name ASC'));
        $list = CHtml::listData($models, 'iso', 'country_name');
        $list = $this->moveToTop($list, 'Switzerland');
        $list = $this->moveToTop($list, 'Austria');
        $list = $this->moveToTop($list, 'Germany');

        return $list;
    }

    private function moveToTop($array, $key) {
        $insert = '';
        foreach ($array as $index => $value) {
            if($value != $key)
                $newArray[$index] = $value;
            else
                $insert[$index] = $value;
        }

        $newArray = $insert + $newArray;
        return $newArray;
    }

    public static function getSpecialityList()
    {
        $models = Speciality::model()->findAll();
        return CHtml::listData($models, 'id', 'speciality');
    }

    public function getCityList()
    {
        return CHtml::listData(Cities::model()->findAll(), 'geonameid', 'city_name_ASCII');
    }

    public function getSelectedCity() {
        $model = Cities::model()->find(array('condition' => 'geonameid = :id', 'params' => array(':id' => $this->city_id)));
        if($model) {
            $ret_arr = array('id' => $model->geonameid, 'value' => $model->city_name_ASCII);
            return json_encode($ret_arr);
        } else {
            return json_encode(array());
        }
    }
}