<section class="separated register">
    <div class="container relative">

        <!--== Breadcrumbs ==-->
        <?php
        $this->widget('Breadcrumbs', array(
            'links' => array(
                Yii::t("base", 'Feedback')
            ),
        ));
        ?>

        <div class="row">
            <div class="col-md-3">
                <h2>
                    <b>Get in touch </b> with us.
                </h2>
            </div>
            <div class="col-md-5 separator">
                <?php $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'feedback-form',
                    'enableAjaxValidation' => true,
                    'clientOptions' => array(
                        'validateOnSubmit' => true,
                        'validateOnChange' => false,
                        'inputContainer' => 'fieldset',
                    ),
                )); ?>
                <fieldset <?php echo $model->requiredClass('name'); ?>>
                    <?php echo $form->label($model, 'name'); ?>
                    <?php echo $form->textField($model, 'name'); ?>
                    <?php echo $form->error($model, 'name'); ?>
                </fieldset>
                <fieldset <?php echo $model->requiredClass('email'); ?>>
                    <?php echo $form->label($model, 'email'); ?>
                    <?php echo $form->textField($model, 'email'); ?>
                    <?php echo $form->error($model, 'email'); ?>
                </fieldset>
                <fieldset <?php echo $model->requiredClass('feedback'); ?>>
                    <?php echo $form->label($model, 'feedback'); ?>
                    <?php echo $form->textArea($model, 'feedback'); ?>
                    <?php echo $form->error($model, 'feedback'); ?>
                </fieldset>
                <button class="button">Send feedback</button>
                <?php $this->endWidget(); ?>
            </div>
            <div class="col-md-4">
                <div class="social-login">
                    <h2>
                        <b>Follow us</b> on the web
                    </h2>
                    <?php $this->widget('Social'); ?>
                </div>
            </div>
        </div>
    </div>
</section>