<?php
/**
 * Created by Idol IT.
 * Date: 10/2/12
 * Time: 3:09 PM
 */

Yii::import('booster.widgets.TbActiveForm');


class ActiveForm extends TbActiveForm
{
    /**
     * File field with attributes
     * @param CModel $model
     * @param string $attribute
     * @param array $htmlOptions
     * @return string
     */
    public function fileField($model, $attribute, $htmlOptions = array())
    {
        $booster = Booster::getBooster();
        $booster->cs->registerPackage('kartik-fileupload');

        return $this->render("file_field",array("model"=>$model,"attribute"=>$attribute, 'htmlOptions' => $htmlOptions));
    }

    public function multipleFileField($model, $relation, $module, $attribute, $htmlOptions = array())
    {
        $booster = Booster::getBooster();
        $booster->cs->registerPackage('kartik-fileupload');

        return $this->render("file_field_multiple", array("model"=>$model, "module" => $module, "relation" => $relation, "attribute"=>$attribute));
    }

    public function dropDownSelect2Group($model, $attribute, $select_options = array(), $htmlOptions = array()){
        $options = array('width' => '100%');

        if(!empty($htmlOptions['placeholder'])) {
            $options = CMap::mergeArray($options, array('placeholder' => $htmlOptions['placeholder']));
            unset($htmlOptions['placeholder']);
        }

        return $this->render("select2", array("model"=>$model, "attribute"=>$attribute, "select_options"=>$select_options, "options" => $options, 'htmlOptions'=>$htmlOptions));
    }
}



