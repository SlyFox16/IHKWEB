<?php
/**
 * @var $model Subscriber
 * @var $attribute string
 * @var $htmlOptions array
 */
?>
<div class="control-group ">

    <?php echo CHtml::activeLabelEx($model, $attribute, array('class' => 'control-label')); ?>

    <div class="controls">
        <?php echo CHtml::activeTextField($model, $attribute, $htmlOptions); ?>
        <p class="help-block"><?php echo isset($htmlOptions['hint'])?$htmlOptions['hint']:''; ?></p>
    </div>
</div>


<script>$().ready(function () {
        $("#<?php echo CHtml::activeId($model, $attribute); ?>").daterangepicker({
            locale: {
                format: '<?php echo $dateFormat; ?>'
            }
        });
    });
</script>