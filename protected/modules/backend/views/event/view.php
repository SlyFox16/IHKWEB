<?php
$this->breadcrumbs=array(
	'Events'=>array('admin'),
	$model->title,
);

$this->menu=array(
	array('label'=>'Create Event','url'=>array('create')),
	array('label'=>'Update Event','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Event','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Event','url'=>array('admin')),
);
?>

<legend>View Event #<?php echo $model->id; ?></legend>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id:user',
		'title',
		'description',
		'facebook_url',
		'twitter_url',
		'xing_url',
		'site_url',
		'image:image',
        array(
            'name' => 'country_id',
            'value' => User::getCityCountry($model->country_id, 'country'),
        ),
        array(
            'name' => 'city_id',
            'value' => User::getCityCountry($model->city_id, 'city'),
        ),
		'address',
		'date:date',
		'active:boolean',
	),
)); ?>

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

<style>
    .icon-on, .icon-off {
        padding: 4px 14px;
    }
</style>