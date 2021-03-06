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
	array('label'=>'Edit','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Change Password','url'=>array('updatePassword','id'=>$model->id)),
);
?>

<legend>View User #<?php echo $model->id; ?></legend>

<?php if (!$model->is_seeker) {
    $params = array(
        'id',
        'username',
        'name',
        'surname',
        'email',
        'avatar:image',
        'phone',
        array(
            'name' => 'country_id',
            'value' => User::getCityCountry($model->country_id, 'country'),
        ),
        array(
            'name' => 'city_id',
            'value' => User::getCityCountry($model->city_id, 'city'),
        ),
        array(
            'name' => 'speciality',
            'value' => function($data) {
                $ret = array();
                if($data->speciality) {
                    foreach($data->speciality as $speciality) {
                        $ret[] = $speciality->speciality;
                    }
                }
                return implode(', ', $ret);
            },
        ),
        'address',
        'position',
        'description',
        'facebook_url:url',
        'twitter_url:url',
        'xing_url:url',
        'web_url:url',
        'rating',
        'level',
        'expert_confirm:boolean',
        'is_active:boolean',
        'is_staff:boolean',
        'last_login',
        'date_joined',
    );
} else {
    $params = array(
        'id',
        'name',
        'surname',
        'email',
        'is_active:boolean',
        'last_login',
        'date_joined',
    );
} ?>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
    'data'=>$model,
    'attributes'=>$params
)); ?>
<br>

<?php if (!$model->is_seeker) { ?>
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
<?php } ?>