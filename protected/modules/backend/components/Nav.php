<?php
/**
 * Created by Idol IT.
 * Date: 10/1/12
 * Time: 3:30 PM
 */

class Nav extends CWidget
{
    public function init(){
        $isSeen = User::model()->count('is_seen = 0 AND expert_confirm = 0 AND is_staff = 0 AND is_seeker = 0');
        $newLevel = User::model()->user()->count('level <> new_level');
        $newCertificate = UserCertificate::model()->with('user')->count('user.is_staff = 0 AND confirm = 0');
        $newProjects = CompletedProjects::model()->with('user')->count('user.is_staff = 0 AND confirm = 0');
        $this->render('nav', array('isSeen' => $isSeen, 'newLevel' => $newLevel, 'newCertificate' => $newCertificate, 'newProjects' => $newProjects));
    }
}