<?php
$this->breadcrumbs=array(
	'Feedbacks',
);

$this->menu=array(
	array('label'=>'Manage Feedback','url'=>array('admin')),
);
?>

<legend>Feedbacks</legend>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
