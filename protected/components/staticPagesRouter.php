<?php

class staticPagesRouter extends CBaseUrlRule
{
    private $matches;

    public function createUrl($manager,$route,$params,$ampersand)
    {
        if ($route==='site/pages')
        {
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
            return 'site/pages';
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

        if(preg_match('~([a-zA-Z0-9\._-]+)?$~', $pathInfo, $this->matches)) {
            if(isset($this->matches[1])) {
                if($section = $this->dbExist('Pages', $this->matches[1])) {
                    $flag = true;
                    $_GET['id'] = $section;
                }
            }
        }

        return $flag;
    }

    private function dbExist($db, $slug)
    {
        $user = $db::model()->find("slug = '$slug'");

        if($user)
            return $user->id;
        else
            return false;
    }

    private function getUrl($id)
    {
        $article = Pages::model()->findByPk($id);

        if($article) {
            return $article->slug;
        }
        else
            return false;
    }
}