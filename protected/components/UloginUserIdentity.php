<?php

class UloginUserIdentity implements IUserIdentity
{

    private $id;
    private $name;
    private $is_staff;
    private $isAuthenticated = false;
    private $states = array();

    public function authenticate($uloginModel = null)
    {
        $criteria = new CDbCriteria;
        $criteria->condition = 'email=:email';
        $criteria->params = array(
            ':email' => $uloginModel->email,
        );

        $user = User::model()->find($criteria);

        if (null !== $user) {
            $this->id = $user->id;
            $this->name = $uloginModel->name;

            $user->username = $uloginModel->name.$uloginModel->surname.rand(1, 999);
            $user->identity = $uloginModel->identity;
            $user->network = $uloginModel->network;
            $user->name = $uloginModel->name;
            $user->surname = $uloginModel->surname;
            $user->update();
        } else {
            $user = new User('socials');
            $user->username = $uloginModel->name.$uloginModel->surname.rand(1, 999);
            $user->identity = $uloginModel->identity;
            $user->network = $uloginModel->network;
            $user->email = $uloginModel->email;
            $user->name = $uloginModel->name;
            $user->surname = $uloginModel->surname;
            $user->is_active = 1;
            $user->is_staff = 0;

            $this->id = $user->id;
            $this->name = $user->name;
            $user->save();

            $this->id = $user->id;
            $this->name = $user->name;
        }
        $this->isAuthenticated = true;
        return true;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getIsAuthenticated()
    {
        return $this->isAuthenticated;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPersistentStates()
    {
        return $this->states;
    }
}