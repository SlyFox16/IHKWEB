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

    public static function generateStr($length = 16)
    {
        $chars = str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789");
        $code = "";
        $clen = strlen($chars) - 1;

        while (strlen($code) < $length)
            $code .= $chars[mt_rand(0, $clen)];

        return $code;
    }

    public static function yiisettingSenderEmail($name, $default = null)
    {
        if ($setting = Settings::model()->findByAttributes(array("name"=>$name))) {
            if (isset($setting))
                if (!empty($setting->sender_email))
                    return $setting->sender_email;
        }

        return $default;
    }

    public static function formatCurrency($value, $currency = "mdl", $format = '#,##0 ¤')
    {        
        return number_format($value, 0, ' ', ' ')." ".$currency; //Yii::app()->numberFormatter->format($format, $value, $currency);
    }

    public static function formatDate($formatGet, $date = null, $formatSet = 'yyyy-MM-dd')
    {
        if ($date && $formatSet)
            $newDate = Yii::app()->dateFormatter->format($formatGet, CDateTimeParser::parse($date, $formatSet));
        elseif ($date)
            $newDate = Yii::app()->dateFormatter->format($formatGet, $date);
        else
            $newDate = Yii::app()->format->date($formatGet);

        return $newDate;
    }

    public static function getImagePath($source_image, $width = 0, $height = 0, $default = '') {
        if (preg_match('~^(http|https)://~', $source_image))
            return $source_image;

        if (!empty($source_image) && file_exists($source_image)) {
            $image_info = getimagesize($source_image);
            if (!is_array($image_info) || count($image_info) < 3)
                $source_image = $default ? : Yii::app()->params['noImage'];
        } else
            $source_image = $default ? : Yii::app()->params['noImage'];

        if (empty($width) && empty($height))
            $image = '/' . $source_image;
        elseif (!empty($width) && empty($height))
            $image = Yii::app()->iwi->load($source_image)->resize($width, 0)->cache();
        else
            $image = Yii::app()->iwi->load($source_image)->adaptive($width, $height, true)->cache();

        return $image;
    }

    public static function urldecodeUrl($param){
        $params = array();
        $url = urldecode(Yii::app()->request->requestUri);
        $uri = parse_url($url, PHP_URL_QUERY);
        $uri = explode('&', $uri);

        if($uri) {
            foreach($uri as $value) {
                if(preg_match('~^(\w+)=(.*)$~', $value, $matches)) {
                    $params[$matches[1]] = $matches[2];
                }
            }
        }

        return $params[$param];
    }
}
