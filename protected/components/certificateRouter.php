<?php
class CertificateRouter extends CBaseUrlRule
{
    private $matches;

    public function createUrl($manager,$route,$params,$ampersand)
    {
        if ($route==='site/certificateView')
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
            return 'site/certificateView';
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

        if(preg_match('~certificate/([a-zA-Z0-9\._-]+)?$~', $pathInfo, $this->matches)) {
            if(isset($this->matches[1])) {
                if($section = $this->dbExist('Certificates', $this->matches[1])) {
                    $flag = true;
                    $_GET['id'] = $section;
                }
            }
        }

        return $flag;
    }

    private function dbExist($db, $slug)
    {
        $user = $db::model()->find("name = '$slug'");

        if($user)
            return $user->id;
        else
            return false;
    }

    private function getUrl($id)
    {
        $article = Certificates::model()->findByPk($id);

        if($article) {
            return 'certificate/'.$article->slug;
        }
        else
            return false;
    }
}