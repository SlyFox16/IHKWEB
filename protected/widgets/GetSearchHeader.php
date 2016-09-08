<?php
class GetSearchHeader extends CWidget
{
    public $model;

    public function run()
    {
        $serchQuery = array();
        $name = ''; $surname = '';

        if ($this->model->name) $name = '<b>'.$this->model->name.'</b>';
        if ($this->model->surname) $surname = '<b>'.$this->model->surname.'</b>';

        $serchQuery[] = trim($name.' '.$surname);
        if ($this->model->city_id) $serchQuery[] = '<b>'.User::getCityCountry($this->model->city_id, 'city').'</b>';
        if ($this->model->level >= 0 && $this->model->level != NULL) $serchQuery[] = Yii::t("base", 'level').': <b>'.$this->model->level.'</b>';
        if ($this->model->rating >= 0 && $this->model->rating != NULL) $serchQuery[] = Yii::t("base", 'rating').': <b>'.$this->model->rating.'</b>';

        foreach ($serchQuery as $key => $value)
            $serchQuery[$key] = trim($value);

        $serchQuery = implode(', ',$serchQuery);

        if (empty($serchQuery))
            echo Yii::t("base", "Find certified [b]Crowd Experts[/b] now.", array('[b]' => '<b>', '[/b]' => '</b>'));
        else
            echo Yii::t("base", "Here is what we found for").': '.$serchQuery;
    }
}