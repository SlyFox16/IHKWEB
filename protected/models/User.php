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
        $options = array(
            'AutoFormat.AutoParagraph' => TRUE,
        );
        $this->htmlpurifier = new CHtmlPurifier();
        $this->htmlpurifier->options = $options;
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
            array('username, name, surname, email, password, password_repeat', 'required', 'on' => 'insert'),
            array('username, name, surname, email', 'required', 'on' => 'update, userupdate, socials'),
            array('password, password_repeat', 'required', 'on' => 'updatepassword'),
            array('username, name, surname, address, position','filter','filter'=>'strip_tags'),
            array('username', 'match', 'pattern' => '/^[a-zA-Z0-9\._-]+$/', 'message' => 'Wrong format!'),
            array('description','filter','filter'=>array($this->htmlpurifier,'purify')),
            array('email', 'noEmail', 'on' => 'changepassword'),
            array('is_active', 'numerical', 'integerOnly' => true),
            array('avatar', 'file', 'types'=>'png, jpg, gif','allowEmpty'=>true),
            array('vcf', 'file', 'types'=>'vcf','allowEmpty'=>true),
            array('password', 'length', 'min' => 5),
            array('name', 'length', 'max' => 80),
            array('password, identity, network', 'length', 'max' => 512),
            array('phone', 'match', 'pattern'=>'/^[-+()0-9 ]+$/', 'message' => Yii::t("base",'Wrong phone format')),
            array('facebook_url, twitter_url, xing_url', 'url'),
            array('salt, username, phone, address', 'length', 'max' => 255),
            array('email, username', 'unique', 'except' => 'changepassword'),
            array('email', 'email', 'message' => 'Email is not valid.'),
            array('password', 'compare', 'on' => 'insert, updatepassword, register'),
            array('password_repeat, certificates, facebook_url, twitter_url, last_login, xing_url, date_joined, is_staff, identity, network, comment, position, description, expert_confirm', 'safe'),
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
        );
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
            'identity' => 'Identity',
            'network' => 'Network',
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
        $criteria->condition ='is_active = 1 && is_staff = 0 && expert_confirm = 1';

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function searchMember($param)
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('password', $this->password, true);
        $criteria->compare('salt', $this->salt, true);
        $criteria->compare('is_active', $this->is_active);
        $criteria->compare('is_staff', $this->is_staff);
        $criteria->compare('last_login', $this->last_login, true);
        $criteria->compare('date_joined', $this->date_joined, true);

        $criteria->addCondition('is_staff = 0');

        if($param)
            $criteria->addCondition('is_seen = 0');

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
        $criteria->compare('name', $this->name, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('password', $this->password, true);
        $criteria->compare('salt', $this->salt, true);
        $criteria->compare('is_active', $this->is_active);
        $criteria->compare('is_staff', $this->is_staff);
        $criteria->compare('last_login', $this->last_login, true);
        $criteria->compare('date_joined', $this->date_joined, true);

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

    public function getUAvatar()
    {
        if(empty($this->avatar))
            return substr(Yii::app()->controller->getAssetsUrl().'/images/profile-no-photo.png', 1);

        return $this->avatar;
    }

    public function getUDescription()
    {
        if(empty($this->description))
            return 'no description';

        return $this->description;
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
        if (isset($_POST['UserCertificate'])) {
            UserCertificate::model()->deleteAll('user_id = :user', array(':user' => Yii::app()->user->id));
            $param = $_POST['UserCertificate'];

            foreach ($param as $i => $item) {
                if (isset($_POST['UserCertificate'][$i]) && !empty($_POST['UserCertificate'][$i])) {
                    $modelParam = new UserCertificate();
                    $modelParam->user_id = Yii::app()->user->id;
                    $modelParam->certificate_id = $_POST['UserCertificate'][$i]["certificate_id"];
                    $modelParam->date = $_POST['UserCertificate'][$i]["date"];
                    if(!$modelParam->save()) {
                        Yii::log(CHtml::errorSummary($modelParam), "error");
                    }

                }
            }
        }

        if($this->scenario == 'userupdate') {
            $cert = UserCertificate::model()->findAllByAttributes(array('user_id' => Yii::app()->user->id));

            if(!empty($this->position) && !empty($this->description) && !empty($this->avatar) && $this->level == 0) {
                $this->level += 1;
                $this->levelUp = true;
                $this->levelDown = false;
            }
            if(!empty($this->address) && !empty($this->phone) && $this->level == 1 && (!empty($this->facebook_url) || !empty($this->twitter_url) || !empty($this->xing_url))) {
                $this->level += 1;
                $this->levelUp = true;
                $this->levelDown = false;
            }
            if(!empty($cert) && $this->level == 2) {
                $this->level += 1;
                $this->levelUp = true;
                $this->levelDown = false;
            }


            if((empty($this->position) || empty($this->description) || empty($this->avatar)) && $this->level > 0) {
                $this->level -= 1;
                $this->levelUp = false;
                $this->levelDown = true;
            }
            if((empty($this->address) || empty($this->phone) || (empty($this->facebook_url) && empty($this->twitter_url) && empty($this->xing_url))) && $this->level > 1) {
                $this->level -= 1;
                $this->levelUp = false;
                $this->levelDown = true;
            }
            if(empty($cert) && $this->level > 2) {
                $this->level -= 1;
                $this->levelUp = false;
                $this->levelDown = true;
            }
            //($this->certificates); die();

            if($this->saveAttributes(array('level'))) {
                if($this->levelUp)
                    Yii::app()->user->setFlash('project_success1', 'Congratulations, You have reached level '.$this->level);
                if($this->levelDown)
                    Yii::app()->user->setFlash('project_error1', 'Your level went down to '.$this->level);
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
        if($this->id == Yii::app()->user->id)

        return true;
    }
}