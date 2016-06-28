<?php
class RatingDescription extends CWidget
{
    public $user;

    public function run()
    {
        $disabled = (!$this->user->ratingLog && !Yii::app()->user->isGuest && $this->user->id != Yii::app()->user->id) || ($this->user->ratingLog && empty($this->user->ratingLog->description) && !Yii::app()->user->isGuest && $this->user->id != Yii::app()->user->id) ? false : true;

        if(!$disabled) {
            $model = RatingLog::model()->find('who_vote = :who_vote AND who_received = :who_received', array(':who_vote' => Yii::app()->user->id, ':who_received' => $this->user->id));

            if(!$model)
                $model = new RatingLog();

            $this->render("rating_description", array('model' => $model, 'user' => $this->user));
        }
    }
}