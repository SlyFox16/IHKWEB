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
                        'validateOnChange' => true,
                        'inputContainer' => 'fieldset',
                    ),
                )); ?>
                <fieldset>
                    <ul class="fields">
                        <li <?php echo $model->requiredClass('name'); ?>>
                            <div class="field-content">
                                <div><?php echo $form->label($model, 'name'); ?></div>
                                <div><?php echo $form->textField($model, 'name'); ?></div>
                            </div>
                            <?php echo $form->error($model, 'name'); ?>
                        </li>
                        <li <?php echo $model->requiredClass('email'); ?>>
                            <div class="field-content">
                                <div><?php echo $form->label($model, 'email'); ?></div>
                                <div><?php echo $form->textField($model, 'email'); ?></div>
                            </div>
                            <?php echo $form->error($model, 'email'); ?>
                        </li>
                        <li <?php echo $model->requiredClass('feedback'); ?>>
                            <div class="field-content">
                                <div><?php echo $form->label($model, 'feedback'); ?></div>
                                <div><?php echo $form->textArea($model, 'feedback'); ?></div>
                            </div>
                            <?php echo $form->error($model, 'feedback'); ?>
                        </li>
                    </ul>
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