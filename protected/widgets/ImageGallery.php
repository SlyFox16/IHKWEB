<?php
class ImageGallery extends  CWidget
{
    public $model = null;

    public function run()
    {
        $this->render("gallery", array('model' => $this->model));
    }
}