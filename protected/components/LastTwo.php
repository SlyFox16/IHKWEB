<?php
class LastTwo extends CWidget
{
    public $category_id;

    public function run()
    {
        switch($this->category_id) {
            case '2':
                $arr = array('3', '4');
                break;
            case '3':
                $arr = array('2', '4');
                break;
            case '4':
                $arr = array('2', '3');
                break;
        }

        $criteria = new CDbCriteria;
        $criteria->addInCondition("id", $arr);
        $categoryes = ArticleCategory::model()->findAll($criteria);

        $this->render("lastTwo", array(
                'categoryes' => $categoryes,
            )
        );
    }
}