<!--===============================-->
<!--== Popup ======================-->
<!--===============================-->
<div class="reveal" id="passrecover" data-reveal data-close-on-click="true" data-animation-in="slide-in-down" data-animation-out="slide-out-up">
    <button class="close-button" data-close aria-label="Close reveal" type="button">
        <span aria-hidden="true">&times;</span>
    </button>
    <h1><?php echo Yii::t("base", "Restore password"); ?></h1>
    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'recover-form',
        'action' => array("user/recover"),
        'enableAjaxValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
            'validateOnChange' => false
        ),
    )); ?>
        <label>
            <span><?php echo $user->getAttributeLabel('email'); ?></span>
            <?php echo $form->textField($user, 'email'); ?>
        </label>
        <?php echo $form->error($model, 'email'); ?>
    <?php $this->endWidget(); ?>
    <button class="button"><?php echo Yii::t("base", "Reset password"); ?></button>
</div>