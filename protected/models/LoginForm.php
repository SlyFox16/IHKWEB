<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class LoginForm extends CFormModel
{
    public $email;
    public $password;
    public $rememberMe = true;

    private $_identity;

    /**
     * Declares the validation rules.
     * The rules state that email and password are required,
     * and password needs to be authenticated.
     */
    public function rules()
    {
        return array(
            // email and password are required
            array('email, password', 'required'),
            array('email', 'email', 'message' => Yii::t("base","E-mail is not valid!")),
            // rememberMe needs to be a boolean
            array('rememberMe', 'boolean'),
            // password needs to be authenticated
            array('password', 'authenticate'),
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels()
    {
        return array(
            'rememberMe'=>'Remember me next time',
            'username' => Yii::t('base','UserName'),
            'password' => Yii::t('base','Password'),
        );
    }

    /**
     * Authenticates the password.
     * This is the 'authenticate' validator as declared in rules().
     */
    public function authenticate($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $this->_identity = new UserIdentity($this->email, $this->password);
            if ($this->_identity->authenticate() == 3)
                $this->addError('email', Yii::t("base","The account is not active"));
            elseif ($this->_identity->authenticate() == 1 || $this->_identity->authenticate() == 2)
                $this->addError('password', Yii::t("base","Incorrect username or password."));
        }
    }

    /**
     * Authenticates the password.
     * This is the 'authenticate' validator as declared in rules().
     */
    public function autoAuthenticate($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $this->_identity = new UserIdentity($this->email);
            if (!$this->_identity->autoAuthenticate())
                $this->addError('password', Yii::t("base","Incorrect E-Mail Address"));
        }
    }

    /**
     * Logs in the user using the given email and password in the model.
     * @return boolean whether login is successful
     */
    public function login()
    {
        if ($this->_identity === null) {
            $this->_identity = new UserIdentity($this->email, $this->password);
            $this->_identity->authenticate();
        }
        if ($this->_identity->errorCode === UserIdentity::ERROR_NONE) {
            $duration = $this->rememberMe ? 3600 * 24 * 30 : 0; // 30 days
            Yii::app()->user->login($this->_identity, $duration);
            return true;
        } else
            return false;
    }

    public function requiredClass($attr) {
        return $this->isAttributeRequired($attr) ? 'class="required"' : '';
    }

    /**
     * Logs in the user using the given email and password in the model.
     * @return boolean whether login is successful
     */
    public function autoLogin()
    {
        if ($this->_identity === null) {
            $this->_identity = new UserIdentity($this->email);
            $this->_identity->autoAuthenticate();
        }
        if ($this->_identity->errorCode === UserIdentity::ERROR_NONE) {
            $duration = $this->rememberMe ? 3600 * 24 * 30 : 0; // 30 days
            Yii::app()->user->login($this->_identity, $duration);
            return true;
        } else
            return false;
    }
}
