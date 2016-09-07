<?php if($this->open) {
    $url = array("user/updateMailPassword");
} else {
    $url = array("user/updatePassword");
}
?>

<!--===============================-->
<!--== Popup ======================-->
<!--===============================-->
<div class="reveal" id="passchange" data-reveal data-close-on-click="true" data-animation-in="slide-in-down" data-animation-out="slide-out-up">
    <button class="close-button" data-close aria-label="Close reveal" type="button">
        <span aria-hidden="true">&times;</span>
    </button>
    <h1><?php echo Yii::t("base", "Change pass"); ?></h1>
    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'changepass-form',
        'action' => $url,
        'enableAjaxValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
            'validateOnChange' => false
        ),
    )); ?>
        <label>
            <span><?php echo $model->getAttributeLabel('password'); ?></span>
            <?php echo $form->passwordField($model, 'password'); ?>
        </label>
        <?php echo $form->error($model, 'password'); ?>

        <label>
            <span><?php echo $model->getAttributeLabel('password_repeat'); ?></span>
            <?php echo $form->passwordField($model, 'password_repeat'); ?>
        </label>
        <?php echo $form->error($model, 'password_repeat'); ?>
        <button class="button"><?php echo Yii::t("base", "Change pass"); ?></button>
    <?php $this->endWidget(); ?>
</div>

<?php if($this->open) {
    Yii::app()->clientScript->registerScript('popoverActivate',"$('#passchange').foundation('open');");
} ?>