<?php $form=$this->beginWidget('backend.components.ActiveForm',array(
	'id'=>'settings-form',
	'enableAjaxValidation'=>false,
	'type'=>'horizontal',
    'htmlOptions'=>array("enctype"=>"multipart/form-data"),
)); ?>

    <?php echo $model->requiredAlert(); ?>	<?php echo $form->errorSummary($model); ?>

    <?php if(in_array($model->id, array(1,2,3,10))) { ?>
        <?php echo $form->textFieldRow($model, 'title', array('class' => 'span5', 'maxlength' => 80)); ?>
    <?php } ?>

    <?php if(in_array($model->id, array(10))) { ?>
        <?php echo $form->tinyMceRow($model,'value',array('rows'=>6, 'cols'=>50, 'class'=>'span5')); ?>
    <?php } else { ?>
        <?php echo $form->textAreaRow($model,'value',array('rows'=>6, 'cols'=>50, 'class'=>'span5')); ?>
    <?php } ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
