<?php
$this->breadcrumbs=array(
	'Completed Projects'=>array('admin'),
	'Create',
);

$this->menu=array(
	array('label'=>'Manage CompletedProjects','url'=>array('admin')),
);
?>

<legend>Create CompletedProjects</legend>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>