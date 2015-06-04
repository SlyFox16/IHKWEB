<div class="row page_margin_top_section">
    <?php foreach($categoryes as $category) { ?>
        <div class="column column_1_2">
            <h4 class="box_header"><?php echo $category->name; ?></h4>
            <ul class="blog small_margin clearfix">
                <?php foreach($category->articles(array('limit' => 1)) as $article) { ?>
                    <li class="post">
                        <?php $image = CHtml::image(Yii::app()->iwi->load($article->image)->adaptive(510, 187)->cache(), $article->title); ?>
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
            <ul class="list">
                <?php foreach($category->articles(array('limit' => 4, 'offset' => 1)) as $article) { ?>
                    <li class="bullet style_1">
                        <?php echo CHtml::link($article->title, Yii::app()->createUrl('article/view', array('id' => $article->id))); ?>
                    </li>
                <?php } ?>
            </ul>
        </div>
    <?php } ?>
</div>