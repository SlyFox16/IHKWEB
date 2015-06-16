<?php

class Reportpop extends CWidget
{
    public $receiver;

    public function run()
    {
        $model = new Report();
        $model->receiver = $this->receiver;

        $this->render("report_pop", array('model' => $model));
    }
}