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
            <li data-tooltip aria-haspopup="true" class="top" title="Add New Event"><a href="<?php echo $this->createUrl('/event/create'); ?>" class="fa fa-plus"></a></li>
        </ul>
    </div>
</div>

<section class="separated">
    <div class="row">
        <?php if ($events) { ?>
            <?php foreach ($events as $event) { ?>
                <div class="medium-4 large-3 columns">
                    <a href="<?php echo $this->createUrl('/event/view', array('id' => $event->id)); ?>" class="event">
                        <time><?php echo YHelper::formatDate('dd MMMM yyyy', $event->date); ?></time>
                        <span class="event_bottom">
                            <h2><?php echo $event->title; ?></h2>
                            <span><?php echo User::getCityCountry($event->country_id, 'country').', '.User::getCityCountry($event->city_id, 'city'); ?></span>
                        </span>
                    </a>
                </div>
            <?php } ?>
        <?php } else { ?>
            No events found
        <?php } ?>
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