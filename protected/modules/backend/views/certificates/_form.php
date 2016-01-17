<?php $form=$this->beginWidget('backend.components.ActiveForm',array(
	'id'=>'certificates-form',
	'enableAjaxValidation'=>false,
	'type'=>'horizontal',
    'htmlOptions'=>array("enctype"=>"multipart/form-data"),
)); ?>

    <?php echo $model->requiredAlert(); ?>	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>255)); ?>

    <?php echo $form->textFieldRow($model,'points',array('class'=>'span5','maxlength'=>255)); ?>

    <?php echo $form->fileFieldRow($model,'logo',array('class'=>'span5','maxlength'=>255,'hint'=>'The recommended size is <b>240x120</b>')); ?>

    <?php echo $form->tinyMceRow($model,'description',array('rows'=>6,'cols'=>50,'class'=>'span8')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
