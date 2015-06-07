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
        Yii::app()->clientScript->registerScript('xing',"
            (function(d) {
                var js, id='lwx';
                if (d.getElementById(id)) return;
                js = d.createElement('script'); js.id = id; js.src = 'https://www.xing-share.com/plugins/login.js';
                d.getElementsByTagName('head')[0].appendChild(js)
            }(document));
        ");
        //Yii::app()->clientScript->registerScriptFile('http://ulogin.ru/js/ulogin.js', CClientScript::POS_END);
        
        $this->params['counter']= self::$counter++;
        $this->render('uloginWidget', $this->params);
    }

    public function setParams($params)
    {
        $this->params = array_merge($this->params, $params);
    }
}
