<?php
    $this->breadcrumbs=array(
        'Users'=>array('admin'),
        'Create',
    );
?>

<legend>Create User</legend>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>