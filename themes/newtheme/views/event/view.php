<div class="row">
    <div class="small-12 medium-6 columns">
        <?php $this->widget('Breadcrumbs', array(
            'links' => array(
                Yii::t("base", 'Events') => array('/event/eventList'),
                $model->title,
            ),
        )); ?>
    </div>
</div>

<section class="separated">
    <div class="row">
        <div class="medium-3 columns">
            <ul class="event_meta">
                <li><?php echo YHelper::formatDate('dd MMMM yyyy', $event->date); ?></li>
                <li><?php echo User::getCityCountry($model->country_id, 'country').', '.User::getCityCountry($model->city_id, 'city'); ?></li>
            </ul>
        </div>
        <div class="medium-6 columns">
            <div class="expert_name">
                <h2><?php echo $model->title; ?></h2>
            </div>
            <p><?php echo $model->description; ?></p>

            <?php if(!empty($model->facebook_url) || !empty($model->twitter_url) || !empty($model->xing_url)) { ?>
            <ul class="items">
                <?php if (!empty($model->facebook_url)) { ?>
                    <li><a href="<?php echo $model->facebook_url; ?>" class="fa fa-facebook"></a></li>
                <?php } ?>
                <?php if (!empty($model->twitter_url)) { ?>
                    <li><a href="<?php echo $model->twitter_url; ?>" class="fa fa-twitter"></a></li>
                <?php } ?>
                <?php if (!empty($model->xing_url)) { ?>
                    <li><a href="<?php echo $model->xing_url; ?>" class="fa fa-xing"></a></li>
                <?php } ?>
                <li><a href=""><i class="fa fa-map-marker"></i> www.google.com</a></li>
            </ul>
            <?php } ?>
        </div>
        <div class="medium-3 columns">
            <img src="<?php echo YHelper::getImagePath($model->image, 263, 263); ?>" alt="">
        </div>
    </div>
</section>
<section class="bottom-separator">
    <div class="row">
        <div class="medium-6 medium-offset-3 columns">
            <div class="expert_section">
                <span><?php echo Yii::t("base", "Participating experts"); ?></span>
                <?php if($conUsers = $model->connectedUsers) { ?>
                    <ul class="event_experts">
                        <?php foreach ($conUsers as $user) { ?>
                            <li>
                                <a href="<?php echo $this->createUrl('user/info', array('id' => $user->id)); ?>" data-tooltip aria-haspopup="true" class="top" title="<?php echo $user->fullName; ?>" ><img src="<?php echo YHelper::getImagePath($user->avatar, 60, 60); ?>" alt="">
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                <?php } ?>
            </div>
            <div class="expert_section">
                <span>Location</span>
                <div class="location">
                    google map here
                </div>
            </div>
        </div>
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