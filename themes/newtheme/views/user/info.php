<?php
    $this->title = $user->pageTitle;
    $this->metaDescription = YText::purifier($user->position);
    $this->canonical = $this->createAbsoluteUrl('user/info', array('id' => $user->id));
    $this->ogImage = YHelper::getImagePath($user->avatar, 200, 200);
    $this->metaProperties = array('og:image:height' => 200, 'og:image:width' => 200);
?>

<!--===============================-->
<!--== Expert =====================-->
<!--===============================-->
<div class="row">
    <div class="small-12 medium-6 columns">
        <?php $this->widget('Breadcrumbs', array(
            'links' => array(
                Yii::t("base", 'Experts') => array('site/findexperts'),
                $user->fullname
            ),
        )); ?>
    </div>
    <div class="small-12 medium-6 columns">
        <ul class="control wow bounceInRight animated" data-wow-duration="0.5s" data-wow-delay="0.5s">
            <?php if (!Yii::app()->user->is_seeker) { ?>
                <li title="<?php echo Yii::t('base', 'Rate this expert'); ?>"><?php $this->widget('StarRating', array('user' => $user)); ?></li>
            <?php } ?>
            <li><a title="<?php echo Yii::t("base", "Report"); ?>" class="fa fa-flag" data-toggle="report"></a></li>
            <?php if (!Yii::app()->user->is_seeker) { ?>
                <li><a title="<?php echo Yii::t("base", "Send mail"); ?>" class="fa fa-envelope" href="<?php echo $this->createUrl('/message/compose/compose', array('param' => $user->username)); ?>"></a></li>
            <?php } ?>
            <li>
                <a href="" class="fa fa-share-alt"></a>
                <ul class="share">
                    <li><a href="http://www.facebook.com/sharer/sharer.php?u=<?php Yii::app()->getBaseUrl(true).Yii::app()->request->requestUri;?>" class="fa fa-facebook"></a></li>
                    <li><a href="http://twitter.com/home?status=Let´s meet at #CrowdDialog in Helsinki <?php Yii::app()->getBaseUrl(true).Yii::app()->request->requestUri;?>" class="fa fa-twitter" class="fa fa-twitter"></a></li>
                    <li><a href="https://plus.google.com/share?url=<?php Yii::app()->getBaseUrl(true).Yii::app()->request->requestUri;?>" class="fa fa-google-plus"></a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>

<section class="separated">
    <div class="row">
        <div class="small-3 medium-3 columns">
            <div class="expert_photo">
                <img src="<?php echo YHelper::getImagePath($user->avatar, 200, 200); ?>" alt="<?php echo Yii::t("base", "Expert photo"); ?>">
            </div>
        </div>
        <div class="small-9 medium-6 columns">
            <div class="expert_name">
                <h2><?php echo $user->title; ?> <b><?php echo $user->name; ?></b> <?php echo $user->surname; ?></h2>
            </div>
            <h3><?php echo $user->position; ?></h3>
            <p><?php echo $user->uDescription; ?></p>
            <ul class="items">
                <?php if(!empty($user->address)) { ?>
                    <li>
                        <span><i class="fa fa-map-marker"></i>
                        <?php echo User::getCityCountry($user->country_id, 'country').', '.User::getCityCountry($user->city_id, 'city'); ?></span>
                    </li>
                <?php } ?>
                <?php if(!empty($user->phone)) { ?>
                    <li>
                        <span><i class="fa fa-phone"></i>
                        <?php echo $user->phone; ?></span>
                    </li>
                <?php } ?>
                <?php if(!empty($user->web_url)) { ?>
                    <li>
                        <a href="<?php echo $user->web_url; ?>">
                            <i class="fa fa-globe"></i>
                            <?php echo $user->clearUrl; ?>
                        </a>
                    </li>
                <?php } ?>
                <?php if(!empty($user->xing_url)) { ?>
                    <li>
                        <a class="fa fa-xing" href="<?php echo $user->xing_url; ?>"></a>
                    </li>
                <?php } ?>
                <?php if(!empty($user->linkedin_url)) { ?>
                    <li>
                        <a class="fa fa-linkedin" href="<?php echo $user->linkedin_url; ?>"></a>
                    </li>
                <?php } ?>
                <?php if(!empty($user->facebook_url)) { ?>
                    <li>
                        <a class="fa fa-facebook" href="<?php echo $user->facebook_url; ?>"></a>
                    </li>
                <?php } ?>
                <?php if(!empty($user->twitter_url)) { ?>
                    <li>
                        <a class="fa fa-twitter" href="<?php echo $user->twitter_url; ?>"></a>
                    </li>
                <?php } ?>
            </ul>
        </div>
        <div class="small-9 small-offset-3 medium-3 medium-offset-0 columns">
            <ul class="stats">
                <?php $this->widget('AmazonRating', array('user' => $user)); ?>
                <li><?php echo Yii::t("base", "Level");?> <b><?php echo $user->level; ?></b></li>
                <?php if($certisicates = $user->certificates(array('scopes' => array('confirmed')))) { ?>
                    <li><?php echo Yii::t("base", "Certification"); ?>
                        <ul class="certifications">
                            <?php foreach($certisicates as $cert) { ?>
                                <li>
                                    <a href="<?php echo $this->createUrl('site/certificateView', array('id' => $cert->certificate->id)); ?>">
                                        <img src="<?php echo YHelper::getImagePath($cert->certificate->logo, 60); ?>" data-tooltip title="<?php echo $cert->certificate->name; ?>">
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</section>
<section class="bottom-separator">
    <div class="row">
        <div class="medium-6 medium-offset-3 columns">
            <?php if($user->speciality) { ?>
                <div class="expert_section">
                    <span><?php echo Yii::t("base", "Specialities"); ?></span>
                    <ul class="items">
                        <?php foreach($user->speciality as $speciality) { ?>
                            <li><span><?php echo $speciality->speciality; ?></span></li>
                        <?php } ?>
                    </ul>
                </div>
            <?php } ?>
            <?php if($user->connectedAssoc) { ?>
                <div class="expert_section">
                    <span><?php echo Yii::t("base", "Associations"); ?></span>
                    <ul class="associates">
                        <?php foreach($user->connectedAssoc as $assoc) { ?>
                            <li data-tooltip aria-haspopup="true" title="<?php echo $assoc->name; ?>">
                                <a href="<?php echo $assoc->link; ?>" target="_blank">
                                    <img src="<?php echo YHelper::getImagePath($assoc->logo); ?>" alt="">
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            <?php } ?>
            <?php if($events = $user->events) { ?>
                <div class="expert_section">
                    <span><?php echo Yii::t("base", "Events participated"); ?></span>
                    <ul class="event_participation">
                        <?php foreach($events as $event) { ?>
                            <li>
                                <a href="<?php echo $this->createUrl('/event/view', array('id' => $event->id)); ?>" target="_blank">
                                    <time><?php echo YHelper::formatDate('dd MMMM yyyy', $event->date, 'dd/MM/yyyy'); ?></time>
                                    <div>
                                        <h2><?php echo $event->title; ?></h2>
                                        <span><?php echo User::getCityCountry($event->country_id, 'country').', '.User::getCityCountry($event->city_id, 'city'); ?></span>
                                    </div>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            <?php } ?>
            <?php if($completed = $user->completed(array('scopes' => array('confirmed')))) { ?>
                <div class="expert_section">
                    <span><?php echo Yii::t("base", "Projects"); ?></span>
                        <ul class="accordion projects" data-accordion>
                            <?php foreach($completed as $key => $cert) { ?>
                            <li class="accordion-item <?php echo $key == 0 ? 'is-active' : ''; ?>" data-accordion-item>
                                <a href="#" class="accordion-title"><?php echo $cert->name; ?> <span><?php echo YHelper::formatDate('dd MMMM yyyy', $cert->date, 'dd/MM/yyyy'); ?></span></a>
                                <div class="accordion-content" data-tab-content>
                                    <img src="<?php echo YHelper::getImagePath($cert->image); ?>">
                                    <p><?php echo $cert->description; ?></p>
                                    <a href="<?php echo $cert->link; ?>" class="more"><?php echo Yii::t("base", "Check out project"); ?> <i class="fa fa-angle-right"></i></a>
                                </div>
                            </li>
                            <?php } ?>
                        </ul>
                </div>
            <?php } ?>
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

<?php $this->widget('RatingDescription', array('user' => $user)); ?>
<?php $this->widget('Reportpop', array('receiver' => $user->id)); ?>
<?php Yii::app()->clientScript->registerScript('username',"
        username = '$user->username'
"); ?>