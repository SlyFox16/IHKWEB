<?php
class AvatarChange extends CWidget
{
    public $change = false;
    public $open = false;

    public function run()
    {
        $this->render("pass_change", array('model' => new User()));
    }
}