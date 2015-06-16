<?php
$this->breadcrumbs=array(
	'Reports'=>array('admin'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Delete Report','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Report','url'=>array('admin')),
);
?>

<legend>View Report #<?php echo $model->id; ?></legend>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'initiator:user',
		'receiver:user',
		'text',
		'date',
	),
)); ?>
