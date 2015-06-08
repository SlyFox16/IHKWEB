<!--===============================-->
<!--== Experts ====================-->
<!--===============================-->
<section class="clearfix">
    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quaerat harum, magni quas ipsam a voluptas repudiandae nihil, ducimus corporis et fugiat tempore cumque itaque! Saepe alias eaque soluta, atque totam.
    <?php $this->widget('Search'); ?>
    <div class="expert">
        <img src="<?php echo $this->getAssetsUrl(); ?>/images/experts/01.jpg" alt="Expert">
        <div class="expert-info">
            <h3><b>John</b> Doe</h3>
            <ul class="expert-certification">
                <li>IHK</li>
                <li>CM</li>
            </ul>
            <span class="expert-level">Level 1</span>
        </div>
    </div>
    <div class="expert">
        <img src="<?php echo $this->getAssetsUrl(); ?>/images/experts/02.jpg" alt="Expert">
        <div class="expert-info">
            <h3><b>John</b> Doe</h3>
            <ul class="expert-certification">
                <li>IHK</li>
                <li>CM</li>
            </ul>
            <span class="expert-level">Level 1</span>
        </div>
    </div>
    <div class="expert">
        <img src="<?php echo $this->getAssetsUrl(); ?>/images/experts/03.jpg" alt="Expert">
        <div class="expert-info">
            <h3><b>John</b> Doe</h3>
            <ul class="expert-certification">
                <li>IHK</li>
                <li>CM</li>
            </ul>
            <span class="expert-level">Level 1</span>
        </div>
    </div>
    <div class="expert">
        <img src="<?php echo $this->getAssetsUrl(); ?>/images/experts/04.jpg" alt="Expert">
        <div class="expert-info">
            <h3><b>John</b> Doe</h3>
            <ul class="expert-certification">
                <li>IHK</li>
                <li>CM</li>
            </ul>
            <span class="expert-level">Level 1</span>
        </div>
    </div>
    <div class="expert">
        <img src="<?php echo $this->getAssetsUrl(); ?>/images/experts/02.jpg" alt="Expert">
        <div class="expert-info">
            <h3><b>John</b> Doe</h3>
            <ul class="expert-certification">
                <li>IHK</li>
                <li>CM</li>
            </ul>
            <span class="expert-level">Level 1</span>
        </div>
    </div>
    <div class="expert">
        <img src="<?php echo $this->getAssetsUrl(); ?>/images/experts/04.jpg" alt="Expert">
        <div class="expert-info">
            <h3><b>John</b> Doe</h3>
            <ul class="expert-certification">
                <li>IHK</li>
                <li>CM</li>
            </ul>
            <span class="expert-level">Level 1</span>
        </div>
    </div>
    <div class="expert">
        <img src="<?php echo $this->getAssetsUrl(); ?>/images/experts/01.jpg" alt="Expert">
        <div class="expert-info">
            <h3><b>John</b> Doe</h3>
            <ul class="expert-certification">
                <li>IHK</li>
                <li>CM</li>
            </ul>
            <span class="expert-level">Level 1</span>
        </div>
    </div>
    <div class="expert">
        <img src="<?php echo $this->getAssetsUrl(); ?>/images/experts/03.jpg" alt="Expert">
        <div class="expert-info">
            <h3><b>John</b> Doe</h3>
            <ul class="expert-certification">
                <li>IHK</li>
                <li>CM</li>
            </ul>
            <span class="expert-level">Level 1</span>
        </div>
    </div>
    <div class="expert">
        <img src="<?php echo $this->getAssetsUrl(); ?>/images/experts/02.jpg" alt="Expert">
        <div class="expert-info">
            <h3><b>John</b> Doe</h3>
            <ul class="expert-certification">
                <li>IHK</li>
                <li>CM</li>
            </ul>
            <span class="expert-level">Level 1</span>
        </div>
    </div>
    <div class="expert">
        <img src="<?php echo $this->getAssetsUrl(); ?>/images/experts/01.jpg" alt="Expert">
        <div class="expert-info">
            <h3><b>John</b> Doe</h3>
            <ul class="expert-certification">
                <li>IHK</li>
                <li>CM</li>
            </ul>
            <span class="expert-level">Level 1</span>
        </div>
    </div>
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
                    Get your crowd project done right and in time. <a href="" class="angle">Find experts</a>
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
                <a href="" class="button">Find Experts <i class="fa fa-search"></i></a>
                <?php echo CHtml::link(Yii::t("base", 'Become Expert'), array('/registration')); ?>
            </div>
        </div>
    </div>
</section>


<!--===============================-->
<!--== Footer =====================-->
<!--===============================-->