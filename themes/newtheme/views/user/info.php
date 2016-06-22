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
            <li><a href="" class="fa fa-flag"></a></li>
            <li>
                <a href="" class="fa fa-share-alt"></a>
                <ul class="share">
                    <li><a href="" class="fa fa-facebook"></a></li>
                    <li><a href="" class="fa fa-twitter"></a></li>
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
                <h2><b><?php echo $user->name; ?></b> <?php echo $user->surname; ?></h2>
            </div>
            <h3><?php echo $user->position; ?></h3>
            <?php if($user->speciality) { ?>
                <ul class="expert_domain">
                    <?php foreach($user->speciality as $speciality) { ?>
                        <li><?php echo $speciality->speciality; ?></li>
                    <?php } ?>
                </ul>
            <?php } ?>
            <p><?php echo $user->uDescription; ?></p>
            <ul class="associates">
                <li data-tooltip aria-haspopup="true" title="Deutscher Crowdsourcing Verband Member"><img src="<?php echo $this->assetsUrl?>/images/DCV-logo.png" alt=""></li>
            </ul>
        </div>
        <div class="small-9 small-offset-3 medium-3 medium-offset-0 columns">
            <ul class="stats">
                <li><?php echo Yii::t("base", "Rating");?> <b><?php echo $user->rating; ?></b></li>
                <li><?php echo Yii::t("base", "Level");?> <b><?php echo $user->level; ?></b></li>
                <li>Certification
                    <b><img src="<?php echo $this->assetsUrl?>/images/ihk.png" alt=""></b>
                </li>
            </ul>
        </div>
    </div>
</section>

<section>
    <div class="row">
        <div class="medium-6 medium-offset-3 columns">
            <?php if(!empty($user->certificates)) { ?>
                <?php foreach($user->certificates as $cert) { ?>
                    <article class="certification">
                        <header>
                            <h3><?php echo $cert->certificate->name; ?></h3> <span><?php echo Yii::app()->format->date($cert->date); ?></span>
                        </header>
                        <p><?php echo $cert->certificate->description; ?></p>
                        <a href="" class="more">Check out project <i class="fa fa-angle-right"></i></a>
                    </article>
                <?php } ?>
            <?php } ?>
        </div>
        <div class="medium-3 columns">
            <ul class="contacts">
                <?php if(!empty($user->address)) { ?>
                    <li>
                        <i class="fa fa-map-marker"></i>
                        <span><?php echo $user->address; ?></span>
                    </li>
                <?php } ?>
                <?php if(!empty($user->phone)) { ?>
                    <li>
                        <i class="fa fa-phone"></i>
                        <span><?php echo $user->phone; ?></span>
                    </li>
                <?php } ?>
                <?php if(!empty($user->xing_url)) { ?>
                    <li>
                        <i class="fa fa-xing"></i>
                        <a href="<?php echo $user->xing_url; ?>"><?php echo $user->fullname;?></a>
                    </li>
                <?php } ?>
                <?php if(!empty($user->facebook_url)) { ?>
                    <li>
                        <i class="fa fa-facebook"></i>
                        <a href="<?php echo $user->facebook_url; ?>">Facebook</a>
                    </li>
                <?php } ?>
                <?php if(!empty($user->twitter_url)) { ?>
                    <li>
                        <i class="fa fa-twitter"></i>
                        <a href="<?php echo $user->twitter_url; ?>">Twitter</a>
                    </li>
                <?php } ?>
            </ul>
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
                <?php echo CHtml::link(Yii::t("base", 'Become Expert').' <i class="fa fa-angle-right">', array('/registration'), array('class' => 'button large transparent')); ?>
            <?php } ?>
        </div>
    </div>
</section>