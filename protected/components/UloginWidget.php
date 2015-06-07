<?php

class UloginWidget extends CWidget
{
    public static $counter = 0;
    
    private $params = array(
        'display'       =>  'buttons', //'panel'
        'fields'        =>  'first_name,last_name,email',
        'providers'     =>  'facebook,linkedin',
        'hidden'        =>  '',
        'redirect'      =>  '',
        'logout_url'    =>  '',
        'lang'          =>  'en',
    );

    public function run()
    {
        Yii::app()->clientScript->registerScriptFile('https://www.xing-share.com/plugins/login.js', CClientScript::POS_HEAD);
        Yii::app()->clientScript->registerScriptFile('http://ulogin.ru/js/ulogin.js', CClientScript::POS_END);
        
        $this->params['counter']= self::$counter++;
        $this->render('uloginWidget', $this->params);
    }

    public function setParams($params)
    {
        $this->params = array_merge($this->params, $params);
    }
}
