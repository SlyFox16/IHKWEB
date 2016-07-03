<?php
/**
 * Created by Idol IT.
 * Date: 10/1/12
 * Time: 3:30 PM
 */

class CompletedProject extends CWidget
{
    public $model;
    public $renderPopUserId;

    public function init(){
        if(!$this->model)
            $this->model = new CompletedProjects();

        $this->render('completed_project', array('model' => $this->model, 'renderPopUserId' => $this->renderPopUserId));
    }
}