<div class="row page_margin_top_section">
    <h4 class="box_header"><?php echo Yii::t("base", "Близжайшие события"); ?></h4>
    <ul class="blog small">
        <?php foreach($events as $event) { ?>
            <li class="post">
                <a href="<?php echo Yii::app()->createUrl('article/view', array('id' => $event->id)); ?>" title="Engaging Oppurtunities and Top Benefits">
                    <?php echo CHtml::image(Yii::app()->iwi->load($event->eventImage)->adaptive(100, 100)->cache(), $event->title); ?>
                </a>
                <div class="post_content">
                    <h5>
                        <a href="<?php echo Yii::app()->createUrl('article/view', array('id' => $event->id)); ?>" title="Engaging Oppurtunities and Top Benefits"><?php echo $event->title; ?></a>
                    </h5>
                    <p><?php echo $event->preview.' '.$event->id; ?></p>
                </div>
            </li>
        <?php } ?>
    </ul>
</div>