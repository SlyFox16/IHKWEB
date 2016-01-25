<?php
class ImagedelAction extends CAction
{
    public function run()
    {
        $id = (int)$_POST["id"];
        $model = new MultipleImages();
        $model = $model->findByPk($id);
        $model->delete();
        echo "";
    }
}