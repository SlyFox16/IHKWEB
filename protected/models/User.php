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
    public $userAssociation = false;

    public $certificate;
    public $certificate_date;

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
            array('username, address, country_id, city_id', 'required', 'on' => 'userupdate'),
            array('password, password_repeat', 'required', 'on' => 'updatepassword'),
            array('username, name, surname, address, position','filter','filter'=>'strip_tags'),
            array('username', 'match', 'pattern' => '/^[a-zA-Z0-9\._-]+$/', 'message' => Yii::t("base", 'Wrong format!')),
            array('description','filter','filter'=>array($this->htmlpurifier,'purify')),
            array('email', 'noEmail', 'on' => 'changepassword'),
            array('is_active, is_staff, is_seeker, is_seen, level, new_level, expert_confirm', 'numerical', 'integerOnly' => true),
            array('avatar', 'file', 'types'=>'png, jpg, gif, jpeg', 'safe' => false,'allowEmpty'=>true),
            array('vcf', 'file', 'types'=>'pdf', 'safe' => false,'allowEmpty'=>true),
            array('password', 'length', 'min' => 5),
            array('name, surname', 'length', 'max' => 80),
            array('password, identity, network', 'length', 'max' => 512),
            array('title', 'length', 'max' => 20),
            array('phone', 'match', 'pattern'=>'/^[-+()0-9 ]+$/', 'message' => Yii::t("base",'Wrong phone format')),
            array('facebook_url, twitter_url, xing_url, web_url', 'url'),
            array('salt, username, email, phone, address, companyname, position, facebook_url, linkedin_url, twitter_url, 	xing_url', 'length', 'max' => 255),
            array('email, username', 'unique', 'except' => 'changepassword'),
            array('email', 'email', 'message' => 'Email is not valid.'),
            array('password', 'compare', 'on' => 'insert, updatepassword, register, seeker'),
            array('password_repeat, certificates, last_login, date_joined, is_staff, identity, network, comment, expert_confirm, level, new_level, seeker_pass, country_id, city_id, rating, userAssociation', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, name, surname, email, password, salt, is_active, is_staff, last_login, date_joined', 'safe', 'on' => 'search'),
            array('is_active', 'default', 'value' => 1,'setOnEmpty' => false, 'on' => 'insert, backendcreate'),
            array('date_joined', 'default', 'value' => date("Y-m-d H:i:s"), 'setOnEmpty' => false, 'on' => 'insert, register, socials, backendcreate')
        );
    }

    public function scopes()
    {
        return array(
            'user'=>array('condition'=>"is_staff = 0"),
            'staff'=>array('condition'=>"is_staff = 1"),
            'expert_confirm'=>array('condition'=>"expert_confirm = 1 || (expert_confirm = 0 && is_staff = 1)"),
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

        if(isset($model) /*&& empty($model->identity)*/) {
            $error = false;
        }

        if ($error == true) {
            $this->addError('email', Yii::t("base", 'This email-a is not in the database.'));
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
            'name' => Yii::t("base","First Name"),
            'surname' => Yii::t("base","Second Name"),
            'email' => Yii::t("base","Email"),
            'password' => Yii::t("base","Password"),
            'password_repeat' => Yii::t("base","Repeat Password"),
            'salt' => 'Salt',
            'fullName' => Yii::t("base", 'Full Name'),
            'is_active' => 'Is Active',
            'is_staff' => 'Admin',
            'last_login' => 'Last Login',
            'date_joined' => 'Date Joined',
            'position' => Yii::t("base","Position"),
            'speciality' => Yii::t("base","Speciality"),
            'username' => Yii::t("base","UserName"),
            'level' => Yii::t("base","Level"),
            'rating' => Yii::t("base","Rating"),
            'avatar' => Yii::t("base","Avatar"),
            'phone' => Yii::t("base","phone"),
            'address' => Yii::t("base","address"),
            'country_id' => Yii::t("base","Country"),
            'city_id' => Yii::t("base","City"),
            'companyname' => Yii::t("base","Company name"),
            'description' => Yii::t("base","Company description"),
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

    public function findCertificates()
    {
        $criteria = new CDbCriteria;

        $criteria->condition = 'user_id = :user_id';
        $criteria->params[':user_id'] = $this->id;

        return new CActiveDataProvider(new UserCertificate(), array(
            'criteria' => $criteria,
            'pagination' => false,
        ));
    }

    public function findCompleted()
    {
        $criteria = new CDbCriteria;

        $criteria->condition = 'user_id = :user_id';
        $criteria->params[':user_id'] = $this->id;

        return new CActiveDataProvider(new CompletedProjects(), array(
            'criteria' => $criteria,
            'pagination' => false,
        ));
    }

    public function findAssociation()
    {
        $criteria = new CDbCriteria;

        $criteria->condition = 'user_id = :user_id';
        $criteria->params[':user_id'] = $this->id;

        return new CActiveDataProvider(new UserAssociation(), array(
            'criteria' => $criteria,
            'pagination' => false,
        ));
    }

    public function searchRatingList()
    {
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

        $criteria->addCondition('is_staff = 0 AND is_seeker = 0');
        $criteria->order = 'rating DESC, level DESC';

        return new CActiveDataProvider(new User, array(
            'criteria' => $criteria,
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

        $criteria->addCondition('is_staff = 0 AND is_seeker = 0');

        if($param == 'new')
            $criteria->addCondition('is_seen = 0 AND expert_confirm = 0 AND is_staff = 0 AND is_seeker = 0');
        if($param == 'newcertificate') {
            $criteria->join = 'LEFT JOIN user_certificate us ON us.user_id = t.id';
            $criteria->addCondition('us.confirm = 0');
        }
        if($param == 'newprojects') {
            $criteria->join = 'LEFT JOIN completed_projects cp ON cp.user_id = t.id';
            $criteria->addCondition('cp.confirm = 0');
        }
        elseif($param == 'newlevel')
            $criteria->addCondition('level <> new_level');

        return new CActiveDataProvider(new User, array(
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

    protected function beforeValidate()
    {
        if($this->isNewRecord)
            $this->username = YText::translit($this->name).YText::translit($this->surname).rand(1, 999);

        return parent::beforeValidate();
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
            return Yii::t("base", 'no description');

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
        if ($this->scenario == 'userupdate') {
            $certs = UserCertificate::model()->findAllByAttributes(array('user_id' => Yii::app()->user->id));

            $this->new_level = 0;
            foreach ($certs as $cert) {
                $this->new_level += $cert->certificate->points;
            }

            if($this->saveAttributes(array('new_level'))) {
                User::newLevel(Yii::app()->user->id);
                Yii::app()->user->setFlash('project_success1', Yii::t("base", 'Your level have been changed to ').$this->new_level);
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

        if (!empty($this->userAssociation)) {
            $modelReceiver = AssociationMembership::model()->findByPk($this->userAssociation);

            if ($modelReceiver) {
                $reference = new UserAssociation();
                $reference->user_id = $this->id;
                $reference->association_id = $modelReceiver->id;
                $reference->save();
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

            $tCriteria->condition = "name LIKE :$k OR surname LIKE :$k OR cities0.city_name_ASCII LIKE :$k OR cities0.city_name_UTF8 LIKE :$k OR speciality.speciality LIKE :$k";
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
        $list = CHtml::listData($models, 'iso', 'country_de');
        $list = $this->moveToTop($list, 'CH');
        $list = $this->moveToTop($list, 'AT');
        $list = $this->moveToTop($list, 'DE');

        return $list;
    }

    private function moveToTop($array, $key) {
        $insert = '';
        foreach ($array as $index => $value) {
            if($index != $key)
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
        return CHtml::listData(Cities::model()->findAll(), 'geonameid', 'city_name_UTF8');
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

    public static function getCityCountry($id, $flag = 'city') {
        $return = '';
        if ($flag == 'city') {
            $city = Cities::model()->findByPk($id);
            $return = $city ? $city->city_name_UTF8 : '';
        } else {
            $country = Countries::model()->find('iso = :country_id', array(':country_id' => $id));
            $return = $country ? $country->country_de : '';
        }

        return $return;
    }

    public static function newLevel($id) {
        $user = User::model()->findByPk($id);
        $level = 0;
        if($user) {
            $certtificates = $user->certificates(array('scopes' => array('confirmed')));
            if($certtificates)
                foreach($certtificates as $cert)
                    $level += $cert->certificate->points;

            $user->level = $level;
            $user->saveAttributes(array('level'));
        }
        return $level;
    }

    public function getPageTitle() {
        $sList = array();
        if ($specList = $this->speciality) {
            foreach($specList as $speciality) {
                $sList[] = $speciality->speciality;
            }

            $sList = implode(', ', $sList);
        }
        $sList = !empty($sList) ? "für $sList " : '';

        $aList = array();
        if ($connected = $this->connectedAssoc) {
            foreach($connected as $conUser) {
                $aList[] = $conUser->name;
            }

            $aList = implode(', ', $aList);
        }
        $aList = !empty($aList) ? "Mitglied bei - $aList" : '';

        return "{$this->title} {$this->fullname} - Crowd Expert {$sList}in ".self::getCityCountry($this->city_id, 'city')." $aList" ;
    }

    public function getStatusConfirm() {
        $stat = array(0 => 'Unconfirmed', 1 => 'Confirmed');
        return $stat[$this->expert_confirm];
    }

    public function getStatusActive() {
        $stat = array(0 => 'Inactve', 1 => 'Active');
        return $stat[$this->is_active];
    }

    public function getStatusStaff() {
        $stat = array(0 => 'User', 1 => 'Admin');
        return $stat[$this->is_staff];
    }

    public function getClearUrl() {
        return preg_replace("(^https?://)", "", $this->web_url);
    }
}
