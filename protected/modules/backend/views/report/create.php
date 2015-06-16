<?php
$this->breadcrumbs=array(
	'Reports'=>array('admin'),
	'Create',
);

$this->menu=array(
	array('label'=>'Manage Report','url'=>array('admin')),
);
?>

<legend>Create Report</legend>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>