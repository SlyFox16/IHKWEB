<!--===============================-->
<!--== Popup ======================-->
<!--===============================-->
<div class="reveal" id="report" data-reveal data-close-on-click="true" data-animation-in="slide-in-down" data-animation-out="slide-out-up">
    <button class="close-button" data-close aria-label="Close reveal" type="button">
        <span aria-hidden="true">&times;</span>
    </button>
    <h1><?php echo Yii::t("base", "Report"); ?></h1>
    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'report-form',
        'action' => array('user/report'),
        'enableAjaxValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
            'validateOnChange' => true
        ),
    )); ?>
        <label>
            <span><?php echo $model->getAttributeLabel('text'); ?></span>
            <?php echo $form->textArea($model, 'text', array('rows' => 5, 'cols' => 30)); ?>
        </label>
        <?php echo $form->error($model, 'text'); ?>
        <?php echo $form->hiddenField($model, 'receiver'); ?>
    <?php $this->endWidget(); ?>
    <button class="button"><?php echo Yii::t("base", "Send report"); ?></button>
</div>