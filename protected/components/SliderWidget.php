<?php
class SliderWidget extends CWidget
{
    public $sidebar = false;

    public function run()
    {
        $albumBull = false;

        $criteria = new CDbCriteria;
        $criteria->order = 'priority,root,lft,id';
        $criteria->addInCondition("is_active", arr_language());

        $slides = Slider::model()->findAll($criteria);

        if($this->sidebar) {
            $album = Album::model()->findByPk(1);
            $slides = $album->albumImagesList(array('limit' => 5));
            $albumBull = true;
        }

        if($slides) {
            if($albumBull)
                $this->render("sliderPhoto", array('slides' => $slides, 'albumBull' => $albumBull));
            else
                $this->render("slider", array('slides' => $slides, 'albumBull' => $albumBull));
        }
    }
}