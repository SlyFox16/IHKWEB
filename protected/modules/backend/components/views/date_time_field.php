<div class="control-group ">
    <?php echo CHtml::activeLabelEx($model, $attribute, array('class' => 'control-label')); ?>
    <div class="controls">
        <?php echo $this->widget('DateTimePicker', array(
                'model'=>$model,
                'attribute'=>'eventDateFormat',
                'language' => 'en',
                'htmlOptions' => array(
                    'id' => 'datepicker_for_due_date',
                    'size' => '10',
                ),
                'options' => array(
                    'showOn' => 'focus',
                    'dateFormat' => $dateFormat,
                    'timeFormat' =>  $timeFormat,
                    'showOtherMonths' => true,
                    'selectOtherMonths' => true,
                    'changeMonth' => true,
                    'changeYear' => true,
                    'showButtonPanel' => true,
                    'controlType' => 'select',
                )
            ),
        true); ?>
        <span class="help-inline error"><?php echo CHtml::error($model, $attribute);?></span>
    </div>
</div>