<div class="summary">
    <ul>
        <?php foreach ($ratings as $num => $count) { ?>
        <li>
            <div class="summary-counter"><?php echo Yii::t('base', '{n} star|{n} stars', $num); ?></div>
            <div class="summary-stars">
                <?php echo CHtml::tag('div', array('id' => 'stars_' . $num, 'class' => 'rating'));
                Yii::app()->clientScript->registerScript("stars_$num", "
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
