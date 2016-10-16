<?php
$this->breadcrumbs=array(
	'Events'=>array('admin'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Create Event','url'=>array('create')),
	array('label'=>'View Event','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Event','url'=>array('admin')),
);
?>

<legend>Update Event <?php echo $model->id; ?></legend>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'user-grid',
    'dataProvider' => User::model()->searchAllActive(),
    'type' => 'striped bordered condensed',
    'columns' => array(
        array('name'=>'id','headerHtmlOptions'=>array('width'=>'40px')),
        'username',
        'name',
        'surname',
        'email',
        array(
            'name'=>'avatar',
            'value'=>'$data->avatar',
            'type'=>'image',
            'filter'=>false,
        ),
        array(
            'name'=>'last_login',
            'value'=>'$data->last_login',
            'filter'=>false,
        ),
        array(
            'name'=>'date_joined',
            'value'=>'$data->date_joined',
            'filter'=>false,
        ),
        array(
            'class'=>'DToggleColumn',
            // атрибут модели
            'name'=>'related',
            // заголовок столбца
            'header' => false,
            // запрос подтвердждения (если нужен)
            'onImageHtml' => '<button class="con-on btn btn-primary" type="button">Related</button>',
            'offImageHtml' => '<button class="con-off btn btn-default" type="button">Related</button>',
            'aTagOn' => 'btn-success',
            'aTagOff' => 'btn-default-alt',
            'aToggle' => 'btn-success btn-default-alt',
            'linkUrl'=>'Yii::app()->controller->createUrl("event/addMember", array("event_id"=>'.$model->id.', "user_id"=>$data->id))',
            'confirmation' => false,
            'value' => '$data->related_button('.$model->id.')',
            // фильтр
            'filter' => false,
            // alt для иконок (так как отличается от стандартного)
            'htmlOptions' => array('style'=>'width:100px'),
        ),
    ),
)); ?>