<?php
$this->breadcrumbs=array(
	'Feedbacks'=>array('admin'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Create Feedback','url'=>array('create')),
	array('label'=>'View Feedback','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Feedback','url'=>array('admin')),
);
?>

<legend>Update Feedback <?php echo $model->id; ?></legend>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>