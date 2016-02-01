<?php
$this->breadcrumbs=array(
	'Rating Logs',
);

$this->menu=array(
	array('label'=>'Create RatingLog','url'=>array('create')),
	array('label'=>'Manage RatingLog','url'=>array('admin')),
);
?>

<legend>Rating Logs</legend>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
