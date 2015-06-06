<?php
$this->breadcrumbs=array(
	'Certificates'=>array('admin'),
	'Create',
);

$this->menu=array(
	array('label'=>'Manage Certificates','url'=>array('admin')),
);
?>

<legend>Create Certificates</legend>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>