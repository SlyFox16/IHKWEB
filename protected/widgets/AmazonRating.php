<?php
class AmazonRating extends CWidget
{
    public $user;
    public $view = 'amazon_rating';

    public function run()
    {
        Yii::app()->clientScript->registerScriptFile($this->controller->assetsUrl.'/javascripts/jquery.raty-fa.js', CClientScript::POS_END);

        $criteria=new CDbCriteria;
        $criteria->select = 'num, COUNT(*) as count';
        $criteria->condition = 'who_received = :user && confirmed = 1';
        $criteria->group = 'num';
        $criteria->params[':user'] = $this->user->id;
        $ratings = RatingLog::model()->findAll($criteria);
        $ratings = CHtml::listData($ratings, 'num', 'count');

        for ($i = 1; $i <= 5; $i++) {
            if (!isset($ratings[$i])) $ratings[$i] = 0;
        }
        ksort($ratings);
        $all = RatingLog::model()->count('who_received = :user && confirmed = 1', array(':user' => $this->user->id));

        $this->render($this->view, array('ratings' => $ratings, 'all' => $all));
    }
}