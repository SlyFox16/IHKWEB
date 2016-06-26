<?php
$this->breadcrumbs=array(
	'Association Memberships'=>array('admin'),
	'Create',
);

$this->menu=array(
	array('label'=>'Manage AssociationMembership','url'=>array('admin')),
);
?>

<legend>Create AssociationMembership</legend>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>