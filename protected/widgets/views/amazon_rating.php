<li><?php echo Yii::t("base", "Rating");?></li>
<div class="summary">
    <ul>
        <?php foreach ($ratings as $num => $count) { ?>
        <li>
            <div class="summary-stars">
                <div id="stars_<?php echo $num; ?>"></div>
                <?php Yii::app()->clientScript->registerScript("stars_$num", "
                $('#stars_" . $num . "').raty({readOnly: true, score: " . $num . "});
                ", CClientScript::POS_READY); ?>
            </div>
            <div class="summary-ammount">
                <?php echo $count; ?>
            </div>
        </li>
        <?php } ?>
    </ul>
</div>
