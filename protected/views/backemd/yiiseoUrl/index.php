<?php
$this->breadcrumbs=array(
	'Yiiseo Urls',
);

$this->menu=array(
	array('label'=>'Create YiiseoUrl','url'=>array('create')),
	array('label'=>'Manage YiiseoUrl','url'=>array('admin')),
);
?>

<legend>Yiiseo Urls</legend>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
