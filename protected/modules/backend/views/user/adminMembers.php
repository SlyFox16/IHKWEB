<?php
/**
 * @var $model User
 * @var $this BackendController
 **/
$this->breadcrumbs = array(
    'Users' => array('adminMembers'),
    'Manage',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('user-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="row-fluid">
    <div class="span12">
        <div class="btn-toolbar pull-right" style="margin-bottom: 10px">
            <div class="btn-group">
                <a class="btn btn-success" href="/backend/user/CreateUser/"><i class="icon-pencil icon-white"></i>
                    Create User</a>
            </div>
        </div>
    </div>
</div>

<legend>
    <?php if($param == 'new') { ?>
        New Users
    <?php } elseif($param == 'newlevel') { ?>
        Users new level
    <?php } else { ?>
        Manage Users
    <?php } ?>
</legend>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'user-grid',
    'dataProvider' => $model->searchMember($param),
    'type' => 'striped bordered condensed',
    'filter' => $model,
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
            'class' => 'ext.editable.EditableColumn',
            'name' => 'expert_confirm',
            'filter' => array('Not Confirmed' , 'Confirmed'),
            'value' => 'CHtml::value($data, "statusConfirm")', //we need to set value because source is url
            'headerHtmlOptions' => array('style' => 'width: 100px'),
            'editable' => array(
                'type'     => 'select',
                'url'      => $this->createUrl('user/staffUpdate'),
                'source'   => array(0 => 'Unconfirmed', 1 => 'Confirmed'),
                'onRender' => 'js: function(e, editable) {
                      var colors = {0: "red", 1: "green"};
                      $(this).css("color", colors[editable.value]);
                  }'
            )
        ),
        array(
            'class' => 'ext.editable.EditableColumn',
            'name' => 'is_active',
            'filter' => array('Inactive' , 'Active'),
            'value' => 'CHtml::value($data, "statusActive")', //we need to set value because source is url
            'headerHtmlOptions' => array('style' => 'width: 100px'),
            'editable' => array(
                'type'     => 'select',
                'url'      => $this->createUrl('user/staffUpdate'),
                'source'   => array(0 => 'Inactive', 1 => 'Active'),
                'onRender' => 'js: function(e, editable) {
                      var colors = {0: "red", 1: "green"};
                      $(this).css("color", colors[editable.value]);
                  }'
            )
        ),
        array(
            'class' => 'ext.editable.EditableColumn',
            'name' => 'is_staff',
            'filter' => false,
            'value' => 'CHtml::value($data, "statusStaff")', //we need to set value because source is url
            'headerHtmlOptions' => array('style' => 'width: 100px'),
            'editable' => array(
                'type'     => 'select',
                'url'      => $this->createUrl('user/staffUpdate'),
                'source'   => array(0 => 'User', 1 => 'Admin'),
                'onRender' => 'js: function(e, editable) {
                      var colors = {0: "green", 1: "blue"};
                      $(this).css("color", colors[editable.value]);
                  }'
            )
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
            'class' => 'backend.components.ButtonColumn',
            'htmlOptions' => array('width' => '60px'),
            'template' => '{view} {update} {delete}',
            'buttons' => array(
                'delete' => array(
                    'visible'=>'$data->is_staff != 1',
                ),
            )
        ),
    ),
)); ?>


