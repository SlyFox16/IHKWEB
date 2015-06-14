<?php

class Xingpopup extends CWidget
{
    public function run()
    {
        Yii::app()->clientScript->registerScriptFile('https://www.xing-share.com/plugins/login.js', CClientScript::POS_HEAD);
        $this->render("xing_pass");
    }
}