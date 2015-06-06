<section class="separated">
    <div class="container relative">

        <!--== Breadcrumbs ==-->
        <ul class="breadcrumbs">
            <li><a href="">Home</a></li>
            <li><a href="">Experts</a></li>
            <li>John Doe</li>
        </ul>

        <!--== Page Control ==-->
        <ul class="page-control wow bounceInRight" data-wow-duration="0.5s" data-wow-delay="0.5s">
            <li>
                <div class="rating">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star-o"></i>
                </div>
            </li>
            <li>
                <a href=""><i class="fa fa-flag"></i></a>
            </li>
            <li>
                <a href=""><i class="fa fa-share"></i></a>
            </li>
        </ul>
        <div class="row">
            <div class="col-sm-3">
                <img src="<?php echo Yii::app()->iwi->load($user->UAvatar)->adaptive(280, 280)->cache(); ?>" alt="<?php echo $user->fullname;?>">
            </div>
            <div class="col-sm-6 col-xs-9">
                <h2 class="expert-name"><b><?php echo $user->name; ?></b> <?php echo $user->surname; ?></h2>
                <?php echo $user->uDescription; ?>
            </div>
            <div class="col-sm-3 col-xs-3 text-right">
                <ul class="stats">
                    <li>
                        Rating <b>4.2</b>
                    </li>
                    <li>
                        Level <b>1</b>
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
                <ul class="certification">
                    <li>
                        <div class="certification-title">
                            <h3>IHK Certified</h3>
                            <span>04 february 2015</span>
                        </div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                            sed do eiusmod tempor incididunt ut labore et dolore
                            magna aliqua</p>
                    </li>
                    <li>
                        <div class="certification-title">
                            <h3>CM Certified</h3>
                            <span>14 january 2015</span>
                        </div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                            sed do eiusmod tempor incididunt ut labore et dolore
                            magna aliqua</p>
                    </li>
                </ul>
                <div class="cta bottom-30">
                    <a href="" class="button">Find Experts <i class="fa fa-search"></i></a>
                    <?php echo CHtml::link(Yii::t("base", 'Become Expert'), array('/registration'), array('class' => 'angle')); ?>
                </div>
            </div>
            <div class="col-sm-3">
                <ul class="contacts">
                    <li class="wow fadeIn" data-wow-duration="1s" data-wow-delay="0.5s">
                        <i class="fa fa-map-marker"></i>
                        <span><?php echo $user->uAddress; ?></span>
                    </li>
                    <li class="wow fadeIn" data-wow-duration="1s" data-wow-delay="0.7s">
                        <i class="fa fa-phone"></i>
                        <span><?php echo $user->uPhone; ?></span>
                    </li>
                    <li class="wow fadeIn" data-wow-duration="1s" data-wow-delay="0.9s">
                        <i class="fa fa-xing"></i>
                        <a href=""><?php echo $user->uXing_url; ?></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>