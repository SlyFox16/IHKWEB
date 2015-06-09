<?php

class CAuthHelper {
	static function isUsersCAbinet($id) {
        $model = Yii::app()->user->is_user;

        if(!$model) return false;
		return $id == Yii::app()->user->id;
	}

    static function isIssetExpert($id) {
        $user = User::model()->is_active()->user()->expert_confirm()->findByPk($id);
        if(isset($user) && !$user->is_staff)
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