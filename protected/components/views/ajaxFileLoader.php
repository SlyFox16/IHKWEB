<?php $attributeClean = preg_replace('~^\[[0-9]+\]~', '', $attribute); ?>

<div class="field-content">
    <div><?php echo $form->labelEx($model, $attributeClean, array('class' => 'control-label')); ?></div>
    <div><?php echo $form->fileField($model, $attribute,array('class'=>'span5','maxlength'=>255)); ?></div>
    <div><?php echo $form->error($model, $attribute); ?></div>
</div>

    <!--<div class="file-preview-frame">
        <?php /*if(!empty($model->$attributeClean))
            if($attributeClean == 'vcf')
                echo CHtml::image(Yii::app()->controller->assetsUrl.'/images/vc-ard.png', "form image");
            else
                echo CHtml::image('/'.$model->$attributeClean, "form image");
        */?>
    </div>-->