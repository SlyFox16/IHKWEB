<?php
    if($model->is_staff) {
        $this->breadcrumbs=array(
            'Users'=>array('adminStaff'),
            'Create',
        );
    } else {
        $this->breadcrumbs=array(
            'Users'=>array('adminMembers'),
            'Create',
        );
    }
?>

<legend>Create User</legend>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>