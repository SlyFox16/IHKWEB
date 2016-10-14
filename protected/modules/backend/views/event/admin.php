<?php
$this->breadcrumbs=array(
	'Events'=>array('admin'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Create Event','url'=>array('create')),
);
?>

<legend>Manage Events</legend>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'event-grid',
    'type' => 'striped bordered condensed',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'user_id:user',
		'title',
		'description',
        'date',
        array(
            'class' => 'ext.editable.EditableColumn',
            'name' => 'active',
            'filter' => false,
            'value' => 'CHtml::value($data, "statusActive")', //we need to set value because source is url
            'headerHtmlOptions' => array('style' => 'width: 100px'),
            'editable' => array(
                'type'     => 'select',
                'url'      => $this->createUrl('event/UCUpdate'),
                'source'   => array(0 => 'Inactive', 1 => 'Active'),
                'onRender' => 'js: function(e, editable) {
                      var colors = {0: "red", 1: "green"};
                      $(this).css("color", colors[editable.value]);
                  }'
            )
        ),
		/*
		'xing_url',
		'site_url',
		'image',
		'city_id',
		'country_id',
		'location',
		'date',
		'active',
		*/
        array(
            'class' => 'backend.components.ButtonColumn',
            'htmlOptions' => array('width' => '60px'),
        ),
	),
)); ?>
