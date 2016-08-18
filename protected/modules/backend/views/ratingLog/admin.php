<?php
$this->breadcrumbs=array(
	'Rating Logs'=>array('admin'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Create RatingLog','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
    $('.search-button').click(function(){
        $('.search-form').toggle();
        return false;
    });
    $('.search-form form').submit(function(){
        $.fn.yiiGridView.update('rating-log-grid', {
            data: $(this).serialize()
        });
        return false;
    });
");
?>

<legend>Manage Rating Logs</legend>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'rating-log-grid',
    'type' => 'striped bordered condensed',
	'dataProvider'=>$model->search($param),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'who_vote:user',
		'who_received:user',
		'num',
		'description',
        array(
            'class' => 'ext.editable.EditableColumn',
            'name' => 'confirmed',
            'value' => 'CHtml::value($data, "status")', //we need to set value because source is url
            'headerHtmlOptions' => array('style' => 'width: 100px'),
            'editable' => array(
                'type'     => 'select',
                'url'      => $this->createUrl('ratingLog/uCUpdate'),
                'source'   => array(0 => 'Unconfirmed', 1 => 'Confirmed'),
                'onRender' => 'js: function(e, editable) {
                      var colors = {0: "red", 1: "green"};
                      $(this).css("color", colors[editable.value]);
                  }'
            )
        ),
        array(
            'class' => 'backend.components.ButtonColumn',
            'htmlOptions' => array('width' => '60px'),
        ),
	),
)); ?>
