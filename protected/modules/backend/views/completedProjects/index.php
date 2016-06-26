<?php
$this->breadcrumbs=array(
	'Completed Projects',
);

$this->menu=array(
	array('label'=>'Create CompletedProjects','url'=>array('create')),
	array('label'=>'Manage CompletedProjects','url'=>array('admin')),
);
?>

<legend>Completed Projects</legend>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
