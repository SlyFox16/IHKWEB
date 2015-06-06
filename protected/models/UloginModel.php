<?php

class UloginModel extends CModel {

    public $identity;
    public $network;
    public $email;
    public $name;
    public $surname;
    public $token;
    public $error_type;
    public $error_message;

    private $uloginAuthUrl = 'http://ulogin.ru/token.php?token=';

    public function rules() {
        return array(
            //array('identity, network', 'required'),
            //array('email', 'email'),
            array('identity, network, email', 'length', 'max'=>255),
            array('name, surname', 'length', 'max'=>80),
        );
    }

    public function attributeLabels() {
        return array(
            'network'=>'Service',
            'identity'=>'Service identity',
            'email'=>'eMail',
            'name'=>'Name',
        );
    }

    public function getAuthData() {
        $authData = json_decode(file_get_contents($this->uloginAuthUrl.$this->token.'&host='.$_SERVER['HTTP_HOST']),true);
        $this->setAttributes($authData);
        $this->name = (isset($authData['first_name']) ? $authData['first_name'] : '');
        $this->surname = (isset($authData['last_name']) ? $authData['last_name'] : '');
    }

    public function login() {
        $identity = new UloginUserIdentity();
        if ($identity->authenticate($this)) {
            $duration = 3600*24*30;
            Yii::app()->user->login($identity,$duration);
            return true;
        }
        return false;
    }

    public function attributeNames() {
        return array(
            'identity'
            ,'network'
            ,'email'
            ,'name'
            ,'surname'
            ,'token'
            ,'error_type'
            ,'error_message'
        );
    }
}