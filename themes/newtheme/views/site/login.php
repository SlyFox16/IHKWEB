<!--===============================-->
<!--== Cabinet ====================-->
<!--===============================-->

<!-- Breadcrumbs -->
<div class="row">
    <div class="small-12 medium-6 columns">
        <?php $this->widget('Breadcrumbs', array(
            'links' => array(
                Yii::t("base", 'Login')
            ),
        )); ?>
    </div>
</div>

<section class="separated separated--edge">
    <div class="row">
        <div class="medium-5 large-3 columns">
            <h2><?php echo Yii::t("base", "[b]Login[/b] with your email.", array('[b]' => '<b>', '[/b]' => '</b>'));?></h2>
        </div>
        <div class="medium-7 large-5 columns separator right-50">
            <?php $form = $this->beginWidget('CActiveForm', array(
                'id' => 'login-form',
                'enableAjaxValidation' => true,
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                    'validateOnChange' => true,
                ),
            )); ?>
                <div class="row">
                    <div class="small-12 columns">
                        <label>
                            <span><?php echo $model->getAttributeLabel('email'); ?></span>
                            <?php echo $form->textField($model, 'email'); ?>
                        </label>
                        <?php echo $form->error($model, 'email'); ?>
                        <label>
                            <span><?php echo $model->getAttributeLabel('password'); ?></span>
                            <?php echo $form->passwordField($model, 'password'); ?>
                        </label>
                        <?php echo $form->error($model, 'password'); ?>
                    </div>
                </div>
                <div class="row bottom-edge">
                    <div class="small-12 columns">
                        <?php echo CHtml::linkButton('Login', array('class' => 'button large')); ?>
                    </div>
                </div>
            <?php $this->endWidget(); ?>
            <a href="" class="angle top-15" data-toggle="passrecover"><?php echo Yii::t("base", "Forgot password?");?></a>
        </div>
        <div class="medium-12 large-4 columns left-50">
            <h2><?php echo Yii::t("base", "Login with [b]social account[/b]", array('[b]' => '<b>', '[/b]' => '</b>'));?></h2>
            <?php $this->widget('ext.eauth.EAuthWidget', array('action' => 'site/login')); ?>
            <?php /* $this->widget('application.components.UloginWidget', array(
                'params' => array(
                    'redirect' => $this->createAbsoluteUrl('site/ulogin'),
                    'logout_url' => $this->createAbsoluteUrl('site/logout'),
                )
            )); */?>
        </div>
    </div>
</section>
<?php $this->widget('PassChange'); ?>