<!--===============================-->
<!--== Experts ====================-->
<!--===============================-->
<section class="clearfix separated">
    <?php $this->widget('Search'); ?>

    <?php foreach($randUsers as $randUser) { ?>
        <div class="expert">
            <a href="<?php echo $this->createUrl('user/info', array('id' => $randUser->id)); ?>">
                <img src="<?php echo Yii::app()->iwi->load($randUser->UAvatar)->adaptive(280, 280)->cache(); ?>" alt="Expert">
            </a>
            <div class="expert-info">
                <h3>
                    <a href="<?php echo $this->createUrl('user/info', array('id' => $randUser->id)); ?>">
                        <b><?php echo $randUser->name; ?></b> <?php echo $randUser->surname; ?>
                    </a>
                </h3>
                <ul class="expert-certification">
                    <?php if(!empty($randUser->certificates)) { ?>
                        <?php foreach($randUser->certificates as $cert) { ?>
                            <li><?php echo $cert->certificate->name; ?></li>
                        <?php } ?>
                    <?php } ?>
                </ul>
                <span class="expert-level">Level 1</span>
            </div>
        </div>
    <?php } ?>
</section>


<!--===============================-->
<!--== Find Experts ===============-->
<!--===============================-->
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <h2 class="about-project">
                    Find the certified <b>Crowd Experts</b> now.
                    Get your crowd project done right and in time. <a href="<?php echo $this->createUrl('site/findexperts'); ?>" class="angle">Find experts</a>
                </h2>
            </div>
        </div>
    </div>
</section>


<!--===============================-->
<!--== Features ===================-->
<!--===============================-->
<section>
    <div class="container separated-left">
        <div class="row">
            <div class="col-sm-4">
                <div class="feature wow fadeIn" data-wow-duration="1s" data-wow-delay="0.5s">
                    <i class="fa fa-quote-left"></i>
                    <h3><?php echo yiisetting('main_footer_1', null, true); ?></h3>
                    <p><?php echo yiisetting('main_footer_1'); ?></p>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="feature wow fadeIn" data-wow-duration="1s" data-wow-delay="0.7s">
                    <i class="fa fa-map-marker"></i>
                    <h3><?php echo yiisetting('main_footer_2', null, true); ?></h3>
                    <p><?php echo yiisetting('main_footer_2'); ?></p>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="feature wow fadeIn" data-wow-duration="1s" data-wow-delay="0.9s">
                    <i class="fa fa-area-chart"></i>
                    <h3><?php echo yiisetting('main_footer_3', null, true); ?></h3>
                    <p><?php echo yiisetting('main_footer_3'); ?></p>
                </div>
            </div>
        </div>
    </div>
</section>


<!--===============================-->
<!--== Features ===================-->
<!--===============================-->
<section>
    <div class="container">
        <div class="row cta">
            <div class="col-sm-12 text-right">
                <h2>Awesome call to action headline goes here!</h2>
                <a href="<?php echo $this->createUrl('site/findexperts'); ?>" class="button">Find Experts <i class="fa fa-search"></i></a>
                <?php if(Yii::app()->user->isGuest) { ?>
                    <?php echo CHtml::link(Yii::t("base", 'Become Expert'), array('/registration'), array('class' => 'angle')); ?>
                <?php } ?>
            </div>
        </div>
    </div>
</section>

<?php if(Yii::app()->user->getFlash('xing')) {
    $this->widget('Xingpopup');
} ?>

<!--===============================-->
<!--== Footer =====================-->
<!--===============================-->