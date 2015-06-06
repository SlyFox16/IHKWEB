<?php

class ihkUserRouter extends CBaseUrlRule
{
    private $matches;
    private $mainpage = false;

    public function createUrl($manager,$route,$params,$ampersand)
    {
        if ($route==='user/info')
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
            return 'user/info';
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

        if(preg_match('~([a-zA-Z0-9_-]+)?$~', $pathInfo, $this->matches)) {
            if(isset($this->matches[1])) {
                if($section = $this->dbExist('User', $this->matches[1])) {
                    $flag = true;
                    $_GET['id'] = $section;
                }
            }
        }

        return $flag;
    }

    private function dbExist($db, $slug)
    {
        $user = $db::model()->find("username = '$slug'");

        if($user)
            return $user->id;
        else
            return false;
    }

    private function getUrl($id)
    {
        $article = User::model()->findByPk($id);

        if($article) {
            return $article->username;
        }
        else
            return false;
    }
}