<?php
class MainPosts extends CWidget
{
    public $category_id;

    public function run()
    {
        $criteria = new CDbCriteria;
        $criteria->condition = 'id = :categoryId';
        $criteria->addInCondition("is_active", arr_language());
        $criteria->params[':categoryId'] = $this->category_id;

        $articleCategory = ArticleCategory::model()->find($criteria);

        if(!empty($articleCategory)) {
            if($articleCategory->show_main == 2)
                $this->render("4main", array('articleCategory' => $articleCategory));
            elseif($articleCategory->show_main == 3)
                $this->render("1b3l", array('articleCategory' => $articleCategory));
            elseif($articleCategory->show_main == 4)
                $this->render("2big", array('articleCategory' => $articleCategory));
        }
    }
}