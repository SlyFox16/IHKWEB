<?php
if($model->is_staff) {
    $this->breadcrumbs=array(
        'Users'=>array('adminStaff'),
        $model->name=>array('view','id'=>$model->id),
        'Update',
    );
} else {
    $this->breadcrumbs=array(
        'Users'=>array('adminMembers'),
        $model->name=>array('view','id'=>$model->id),
        'Update',
    );
}

$url = $model->is_staff == 1 ? 'adminStaff' : 'adminMembers';
$this->menu=array(
    array('label'=>'Change Password','url'=>array('updatePassword','id'=>$model->id)),
    array('label'=>'Create User','url'=>array('create')),
	array('label'=>'View User','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage User','url'=>array($url)),
);
?>

<legend>Update User <?php echo $model->id; ?></legend>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>

    <div class="heading clearfix"><h3 class="pull-left">Certificates</small></h3></div>
<?php /*$dataProvider = new CArrayDataProvider(
    $model->certificates,
    array(
        'sort'=> array(
            'attributes' =>  array(
                'certificate_id' => array('label' => UserCertificate::model()->getAttributeLabel('certificate_id')),
                'tebleDescr' => array('label' => UserCertificate::model()->getAttributeLabel('tebleDescr')),
                'date' => array('label' => UserCertificate::model()->getAttributeLabel('date')),
            ),
        ),
    )
); */?>
<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'order-delivery-grid',
    'type' => 'striped bordered condensed',
    'dataProvider' => $model->findCertificates(),
    'htmlOptions'=>array('style'=>'padding:0;'),
    'columns' => array(
        array(
            'name' => 'certificate_id',
            'value' => '$data->certificate->name',
            'headerHtmlOptions' => array('width' => '10%')
        ),
        array(
            'name' => 'tebleDescr',
            'value' => '$data->certificate->description',
            'headerHtmlOptions' => array('width' => '70%')
        ),
        array(
            'class' => 'ext.editable.EditableColumn',
            'name' => 'date',
            'headerHtmlOptions' => array('style' => 'width: 20%'),
            'editable' => array(
                'type'          => 'date',
                'viewformat'    => 'dd/mm/yyyy',
                'url'           => $this->createUrl('user/uCUpdate'),
                'placement'     => 'left',
            )
        ),
        array(
            'class' => 'ext.editable.EditableColumn',
            'name' => 'confirm',
            'value' => 'CHtml::value($data, "status")', //we need to set value because source is url
            'headerHtmlOptions' => array('style' => 'width: 100px'),
            'editable' => array(
                'type'     => 'select',
                'url'      => $this->createUrl('user/uCUpdate'),
                'source'   => array(0 => 'Unconfirmed', 1 => 'Confirmed'),
                'onRender' => 'js: function(e, editable) {
                      var colors = {0: "red", 1: "green"};
                      $(this).css("color", colors[editable.value]);
                  }'
            )
        ),
        array(
            'class' => 'backend.components.ButtonColumn',
            'htmlOptions' => array('width' => '60px'),
            'template' => '{delete}',
            'deleteButtonUrl' => function ($data){
                return Yii::app()->createUrl("backend/certificates/uCDelete", array('id' => $data->id));
            },
        ),
    ),
)); ?>
<br />
<a href="#newCertificate" class="btn btn-inverse" data-toggle="modal">Add a certificate</a>
<br />
<br />
<div class="heading clearfix"><h3 class="pull-left">Completed projects</small></h3></div>
<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'order-completed-grid',
    'type' => 'striped bordered condensed',
    'dataProvider' => $model->findCompleted(),
    'htmlOptions'=>array('style'=>'padding:0;'),
    'columns' => array(
        array(
            'name' => 'name',
            'type' => 'raw',
            'value' => 'CHtml::link($data->name, "#completedProject".$data->id, array("data-toggle" => "modal"))',
        ),
        'image:image',
        array(
            'name' => 'description',
            'value' => 'YText::wordLimiter($data->description, 200)',
        ),
        'date',
        'link:url',
        array(
            'class' => 'ext.editable.EditableColumn',
            'name' => 'confirm',
            'value' => 'CHtml::value($data, "status")', //we need to set value because source is url
            'headerHtmlOptions' => array('style' => 'width: 100px'),
            'editable' => array(
                'type'     => 'select',
                'url'      => $this->createUrl('completedProjects/uCUpdate'),
                'source'   => array(0 => 'Unconfirmed', 1 => 'Confirmed'),
                'onRender' => 'js: function(e, editable) {
                      var colors = {0: "red", 1: "green"};
                      $(this).css("color", colors[editable.value]);
                  }'
            )
        ),
        array(
            'class' => 'backend.components.ButtonColumn',
            'htmlOptions' => array('width' => '60px'),
            'renderPopUserId' => $model->id,
            'template' => '{delete}',
            'deleteButtonUrl' => function ($data){
                return Yii::app()->createUrl("backend/completedProjects/delete", array('id' => $data->id));
            },
        ),
    ),
)); ?>
<br />
<a href="#completedProject" class="btn btn-inverse" data-toggle="modal">Add new project</a>
<br />
<br />
<div class="heading clearfix"><h3 class="pull-left">Association membership</small></h3></div>
<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'association-membership-grid',
    'type' => 'striped bordered condensed',
    'dataProvider' => $model->findAssociation(),
    'htmlOptions'=>array('style'=>'padding:0;'),
    'columns' => array(
        array(
            'name' => 'name',
            'value' => '$data->assoc->name',
        ),
        array(
            'name' => 'logo',
            'type' => 'image',
            'value' => '$data->assoc->logo',
        ),
        array(
            'name' => 'link',
            'type' => 'url',
            'value' => '$data->assoc->link',
        ),
        array(
            'class' => 'backend.components.ButtonColumn',
            'htmlOptions' => array('width' => '60px'),
            'template' => '{delete}',
            'deleteButtonUrl' => function ($data){
                return Yii::app()->createUrl("backend/associationMembership/deleteRelation", array('id' => $data->id));
            },
        ),
    ),
)); ?>
<br />
<a href="#associationMembership" class="btn btn-inverse" data-toggle="modal">Add new association</a>

<?php $this->widget('CreateCertificate', array('user' => $model->id)); ?>
<?php $this->widget('CompletedProject', array('renderPopUserId' => $model->id)); ?>
<?php $this->widget('AddAssociation', array('user' => $model->id)); ?>