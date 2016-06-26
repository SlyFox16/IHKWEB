<?php
$this->breadcrumbs=array(
	'Association Memberships'=>array('admin'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Create AssociationMembership','url'=>array('create')),
	array('label'=>'View AssociationMembership','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage AssociationMembership','url'=>array('admin')),
);
?>

<legend>Update AssociationMembership <?php echo $model->id; ?></legend>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>