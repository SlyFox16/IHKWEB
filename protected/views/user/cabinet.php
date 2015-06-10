<section class="separated">
    <div class="container relative">

        <!--== Breadcrumbs ==-->
        <?php
            $this->widget('Breadcrumbs', array(
                'links' => array(
                    Yii::t("base", 'My account')
                ),
            ));
        ?>

        <div class="row">
            <div class="col-sm-3">
                <img src="<?php echo Yii::app()->iwi->load(Yii::app()->user->avater)->adaptive(280, 280)->cache(); ?>" alt="John Doe">
            </div>
            <div class="col-sm-6 col-xs-9">
                <?php $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'cabinet-form',
                    'enableAjaxValidation' => true,
                    'clientOptions' => array(
                        'validateOnSubmit' => true,
                        'validateOnChange' => false,
                        'inputContainer' => 'fieldset',
                    ),
                    'htmlOptions'=>array("enctype"=>"multipart/form-data"),
                )); ?>
                    <fieldset <?php echo $user->requiredClass('email'); ?>>
                        <?php echo $form->label($user, 'username'); ?>
                        <?php echo $form->textField($user, 'username'); ?>
                        <?php echo $form->error($user, 'username'); ?>
                    </fieldset>
                    <fieldset <?php echo $user->requiredClass('email'); ?>>
                        <?php echo $form->label($user, 'name'); ?>
                        <?php echo $form->textField($user, 'name'); ?>
                        <?php echo $form->error($user, 'name'); ?>
                    </fieldset>
                    <fieldset <?php echo $user->requiredClass('email'); ?>>
                        <?php echo $form->label($user, 'surname'); ?>
                        <?php echo $form->textField($user, 'surname'); ?>
                        <?php echo $form->error($user, 'surname'); ?>
                    </fieldset>
                    <fieldset <?php echo $user->requiredClass('email'); ?>>
                        <?php echo $form->label($user, 'email'); ?>
                        <?php echo $form->textField($user, 'email', array('readonly'=>true)); ?>
                        <?php echo $form->error($user, 'email'); ?>
                    </fieldset>
                    <fieldset <?php echo $user->requiredClass('email'); ?>>
                        <?php echo $form->label($user, 'position'); ?>
                        <?php echo $form->textField($user, 'position'); ?>
                        <?php echo $form->error($user, 'position'); ?>
                    </fieldset>
                    <fieldset <?php echo $user->requiredClass('email'); ?>>
                        <?php echo $form->label($user, 'description'); ?>
                        <?php echo $form->textArea($user, 'description'); ?>
                        <?php echo $form->error($user, 'description'); ?>
                    </fieldset>

                    <?php $this->widget('AjaxFileLoader', array('attribute' => 'avatar', 'model' => $user)); ?>

                    <div class="secondary">
                        <span>Certifications</span>
                    </div>
                    <fieldset>
                        <div class="wheretoadd">
                            <?php foreach ($certificates as $key => $certificate) { ?>
                                <?php if(!$certificate->isNewRecord) { ?>
                                    <div class="field-row" data-id="<?php echo $certificate->id; ?>">
                                        <fieldset>
                                            <?php echo $form->dropDownList($certificate, "[$key]certificate_id", $certificate->allCertificates); ?>
                                            <?php $form->error($certificate, "[$key]certificate_id"); ?>
                                        </fieldset>
                                        <fieldset>
                                            <?php echo $form->label($certificate, "[$key]date"); ?>
                                            <?php echo $form->textField($certificate, "[$key]date"); ?>
                                            <?php echo $form->error($certificate, "[$key]date"); ?>
                                        </fieldset>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                        </div>
                        <?php echo CHtml::link(Yii::t("base", 'ADD'), '#', array('class' => 'addButton')); ?>
                        <?php echo CHtml::link(Yii::t("base", 'REMOVE'), '#', array('class' => 'removeButton')); ?>
                    </fieldset>
                    <div class="secondary">
                        <span>References</span>
                    </div>
                    <fieldset <?php echo $user->requiredClass('email'); ?>>
                        <?php echo $form->label($user, 'address'); ?>
                        <?php echo $form->textField($user, 'address'); ?>
                        <?php echo $form->error($user, 'address'); ?>
                    </fieldset>
                    <fieldset <?php echo $user->requiredClass('email'); ?>>
                        <?php echo $form->label($user, 'phone'); ?>
                        <?php echo $form->textField($user, 'phone'); ?>
                        <?php echo $form->error($user, 'phone'); ?>
                    </fieldset>
                    <fieldset <?php echo $user->requiredClass('email'); ?>>
                        <?php echo $form->label($user, 'facebook_url'); ?>
                        <?php echo $form->textField($user, 'facebook_url'); ?>
                        <?php echo $form->error($user, 'facebook_url'); ?>
                    </fieldset>
                    <fieldset <?php echo $user->requiredClass('email'); ?>>
                        <?php echo $form->label($user, 'twitter_url'); ?>
                        <?php echo $form->textField($user, 'twitter_url'); ?>
                        <?php echo $form->error($user, 'twitter_url'); ?>
                    </fieldset>
                    <fieldset <?php echo $user->requiredClass('email'); ?>>
                        <?php echo $form->label($user, 'xing_url'); ?>
                        <?php echo $form->textField($user, 'xing_url'); ?>
                        <?php echo $form->error($user, 'xing_url'); ?>
                    </fieldset>
                    <?php $this->widget('AjaxFileLoader', array('attribute' => 'vcf', 'model' => $user)); ?>

                    <button class="button" type="submit">Register</button>
                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
</section>