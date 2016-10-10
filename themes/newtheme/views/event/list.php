<div class="row">
    <div class="small-12 medium-6 columns">
        <ul class="breadcrumbs">
            <?php $this->widget('Breadcrumbs', array(
                'links' => array(
                    Yii::t("base", 'Events')
                ),
            )); ?>
        </ul>
    </div>
    <div class="small-12 medium-6 columns">
        <ul class="control wow bounceInRight animated" data-wow-duration="0.5s" data-wow-delay="0.5s">
            <li data-tooltip aria-haspopup="true" class="top" title="<?php echo Yii::t("base", "Add New Event"); ?>"><a href="<?php echo $this->createUrl('/event/create'); ?>" class="fa fa-plus"></a></li>
        </ul>
    </div>
</div>

<section class="separated">
    <div class="row">
        <?php $this->widget('ListView', array(
            'id'=>'event-grid',
            'dataProvider' => $event->searchApproved(),
            'itemView' => '_event', // refers to the partial view named '_post'
            'summaryText' => false,
            'itemsTagName' => 'div',
            'itemsCssClass' => 'experts experts--ranking',
            'loadingCssClass' => false,
            'pager'=> "LinkPager",
            'template'=>'{items} {pager}',
            'cssFile' => false,
            'emptyText' => '<div class="col-sm-12 text-center no-results">
                <h1>'.Yii::t("base", "Sorry").'</h1>
                <p>'. Yii::t("base", "Nothing found").'<a class="angle" href="/"> '. Yii::t("base", "Go back").'</a></p>
            </div>',
            'htmlOptions' => array(
                'class' => false
            )
        )); ?>
    </div>
</section>


<!--===============================-->
<!--== CTA ========================-->
<!--===============================-->
<section>
    <div class="row">
        <div class="small-12 medium-9 medium-offset-3 columns">
            <?php if(!Yii::app()->user->isGuest) { ?>
                <a href="<?php echo $this->createUrl('site/findexperts'); ?>" class="button large"><?php echo Yii::t("base", "Find Experts");?> <i class="fa fa-search"></i></a>
            <?php } ?>
            <?php if(Yii::app()->user->isGuest) { ?>
                <a href="<?php echo $this->createUrl('/registration'); ?>" class="button large"><?php echo Yii::t("base", "Become Expert");?> <i class="fa fa-angle-right"></i></a>
            <?php } ?>
        </div>
    </div>
</section>