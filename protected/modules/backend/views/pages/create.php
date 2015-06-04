<?php
$this->breadcrumbs=array(
	'Pages'=>array('admin'),
	'Create',
);

$this->menu=array(
	array('label'=>'Manage Pages','url'=>array('admin')),
);
?>

<legend>Create Pages</legend>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>