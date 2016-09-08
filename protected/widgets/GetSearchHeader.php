<?php
class GetSearchHeader extends CWidget
{
    public $model;

    public function run()
    {
        $serchQuery = array();
        $name = ''; $surname = '';

        if ($this->model->name) $name = $this->model->name;
        if ($this->model->surname) $surname = $this->model->surname;

        $full_name = '';
        if ($name) $full_name .= '<b>'.$name.'</b>';
        if ($surname && $name) $full_name .= '<b>'.$name.'</b> <b>'.$surname.'</b>';
        if ($surname && !$name) $full_name .= '<b>'.$surname.'</b>';
        if (!$surname && !$name) $full_name = null;

        if($full_name) $serchQuery[] = trim($full_name);
        if ($this->model->city_id) $serchQuery[] = '<b>'.User::getCityCountry($this->model->city_id, 'city').'</b>';
        if ($this->model->level >= 0 && $this->model->level != NULL) $serchQuery[] = Yii::t("base", 'level').': <b>'.$this->model->level.'</b>';
        if ($this->model->rating >= 0 && $this->model->rating != NULL) $serchQuery[] = Yii::t("base", 'rating').': <b>'.$this->model->rating.'</b>';


        $serchQuery = implode(', ',$serchQuery);

        if (empty($serchQuery))
            echo Yii::t("base", "Find certified [b]Crowd Experts[/b] now.", array('[b]' => '<b>', '[/b]' => '</b>'));
        else
            echo Yii::t("base", "Here is what we found for").': '.$serchQuery;
    }
}