<section class="separated register">
    <div class="container relative">

        <!--== Breadcrumbs ==-->
        <?php
        $this->widget('Breadcrumbs', array(
            'links' => array(
                Yii::t("base", 'Register')
            ),
        ));
        ?>

        <div class="row">
            <div class="col-md-3">
                <h2>
                    Join our program, <b>register</b> and become a certified expert.
                </h2>
            </div>
            <div class="col-md-5 separator">
                <?php $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'seeker-form',
                    'enableAjaxValidation' => true,
                    'clientOptions' => array(
                        'validateOnSubmit' => true,
                        'validateOnChange' => false,
                        'inputContainer' => 'fieldset',
                    ),
                )); ?>
                    <fieldset>
                        <ul class="fields">
                            <li <?php echo $register_form->requiredClass('name'); ?>>
                                <div class="field-content">
                                    <div><?php echo $form->label($register_form, 'name'); ?></div>
                                    <div><?php echo $form->textField($register_form, 'name'); ?></div>
                                </div>
                                <?php echo $form->error($register_form, 'name'); ?>
                            </li>
                            <li <?php echo $register_form->requiredClass('surname'); ?>>
                                <div class="field-content">
                                    <div><?php echo $form->label($register_form, 'surname'); ?></div>
                                    <div><?php echo $form->textField($register_form, 'surname'); ?></div>
                                </div>
                                <?php echo $form->error($register_form, 'surname'); ?>
                            </li>
                            <li <?php echo $register_form->requiredClass('email'); ?>>
                                <div class="field-content">
                                    <div><?php echo $form->label($register_form, 'email'); ?></div>
                                    <div><?php echo $form->textField($register_form, 'email'); ?></div>
                                </div>
                                <?php echo $form->error($register_form, 'email'); ?>
                            </li>
                        </ul>
                    </fieldset>

                    <fieldset>
                        <legend><span>Password</span></legend>
                        <ul class="fields">
                            <li <?php echo $register_form->requiredClass('password'); ?>>
                                <div class="field-content">
                                    <div><?php echo $form->label($register_form, 'password'); ?></div>
                                    <div><?php echo $form->passwordField($register_form, 'password', array('class' => "form-control", 'placeholder' => Yii::t("base", "Min 5 characters"))); ?></div>
                                </div>
                                <?php echo $form->error($register_form, 'password', array('inputContainer' => 'fieldset')); ?>
                            </li>
                            <li <?php echo $register_form->requiredClass('password_repeat'); ?>>
                                <div class="field-content">
                                    <div><?php echo $form->label($register_form, 'password_repeat'); ?></div>
                                    <div><?php echo $form->passwordField($register_form, 'password_repeat', array('class' => "form-control")); ?></div>
                                </div>
                                <?php echo $form->error($register_form, 'password_repeat', array('inputContainer' => 'fieldset')); ?>
                            </li>
                        </ul>
                    </fieldset>
                    <button class="button" type="submit">Register</button>
                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
</section>