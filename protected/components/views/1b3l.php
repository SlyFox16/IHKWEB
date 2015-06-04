<div class="row page_margin_top_section_smaller">
    <h4 class="box_header"><?php echo $articleCategory->name; ?></h4>
    <div class="row">
        <?php $i = 0; foreach($articleCategory->articles(array('limit' => 1)) as $article) { $i++; ?>
            <?php if($i == 1) { ?>
                <ul class="blog column column_1_2">
                    <li class="post">
                        <?php $image = CHtml::image(Yii::app()->iwi->load($article->image)->adaptive(330, 242)->cache(), $article->title); ?>
                        <?php echo CHtml::link($image, Yii::app()->createUrl('article/view', array('id' => $article->id))); ?>
                        <h2 class="with_number">
                            <?php echo CHtml::link($article->title, Yii::app()->createUrl('article/view', array('id' => $article->id))); ?>
                        </h2>
                        <ul class="post_details"></ul>
                        <p><?php echo $article->preview; ?></p>
                        <?php echo CHtml::link('<span class="arrow"></span><span>'. Yii::t("base", 'ЧИТАТЬ ДАЛЕЕ').'</span>', Yii::app()->createUrl('article/view', array('id' => $article->id)), array('class' => 'read_more')); ?>
                    </li>
                </ul>
            <?php } ?>
        <?php } ?>

        <div class="column column_1_2">
            <ul class="blog small clearfix">
                <?php foreach($articleCategory->articles(array('limit' => 3, 'offset' => 1)) as $article) { ?>
                    <li class="post">
                        <?php $image = CHtml::image(Yii::app()->iwi->load($article->image)->adaptive(100, 100)->cache(), $article->title); ?>
                        <?php echo CHtml::link($image, Yii::app()->createUrl('article/view', array('id' => $article->id))); ?>
                        <div class="post_content">
                            <h5>
                                <?php echo CHtml::link($article->title, Yii::app()->createUrl('article/view', array('id' => $article->id))); ?>
                            </h5>
                            <ul class="post_details simple">
                                <li class="date">
                                    <?php echo Yii::app()->format->sliderDate($article->created); ?>
                                </li>
                            </ul>
                        </div>
                    </li>
                <?php } ?>
            </ul>
            <?php /*echo CHtml::link(Yii::t("base", 'Перейти в категорию'), Yii::app()->createUrl('article/category', array('id' => $articleCategory->id)), array('class' => 'more page_margin_top')); */?>
        </div>
    </div>
</div>