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
                <fieldset>
                    <ul class="fields">
                        <li <?php echo $model->requiredClass('email'); ?>>
                            <div class="field-content">
                                <div><?php echo $form->label($model, 'email'); ?></div>
                                <div><?php echo $form->textField($model, 'email'); ?></div>
                            </div>
                            <?php echo $form->error($model, 'email'); ?>
                        </li>
                        <li <?php echo $model->requiredClass('password'); ?>>
                            <div class="field-content">
                                <div><?php echo $form->label($model, 'password'); ?></div>
                                <div><?php echo $form->passwordField($model, 'password'); ?></div>
                            </div>
                            <?php echo $form->error($model, 'password'); ?>
                        </li>
                    </ul>
                </fieldset>
                <!-- END Form Control-->
                <button class="button">Login</button>
                <?php $this->endWidget(); ?>
            </div>
            <div class="col-md-4">
                <div class="social-login">
                    <h2>
                       Login with <b>social account</b>
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