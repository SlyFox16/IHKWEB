<?php
/**
 * @var $model Entity
 * @var $attribute string
 * @var $htmlOptions array
 */
?>
<div class="control-group" id="compatible">
    <?php echo CHtml::activeLabelEx($model, $attribute, array('class'=>'control-label control-label')); ?>
    <div class="controls">
        <?php echo CHtml::activeDropDownList($model, $attribute, $model->allTags, array('class'=>'span5', 'multiple' => 'multiple')); ?>
	</div>
</div>

<?php
    $id = CHtml::activeId($model, $attribute);
    Yii::app()->clientScript->registerScript($id, "
        $('#{$id}').select2({
             tags: true,
             placeholder: 'Insert the tag',
             tokenSeparators: [',', ' '],
             ajax: {
                url: '/backend/".Yii::app()->controller->id."/ajaxTags',
                dataType: 'json',
                quietMillis: 100,
             },
        });
    ");
    Yii::app()->clientScript->registerScriptFile(Yii::app()->getModule('backend')->assetsUrl.'/dist/js/select2.js', CClientScript::POS_END);
    Yii::app()->clientScript->registerCssFile(Yii::app()->getModule('backend')->assetsUrl.'/dist/css/select2.min.css');
    Yii::app()->clientScript->registerCss('tags_custom', "
        .select2-selection__rendered input[type='search'] {box-shadow: none; height: 25px; padding: 0;}
    ");
?>