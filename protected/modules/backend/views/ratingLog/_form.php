<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'rating-log-form',
	'enableAjaxValidation'=>false,
	'type'=>'horizontal',
)); ?>

    <?php echo $model->requiredAlert(); ?>	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'num',array('class'=>'span5', 'disabled' => 'disabled')); ?>

	<?php echo $form->textAreaRow($model,'description',array('rows'=>6, 'cols'=>50, 'class'=>'span8', 'disabled' => 'disabled')); ?>

    <?php echo $form->checkBoxRow($model, 'confirmed'); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
