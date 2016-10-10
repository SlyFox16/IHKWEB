<?php

class CAuthHelper {
	static function isUsersCAbinet()
    {
        $is_user = Yii::app()->user->is_user;

        if(!$is_user) return false;
        return true;
	}

    static function isExpert($id)
    {
        $user = User::model()->is_active()->findByPk($id);

        if (!$user) return false;

        if($user->is_seeker) return false;

        if($user && !$user->is_staff && $user->expert_confirm)
            return true;

        if($id == Yii::app()->user->id)
            return true;

        if($user->is_staff)
            return true;

        return false;
    }

    static function isUseresProject($id)
    {
        if(!isset($id)) return true;
        if(!Yii::app()->user->id) return false;

        $project = CompletedProjects::model()->findByPk($id);
        if(!$project) return false;

        if($project->user_id == Yii::app()->user->id) return true;

        return false;
    }

    static function eventExists($id)
    {
        if (empty($id)) return false;
        $event = Event::model()->findByPk($id);
        if (!$event) return false;
        return true;
    }

    static function isUsersEvent($id)
    {
        if(!isset($id)) return true;
        if(!Yii::app()->user->id) return false;

        $event = Event::model()->findByPk($id);
        if(!$event) return false;

        if($event->user_id == Yii::app()->user->id) return true;

        return false;
    }

    static function hasExpertRights()
    {
        $user = User::model()->is_active()->findByPk(Yii::app()->user->id);

        if($user->is_seeker) return false;

        if($user && !$user->is_staff && $user->expert_confirm)
            return true;

        if($user->is_staff)
            return true;

        return false;
    }

    static function hasRightToVote()
    {
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