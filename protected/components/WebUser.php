<?php

class WebUser extends CWebUser {

    // Store model to not repeat query.
    private $_model;

    // Return first name.
    // access it by Yii::app()->user->first_name
    public function getFull_Name(){
        $user = $this->loadUser(Yii::app()->user->id);
        return $user->name.' '.$user->surname;
    }

    public function getName(){
        $user = $this->loadUser(Yii::app()->user->id);
        return $user->name;
    }

    public function getSurName(){
        $user = $this->loadUser(Yii::app()->user->id);
        return $user->surname;
    }

    public function getUsername(){
        $user = $this->loadUser(Yii::app()->user->id);
        return $user->username;
    }

    public function getAvater(){
        $user = $this->loadUser(Yii::app()->user->id);
        return $user->UAvatar;
    }

    public function getIs_user(){
        $user = $this->loadUser(Yii::app()->user->id);
        return isset($user);
    }

    // Load user model.
    private function loadUser($id=null)
    {
        if($this->_model===null)
        {
            if($id!==null)
                $this->_model=User::model()->findByPk($id);
        }
        return $this->_model;
    }
}