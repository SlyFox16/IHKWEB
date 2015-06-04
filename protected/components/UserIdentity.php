<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
    const ERROR_IS_NOT_ACCTIVE = 3;

    public $_id;
    public $_name;

    public function __construct($username,$password = null)
    {
        $this->username=$username;
        $this->password=$password;
    }
    /**
     * Authenticates a user.
     * The example implementation makes sure if the email and password
     * are both 'demo'.
     * In practical applications, this should be changed to authenticate
     * against some persistent user identity storage (e.g. database).
     * @return boolean whether authentication succeeds.
     */
    public function authenticate()
    {
        $user = User::model()->find('LOWER(username)=?', array(strtolower($this->username)));
        if ($user === null)
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        else if (!$user->validatePassword($this->password))
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        else if ($user->is_active == 0)
            $this->errorCode = self::ERROR_IS_NOT_ACCTIVE;
        else {
            $this->_id = $user->id;
            $this->_name = $user->name;
            $this->setState('fullname', $user->fullname);
            $this->errorCode = self::ERROR_NONE;
        }
        return 0; // == self::ERROR_NONE;
    }

    public function autoAuthenticate()
    {
        $user = User::model()->find('LOWER(username)=?', array(strtolower($this->username)));
        if ($user === null)
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        else {
            $this->_id = $user->id;
            $this->_name = $user->name;
            $this->setState('fullname', $user->fullname);
            $this->errorCode = self::ERROR_NONE;
        }
        return $this->errorCode == self::ERROR_NONE;
    }

    public function getId()
    {
        return $this->_id;
    }

    public function getName()
    {
        return $this->_name;
    }
}