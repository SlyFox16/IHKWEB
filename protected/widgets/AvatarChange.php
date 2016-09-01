<?php
class AvatarChange extends CWidget
{
    public function run()
    {
        $this->render("avatar_change", array('model' => new User()));
    }
}