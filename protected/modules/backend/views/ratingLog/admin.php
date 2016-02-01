<?php
$this->breadcrumbs=array(
	'Rating Logs'=>array('admin'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Create RatingLog','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
    $('.search-button').click(function(){
        $('.search-form').toggle();
        return false;
    });
    $('.search-form form').submit(function(){
        $.fn.yiiGridView.update('rating-log-grid', {
            data: $(this).serialize()
        });
        return false;
    });
");
?>

<legend>Manage Rating Logs</legend>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'rating-log-grid',
    'type' => 'striped bordered condensed',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'who_vote:user',
		'who_received:user',
		'num',
		'description',
		'confirmed:boolean',
        array(
            'class' => 'backend.components.ButtonColumn',
            'htmlOptions' => array('width' => '60px'),
        ),
	),
)); ?>
