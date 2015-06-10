<?php $form = new CActiveForm();
$form->enableAjaxValidation = true;
$form->clientOptions = array(
    'validateOnSubmit' => true,
    'validateOnChange' => false);
?>

<div class="field-content">
    <div><?php echo $form->labelEx($model, $attribute, array('class' => 'control-label')); ?></div>
    <div><?php echo $form->fileField($model, $attribute,array('class'=>'span5','maxlength'=>255)); ?></div>
</div>
<?php echo $form->error($model, $attribute); ?>

    <!--<div class="file-preview-frame">
        <?php if(!empty($model->$attribute))
            if($attribute == 'vcf')
                echo CHtml::image(Yii::app()->controller->assetsUrl.'/images/vc-ard.png', "form image");
            else
                echo CHtml::image('/'.$model->$attribute, "form image");
        ?>
    </div>-->