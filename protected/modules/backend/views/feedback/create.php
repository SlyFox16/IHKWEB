<?php
$this->breadcrumbs=array(
	'Feedbacks'=>array('admin'),
	'Create',
);

$this->menu=array(
	array('label'=>'Manage Feedback','url'=>array('admin')),
);
?>

<legend>Create Feedback</legend>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>