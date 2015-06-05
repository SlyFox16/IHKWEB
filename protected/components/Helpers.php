<?php
/**
 * Created by JetBrains PhpStorm.
 * User: slava
 * Date: 12/4/12
 * Time: 3:56 AM
 * To change this template use File | Settings | File Templates.
 */


function yiisetting($name, $default = null, $title = false)
{
    if ($setting = Settings::model()->findByAttributes(array("name"=>$name)))
        if (isset($setting)) {
            $return = $title ? $setting->title : $setting->value;
            return $return;
        }

    return $default;
}

function isFrontPage()
{
    if (Yii::app()->request->requestUri == "/")
        return true;

    return false;
}

function trim_text($input, $length, $ellipses = true, $strip_html = true) {
    mb_internal_encoding('utf-8');

    //strip tags, if desired
    if ($strip_html)
        $input = strip_tags($input);

    //no need to trim, already shorter than trim length
    if (mb_strlen($input) <= $length)
        return $input;

    //find last space within length
    $last_space = mb_strrpos(mb_substr($input, 0, $length), ' ');
    $trimmed_text = mb_substr($input, 0, $last_space);

    //add ellipses (...)
    if ($ellipses)
        $trimmed_text .= '...';

    return $trimmed_text;
}

function transliterate($str)
{
    $str = mb_strtolower($str,'utf-8');
    $tr = array(
        "А"=>"a","Б"=>"b","В"=>"v","Г"=>"g",
        "Д"=>"d","Е"=>"e","Ж"=>"j","З"=>"z","И"=>"i",
        "Й"=>"y","К"=>"k","Л"=>"l","М"=>"m","Н"=>"n",
        "О"=>"o","П"=>"p","Р"=>"r","С"=>"s","Т"=>"t",
        "У"=>"u","Ф"=>"f","Х"=>"h","Ц"=>"ts","Ч"=>"ch",
        "Ш"=>"sh","Щ"=>"sch","Ъ"=>"","Ы"=>"yi","Ь"=>"",
        "Э"=>"e","Ю"=>"yu","Я"=>"ya","а"=>"a","б"=>"b",
        "в"=>"v","г"=>"g","д"=>"d","е"=>"e","ж"=>"j",
        "з"=>"z","и"=>"i","й"=>"y","к"=>"k","л"=>"l",
        "м"=>"m","н"=>"n","о"=>"o","п"=>"p","р"=>"r",
        "с"=>"s","т"=>"t","у"=>"u","ф"=>"f","х"=>"h",
        "ц"=>"ts","ч"=>"ch","ш"=>"sh","щ"=>"sch","ъ"=>"y",
        "ы"=>"yi","ь"=>"","э"=>"e","ю"=>"yu","я"=>"ya",
        ", "=>"-"," "=> "-", "."=> "", "/"=> "-","-"=>"-",
    );

    $url = strtr($str,$tr);
    $url = preg_replace('/[^A-Za-z0-9_\-]/', '', $url);
    return $url;
}

function transliterate_ro($str)
{
    $str = mb_strtolower($str,'utf-8');
    $tr = array(
        "ă"=>"a","â"=>"a","î"=>"i","ş"=>"s","ț"=>"t",
        ", "=>"-"," "=> "-", "."=> "", "/"=> "-","-"=>"-",
    );

    $url = strtr($str,$tr);
    $url = preg_replace('/[^A-Za-z0-9_\-]/', '', $url);
    return $url;
}

function language_version($id = null)
{
    $arr = array(
        1 => 'RU/RO',
        2 => "Don't show",
        3 => 'RU',
        4 => 'RO',
    );

    if(isset($id)) {
        if (is_array($arr)) {
            return $arr[$id];
        }
    }

    return $arr;
}

function arr_language($command = false)
{
    $arr = null;
    switch(Yii::app()->language) {
        case 'ru':
                $arr = array('1', '3');
            break;
        case 'ro':
                $arr = array('1', '4');
            break;
    }

    if(!Yii::app()->user->isGuest)
        $arr[] = '2';

    if($command)
        $arr = '('.implode(',', $arr).')';

    return $arr;
}

function mass($categoryes)
{
    mb_internal_encoding('utf-8');
    $ret = '';
    if(!empty($categoryes))
    {
        foreach($categoryes as $value)
        {
            $ret[] = $value->id;
        }
        $ret = implode(',', $ret);
    }
    $ret = '('.$ret.')';
    return $ret;
}

function content_id($name, $reverse = false)
{
    $contentID = array(
        1 => 'AlbumImage',
    );

    if($reverse)
        return $contentID[$name];

    return array_search($name, $contentID);
}