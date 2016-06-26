<?php
$this->breadcrumbs=array(
	'Completed Projects'=>array('admin'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Create CompletedProjects','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('completed-projects-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<legend>Manage Completed Projects</legend>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'completed-projects-grid',
    'type' => 'striped bordered condensed',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'user_id',
		'name',
		'description',
		'date',
		'link',
        array(
            'class' => 'backend.components.ButtonColumn',
            'htmlOptions' => array('width' => '60px'),
        ),
	),
)); ?>
