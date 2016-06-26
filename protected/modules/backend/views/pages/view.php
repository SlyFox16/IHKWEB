<?php
$this->breadcrumbs=array(
	'Pages'=>array('admin'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Create Pages','url'=>array('create')),
	array('label'=>'Update Pages','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Pages','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Pages','url'=>array('admin')),
);
?>

<legend>View Pages #<?php echo $model->id; ?></legend>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'content',
	),
)); ?>
