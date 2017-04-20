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
        $criteria->condition = 'who_received = :user AND confirmed = 1';
        $criteria->group = 'num';
        $criteria->params[':user'] = $this->user->id;
        $ratings = RatingLog::model()->findAll($criteria);
        $ratings = CHtml::listData($ratings, 'num', 'count');
        ksort($ratings);

        if ($ratings)
            $this->render($this->view, array('ratings' => $ratings));
    }
}