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
        return $user ? $user->name : '';
    }

    public function getSurName(){
        $user = $this->loadUser(Yii::app()->user->id);
        return $user ? $user->surname : '';
    }

    public function getUsername(){
        $user = $this->loadUser(Yii::app()->user->id);
        return $user ? $user->username : '';
    }

    public function getIsStaff(){
        $user = $this->loadUser(Yii::app()->user->id);
        return $user->is_staff;
    }

    public function getIs_user(){
        $user = $this->loadUser(Yii::app()->user->id);
        if(!$user) return false;
        return $user->is_seeker ? false : true;
    }

    public function getIs_seeker(){
        $user = $this->loadUser(Yii::app()->user->id);
        return $user->is_seeker;
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