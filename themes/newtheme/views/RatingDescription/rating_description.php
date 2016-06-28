<!--===============================-->
<!--== Popup ======================-->
<!--===============================-->
<div class="reveal" id="ratingDescription" data-reveal data-close-on-click="true" data-animation-in="slide-in-down" data-animation-out="slide-out-up">
    <button class="close-button" data-close aria-label="Close reveal" type="button">
        <span aria-hidden="true">&times;</span>
    </button>
    <h1><?php echo Yii::t("base", "Work description"); ?></h1>
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
            <span><?php echo $model->getAttributeLabel('description'); ?></span>
            <?php echo $form->textArea($model, 'description', array('cols' => 30, 'rows' => 5)); ?>
        </label>
        <?php echo $form->error($model, 'description'); ?>
        <button class="button"><?php echo Yii::t("base", "Send report"); ?></button>
    <?php $this->endWidget(); ?>
</div>