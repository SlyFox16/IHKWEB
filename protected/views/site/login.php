<section class="separated register">
    <div class="container relative">

        <!--== Breadcrumbs ==-->
        <?php
        $this->widget('Breadcrumbs', array(
            'links' => array(
                Yii::t("base", 'Login')
            ),
        ));
        ?>

        <div class="row">
            <div class="col-md-3">
                <h2>
                    <b>Login</b> with your email.
                </h2>
            </div>
            <div class="col-md-5 separator">
                <?php $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'login-form',
                    'enableAjaxValidation' => true,
                    'clientOptions' => array(
                        'validateOnSubmit' => true,
                        'validateOnChange' => false
                    ),
                )); ?>
                <!-- START Form Control-->
                <fieldset <?php echo $model->requiredClass('email'); ?>>
                    <?php echo $form->label($model, 'email'); ?>
                    <?php echo $form->textField($model, 'email'); ?>
                    <?php echo $form->error($model, 'email'); ?>
                </fieldset>

                <fieldset <?php echo $model->requiredClass('email'); ?>>
                    <?php echo $form->label($model, 'password'); ?>
                    <?php echo $form->passwordField($model, 'password'); ?>
                    <?php echo $form->error($model, 'password'); ?>
                </fieldset>

                    <?php echo $form->checkBox($model, 'rememberMe'); ?>
                    <?php echo $form->labelEx($model, 'rememberMe', array('for' => 'checkbox1')); ?>

                <br />
                <a href="#" class="text-info small forgetpass">Забыли пароль?</a>
                <!-- END Form Control-->
                <button class="button">Login</button>
                <?php $this->endWidget(); ?>
            </div>
            <div class="col-md-4">
                <div class="social-login">
                    <h2>
                        Use already existing
                        <b>social</b> account to<br>
                        <b>log in</b>
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