<?php
if($model->is_staff) {
    $this->breadcrumbs=array(
        'Users'=>array('adminStaff'),
        $model->name,
    );
} else {
    $this->breadcrumbs=array(
        'Users'=>array('adminMembers'),
        $model->name,
    );
}

$url = $model->is_staff == 1 ? 'adminStaff' : 'adminMembers';
$this->menu=array(
	array('label'=>'Create User','url'=>array('create')),
	array('label'=>'Update User','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete User','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage User','url'=>array($url)),
	array('label'=>'Change Password','url'=>array('updatePassword','id'=>$model->id)),
);
?>

<legend>View User #<?php echo $model->id; ?></legend>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
    'data'=>$model,
    'attributes'=>array(
        'id',
        'username',
        'name',
        'surname',
        'email',
        'avatar:image',
        'phone',
        'address',
        'position',
        'description',
        'facebook_url:url',
        'twitter_url:url',
        'xing_url:url',
        'rating',
        'level',
        'expert_confirm:boolean',
        'is_active:boolean',
        'is_staff:boolean',
        'last_login',
        'date_joined',
    )
)); ?>

<div class="heading clearfix"><h3 class="pull-left">Certificates</small></h3></div>
<?php $dataProvider = new CArrayDataProvider($model->certificates); ?>
<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'order-delivery-grid',
    'type' => 'striped bordered condensed',
    'dataProvider' => $dataProvider,
    'template' => '{items}',
    'htmlOptions'=>array('style'=>'padding:0;'),
    'columns' => array(
        array(
            'name' => 'certificate_id',
            'value' => '$data->certificate->certificate',
            'headerHtmlOptions' => array('width' => '40px')
        ),
        array(
            'name' => 'tebleDescr',
            'value' => '$data->certificate->description',
            'headerHtmlOptions' => array('width' => '40px')
        ),
        array(
            'name' => 'date',
            'value' => '$data->date',
            'headerHtmlOptions' => array('width' => '40px')
        )
    ),
)); ?>
