<?php
class ComingEvents extends  CWidget
{
    public $article;

    public function run()
    {
        $criteria=new CDbCriteria;
        $criteria->condition = "STR_TO_DATE(event_date, '%Y-%m-%d %H:%i') >= NOW()";
        $criteria->addCondition('category_id = 2 && article_category_id = 6 && id <> :id');
        $criteria->addInCondition("is_active", arr_language());
        $criteria->params[':id'] = $this->article->id;

        $events = Article::model()->findAll($criteria);

        if($events)
            $this->render("coming_events", array('events' => $events));
    }
}