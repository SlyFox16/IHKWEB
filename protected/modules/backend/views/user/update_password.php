<?php
if($model->is_staff) {
    $this->breadcrumbs=array(
        'Users'=>array('adminStaff'),
        $model->name=>array('view','id'=>$model->id),
        'Update',
    );
} else {
    $this->breadcrumbs=array(
        'Users'=>array('adminMembers'),
        $model->name=>array('view','id'=>$model->id),
        'Update',
    );
}

$this->menu=array(
    array('label'=>'Update User','url'=>array('update','id'=>$model->id)),
	array('label'=>'Create User','url'=>array('create')),
	array('label'=>'View User','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage User','url'=>array('admin')),
);
?>

<legend>Update User <?php echo $model->id; ?></legend>

<?php echo $this->renderPartial('_form_password',array('model'=>$model)); ?>