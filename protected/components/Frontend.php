<?php
/**
 * Created by Idol IT.
 * Date: 10/30/12
 * Time: 12:38 PM
 */

class Frontend extends Controller {
    public $_assetsUrl;
    public $_curNav;

    public function init()
    {
        if(YII_DEBUG)
            $this->getAssetsUrl();
        Yii::app()->clientScript->registerPackage('base');

        return parent::init();
    }

    public function getAssetsUrl()
    {
        if ($this->_assetsUrl === null)
            $this->_assetsUrl = Yii::app()->assetManager->publish(Yii::getPathOfAlias('webroot.static'), false, -1, YII_DEBUG);
        return $this->_assetsUrl;
    }
}