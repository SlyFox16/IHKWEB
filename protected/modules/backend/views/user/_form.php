<?php $form = $this->beginWidget('backend.components.ActiveForm', array(
    'id' => 'user-form',
    'enableAjaxValidation' => false,
    'type'=>'horizontal',
    'htmlOptions'=>array("enctype"=>"multipart/form-data"),
)); ?>

<?php echo $model->requiredAlert(); ?>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldRow($model, 'username', array('class' => 'span5', 'maxlength' => 255)); ?>

<?php echo $form->textFieldRow($model, 'name', array('class' => 'span5', 'maxlength' => 255)); ?>

<?php echo $form->textFieldRow($model, 'surname', array('class' => 'span5', 'maxlength' => 255)); ?>

<?php echo $form->textFieldRow($model, 'email', array('class' => 'span5', 'maxlength' => 255)); ?>

<?php if($model->isNewRecord) : ?>
    <?php echo $form->passwordFieldRow($model,'password',array('class'=>'span5','maxlength'=>64)); ?>
    <?php echo $form->passwordFieldRow($model,'password_repeat',array('class'=>'span5','maxlength'=>64)); ?>
<?php endif; ?>

<?php echo $form->fileFieldRow($model,'avatar',array('class'=>'span5','maxlength'=>255,'hint'=>'The recommended size is <b>240x120</b>')); ?>

<?php echo $form->checkBoxRow($model, 'is_active'); ?>

<?php echo $form->checkBoxRow($model, 'expert_confirm'); ?>

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array(
    'buttonType' => 'submit',
    'type' => 'primary',
    'label' => $model->isNewRecord ? 'Create' : 'Save',
)); ?>
<?php $this->endWidget(); ?>