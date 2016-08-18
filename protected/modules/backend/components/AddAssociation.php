<?php
/**
 * Created by Idol IT.
 * Date: 10/1/12
 * Time: 3:30 PM
 */

class AddAssociation extends CWidget
{
    public $user;

    public function init(){
        $this->render('add_association', array('model' => new UserAssociation(), 'user' => $this->user));
    }
}