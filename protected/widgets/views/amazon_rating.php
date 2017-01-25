<div class="poll-results">
    <table cellspacing="0" cellpadding="0">
        <tbody>
            <?php foreach ($ratings as $num => $count) { ?>
                <tr>
                    <td colspan="2" class="page_poll_text"><?php echo Yii::t('base', '{n} star|{n} stars', $num); ?></td>
                    <td>
                        <?php echo CHtml::tag('div', array('id' => 'stars_' . $num, 'class' => 'rating'));
                        Yii::app()->clientScript->registerScript("stars_$num", "
                        $('#stars_" . $num . "').raty({readOnly: true, score: " . $num . "});
                        ", CClientScript::POS_READY); ?>
                    </td>
                    <td class="page_poll_row_percent ta_r"><nobr><b><?php echo $count; ?></b></nobr></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
