<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'certificates-form',
	'enableAjaxValidation'=>false,
	'type'=>'horizontal',
)); ?>

    <?php echo $model->requiredAlert(); ?>	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>255)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
