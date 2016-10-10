<?php
$this->breadcrumbs=array(
	'Events'=>array('admin'),
	'Create',
);

$this->menu=array(
	array('label'=>'Manage Event','url'=>array('admin')),
);
?>

<legend>Create Event</legend>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>