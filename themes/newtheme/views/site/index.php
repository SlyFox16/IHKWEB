<!--===============================-->
<!--== Experts ====================-->
<!--===============================-->
<div class="row">
    <div class="small-12 medium-4 columns">
        <!-- Breadcrumbs -->
        <?php $this->widget('Breadcrumbs', array(
            'links' => array(),
        )); ?>
    </div>
    <!-- Control -->
    <?php $this->widget('SearchWidget'); ?>
</div>

<section class="separated">
    <?php foreach($randUsers as $randUser) { ?>
        <div class="expert">
            <a href="<?php echo $this->createUrl('user/info', array('id' => $randUser->id)); ?>">
                <img src="<?php echo YHelper::getImagePath($randUser->avatar, 280, 280); ?>" alt="<?php echo Yii::t("base", "Expert"); ?>">
            </a>
            <?php if(!empty($randUser->speciality)) { ?>
                <ul class="expert_cat">
                    <?php foreach($randUser->speciality as $spec) { ?>
                        <li data-tooltip aria-haspopup="true" class="left" title="<?php echo $spec->speciality; ?>"><?php echo $spec->abbr; ?></li>
                    <?php } ?>
                </ul>
            <?php } ?>
            <div class="expert_info">
                <h3><a href="<?php echo $this->createUrl('user/info', array('id' => $randUser->id)); ?>"><b><?php echo $randUser->name; ?></b> <?php echo $randUser->surname; ?></a></h3>
                <span class="expert_level"><?php echo Yii::t("base", "level"); ?> <?php echo $randUser->level; ?></span>
            </div>
        </div>
    <?php } ?>
</section>


<!--===============================-->
<!--== Find Experts ===============-->
<!--===============================-->
<section>
    <div class="row">
        <div class="small-12 medium-6 columns">
            <h2>
                <?php echo Yii::t("base", "Find the certified [b]Crowd Experts[/b] now.[br]Get your crowd project done right and in time.", array('[b]' => '<b>', '[/b]' => '</b>', '[br]' => '<br>')); ?>
                <?php if(!Yii::app()->user->isGuest) { ?>
                    <a href="<?php echo $this->createUrl('site/findexperts'); ?>" class="angle"><?php echo Yii::t("base", "Find experts"); ?></a>
                <?php } ?>
            </h2>
        </div>
    </div>
</section>


<!--===============================-->
<!--== Features ===================-->
<!--===============================-->
<section>
    <div class="row separated separated--left">
        <div class="small-12 medium-6 large-4 columns">
            <div class="feature wow fadeIn" data-wow-duration="1s" data-wow-delay="0.5s">
                <i class="fa fa-quote-left"></i>
                <h3><?php echo Yii::t("base", "How it works"); ?></h3>
                <p><?php echo Yii::t("base", "HOW IT WORKS TEXT"); ?></p>
            </div>
        </div>
        <div class="small-12 medium-6 large-4 columns">
            <div class="feature wow fadeIn" data-wow-duration="1s" data-wow-delay="0.7s">
                <i class="fa fa-map-marker"></i>
                <h3><?php echo Yii::t("base", "Why and WHERE to get CERTIFIED"); ?></h3>
                <p><?php echo Yii::t("base", "CERTIFIED TEXT"); ?></p>
            </div>
        </div>
        <div class="small-12 medium-6 large-4 columns end">
            <div class="feature wow fadeIn" data-wow-duration="1s" data-wow-delay="0.9s">
                <i class="fa fa-area-chart"></i>
                <h3><?php echo Yii::t("base", "Our work platforms"); ?></h3>
                <p><?php echo Yii::t("base", "WORK PLATFORMS TEXT"); ?></p>
            </div>
        </div>
    </div>
</section>



<!--===============================-->
<!--== CTA ========================-->
<!--===============================-->
<section>
    <div class="row">
        <div class="small-12 columns">
            <div class="cta">
                <h2><?php echo Yii::t("base", "Awesome call to action headline goes here!");?></h2>
                <?php if(!Yii::app()->user->isGuest) { ?>
                    <a href="<?php echo Yii::app()->createUrl('site/findexperts'); ?>" class="button large"><?php echo Yii::t("base", "Find Experts");?> <i class="fa fa-search"></i></a>
                <?php } ?>
                <?php if(Yii::app()->user->isGuest) { ?>
                    <?php echo CHtml::link(Yii::t("base", 'Become Expert').' <i class="fa fa-angle-right"></i>', array('/registration'), array('class' => 'button large')); ?>
                    <?php echo CHtml::link(Yii::t("base", 'Become Seeker').' <i class="fa fa-angle-right"></i>', array('site/seekerRegister'), array('class' => 'button large transparent')); ?>
                <?php } ?>
            </div>
        </div>
    </div>
</section>

<?php if(Yii::app()->user->getFlash('mail_recover')) {
    $this->widget('PassChange', array('change' => true, 'open' => true));
} ?>
