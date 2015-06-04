<div class="row page_margin_top_section">
    <?php $text = $this->video ? Yii::t("base", "В той же рубрике") : Yii::t("base", "Читайте также"); ?>
    <h4 class="box_header"><?php echo $text; ?></h4>
    <div class="horizontal_carousel_container page_margin_top">
        <ul class="blog horizontal_carousel autoplay-1 scroll-1 navigation-1 easing-easeInOutQuint duration-750">
            <?php foreach($articles as $article) { ?>
                <li class="post">
                    <a href="<?php echo Yii::app()->createUrl('article/view', array('id' => $article->id)); ?>">
                        <?php echo $article->article_icon(); ?>
                        <?php echo CHtml::image(Yii::app()->iwi->load($article->image)->adaptive(330, 242)->cache(), $article->title); ?>
                    </a>
                    <h5>
                        <?php echo CHtml::link($article->title, Yii::app()->createUrl('article/view', array('id' => $article->id))); ?>
                    </h5>
                    <ul class="post_details simple">
                        <li class="date">
                            <?php echo Yii::app()->format->sliderDate($article->created); ?>
                        </li>
                    </ul>
                </li>
            <?php } ?>
        </ul>
    </div>
</div>