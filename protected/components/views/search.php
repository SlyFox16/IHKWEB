<div class="container relative no-padding">

    <!--== Page Control ==-->
    <ul class="page-control wow bounceInRight" data-wow-duration="0.5s" data-wow-delay="0.5s">
        <li class="search">
            <?php $this->beginWidget('CActiveForm', array(
                'id'=>'search-form',
                'method'=>'get',
                'action' => array('/site/search'),
                'enableAjaxValidation'=>false,
                'htmlOptions'=>array(
                    'class'=>'search',
                ),
            )); ?>
                <?php echo CHtml::textField('q', '', array('placeholder' => Yii::t("base", 'Search'))); ?>
                <?php echo CHtml::linkButton('', array('class' => 'fa fa-search')); ?>
            <?php $this->endWidget(); ?>
        </li>
        <li>
            <a href="<?php echo Yii::app()->createUrl('site/findexperts'); ?>" class="fa fa-chevron-right"></a>
        </li>
    </ul>
</div>