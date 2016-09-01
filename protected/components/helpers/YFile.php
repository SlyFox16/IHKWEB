<?php

/**
 * хелпер, содержащий вспомогательные функции для работы с файловой системой
 *
 * @package  yupe.modules.yupe.helpers
 * @subpackage helpers
 * @license  BSD http://ru.wikipedia.org/wiki/%D0%9B%D0%B8%D1%86%D0%B5%D0%BD%D0%B7%D0%B8%D1%8F_BSD
 * @version  0.1
 * @author  Opeykin A. <aopeykin@yandex.ru>
 * @link http://yupe.ru
 *
 */

class YFile extends CFileHelper
{
    /**
     * @param $word
     * @return mixed|string
     */
    public static function getTranslatedName($word)
    {
        return YText::translit($word);
    }

    /**
     * @param $name
     * @param $ext
     * @param $path
     * @return bool|string
     */
    public static function pathIsWritable($name, $ext, $path)
    {
        if (self::checkPath($path)) {
            return $path . self::getTranslatedName($name) . '.' . $ext;
        } else {
            return false;
        }
    }

    /**
     * @param $path
     * @param  int $rights
     * @param  bool $recursive
     * @return bool
     */
    public static function checkPath($path, $rights = 0777, $recursive = true)
    {
        if (!is_dir($path)) { // проверка на существование директории

            return mkdir($path, $rights, $recursive); // возвращаем результат создания директории
        } else {
            if (!is_writable($path)) { // проверка директории на доступность записи

                return false;
            }
        }

        return true; // папка существует и доступна для записи
    }

    /**
     * Рекрусивное удаление директорий.
     *
     * @param $path Если $path оканчивается на *, то удаляется только содержимое директории.
     * @since 0.5
     * @return bool
     */
    public static function rmDir($path)
    {
        static $doNotRemoveBaseDirectory = false, $baseDirectory;

        $path = trim($path);
        if (substr($path, -1) == '*') {
            $doNotRemoveBaseDirectory = true;
            $path = substr($path, 0, -1);
        }
        if (substr($path, -1) == '/') {
            $path = substr($path, 0, -1);
        }
        if ($doNotRemoveBaseDirectory) {
            $baseDirectory = $path;
        }

        if (is_dir($path)) {
            $dirHandle = opendir($path);
            while (false !== ($file = readdir($dirHandle))) {
                if ($file != '.' && $file != '..') {
                    $tmpPath = $path . '/' . $file;

                    if (is_dir($tmpPath)) {
                        self::rmDir($tmpPath);
                    } else {
                        if (file_exists($tmpPath)) {
                            unlink($tmpPath);
                        }
                    }
                }
            }
            closedir($dirHandle);

            // удаляем текущую папку
            if ($doNotRemoveBaseDirectory === true && $baseDirectory == $path) {
                return true;
            }

            return rmdir($path);
        } elseif (is_file($path) || is_link($path)) {
            return unlink($path);
        } else {
            return false;
        }
    }

    /**
     * @param $file
     * @since 0.8
     * @return bool
     */
    public static function rmFile($file)
    {
        return @unlink($file);
    }

    /**
     * @param $from
     * @param $to
     * @since 0.8
     * @return bool
     */
    public static function cpFile($from, $to)
    {
        return copy($from, $to);
    }


    public static function rmIfExists($file)
    {
        if(!file_exists($file)) {
            return true;
        }

        if(is_dir($file)) {
            return static::rmDir($file);
        }

        return static::rmFile($file);
    }

    public function saveImage($model, $attribute, $item = null) {
        $uploadedFile = CUploadedFile::getInstance($model, $attribute);
        $attributeClean = preg_replace('~^\[[0-9]+\]~', '', $attribute);

        if (!empty($model->verification_document_remove))
            $model->$attributeClean = "";

        if (!empty($uploadedFile)) {
            $model->dinamicImage($model, $attribute, $item);
            //Yii::log($model->$attributeClean, "error");
            return $model->$attributeClean;
        }

        return false;
    }

    protected function saveTabular($param)
    {
        $flag = true;
        foreach ($param as $i => $item) {
            $setting = Settings::model()->findByPk($item['cur_id']);
            $setting->attributes = $item;
            $uploadedFile=CUploadedFile::getInstance($setting,'['.$i.']value');
            if(!empty($uploadedFile))
                $setting->dinamicImage($setting, '['.$i.']value');

            if (!empty($item['image_remove']))
                $setting->image = "";

            if(!$setting->save()){
                $flag = false;
                Yii::log(CHtml::errorSummary($setting), "error");
            }
        }
        return $flag;
    }
}
