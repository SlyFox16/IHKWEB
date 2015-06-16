<?php
$this->breadcrumbs=array(
	'Reports',
);

$this->menu=array(
	array('label'=>'Manage Report','url'=>array('admin')),
);
?>

<legend>Reports</legend>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
