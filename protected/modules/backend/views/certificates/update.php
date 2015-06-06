<?php
$this->breadcrumbs=array(
	'Certificates'=>array('admin'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Create Certificates','url'=>array('create')),
	array('label'=>'View Certificates','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Certificates','url'=>array('admin')),
);
?>

<legend>Update Certificates <?php echo $model->id; ?></legend>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>