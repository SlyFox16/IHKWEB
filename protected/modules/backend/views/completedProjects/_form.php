<?php $form=$this->beginWidget('backend.components.ActiveForm',array(
	'id'=>'completed-projects-form',
	'enableAjaxValidation'=>false,
	'type'=>'horizontal',
)); ?>

    <?php echo $model->requiredAlert(); ?>	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>255)); ?>

    <?php echo $form->tinyMceRow($model,'description',array('rows'=>6,'cols'=>50,'class'=>'span8')); ?>

    <?php echo $form->dateFieldRow($model, 'date', 'dd/mm/yyyy', array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'link',array('class'=>'span5','maxlength'=>255)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
