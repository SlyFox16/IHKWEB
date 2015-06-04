<div class="row page_margin_top">
    <div class="column column_1_1">
        <div class="horizontal_carousel_container small">
            <ul class="blog horizontal_carousel autoplay-1 scroll-1 visible-3 navigation-1 easing-easeInOutQuint duration-750">
                <?php foreach($slides as $slide) : ?>
                <li class="post">
                    <a href="<?php echo $slide->link ?>" title="<?php echo $slide->title; ?>">
                        <?php echo CHtml::image(Yii::app()->iwi->load($slide->image)->adaptive(330,121)->cache(), $slide->title); ?>
                    </a>
                    <h5><a href="<?php echo $slide->link ?>" title="<?php echo $slide->title; ?>"><?php echo trim_text($slide->title, 38); ?></a></h5>
                    <ul class="post_details simple">
                        <!--<li class="category"><a href="category_health.html" title="HEALTH">HEALTH</a></li>-->
                        <li class="date">
                            <?php echo Yii::app()->format->sliderDate($slide->created); ?>
                        </li>
                    </ul>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>