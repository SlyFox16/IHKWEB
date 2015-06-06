<section class="separated register">
    <div class="container relative">

        <!--== Breadcrumbs ==-->
        <ul class="breadcrumbs">
            <li><a href="">Home</a></li>
            <li>Register</li>
        </ul>

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
                        <?php echo $form->labelEx($register_form, 'username'); ?>
                        <?php echo $form->textField($register_form, 'username'); ?>
                        <?php echo $form->error($register_form, 'username'); ?>
                    </fieldset>
                    <fieldset>
                        <?php echo $form->labelEx($register_form, 'name'); ?>
                        <?php echo $form->textField($register_form, 'name'); ?>
                        <?php echo $form->error($register_form, 'name'); ?>
                    </fieldset>
                    <fieldset>
                        <?php echo $form->labelEx($register_form, 'surname'); ?>
                        <?php echo $form->textField($register_form, 'surname'); ?>
                        <?php echo $form->error($register_form, 'surname'); ?>
                    </fieldset>
                    <fieldset>
                        <?php echo $form->labelEx($register_form, 'email'); ?>
                        <?php echo $form->textField($register_form, 'email'); ?>
                        <?php echo $form->error($register_form, 'email'); ?>
                    </fieldset>
                    <div class="secondary">
                        <span>References</span>
                    </div>
                    <fieldset>
                        <?php echo $form->labelEx($register_form, 'password'); ?>
                        <?php echo $form->passwordField($register_form, 'password', array('class' => "form-control", 'placeholder' => Yii::t("base", "Минимум 5 символов"))); ?>
                        <?php echo $form->error($register_form, 'password', array('inputContainer' => 'fieldset')); ?>
                    </fieldset>
                    <fieldset>
                        <?php echo $form->labelEx($register_form, 'password_repeat'); ?>
                        <?php echo $form->passwordField($register_form, 'password_repeat', array('class' => "form-control")); ?>
                        <?php echo $form->error($register_form, 'password_repeat', array('inputContainer' => 'fieldset')); ?>
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