<?php
/**
 * Created by Idol IT.
 * Date: 10/3/12
 * Time: 11:51 AM
 */

class ExtendedFormatter extends CFormatter
{
    public function formatBoolean($value)
    {

        if ($value > 0)
            return '<i class="splashy-check"></i>';
        else
            return '<i class="splashy-remove_minus_sign"></i>';
    }

    public function formatSex($value){
        if ($value > 0)
            return 'Female';
        else
            return 'Male';

    }

    public function formatImage($value)
    {
        return CHtml::image(YHelper::getImagePath($value, 100), 'user', array('width' => '100px'));
    }

    public function formatLogo($value)
    {
        return CHtml::image(Yii::app()->iwi->load($value)->resize(150, 0)->cache());
    }

    public function formatUser($value)
    {
        if ($user = User::model()->findByPk($value))
            return CHtml::link($user->name.' '.$user->surname, Yii::app()->createUrl("backend/user/view", array("id" => $user->id)));
        else
            return '<span class="null">No user</span>';
    }

    public function formatArticleCataroryId($value)
    {
        if ($articleCategory = ArticleCategory::model()->findByPk($value))
            return CHtml::link($articleCategory->name, Yii::app()->createUrl("backend/articleCategory/view", array("id" => $articleCategory->id)));
        else
            return '<span class="null">No user</span>';
    }

    public function formatDate($value) {
        return Yii::app()->dateFormatter->format("dd MMMM yyyy", $value);
    }

    public function formatLanguageVersion($value) {
        return language_version($value);
    }

    public function formatCategoryType($value) {
        $model = new Article();
        return $model->category_type($value);
    }

    public function formatAlbum($value) {
        $model = Album::model()->findByPk($value);

        if(isset($model))
            return CHtml::link($model->{'title_'.Yii::app()->language}, Yii::app()->createUrl("backend/album/view", array("id" => $model->id)));
        else
            echo 'not set';
    }

    public function formatShowMain($value) {
        $model = new ArticleCategory();
        return $model->mainPageShowType($value);
    }

    public function formatPosition($value) {
        $model = new Banner();
        return $model->banner_position($value);
    }

    public function formatBannerType($value) {
        $model = new Banner();
        return $model->banner_type($value);
    }

    public function formatSettingsDescription($value) {
        mb_internal_encoding('utf-8');
        $line = mb_strtolower($value);
        return mb_strtoupper(mb_substr($line, 0, 1)) . mb_substr($line, 1);
    }
}