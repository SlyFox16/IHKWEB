<?php $this->pageTitle=Yii::app()->name . ' - ' . Yii::t("base", "Compose Message"); ?>

<!-- Breadcrumbs -->
<div class="row">
    <div class="small-12 medium-6 columns">
        <?php $this->widget('Breadcrumbs', array(
            'links' => array(
                Yii::t("base", 'Mail') => array('/message/inbox'),
                $viewedMessage[0]->subject
            ),
        )); ?>
    </div>
</div>

<section class="separated separated--edge">
    <div class="row">
        <?php $this->renderPartial(Yii::app()->getModule('message')->viewPath . '/_navigation') ?>
        <div class="medium-8 large-9 columns separator separator--left left-50">
            <?php $form = $this->beginWidget('CActiveForm', array(
                'id'=>'message-form',
                'enableAjaxValidation'=>false,
            )); ?>
                <div class="row">
                    <div class="small-12 columns">
                        <h3><?php echo $viewedMessage[0]->subject; ?></h3>
                        <ul id="chatArea" class="messages_flow">
                            <?php foreach ($viewedMessage as $messageList) { ?>
                                <li>
                                    <div class="message_header">
                                        <span><?php echo $messageList->sender->fullname; ?></span>
                                        <time><?php echo date(Yii::app()->getModule('message')->dateFormat, strtotime($messageList->created_at)) ?></time>
                                    </div>
                                    <p><?php echo CHtml::encode($messageList->body) ?></p>
                                </li>
                            <?php } ?>
                        </ul>

                        <div class="reply">
                            <label>
                                <span><?php echo $message->getAttributeLabel('Message'); ?></span>
                                <?php echo $form->textArea($message,'body', array('cols' => '30', 'rows' => 10)); ?>
                                <?php echo $form->error($message,'body'); ?>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row bottom-edge">
                    <div class="small-12 columns">
                        <div class="button-group">
                            <?php echo CHtml::linkButton(Yii::t("base", 'Reply'), array('class' => 'button large')); ?>
                        </div>
                    </div>
                </div>
            <?php $this->endWidget(); ?>
        </div>
    </div>
</section>

<?php Yii::app()->clientScript->registerScript('toBottom',"
    var objDiv = document.getElementById('chatArea');
    objDiv.scrollTop = objDiv.scrollHeight;
", CClientScript::POS_LOAD);?>