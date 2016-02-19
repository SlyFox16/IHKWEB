<?php
class RatingDescription extends CWidget
{
    public $user;

    public function run()
    {
        if($this->user && !Yii::app()->user->isGuest && ($this->user->id != Yii::app()->user->id)) {
            $model = RatingLog::model()->find('who_vote = :who_vote AND who_received = :who_received', array(':who_vote' => Yii::app()->user->id, ':who_received' => $this->user->id));

            if(!$model)
                $model = new RatingLog();

            $this->render("rating_description", array('model' => $model, 'user' => $this->user));
        }
    }
}