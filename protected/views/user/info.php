<section class="separated">
    <div class="container relative">

        <!--== Breadcrumbs ==-->
        <?php
        $this->widget('Breadcrumbs', array(
            'links' => array(
                Yii::t("base", 'Experts') => array('site/findexperts'),
                $user->fullname
            ),
        ));
        ?>

        <!--== Page Control ==-->
        <ul class="page-control wow bounceInRight" data-wow-duration="0.5s" data-wow-delay="0.5s">
            <li>
                <div class="rating">
                    <?php $this->widget('StarRating', array('user' => $user)); ?>
                </div>
            </li>
            <?php if($user->checkReport()) { ?>
                <li>
                    <a href="" class="fa fa-flag" data-toggle="modal" data-target="#report"></a>
                </li>
            <?php } ?>
            <li>
                <a href="" class="fa fa-share-alt"></a>
                <ul class="share">
                    <li><a href="http://www.facebook.com/sharer/sharer.php?u=<?php Yii::app()->getBaseUrl(true).Yii::app()->request->requestUri;?>" class="fa fa-facebook"></a></li>
                    <li><a href="http://twitter.com/home?status=Let´s meet at #CrowdDialog in Helsinki <?php Yii::app()->getBaseUrl(true).Yii::app()->request->requestUri;?>" class="fa fa-twitter"></a></li>
                    <li><a href="https://plus.google.com/share?url=<?php Yii::app()->getBaseUrl(true).Yii::app()->request->requestUri;?>" class="fa fa-google-plus"></a></li>
                </ul>
            </li>
        </ul>
        <div class="row">
            <div class="col-sm-3">
                <img src="<?php echo Yii::app()->iwi->load($user->UAvatar)->adaptive(280, 280)->cache(); ?>" alt="<?php echo $user->fullname;?>">
            </div>
            <div class="col-sm-6 col-xs-9">
                <h2 class="expert-name"><b><?php echo $user->name; ?></b> <?php echo $user->surname; ?></h2>

                <?php if($user->speciality) { ?>
                    <?php foreach($user->speciality as $speciality) { ?>
                        expert in: <?php echo $speciality->speciality; ?>
                    <?php } ?>
                <?php } ?>

                <h3><?php echo $user->position; ?></h3>
                <?php echo $user->uDescription; ?>
            </div>
            <div class="col-sm-3 col-xs-3 text-right">
                <ul class="stats">
                    <li class="userRating">
                        Rating <b><?php echo $user->rating; ?></b>
                    </li>
                    <li>
                        Level <b><?php echo $user->level; ?></b>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6">
                    <?php if(!empty($user->certificates)) { ?>
                    <ul class="certification">
                        <?php foreach($user->certificates as $cert) { ?>
                        <li>
                            <div class="certification-title">
                                <h3><?php echo $cert->certificate->name; ?></h3>
                                <span><?php echo Yii::app()->format->date($cert->date); ?></span>
                            </div>
                            <?php echo CHtml::image(YHelper::getImagePath($cert->certificate->logo, 120, 120), 'Certifacate image'); ?>
                            <p><?php echo $cert->certificate->description; ?></p>
                        </li>
                        <?php } ?>
                    </ul>
                    <?php } ?>
                <div class="cta bottom-30">
                    <a href="<?php echo $this->createUrl('site/findexperts'); ?>" class="button">Find Experts <i class="fa fa-search"></i></a>
                    <?php if(Yii::app()->user->isGuest) { ?>
                        <?php echo CHtml::link(Yii::t("base", 'Become Expert'), array('/registration'), array('class' => 'angle')); ?>
                    <?php } ?>
                </div>
            </div>

            <?php if (!Yii::app()->user->isGuest) { ?>
                <div class="col-sm-3">
                    <ul class="contacts">
                        <?php if(!empty($user->address)) { ?>
                            <li class="fadeIn">
                                <i class="fa fa-map-marker"></i>
                                <span><?php echo $user->address; ?></span>
                            </li>
                        <?php } ?>
                        <?php if(!empty($user->phone)) { ?>
                            <li class="fadeIn">
                                <i class="fa fa-phone"></i>
                                <span><?php echo $user->phone; ?></span>
                            </li>
                        <?php } ?>
                        <?php if(!empty($user->xing_url)) { ?>
                            <li class="fadeIn">
                                <i class="fa fa-xing"></i>
                                <a href="<?php echo $user->xing_url; ?>"><?php echo $user->fullname;?></a>
                            </li>
                        <?php } ?>
                        <?php if(!empty($user->facebook_url)) { ?>
                            <li class="fadeIn">
                                <i class="fa fa-facebook"></i>
                                <a href="<?php echo $user->facebook_url; ?>">Facebook</a>
                            </li>
                        <?php } ?>
                        <?php if(!empty($user->twitter_url)) { ?>
                            <li class="fadeIn">
                                <i class="fa fa-twitter"></i>
                                <a href="<?php echo $user->twitter_url; ?>">Twitter</a>
                            </li>
                        <?php } ?>
                    </ul>
                    <button id="loadMore" class="contacts-button">Show More</button>
                    <button id="hideMore" class="contacts-button">Show Less</button>
                </div>
            <?php } ?>
        </div>
    </div>
</section>
<?php $this->widget('RatingDescription', array('user' => $user)); ?>
<?php $this->widget('Reportpop', array('receiver' => $user->id)); ?>
<?php Yii::app()->clientScript->registerScript('username',"
        username = '$user->username'
"); ?>
