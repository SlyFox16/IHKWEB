<?php
/**
 * Created by Idol IT.
 * Date: 10/1/12
 * Time: 3:30 PM
 */

class Nav extends CWidget{


    public function init(){
        $isSeen = User::model()->count('is_seen = 0 AND is_staff = 0');
        $this->render('nav', array('isSeen' => $isSeen));
    }
}