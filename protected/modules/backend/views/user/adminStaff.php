<?php
    /**
     * @var $model User
     * @var $this BackendController
     **/
    $this->breadcrumbs = array(
        'Users' => array('adminStaff'),
        'Manage',
    );
?>

<div class="row-fluid">
    <div class="span12">
        <div class="btn-toolbar pull-right" style="margin-bottom: 10px">
            <div class="btn-group">
                <a class="btn btn-success" href="/backend/user/create/"><i class="icon-pencil icon-white"></i>
                    Create Administrator</a>
            </div>
        </div>
    </div>
</div>

<?php
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

<legend>Manage Users</legend>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'user-grid',
    'dataProvider' => $model->searchStaff(),
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
            'type' => 'boolean',
            'name' => 'expert_confirm',
            'filter' => array('Not Confirmed' , 'Confirmed'),
            'value' => '$data->expert_confirm',
        ),
        array(
            'type' => 'boolean',
            'name' => 'is_active',
            'filter' => array('Not Active' , 'Active'),
            'value' => '$data->is_active',
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