<?php
class CompletedWidget extends CWidget
{
    public $project_id = false;

    public function run()
    {
        if($this->project_id)
            $model = CompletedProjects::model()->findByPk($this->project_id);
        else
            $model = new CompletedProjects();

        $this->render("completed_view", array('model' => $model));
    }
}