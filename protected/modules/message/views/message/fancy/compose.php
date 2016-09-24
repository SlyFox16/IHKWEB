<?php $this->pageTitle=Yii::app()->name . ' - '.MessageModule::t("Compose Message"); ?>
<?php
	$this->breadcrumbs=array(
		MessageModule::t("Messages"),
		MessageModule::t("Compose"),
	);
?>

<?php $this->renderPartial(Yii::app()->getModule('message')->viewPath . '/_styles') ?>
<?php $this->renderPartial(Yii::app()->getModule('message')->viewPath . '/_flash') ?>

<div class="row">
<?php $this->renderPartial(Yii::app()->getModule('message')->viewPath . '/_navigation'); ?>
	<div class="span13">
		<h2><?php echo MessageModule::t('Compose New Message'); ?></h2>

		<div class="form">
			<?php $form = $this->beginWidget('CActiveForm', array(
				'id'=>'message-form',
				'enableAjaxValidation'=>false,
			)); ?>

			<p class="note"><?php echo MessageModule::t('Fields with <span class="required">*</span> are required.'); ?></p>

			<?php echo $form->errorSummary($model, null, null, array('class' => 'alert-message block-message error')); ?>

			<?php echo $form->labelEx($model,'receiver_id'); ?>
			<div class="input">
                <?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                    'name' => 'receiver',
                    'source'=>"js:function(request, response) {
                            $.getJSON('".Yii::app()->createUrl('site/suggest')."', {
                            term: request.term
                            }, response);
                        }",
                    'options'=>array(
                        'delay'=>300,
                        'minLength'=>2,
                        'showAnim'=>'fold',
                        'multiple'=>true,
                        'focus' => "function(event, ui) {
                            $('#receiver').val(ui.item.label);
                            return false;
                        }",
                        'select'=>"js:function(event, ui) {
                            this.value = ui.item.value;
                            $('#Message_receiver_id').val(ui.item.id);
                            return false;
                        }",
                        'open' => "function() {
                            $(this).removeClass('ui-corner-all').addClass('ui-corner-top');
                        }",
                        'close' => "function() {
                            $(this).removeClass('ui-corner-top').addClass('ui-corner-all');
                        }"
                    ),
                    'htmlOptions'=>array(
                        'size'=>'40',
                        'placeholder' => 'Search',
                        'value' => $receiverName
                    ),
                )); ?>
				<?php /*echo CHtml::textField('receiver', $receiverName) */?>
				<?php echo $form->hiddenField($model,'receiver_id'); ?>
				<?php echo $form->error($model,'receiver_id'); ?>
			</div>

			<?php echo $form->labelEx($model,'subject'); ?>
			<div class="input">
				<?php echo $form->textField($model,'subject'); ?>
				<?php echo $form->error($model,'subject'); ?>
			</div>

			<?php echo $form->labelEx($model,'body'); ?>
			<div class="input">
				<?php echo $form->textArea($model,'body'); ?>
				<?php echo $form->error($model,'body'); ?>
			</div>

			<div class="buttons">
				<button class="btn primary"><?php echo MessageModule::t("Send") ?></button>
			</div>

			<?php $this->endWidget(); ?>

		</div>
	</div>
</div>

<?php /*$this->renderPartial(Yii::app()->getModule('message')->viewPath . '/_suggest'); */?>
