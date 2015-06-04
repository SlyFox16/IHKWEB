<?php

class CAuthHelper {
	static function isArticleAvailable($id) {

        $criteria = new CDbCriteria;
        $criteria->condition = 'id = :id';
        $criteria->addInCondition("is_active", arr_language());
        $criteria->params[':id'] = $id;

        $article = Article::model()->count($criteria);
		if($article) return true;

		return false;
	}

    static function isCategoryAvailable($id) {

        $criteria = new CDbCriteria;
        $criteria->condition = 'id = :id';
        $criteria->addInCondition("is_active", arr_language());
        $criteria->params[':id'] = $id;

        $article = ArticleCategory::model()->count($criteria);
        if($article) return true;

        return false;
    }

    static function isAlbumAvailable($id) {

        $criteria = new CDbCriteria;
        $criteria->condition = 'id = :id';
        $criteria->addInCondition("is_active", arr_language());
        $criteria->params[':id'] = $id;

        $article = Album::model()->count($criteria);
        if($article) return true;

        return false;
    }
}