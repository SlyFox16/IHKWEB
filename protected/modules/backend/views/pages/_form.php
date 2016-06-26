<?php $form=$this->beginWidget('backend.components.ActiveForm',array(
	'id'=>'pages-form',
	'enableAjaxValidation'=>false,
	'type'=>'horizontal',
)); ?>

    <?php echo $model->requiredAlert(); ?>	<?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldRow($model,'title',array('class'=>'span5','maxlength'=>255)); ?>

    <?php echo $form->tinyMceRow($model,'content',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
