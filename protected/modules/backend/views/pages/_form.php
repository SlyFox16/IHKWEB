<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'pages-form',
	'enableAjaxValidation'=>false,
	'type'=>'horizontal',
)); ?>

    <?php echo $model->requiredAlert(); ?>	<?php echo $form->errorSummary($model); ?>

    <?php $this->widget('bootstrap.widgets.TbTabsLang', array(
        'type'=>'pills',
        'htmlOptions'=>array('style'=>'font-size: 11px;'),
        'tabs'=>array(
            array('label'=>'RU', 'content'=>$form->textFieldRow($model,'title_ru',array('class'=>'span5','maxlength'=>255)), 'active'=>($model->hasErrors('title_ru'))),
            array('label'=>'RO', 'content'=>$form->textFieldRow($model,'title_ro',array('class'=>'span5','maxlength'=>255)), 'active'=>($model->hasErrors('title_ro'))),
        ),
    ));?>

    <?php $this->widget('bootstrap.widgets.TbTabsLang', array(
        'type'=>'pills',
        'htmlOptions'=>array('style'=>'font-size: 11px;'),
        'tabs'=>array(
            array('label'=>'RU', 'content'=>$form->textAreaRow($model,'content_ru',array('rows'=>6, 'cols'=>50, 'class'=>'span8')), 'active'=>($model->hasErrors('content_ru'))),
            array('label'=>'RO', 'content'=>$form->textAreaRow($model,'content_ro',array('rows'=>6, 'cols'=>50, 'class'=>'span8')), 'active'=>($model->hasErrors('content_ro'))),
        ),
    ));?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
