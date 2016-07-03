<?php
/**
 * Created by Idol IT.
 * Date: 10/1/12
 * Time: 3:30 PM
 */

class CreateCertifivate extends CWidget
{
    public $user;

    public function init(){
        $this->render('create_certificate', array('model' => new UserCertificate(), 'user' => $this->user));
    }
}