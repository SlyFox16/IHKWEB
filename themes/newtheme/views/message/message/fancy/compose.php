<?php $this->title=Yii::app()->name . ' - '.MessageModule::t("Compose Message"); ?>

<!-- Breadcrumbs -->
<div class="row">
    <div class="small-12 medium-6 columns">
        <?php $this->widget('Breadcrumbs', array(
            'links' => array(
                Yii::t("base", 'Messages') => array('message/inbox'),
                MessageModule::t("Compose"),
            ),
        )); ?>
    </div>
</div>

<section class="separated separated--edge">
    <div class="row">
        <?php $this->renderPartial(Yii::app()->getModule('message')->viewPath . '/_navigation'); ?>
        <div class="medium-8 large-9 columns separator separator--left left-50">
            <?php $form = $this->beginWidget('CActiveForm', array(
                'id'=>'message-form',
                'enableAjaxValidation'=>false,
                'clientOptions' => array(
                    'beforeValidate' => 'js:function(form){$(form).find("button[type=\'submit\']").prop("disabled", true); return true;}',
                    'afterValidate' => 'js:function(form, data, hasError){$(form).find("button[type=\'submit\']").prop("disabled", false);return !hasError;}',
                ),
            )); ?>
                <div class="row">
                    <div class="small-12 columns">
                        <div class="row">
                            <div class="small-12 columns">
                                <h2><?php echo MessageModule::t('Compose New Message'); ?></h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="small-12 medium-6 columns">
                                <label>
                                    <span><?php echo $model->getAttributeLabel('receiver_id'); ?></span>
                                    <?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                                        'name' => 'receiver',
                                        'source'=>"js:function(request, response) {
                                            $.getJSON('".Yii::app()->createUrl(Yii::app()->getModule('message')->getSuggestMethod)."', {
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
                                    ),
                                    'htmlOptions'=>array(
                                        'size'=>'40',
                                        'placeholder' => 'Search',
                                        'value' => $receiverName
                                    ),
                                    )); ?>
                                    <?php echo $form->hiddenField($model,'receiver_id'); ?>
                                    <?php echo $form->error($model,'receiver_id'); ?>
                                </label>
                                <label>
                                    <span><?php echo $model->getAttributeLabel('subject'); ?></span>
                                    <?php echo $form->textField($model,'subject'); ?>
                                    <?php echo $form->error($model,'subject'); ?>
                                </label>
                                <label>
                                    <span><?php echo $model->getAttributeLabel('body'); ?></span>
                                    <?php echo $form->textArea($model,'body', array('cols' => 30, 'rows' => 10)); ?>
                                    <?php echo $form->error($model,'body'); ?>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row bottom-edge">
                    <div class="small-12 columns">
                        <div class="button-group">
                            <?php echo CHtml::linkButton(Yii::t("base", 'Send mail'), array('class' => 'button large')); ?>
                        </div>
                    </div>
                </div>
            <?php $this->endWidget(); ?>
        </div>
    </div>
</section>
