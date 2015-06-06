<?php

class CAuthHelper {
	static function isUsersCAbinet($id) {
        $model = Yii::app()->user->is_user;

        if(!$model) return false;
		return $id == Yii::app()->user->id;
	}

    static function isIssetExpert($id) {
        $user = User::model()->findByPk($id);
        if(isset($user) && !$user->is_staff)
            return true;

        return false;
    }
}