<!--===============================-->
<!--== Popup ======================-->
<!--===============================-->
<div class="reveal" id="ratingDescription" data-reveal data-close-on-click="true" data-animation-in="slide-in-down" data-animation-out="slide-out-up">
    <button class="close-button" data-close aria-label="Close reveal" type="button">
        <span aria-hidden="true">&times;</span>
    </button>
    <h1><?php echo Yii::t("base", "Restore password"); ?></h1>
    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'rating-description',
        'action' => array('user/ratingDescr', 'id' => $user->id),
        'enableAjaxValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
            'validateOnChange' => true
        ),
    )); ?>
        <label>
            <span><?php echo $user->getAttributeLabel('description'); ?></span>
            <?php echo $form->textArea($user, 'description'); ?>
        </label>
        <?php echo $form->error($model, 'description'); ?>
    <?php $this->endWidget(); ?>
    <button class="button"><?php echo Yii::t("base", "Send report"); ?></button>
</div>