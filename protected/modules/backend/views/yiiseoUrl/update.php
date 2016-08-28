<?php
$this->breadcrumbs=array(
	'Yiiseo Urls'=>array('admin'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Create YiiseoUrl','url'=>array('create')),
	array('label'=>'View YiiseoUrl','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage YiiseoUrl','url'=>array('admin')),
);
?>

<legend>Update YiiseoUrl <?php echo $model->id; ?></legend>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>