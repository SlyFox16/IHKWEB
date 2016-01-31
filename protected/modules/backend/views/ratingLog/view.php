<?php
$this->breadcrumbs=array(
	'Rating Logs'=>array('admin'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Create RatingLog','url'=>array('create')),
	array('label'=>'Update RatingLog','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete RatingLog','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage RatingLog','url'=>array('admin')),
);
?>

<legend>View RatingLog #<?php echo $model->id; ?></legend>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'who_vote:user',
		'who_received:user',
		'num',
		'description',
		'confirmed:boolean',
	),
)); ?>
