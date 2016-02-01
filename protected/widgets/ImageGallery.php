<?php
class ImageGallery extends  CWidget
{
    public $noUpload = false;
    public $model = null;

    public function run()
    {
        $this->render("gallery", array('model' => $this->model, 'noUpload' => $this->noUpload));
    }
}