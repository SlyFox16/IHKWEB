<?php
    $this->title = $model->title;
    $this->metaDescription = YText::purifier($model->description);
    $this->canonical = $this->createAbsoluteUrl('/event/view', array('id' => $model->id));
    $this->ogImage = YHelper::getImagePath($model->image);
?>

<div class="row">
    <div class="small-12 medium-6 columns">
        <?php $this->widget('Breadcrumbs', array(
            'links' => array(
                Yii::t("base", 'Events') => array('/event/eventList'),
                $model->title,
            ),
        )); ?>
    </div>
    <?php if ($model->user_id == Yii::app()->user->id) { ?>
        <div class="small-12 medium-6 columns">
            <ul class="control wow bounceInRight animated" data-wow-duration="0.5s" data-wow-delay="0.5s">
                <li data-tooltip aria-haspopup="true" class="top" title="<?php echo Yii::t("base", "Update Event"); ?>"><a href="<?php echo $this->createUrl('/event/update', array('id' => $model->id)); ?>" class="fa fa-pencil"></a></li>
                <li data-tooltip aria-haspopup="true" class="top" title="<?php echo Yii::t("base", "Delete Event"); ?>"><a id="delete" data-id="<?php $model->id; ?>" href="#" class="fa fa-times"></a></li>
                <li data-tooltip aria-haspopup="true" class="top" title="<?php echo $model->checkEventUser() ? Yii::t("base", "Delete yourself") : Yii::t("base", "Add yourself"); ?>"><a id="add-yourself" data-id="<?php $model->id; ?>" href="#" class="fa <?php echo $model->checkEventUser() ? 'fa-user-times' : 'fa-user-plus'; ?>"></a></li>
            </ul>
        </div>
    <?php } ?>
</div>

<section class="separated">
    <div class="row">
        <div class="medium-3 columns">
            <ul class="event_meta">
                <li><?php echo YHelper::formatDate('dd MMM', $model->date, 'dd/MM/yyyy'); ?> -
                <?php echo YHelper::formatDate('dd MMM yyyy', $model->date_end, 'dd/MM/yyyy'); ?></li>
                <li><?php echo User::getCityCountry($model->country_id, 'country').', '.User::getCityCountry($model->city_id, 'city'); ?></li>
            </ul>
        </div>
        <div class="medium-6 columns">
            <div class="expert_name">
                <h2><?php echo $model->title; ?></h2>
            </div>
            <p><?php echo $model->description; ?></p>

            <?php if(!empty($model->facebook_url) || !empty($model->twitter_url) || !empty($model->xing_url) || !empty($model->site_url)) { ?>
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
                <?php if (!empty($model->site_url)) { ?>
                    <li><a href="<?php echo $model->site_url; ?>"><i class="fa fa-globe"></i> <?php echo $model->site_url; ?></a></li>
                <?php } ?>
            </ul>
            <?php } ?>
        </div>
        <?php if (!empty($model->image)) { ?>
            <div class="medium-3 columns">
                <img src="<?php echo YHelper::getImagePath($model->image); ?>" alt="">
            </div>
        <?php } ?>
    </div>
</section>
<section class="bottom-separator">
    <div class="row">
        <div class="medium-6 medium-offset-3 columns">
            <?php if($conUsers = $model->connectedUsers) { ?>
                <div class="expert_section">
                    <span><?php echo Yii::t("base", "Participating experts"); ?></span>
                        <ul class="event_experts">
                            <?php foreach ($conUsers as $user) { ?>
                                <li>
                                    <a href="<?php echo $this->createUrl('user/info', array('id' => $user->id)); ?>" data-tooltip aria-haspopup="true" class="top" title="<?php echo $user->fullName; ?>" ><img src="<?php echo YHelper::getImagePath($user->avatar, 60, 60); ?>" alt="">
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                </div>
            <?php } ?>
            <div class="expert_section">
                <span>Location</span>
                <div id="location">
                    <iframe src="https://www.google.com/maps/embed/v1/place?q=<?php echo urlencode($model->address." ".User::getCityCountry($model->city_id, 'city'). " " .User::getCityCountry($model->country_id, 'country')); ?>&key=<?php echo Yii::app()->params['googleMapKey']; ?>" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
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

<?php Yii::app()->clientScript->registerScript('delete-event', "
    $('.columns').on('click', '#delete', function () {
        var self = $(this);
        $.ajax({
            type:'POST',
            url: '".Yii::app()->controller->createUrl('/event/delete', array('id' => $model->id))."',
            success:function (msg) {
                window.location = '".Yii::app()->controller->createUrl('/event/eventList')."';
            }
        });
    });
    $('.columns').on('click', '#add-yourself', function () {
        var self = $(this);
        $.ajax({
            type:'POST',
            url: '".Yii::app()->controller->createUrl('/event/addYourself', array('id' => $model->id))."',
            success:function (msg) {
                window.location.reload(false);
            }
        });
    });
", CClientScript::POS_END); ?>
