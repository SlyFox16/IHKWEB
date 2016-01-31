<?php
$this->breadcrumbs=array(
	'Rating Logs'=>array('admin'),
	'Create',
);

$this->menu=array(
	array('label'=>'Manage RatingLog','url'=>array('admin')),
);
?>

<legend>Create RatingLog</legend>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>