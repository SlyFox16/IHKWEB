<!--===============================-->
<!--== Cabinet ====================-->
<!--===============================-->

<!-- Breadcrumbs -->
<div class="row">
    <div class="small-12 medium-6 columns">
        <?php $this->widget('Breadcrumbs', array(
            'links' => array(
                Yii::t("base", 'Register')
            ),
        )); ?>
    </div>
</div>

<section class="separated separated--edge">
    <div class="row">
        <div class="medium-5 large-3 columns">
            <h2>Join our program, <b>register</b> and become a certified expert.</h2>
        </div>
        <div class="medium-7 large-5 columns separator right-50">
            <?php $form = $this->beginWidget('CActiveForm', array(
                'id' => 'seeker-form',
                'enableAjaxValidation' => true,
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                    'validateOnChange' => false,
                    'inputContainer' => 'fieldset',
                ),
            )); ?>
            <div class="row">
                <div class="small-12 columns">
                    <label>
                        <span><?php echo $register_form->getAttributeLabel('name'); ?></span>
                        <?php echo $form->textField($register_form, 'name'); ?>
                    </label>
                    <?php echo $form->error($register_form, 'name'); ?>
                    <label>
                        <span><?php echo $register_form->getAttributeLabel('surname'); ?></span>
                        <?php echo $form->textField($register_form, 'surname'); ?>
                    </label>
                    <?php echo $form->error($register_form, 'name'); ?>
                    <label>
                        <span><?php echo $register_form->getAttributeLabel('email'); ?></span>
                        <?php echo $form->textField($register_form, 'email'); ?>
                    </label>
                    <?php echo $form->error($register_form, 'email'); ?>
                </div>
            </div>
            <div class="row">
                <div class="small-12 columns">
                    <fieldset class="fieldset">
                        <legend><?php echo Yii::t("base", "Password");?></legend>
                        <label>
                            <span><?php echo $register_form->getAttributeLabel('password'); ?></span>
                            <?php echo $form->passwordField($register_form, 'password'); ?>
                        </label>
                        <?php echo $form->error($register_form, 'password'); ?>
                        <label>
                            <span><?php echo $register_form->getAttributeLabel('password_repeat'); ?></span>
                            <?php echo $form->passwordField($register_form, 'password_repeat'); ?>
                        </label>
                        <?php echo $form->error($register_form, 'password_repeat'); ?>
                    </fieldset>
                </div>
            </div>
            <div class="row bottom-edge">
                <div class="small-12 columns">
                    <?php echo CHtml::linkButton(Yii::t("base", 'Register'), array('class' => 'button large')); ?>
                </div>
            </div>
        </div>
        <div class="medium-12 large-4 columns left-50">
            <h2>Use already existing <b>social</b> account to <b>sign up</b></h2>
            <div class="socials">
                <a href="" class="fa fa-facebook"></a>
                <a href="" class="fa fa-twitter"></a>
                <a href="" class="fa fa-xing"></a>
            </div>
        </div>
        <?php $this->endWidget(); ?>
    </div>
</section>