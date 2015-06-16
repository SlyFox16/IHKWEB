<?php
$this->breadcrumbs=array(
	'Reports'=>array('admin'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'View Report','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Report','url'=>array('admin')),
);
?>

<legend>Update Report <?php echo $model->id; ?></legend>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>