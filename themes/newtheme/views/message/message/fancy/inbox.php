<?php $this->pageTitle=Yii::app()->name . ' - '. Yii::t("base", "Messages:inbox"); ?>

<!-- Breadcrumbs -->
<div class="row">
    <div class="small-12 medium-6 columns">
        <?php $this->widget('Breadcrumbs', array(
            'links' => array(
                Yii::t("base", "Inbox"),
            ),
        )); ?>
    </div>
</div>

<section class="separated separated--edge">
    <div class="row">
        <?php $this->renderPartial(Yii::app()->getModule('message')->viewPath . '/_navigation'); ?>
        <div class="medium-8 large-9 columns separator separator--left left-50">
            <?php if ($messagesAdapter->data) { ?>
                <?php $form = $this->beginWidget('CActiveForm', array(
                    'id'=>'message-delete-form',
                    'enableAjaxValidation'=>false,
                    'action' => $this->createUrl('delete/')
                )); ?>
                    <div class="row">
                        <div class="small-12 columns">
                            <ul class="messages_list">
                                <?php foreach ($messagesAdapter->data as $index => $message) { ?>
                                    <li class="<?php echo $message->unreadInThisChat() ? 'unread' : ''; ?>">
                                        <div>
                                            <h3>
                                                <a href="<?php echo $this->createUrl('view/', array('id' => $message->chat_id)) ?>">
                                                    <?php echo $message->subject ?>
                                                </a>
                                            </h3>
                                            <span><?php echo $message->getSenderName(); ?></span>
                                        </div>
                                        <time>
                                            <span class="date">
                                                <?php echo date(Yii::app()->getModule('message')->dateFormat, strtotime($message->created_at)) ?>
                                            </span>
                                        </time>
                                        <div>
                                            <?php echo CHtml::checkBox("Message[$index][selected]"); ?>
                                            <?php echo $form->hiddenField($message,"[$index]id"); ?>
                                        </div>
                                    </li>
                                <?php } ?>
                            </ul>
                            <div class="pagination">
                                <?php $this->widget('CLinkPager', array('header' => '', 'pages' => $messagesAdapter->getPagination(), 'htmlOptions' => array('class' => 'pager'))) ?>
                            </div>
                        </div>
                    </div>
                    <div class="row bottom-edge">
                        <div class="small-12 columns">
                            <div class="button-group">
                                <?php echo CHtml::linkButton(Yii::t("base", 'Delete selected'), array('class' => 'button large')); ?>
                            </div>
                        </div>
                    </div>
                <?php $this->endWidget(); ?>
            <?php } else { ?>
                <h3><?php echo Yii::t("base", "Your inbox is empty."); ?></h3>
                <p><?php echo Yii::t("base", "Start a discussion"); ?> <a href="<?php echo $this->createUrl('compose/') ?>"><?php echo Yii::t("base", "here"); ?></a>.</p>
            <?php } ?>
        </div>
    </div>
</section>
