<?php
class Sidebar extends  CWidget
{
    public function run()
    {
        $slug = Yii::app()->controller->id . '/' . Yii::app()->controller->action->id;
        $crt = new CDbCriteria;
        $crt->condition = '(slug = :slug || slug = "all") and is_active = 1';
        $crt->params = array(':slug' => $slug);
        $categoryes = BannerCategory::model()->findAll($crt);

        $banners = Banner::model()->findAllBySql('SELECT b.* FROM banner b WHERE b.is_active IN '.arr_language(true).' AND b.banner_category_id IN '.mass($categoryes));

        $countBanners = count($banners);

        //=======================infografic=======================
        $crt = new CDbCriteria;
        $crt->condition = 'category_id = 4 && article_category_id = 5';
        $crt->addInCondition("is_active", arr_language());
        $crt->order = 'created DESC';
        $infographic  =  Article::model()->find($crt);

        //=======================video=======================
        $crt = new CDbCriteria;
        $crt->condition = 'category_id = 6 && article_category_id = 1';
        $crt->addInCondition("is_active", arr_language());
        $crt->order = 'created DESC';
        $video  =  Article::model()->find($crt);

        //=======================event=======================
        $criteria = new CDbCriteria;
        $criteria->condition = 'category_id = 2 && article_category_id = 6';
        $criteria->addInCondition("is_active", arr_language());

        $events = Article::model()->findAll($criteria);

        //=======================photo=======================
        $crt = new CDbCriteria;
        $crt->order = 'id DESC';
        $crt->limit = 3;
        $photoes  =  AlbumImage::model()->findAll($crt);

        $this->render("sidebar", array(
                'countBanners' => $countBanners,
                'infographic'=> $infographic,
                'events' => $events,
                'video' => $video,
                'photoes' => $photoes
            )
        );
    }
}