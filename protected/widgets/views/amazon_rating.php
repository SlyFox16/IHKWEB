<div class="poll-results">
    <table cellspacing="0" cellpadding="0">
        <tbody>
            <?php foreach ($ratings as $num => $count) { ?>
                <tr>
                    <td colspan="2" class="page_poll_text"><?php echo Yii::t('base', '{n} star|{n} stars', $num); ?></td>
                    <td>
                        <div class="progress-div">
                            <div class="progress-bar" style="width: <?php echo round($count*100/$all, 2); ?>%" role="progressbar" aria-valuenow="<?php echo $count; ?>" aria-valuemin="0" aria-valuemax="<?php echo $all; ?>"></div>
                        </div>
                    </td>
                    <td class="page_poll_row_percent ta_r"><nobr><b><?php echo $count; ?></b></nobr></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
