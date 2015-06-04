<div class="row page_margin_top">
    <div class="column column_1_1">
        <div class="horizontal_carousel_container small">
            <ul class="blog horizontal_carousel autoplay-1 scroll-1 visible-3 navigation-1 easing-easeInOutQuint duration-750">
                <?php foreach($slides as $slide) : ?>
                    <li class="post">
                        <a href="<?php echo Yii::app()->createUrl('album/view', array('id' => 1)) ?>" title="<?php echo $slide->title; ?>">
                            <?php echo CHtml::image(Yii::app()->iwi->load($slide->path)->adaptive(330,121)->cache(), $slide->title); ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>