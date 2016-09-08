<!--===============================-->
<!--== Cabinet ====================-->
<!--===============================-->

<!-- Breadcrumbs -->
<div class="row">
    <div class="small-12 medium-6 columns">
        <?php $this->widget('Breadcrumbs', array(
            'links' => array(
                Yii::t("base", 'Feedback')
            ),
        )); ?>
    </div>
</div>

<section class="separated separated--edge">
    <div class="row">
        <div class="medium-4 large-3 columns">
            <h2><?php echo Yii::t("base", "[b]Get in touch[/b] with us.", array('[b]' => '<b>', '[/b]' => '</b>')); ?></h2>
        </div>
        <div class="medium-8 large-5 columns separator right-50">
            <?php $form = $this->beginWidget('CActiveForm', array(
                'id' => 'feedback-form',
                'enableAjaxValidation' => true,
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                    'validateOnChange' => true,
                ),
            )); ?>
                <div class="row">
                    <div class="small-12 columns">
                        <label>
                            <span><?php echo $model->getAttributeLabel('name'); ?></span>
                            <?php echo $form->textField($model, 'name'); ?>
                        </label>
                        <?php echo $form->error($model, 'name'); ?>
                        <label>
                            <span><?php echo $model->getAttributeLabel('email'); ?></span>
                            <?php echo $form->textField($model, 'email'); ?>
                        </label>
                        <?php echo $form->error($model, 'email'); ?>
                        <label>
                            <span><?php echo $model->getAttributeLabel('feedback'); ?></span>
                            <?php echo $form->textArea($model, 'feedback', array('cols' => 30, 'rows' => 5)); ?>
                        </label>
                        <?php echo $form->error($model, 'feedback'); ?>
                    </div>
                </div>
                <div class="row bottom-edge">
                    <div class="small-12 columns">
                        <?php echo CHtml::linkButton(Yii::t("base", 'Send Feedback'), array('class' => 'button large')); ?>
                    </div>
                </div>
            <?php $this->endWidget(); ?>
        </div>
        <div class="medium-8 medium-offset-4 large-4 columns left-50">
            <h2><?php echo Yii::t("base", "[b]Follow us[/b] on the web", array('[b]' => '<b>', '[/b]' => '</b>')); ?></h2>
            <?php $this->widget('Social'); ?>
        </div>
    </div>
</section>