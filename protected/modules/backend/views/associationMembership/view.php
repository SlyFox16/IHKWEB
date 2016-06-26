<?php
$this->breadcrumbs=array(
	'Association Memberships'=>array('admin'),
	$model->name,
);

$this->menu=array(
	array('label'=>'Create AssociationMembership','url'=>array('create')),
	array('label'=>'Update AssociationMembership','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete AssociationMembership','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage AssociationMembership','url'=>array('admin')),
);
?>

<legend>View AssociationMembership #<?php echo $model->id; ?></legend>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'logo:image',
		'link',
	),
)); ?>
