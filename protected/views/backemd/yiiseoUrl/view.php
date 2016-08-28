<?php
$this->breadcrumbs=array(
	'Yiiseo Urls'=>array('admin'),
	$model->title,
);

$this->menu=array(
	array('label'=>'Create YiiseoUrl','url'=>array('create')),
	array('label'=>'Update YiiseoUrl','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete YiiseoUrl','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage YiiseoUrl','url'=>array('admin')),
);
?>

<legend>View YiiseoUrl #<?php echo $model->id; ?></legend>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'url',
		'title',
		'keywords',
		'description',
		'image',
	),
)); ?>
