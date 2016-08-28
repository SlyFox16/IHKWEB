<?php
$this->breadcrumbs=array(
	'Yiiseo Urls'=>array('admin'),
	'Create',
);

$this->menu=array(
	array('label'=>'Manage YiiseoUrl','url'=>array('admin')),
);
?>

<legend>Create YiiseoUrl</legend>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>