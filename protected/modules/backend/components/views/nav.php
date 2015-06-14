<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container-fluid">
            <a class="brand" href="<?php echo Yii::app()->createUrl("backend"); ?>">
                <?php echo CHtml::image($this->controller->module->assetsUrl.'/img/Logo.png', 'Logo', array('width' => '70px')); ?>
            </a>
            <ul class="nav user_menu pull-right">

                <?php if($isSeen > 0) { ?>
                    <li class="hidden-phone hidden-tablet">
                        <div class="nb_boxes clearfix">
                            <a class="label ttip_b" href="<?php echo Yii::app()->createUrl('/backend/user/adminMembers/new');?>" data-backdrop="static" data-toggle="modal" title="New members" aria-describedby="ui-tooltip-0"><?php echo $isSeen; ?> <i class="splashy-contact_blue"></i></a>
                        </div>
                    </li>
                    <li class="divider-vertical hidden-phone hidden-tablet"></li>
                <?php } ?>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo Yii::app()->user->name; ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo Yii::app()->createUrl("backend/user/view",array('id'=>Yii::app()->user->id)); ?>">My Profile</a></li>
                        <li class="divider"></li>
                        <li><a href="<?php echo Yii::app()->createUrl("backend/default/logout"); ?>">Log Out</a></li>
                    </ul>
                </li>
            </ul>
            <a data-target=".nav-collapse" data-toggle="collapse" class="btn_menu">
                <span class="icon-align-justify icon-white"></span>
            </a>
            <?php $this->widget('MainMenu'); ?>
        </div>
    </div>
</div>