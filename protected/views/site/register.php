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
                    'id' => 'register-form',
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
<<<<<<< HEAD

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
=======
                    <fieldset <?php echo $register_form->requiredClass('email'); ?>>
                        <?php echo $form->label($register_form, 'surname'); ?>
                        <?php echo $form->textField($register_form, 'surname'); ?>
                        <?php echo $form->error($register_form, 'surname'); ?>
                    </fieldset>
                    <fieldset <?php echo $register_form->requiredClass('email'); ?>>
                        <?php echo $form->label($register_form, 'email'); ?>
                        <?php echo $form->textField($register_form, 'email'); ?>
                        <?php echo $form->error($register_form, 'email'); ?>
                    </fieldset>
                    <div class="secondary">
                        <span>References</span>
                    </div>
                    <fieldset <?php echo $register_form->requiredClass('email'); ?>>
                        <?php echo $form->label($register_form, 'password'); ?>
                        <?php echo $form->passwordField($register_form, 'password', array('class' => "form-control", 'placeholder' => Yii::t("base", "Minimum 5 characters"))); ?>
                        <?php echo $form->error($register_form, 'password', array('inputContainer' => 'fieldset')); ?>
                    </fieldset>
                    <fieldset <?php echo $register_form->requiredClass('email'); ?>>
                        <?php echo $form->label($register_form, 'password_repeat'); ?>
                        <?php echo $form->passwordField($register_form, 'password_repeat', array('class' => "form-control")); ?>
                        <?php echo $form->error($register_form, 'password_repeat', array('inputContainer' => 'fieldset')); ?>
>>>>>>> origin/master
                    </fieldset>
                    <button class="button" type="submit">Register</button>
                <?php $this->endWidget(); ?>
            </div>
            <div class="col-md-4">
                <div class="social-login">
                    <h2>
                        Use already existing
                        <b>social</b> account to<br>
                        <b>sign up</b>
                    </h2>
                    <?php  $this->widget('application.components.UloginWidget', array(
                        'params' => array(
                            'redirect' => $this->createAbsoluteUrl('site/ulogin'),
                            'logout_url' => $this->createAbsoluteUrl('site/logout'),
                        )
                    )); ?>
                </div>
            </div>
        </div>
    </div>
</section>