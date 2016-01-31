<?php
$this->breadcrumbs=array(
	'Rating Logs'=>array('admin'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Create RatingLog','url'=>array('create')),
	array('label'=>'View RatingLog','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage RatingLog','url'=>array('admin')),
);
?>

<legend>Update RatingLog <?php echo $model->id; ?></legend>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>