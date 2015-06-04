<?php
class Banners extends CWidget
{
    public $limit = 1;
    public $position = 'right_top';

    public function run()
    {
        $slug = Yii::app()->controller->id . '/' . Yii::app()->controller->action->id;
        $crt = new CDbCriteria;
        $crt->condition = '(slug = :slug || slug = "all")';
        $crt->addInCondition("is_active", arr_language());
        $crt->params[':slug'] = $slug;

        if ($categoryes = BannerCategory::model()->findAll($crt)) {
            $criteria = new CDbCriteria;
            $criteria->order = 'rotate DESC';
            $criteria->condition = 'position = "'.$this->position.'" AND banner_category_id IN '.mass($categoryes);
            $criteria->addInCondition("is_active", arr_language());

            $banners = Banner::model()->findAll($criteria);

            $criteria->addCondition('rotate = "1"');
            $banners_rotate = Banner::model()->findAll($criteria);

            $banners_view = array();
            $saved = (count($banners) > 1) ? true : false;

            if(count(Yii::app()->session["banners_view"][$this->position]) > count($banners_rotate))
                unset(Yii::app()->session["banners_view"]);

            if (isset(Yii::app()->session["banners_view"][$this->position])) {
                $banners_view = Yii::app()->session["banners_view"][$this->position];
                if (isset($banners_view)) {
                    asort($banners_view);
                    $slice = array_slice($banners_view, 0, $this->limit, true);
                }
            }

            $i = 0;

            foreach ($banners as $model) {
                if($model->rotate == 1) {
                    if (is_array($banners_view) && isset($banners_view) && count($banners_view) == count($banners_rotate)) {
                        if ($i < $this->limit && array_key_exists($model->id, $slice)) {
                            $i++;
                            $banners_view[$model->id]++;
                            $this->renderView($model, $banners_view, $saved);
                            //return;
                        }
                    } else {
                        if ((!isset($banners_view) || (!array_key_exists($model->id, $banners_view)  && $i < $this->limit))) {
                            $i++;
                            $banners_view[$model->id] = 1;
                            $this->renderView($model, $banners_view, $saved);
                            //return;
                        }
                    }
                } else {
                    $this->render('banners', array('banner' => $model));
                }
            }
        }
    }

    private function renderView($model, $banners_view, $saved = true)
    {
        $model->views++;
        //$model->reffer = md5(time() . uniqid());
        $model->update();

        if ($saved) {
            $a = Yii::app()->session["banners_view"];
            $a[$this->position] = $banners_view;
            Yii::app()->session["banners_view"] = $a;
            Yii::app()->session["banners_view"];
        }

        $this->render('banners', array('banner' => $model));
    }
}