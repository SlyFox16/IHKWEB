<?php
$this->breadcrumbs=array(
	'Completed Projects'=>array('admin'),
	$model->name,
);

$this->menu=array(
	array('label'=>'Create CompletedProjects','url'=>array('create')),
	array('label'=>'Update CompletedProjects','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete CompletedProjects','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CompletedProjects','url'=>array('admin')),
);
?>

<legend>View CompletedProjects #<?php echo $model->id; ?></legend>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id:user',
		'name',
		'description',
		'date',
		'link:url',
	),
)); ?>
