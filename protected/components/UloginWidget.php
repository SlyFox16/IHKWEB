<?php

class UloginWidget extends CWidget
{
    public static $counter = 0;
    
    private $params = array(
        'display'       =>  'buttons',
        'fields'        =>  'first_name,last_name,email',
        'providers'     =>  'vkontakte,odnoklassniki,facebook',
        'hidden'        =>  '',
        'redirect'      =>  '',
        'logout_url'    =>  '',
        'lang'          =>  'en',
    );

    public function run()
    {    
        Yii::app()->clientScript->registerScriptFile('http://ulogin.ru/js/ulogin.js', CClientScript::POS_HEAD);
        
        $this->params['counter']= self::$counter++;
        $this->render('uloginWidget', $this->params);
    }

    public function setParams($params)
    {
        $this->params = array_merge($this->params, $params);
    }
}
