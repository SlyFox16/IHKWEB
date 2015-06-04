<?php
$this->breadcrumbs=array(
	'Users'=>array('admin'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);
$url = $model->is_staff == 1 ? 'adminStaff' : 'adminMembers';
$this->menu=array(
    array('label'=>'Change Password','url'=>array('updatePassword','id'=>$model->id)),
    array('label'=>'Create User','url'=>array('create')),
	array('label'=>'View User','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage User','url'=>array($url)),
);
?>

<legend>Update User <?php echo $model->id; ?></legend>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>