<?php
$this->breadcrumbs=array(
	'Completed Projects'=>array('admin'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Create CompletedProjects','url'=>array('create')),
	array('label'=>'View CompletedProjects','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage CompletedProjects','url'=>array('admin')),
);
?>

<legend>Update CompletedProjects <?php echo $model->id; ?></legend>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>