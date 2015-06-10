<?php
$this->breadcrumbs=array(
	'Feedbacks'=>array('admin'),
	$model->name,
);

$this->menu=array(
	array('label'=>'Update Feedback','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Feedback','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Feedback','url'=>array('admin')),
);
?>

<legend>View Feedback #<?php echo $model->id; ?></legend>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'email',
		'feedback',
	),
)); ?>
