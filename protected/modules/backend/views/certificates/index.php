<?php
$this->breadcrumbs=array(
	'Certificates',
);

$this->menu=array(
	array('label'=>'Create Certificates','url'=>array('create')),
	array('label'=>'Manage Certificates','url'=>array('admin')),
);
?>

<legend>Certificates</legend>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
