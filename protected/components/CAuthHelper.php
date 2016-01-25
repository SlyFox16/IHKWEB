<?php

class CAuthHelper {
	static function isUsersCAbinet() {
        $is_user = Yii::app()->user->is_user;

        if(!$is_user) return false;
        return true;
	}

    static function isIssetExpert($id) {
        $user = User::model()->is_active()->findByPk($id);

        if($user->is_seeker) return false;

        if($user && !$user->is_staff && $user->expert_confirm)
            return true;

        if($id == Yii::app()->user->id)
            return true;

        if($user->is_staff)
            return true;

        return false;
    }

    static function hasRightToVote() {
        $username = Yii::app()->request->getPost('username');
        $index = (int) Yii::app()->request->getPost('index');

        $user = User::model()->findByAttributes(array('username' => $username));

        if(!$user) return false;
        if($user->id == Yii::app()->user->id) return false;

        $log = RatingLog::model()->findAllByAttributes(array('who_vote' => Yii::app()->user->id, 'who_received' => $user->id));
        if($log) return false;
        if(empty($index) || !is_int($index)) return false;

        return true;
    }
}