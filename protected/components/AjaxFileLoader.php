<?php

class AjaxFileLoader extends CWidget
{
    public $attribute = 'image';
    public $model = null;
    public $form = null;

    public function run()
    {
        Yii::app()->clientScript->registerScriptFile(Yii::app()->controller->getAssetsUrl().'/js/idol_ajax_preview_image.js',CClientScript::POS_END);
        $this->render("ajaxFileLoader", array('attribute' => $this->attribute, 'model' => $this->model, 'form' => $this->form));
    }
}