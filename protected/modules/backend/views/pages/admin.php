<?php
$this->breadcrumbs=array(
	'Pages'=>array('admin'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Create Pages','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('pages-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<legend>Manage Pages</legend>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'pages-grid',
    'type' => 'striped bordered condensed',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
        array(
            'name' => 'slug',
            'value' => function($data) {
                return Yii::app()->createAbsoluteUrl('site/pages', array('id' => $data->id));
            }
        ),
		'title',
        array(
            'class' => 'backend.components.ButtonColumn',
            'htmlOptions' => array('width' => '60px'),
        ),
	),
)); ?>
