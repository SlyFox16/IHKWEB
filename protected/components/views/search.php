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
                <?php echo CHtml::linkButton('<i class="fa fa-search"></i>'); ?>
            <?php $this->endWidget(); ?>
        </li>
        <li>
            <a href=""><i class="fa fa-chevron-right"></i></a>
        </li>
    </ul>
</div>