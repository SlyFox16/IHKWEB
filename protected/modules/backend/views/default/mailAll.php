<?php
    $this->breadcrumbs=array(
        'Send Mail',
    );
?>

    <legend>Send Mail</legend>

<?php $form=$this->beginWidget('backend.components.ActiveForm',array(
    'id'=>'settings-form',
    'enableAjaxValidation'=>false,
    'type'=>'horizontal',
)); ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldRow($model,'subject',array('class'=>'span5','maxlength'=>255)); ?>

    <?php echo $form->textFieldRow($model,'sender_email',array('class'=>'span5','maxlength'=>255)); ?>

    <?php echo $form->tinyMceRow($model,'body',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

    <div class="form-actions">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'type'=>'primary',
            'label'=>'Отправить',
        )); ?>
    </div>

<?php $this->endWidget(); ?>