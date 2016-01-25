<?php

class UploadAction extends CAction
{
    public $_alreadyFirst;
    public $model;

    public function run()
    {
        if (!empty($_FILES)) {
            if (is_uploaded_file($_FILES["User"]["tmp_name"]["pdf"])) {
                $fileTypes = array('jpg','jpeg','gif','png', 'pdf'); // File extensions
                $fileParts = pathinfo($_FILES['User']['name']["pdf"]);
                if (in_array($fileParts['extension'],$fileTypes)) {
                    $id = Yii::app()->user->id;
                    $this->model = $this->controller->createModel();

                    $hash = md5(rand(1, 99999) . $_FILES["User"]["name"]["pdf"]) . "_" . $_FILES["User"]["name"]["pdf"];
                    $dir = "images/site/".$this->model->getClass()."/" . $id . "/";

                    if (!is_dir($dir)) {
                        mkdir($dir, 0755, true);
                    }

                    move_uploaded_file($_FILES["User"]["tmp_name"]["pdf"], "images/site/".$this->model->getClass()."/" . $id . "/" . $hash);

                    $file = new MultipleImages();
                    $file->item_id = $id;
                    $file->content_type = $this->model->getClass();
                    $file->title = $_FILES["User"]["name"]["pdf"];
                    $file->hash_path = $hash;
                    $file->path = "images/site/".$this->model->getClass()."/" . $id . "/" . $hash;

                    if(!$file->save())
                        Yii::log(CHtml::errorSummary($file), "error");

                    echo $hash . 'uploaded';
                } else {
                    header("HTTP/1.1 405"); //any 4XX error will work
                    exit();
                }
            } else {
                echo 'error';
            }
        }
    }

    private function checkFirst($item_id) {
        $multipleImages = MultipleImages::model()->count('content_type = :contentType && item_id = :item_id', array(':contentType' => $this->model->getClass(), ':item_id' => $item_id));

        return $multipleImages > 0 ? true : false;
    }
}