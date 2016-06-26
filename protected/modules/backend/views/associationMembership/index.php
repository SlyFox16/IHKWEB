<?php
$this->breadcrumbs=array(
	'Association Memberships',
);

$this->menu=array(
	array('label'=>'Create AssociationMembership','url'=>array('create')),
	array('label'=>'Manage AssociationMembership','url'=>array('admin')),
);
?>

<legend>Association Memberships</legend>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
