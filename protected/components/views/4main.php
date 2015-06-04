<h4 class="box_header"><?php echo $articleCategory->name; ?></h4>
<div class="row">
    <?php $i = 0; foreach($articleCategory->articles(array('limit' => 4)) as $article) { $i++; ?>
    <?php $first = $i%2 != 0 ? 'first' : ''; ?>
            <ul class="blog column column_1_2 straightLine <?php echo $first; ?>">
                <li class="post">
                    <a href="<?php echo Yii::app()->createUrl('article/view', array('id' => $article->id)); ?>">
                        <?php echo $article->article_icon(); ?>
                        <?php echo CHtml::image(Yii::app()->iwi->load($article->image)->adaptive(330, 242)->cache(), $article->title); ?>
                    </a>

                    <h2 class="with_number">
                        <?php echo CHtml::link($article->title, Yii::app()->createUrl('article/view', array('id' => $article->id))); ?>
                    </h2>
                    <ul class="post_details"></ul>
                    <p><?php echo $article->preview; ?></p>
                    <?php echo CHtml::link('<span class="arrow"></span><span>'. Yii::t("base", 'ЧИТАТЬ ДАЛЕЕ').'</span>', Yii::app()->createUrl('article/view', array('id' => $article->id)), array('class' => 'read_more')); ?>
                </li>
            </ul>
            <?php if($i%2 == 0) { ?>
                <div style="clear: both;"></div>
            <?php } ?>
    <?php } ?>
</div>