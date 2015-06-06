<?php
$this->breadcrumbs=array(
	'Certificates'=>array('admin'),
	$model->name,
);

$this->menu=array(
	array('label'=>'Create Certificates','url'=>array('create')),
	array('label'=>'Update Certificates','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Certificates','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Certificates','url'=>array('admin')),
);
?>

<legend>View Certificates #<?php echo $model->id; ?></legend>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
	),
)); ?>
