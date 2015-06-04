<?php

class euArticleRouter extends CBaseUrlRule
{
    private static $instance;
    private $matches;
    private $mainpage = false;

    public static function Instance() {
        if (self::$instance == null)
            self::$instance = new euArticleRouter();

        return self::$instance;
    }

    public function urltrans($pathInfo)
    {
        $flag = $this->checkUrl($pathInfo);
        if($flag)
            return Yii::app()->createUrl($this->getUrl($_GET['id']));

        return false;  // не применяем данное правило
    }

    public function createUrl($manager,$route,$params,$ampersand)
    {
        if ($route==='article/view' || $route==='article/category')
        {
            $this->mainpage = ($route==='article/category') ? true : false;
            if (isset($params['id']) && !isset($params['language'])) {
                return $this->getUrl($params['id']);
            }
        }
        return false;  // не применяем данное правило
    }

    public function parseUrl($manager,$request,$pathInfo,$rawPathInfo)
    {
        $flag = $this->checkUrl($pathInfo);

        if($flag) {
            if($this->mainpage)
                return 'article/category';
            else
                return 'article/view';
        }

        return false;  // не применяем данное правило
    }

    //========================help functions=====================

    private function checkUrl($pathInfo)
    {
        $flag = false;

        $pathInfo = preg_replace('~^'.Yii::app()->getBaseUrl(true).'/~', '', $pathInfo);

        if(preg_match('~^backend~', $pathInfo))
            return $flag;

        if(!preg_match('~(ru|ro)/~', $pathInfo))
            $pathInfo = 'ro/'.$pathInfo;

        if(preg_match('~(ru|ro)?/([a-zA-Z0-9_-]+)/?([a-zA-Z0-9/_-]+)?$~', $pathInfo, $this->matches)) {
            if(isset($this->matches[1]))
                $_GET['language'] = $this->matches[1];
            else
                $_GET['language'] = 'ro';

            if(isset($this->matches[2])) {
                if($section = $this->dbExist('ArticleCategory', $this->matches[2])) {
                    $flag = true;
                    $this->mainpage = true;
                    $_GET['id'] = $section;
                }
            }

            if(isset($this->matches[3]) && $flag) {
                if($id = $this->dbExist('Article', $this->matches[3])) {
                    $flag = true;
                    $this->mainpage = false;
                    $_GET['id'] = $id;
                } else
                    $flag = false;
            }
        }

        if(!$flag)
            $_GET['language'] = Yii::app()->language;

        return $flag;
    }

    private function dbExist($db, $slug)
    {
        $article = $db::model()->find("slug_".$_GET['language']. " = '$slug'");

        if($article)
            return $article->id;
        else
            return false;
    }

    private function getUrl($id)
    {
        if($this->mainpage)
            $article = ArticleCategory::model()->findByPk($id);
        else
            $article = Article::model()->findByPk($id);

        if($article) {
            if(Yii::app()->language == 'ru') {
                if($this->mainpage)
                    return Yii::app()->language.'/'.$article->slug;
                else
                    return Yii::app()->language.'/'.$article->articleCategory->slug.'/'.$article->slug;
            } else {
                if($this->mainpage)
                    return $article->slug;
                else
                    return $article->articleCategory->slug.'/'.$article->slug;
            }
        }
        else
            return false;
    }
}