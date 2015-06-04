<?php
$this->breadcrumbs=array(
	'Pages'=>array('admin'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Create Pages','url'=>array('create')),
	array('label'=>'View Pages','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Pages','url'=>array('admin')),
);
?>

<legend>Update Pages <?php echo $model->id; ?></legend>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>