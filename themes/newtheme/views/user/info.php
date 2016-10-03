<?php
    $this->title = $user->pageTitle;
    $this->metaDescription = $user->position;
    $this->canonical = $this->createAbsoluteUrl('user/info', array('id' => $user->id));
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
            <li><a class="fa fa-flag" data-toggle="report"></a></li>
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
                        <?php echo User::getCityCountry($user->country_id, 'country').'<br> '.User::getCityCountry($user->city_id, 'city').'<br> '.$user->address; ?></span>
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
                        <a class="fa fa-globe" href="<?php echo $user->web_url; ?>"><?php echo $user->clearUrl; ?></a>
                    </li>
                <?php } ?>
                <?php if(!empty($user->xing_url)) { ?>
                    <li>
                        <a class="fa fa-xing" href="<?php echo $user->xing_url; ?>"><?php echo $user->fullname;?></a>
                    </li>
                <?php } ?>
                <?php if(!empty($user->linkedin_url)) { ?>
                    <li>
                        <a class="fa fa-linkedin" href="<?php echo $user->linkedin_url; ?>">Linkedin</a>
                    </li>
                <?php } ?>
                <?php if(!empty($user->facebook_url)) { ?>
                    <li>
                        <a class="fa fa-facebook" href="<?php echo $user->facebook_url; ?>">Facebook</a>
                    </li>
                <?php } ?>
                <?php if(!empty($user->twitter_url)) { ?>
                    <li>
                        <a class="fa fa-twitter" href="<?php echo $user->twitter_url; ?>">Twitter</a>
                    </li>
                <?php } ?>

                <li><span><i class="fa fa-phone"></i> +1 (234) 567 89</span></li>
                <li><span><i class="fa fa-map-marker"></i> Moldova, Chisinau</span></li>
                <li><a href="" class="fa fa-facebook"></a></li>
                <li><a href="" class="fa fa-twitter"></a></li>
                <li><a href="" class="fa fa-xing"></a></li>
            </ul>
        </div>
        <div class="small-9 small-offset-3 medium-3 medium-offset-0 columns">
            <ul class="stats">
                <li>Rating <b>0</b></li>
                <li>Level <b>0</b></li>
                <li>Certification
                    <ul class="certifications">
                        <li data-tooltip aria-haspopup="true" title="Certification Title"><img src="assets/images/ihk.png" alt=""></li>
                        <li data-tooltip aria-haspopup="true" title="Certification Title"><img src="assets/images/ihk.png" alt=""></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</section>
<section class="bottom-separator">
    <div class="row">
        <div class="medium-6 medium-offset-3 columns">
            <div class="expert_section">
                <span>Specialities</span>
                <ul class="items">
                    <li><span>CrowdInnovation</span></li>
                    <li><span>CrowdSourcing</span></li>
                    <li><span>CrowdFunding</span></li>
                </ul>
            </div>
            <div class="expert_section">
                <span>Associations</span>
                <ul class="associates">
                    <li data-tooltip aria-haspopup="true" title="Deutscher Crowdsourcing Verband Member"><img src="assets/images/DCV-logo.png" alt=""></li>
                    <li data-tooltip aria-haspopup="true" title="Deutscher Crowdsourcing Verband Member"><img src="assets/images/BC-logo.png" alt=""></li>
                </ul>
            </div>
            <div class="expert_section">
                <span>Projects</span>
                <ul class="accordion projects" data-accordion>
                    <li class="accordion-item is-active" data-accordion-item>
                        <a href="#" class="accordion-title">activoris Medzintechnik GmbH <span>02 Januar 2016</span></a>
                        <div class="accordion-content" data-tab-content>
                            <img src="assets/images/ihk.png" alt="Image">
                            <p>
                                Ein erstklassiger Medizintechnik-Dienstleister, der alle Stolpersteine aus dem Weg räumt!
                                <a href="">Project details ></a>
                            </p>
                        </div>
                    </li>
                    <li class="accordion-item" data-accordion-item>
                        <a href="#" class="accordion-title">Accordion 1</a>
                        <div class="accordion-content" data-tab-content>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Hic vel, iusto omnis harum officia est modi nobis sapiente placeat incidunt eos voluptatibus veritatis sequi natus voluptates consequuntur sed velit commodi?
                        </div>
                    </li>
                </ul>
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
            <a href="" class="button large">Find Experts <i class="fa fa-search"></i></a>
            <a href="" class="button large transparent">Become Expert <i class="fa fa-angle-right"></i></a>
        </div>
    </div>
</section>