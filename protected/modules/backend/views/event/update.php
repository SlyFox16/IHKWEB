<?php
$this->breadcrumbs=array(
	'Events'=>array('admin'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Create Event','url'=>array('create')),
	array('label'=>'View Event','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Event','url'=>array('admin')),
);
?>

<legend>Update Event <?php echo $model->id; ?></legend>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>