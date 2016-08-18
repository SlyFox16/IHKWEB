<?php
$this->breadcrumbs=array(
	'Association Memberships'=>array('admin'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Create AssociationMembership','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('association-membership-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<legend>Manage Association Memberships</legend>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'association-membership-grid',
    'type' => 'striped bordered condensed',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
        array(
            'name' => 'id',
            'htmlOptions' => array('width' => '20px'),
        ),
		'name',
        array(
            'name' => 'logo',
            'type' => 'image',
            'htmlOptions' => array('width' => '100px'),
            'filter' => false,
        ),
		'link:url',
        array(
            'class' => 'backend.components.ButtonColumn',
            'htmlOptions' => array('width' => '60px'),
        ),
	),
)); ?>
