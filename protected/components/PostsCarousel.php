<?php
class PostsCarousel extends  CWidget
{
    public $article;
    public $video = false;

    public function run()
    {
        $criteria=new CDbCriteria;
        $criteria->condition = 'id <> :id';
        $criteria->addCondition("article_category_id = :articleCategory");

        if($this->video)
            $criteria->addCondition("category_id = 6");

        $criteria->limit = 5;
        $criteria->addInCondition("is_active", arr_language());
        $criteria->params[':id'] = $this->article->id;
        $criteria->params[':articleCategory'] = $this->article->article_category_id;

        $articles = Article::model()->findAll($criteria);

        //if(!empty($articles))
            $this->render("post_carusel", array('articles' => $articles));
    }
}