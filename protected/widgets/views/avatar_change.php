<!--===============================-->
<!--== Popup ======================-->
<!--===============================-->
<div class="reveal" id="avatarhange" data-reveal data-close-on-click="true" data-animation-in="slide-in-down" data-animation-out="slide-out-up">
    <button class="close-button" data-close aria-label="Close reveal" type="button">
        <span aria-hidden="true">&times;</span>
    </button>
    <h1><?php echo Yii::t("base", "Restore password"); ?></h1>
    <?php $form = $this->beginWidget('ActiveForm', array(
        'id' => 'changepass-form',
        'action' => '/user/avatarChange',
        'enableAjaxValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
            'validateOnChange' => false
        ),
    )); ?>
        <label>
            <span><?php echo $model->getAttributeLabel('avatar'); ?></span>
            <?php echo $form->multipleFileField($model, 'avatar'); ?>
        </label>
        <?php echo $form->error($model, 'avatar'); ?>
    <?php $this->endWidget(); ?>
</div>
