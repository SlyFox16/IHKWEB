<?php

class PassChange extends CWidget
{
    public $change = false;

    public function run()
    {
        if($this->change)
            $this->render("pass_change", array('model' => new User()));
        else
            $this->render("restore_pass", array('model' => new User()));
    }
}