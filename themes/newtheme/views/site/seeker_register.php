<!--===============================-->
<!--== Cabinet ====================-->
<!--===============================-->

<!-- Breadcrumbs -->
<div class="row">
    <div class="small-12 medium-6 columns">
        <?php $this->widget('Breadcrumbs', array(
            'links' => array(
                Yii::t("base", 'Seeker register')
            ),
        )); ?>
    </div>
</div>

<section class="separated separated--edge">
    <div class="row">
        <div class="medium-4 large-3 columns">
            <h2><?php echo Yii::t("base", "Find certified experts, become a seeker.", array('[b]' => '<b>', '[/b]' => '</b>')); ?></h2>
        </div>
        <div class="medium-8 large-5 columns separator right-50">
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
            <div class="small-12 columns">
                <div class="col-xs-12">
                    <?php echo $form->checkBox($register_form, 'confirmCheck'); ?>
                    <label for="checkbox-signup">
                        Ich stimme den <?php echo CHtml::link('AGB\'s', array('site/pages', 'id' => 3)); ?> zu
                    </label>
                    <?php echo $form->error($register_form, 'confirmCheck'); ?>
                </div>
            </div>
            <div class="row bottom-edge">
                <div class="small-12 columns">
                    <?php echo CHtml::linkButton(Yii::t("base", 'Register'), array('class' => 'button large')); ?>
                </div>
            </div>
        </div>
        <div class="medium-8 medium-offset-4 large-4 large-offset-0 columns left-50">
            <h2><?php echo Yii::t("base", "Use already existing [b]social[/b] account to [b]sign up[/b]", array('[b]' => '<b>', '[/b]' => '</b>')); ?></h2>
            <?php $this->widget('ext.eauth.EAuthWidget', array('action' => 'site/sLogin')); ?>
        </div>
        <?php $this->endWidget(); ?>
    </div>
</section>