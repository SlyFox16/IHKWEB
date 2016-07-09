<?php

class PassChange extends CWidget
{
    public $change = false;
    public $open = false;

    public function run()
    {
        if($this->change) {
            unset(Yii::app()->session['passver']);
            $this->render("pass_change", array('model' => new User()));
        }
        else
            $this->render("restore_pass", array('model' => new User()));
    }
}