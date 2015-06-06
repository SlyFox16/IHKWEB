<?php $form = new CActiveForm();
$form->enableAjaxValidation = true;
$form->clientOptions = array(
    'validateOnSubmit' => true,
    'validateOnChange' => false);
?>

<?php echo $form->labelEx($model, $attribute, array('class' => 'col-sm-3 control-label')); ?>
<div class="col-sm-9">
    <div class="file-preview-frame">
        <?php echo CHtml::image('/'.$model->$attribute, "form image"); ?>
    </div>
    <?php echo $form->fileField($model, $attribute,array('class'=>'span5','maxlength'=>255)); ?>
    <?php echo $form->error($model, $attribute); ?>
</div>

<style>
    .file-preview-frame img {height: 100px; margin-bottom: 20px;}
</style>