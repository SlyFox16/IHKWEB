<?php
/**
 * @var $model Entity
 * @var $attribute string
 * @var $htmlOptions array
 */
?>

<?php $this->widget(
    'booster.widgets.TbSelect2',
    array(
        'model' => $model,
        'attribute' => $attribute,
        'data' => $select_options,
        'options' => $options,
        'htmlOptions' => $htmlOptions,
    )
); ?>