<!--===============================-->
<!--== Popup ======================-->
<!--===============================-->
<div class="reveal" id="avatarhange" data-reveal data-close-on-click="true" data-animation-in="slide-in-down" data-animation-out="slide-out-up">
    <button class="close-button" data-close aria-label="Close reveal" type="button">
        <span aria-hidden="true">&times;</span>
    </button>
    <h1><?php echo Yii::t("base", "Change avatar"); ?></h1>
    <?php $form = $this->beginWidget('ActiveForm', array(
        'id' => 'changeavatar-form',
        'action' => '/user/avatarChange',
        'enableAjaxValidation' => false,
        'clientOptions' => array(
            'validateOnSubmit' => true,
            'validateOnChange' => false
        ),
        'htmlOptions'=>array("enctype"=>"multipart/form-data"),
    )); ?>
        <label>
            <span><?php echo $model->getAttributeLabel('avatar'); ?></span>
            <?php echo $form->FileField($model, 'avatar'); ?>
        </label>
        <?php echo $form->error($model, 'avatar'); ?>
        <?php echo CHtml::linkButton(Yii::t("base", 'Save'), array('class' => 'button large')); ?>
    <?php $this->endWidget(); ?>
</div>
