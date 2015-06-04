<div class="row page_margin_top_section_smaller">
    <h4 class="box_header"><?php echo $articleCategory->name; ?></h4>
    <div class="row">
        <?php $i = 0; foreach($articleCategory->articles(array('limit' => 2)) as $article) { $i++; ?>
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
    </div>
</div>