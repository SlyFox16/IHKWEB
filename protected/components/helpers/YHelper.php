<?php
class YHelper
{
    public static function yiisetting($name, $default = null, $title = false)
    {
        if ($setting = Settings::model()->findByAttributes(array("name"=>$name)))
            if (isset($setting)) {
                $return = $title ? $setting->title : $setting->value;
                return $return;
            }

        return $default;
    }

    public static function formatCurrency($value, $currency = "mdl", $format = '#,##0 ¤')
    {        
        return number_format($value, 0, ' ', ' ')." ".$currency; //Yii::app()->numberFormatter->format($format, $value, $currency);
    }

    public static function formatDate($value)
    {
        return Yii::app()->format->date($value);
    }

    public static function getImagePath($source_image, $width = 0, $height = 0, $default = '') {
        if (!empty($source_image) && file_exists($source_image)) {
            if (empty($width) && empty($height))
                $image = '/' . $source_image;
            elseif (!empty($width) && empty($height))
                $image = Yii::app()->iwi->load($source_image)->resize($width, 0)->cache();
            else
                $image = Yii::app()->iwi->load($source_image)->adaptive($width, $height)->cache();
        } else {
            if (!empty($width) && !empty($height)) {
                $image = $default ? : Yii::app()->params['noImage'];
                $image = Yii::app()->iwi->load($image)->adaptive($width, $height)->cache();
            } else {
                $image = $default ? : '/' . Yii::app()->params['noImage'];
            }
        }

        return $image;
    }
}
