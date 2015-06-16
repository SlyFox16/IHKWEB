<?php
$this->breadcrumbs=array(
	'Reports'=>array('admin'),
	'Manage',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('report-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<legend>Manage Reports</legend>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'report-grid',
    'type' => 'striped bordered condensed',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'initiator',
		'receiver',
		'text',
		'date',
        array(
            'class' => 'backend.components.ButtonColumn',
            'htmlOptions' => array('width' => '60px'),
            'template' => '{view} {delete}',
        ),
	),
)); ?>
