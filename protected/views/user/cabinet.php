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

                    <fieldset>
                        <ul class="fields">
                            <li <?php echo $user->requiredClass('username'); ?>>
                                <div class="field-content">
                                    <div><?php echo $form->label($user, 'username'); ?></div>
                                    <div><?php echo $form->textField($user, 'username'); ?></div>
                                </div>
                                <?php echo $form->error($user, 'username'); ?>
                            </li>
                            <li <?php echo $user->requiredClass('name'); ?>>
                                <div class="field-content">
                                    <div><?php echo $form->label($user, 'name'); ?></div>
                                    <div><?php echo $form->textField($user, 'name'); ?></div>
                                </div>
                                <?php echo $form->error($user, 'name'); ?>
                            </li>
                            <li <?php echo $user->requiredClass('email'); ?>>
                                <div class="field-content">
                                    <div><?php echo $form->label($user, 'surname'); ?></div>
                                    <div><?php echo $form->textField($user, 'surname'); ?></div>
                                </div>
                                <?php echo $form->error($user, 'surname'); ?>
                            </li>
                            <li <?php echo $user->requiredClass('email'); ?>>
                                <div class="field-content">
                                    <div><?php echo $form->label($user, 'email'); ?></div>
                                    <div><?php echo $form->textField($user, 'email', array('readonly'=>true)); ?></div>
                                </div>
                                <?php echo $form->error($user, 'email'); ?>
                            </li>
                            <li <?php echo $user->requiredClass('position'); ?>>
                                <div class="field-content">
                                    <div><?php echo $form->label($user, 'position'); ?></div>
                                    <div><?php echo $form->textField($user, 'position'); ?></div>
                                </div>
                                <?php echo $form->error($user, 'position'); ?>
                            </li>
                            <li <?php echo $user->requiredClass('description'); ?>>
                                <div class="field-content">
                                    <div><?php echo $form->label($user, 'description'); ?></div>
                                    <div><?php echo $form->textArea($user, 'description'); ?></div>
                                </div>
                                <?php echo $form->error($user, 'description'); ?>
                            </li>
                            <li>
                                <?php $this->widget('AjaxFileLoader', array('attribute' => 'avatar', 'model' => $user)); ?>
                            </li>
                        </ul>
                    </fieldset>

                    <fieldset>
                        <legend><span>Certifications</span></legend>
                        <div class="wheretoadd">
                            <?php foreach ($certificates as $key => $certificate) { ?>
                                <?php if(!$certificate->isNewRecord) { ?>
                                    <ul class="fields" data-id="<?php echo $certificate->id; ?>">
                                        <li>
                                            <div class="field-content">
                                                <div><?php echo $form->dropDownList($certificate, "[$key]certificate_id", $certificate->allCertificates); ?></div>
                                            </div>
                                            <?php $form->error($certificate, "[$key]certificate_id"); ?>
                                        </li>
                                        <li>
                                            <div class="field-content">
                                                <div><?php echo $form->label($certificate, "[$key]date"); ?></div>
                                                <div><?php echo $form->textField($certificate, "[$key]date"); ?></div>
                                            </div>
                                            <?php echo $form->error($certificate, "[$key]date"); ?>
                                        </li>
                                    </ul>
                                <?php } ?>
                            <?php } ?>
                        </div>
                        <?php echo CHtml::link(Yii::t("base", 'ADD'), '#', array('class' => 'addButton')); ?>
                        <?php echo CHtml::link(Yii::t("base", 'REMOVE'), '#', array('class' => 'removeButton')); ?>
                    </fieldset>
                    

                    <fieldset>
                        <legend><span>References</span></legend>
                        <ul class="fields">
                            <li>
                                <div class="field-content">
                                    <div><?php echo $form->label($user, 'address'); ?></div>
                                    <div><?php echo $form->textField($user, 'address'); ?></div>
                                </div>
                                <?php echo $form->error($user, 'address'); ?>
                            </li>
                            <li>
                                <div class="field-content">
                                    <div><?php echo $form->label($user, 'phone'); ?></div>
                                    <div><?php echo $form->textField($user, 'phone'); ?></div>
                                </div>
                                <?php echo $form->error($user, 'phone'); ?>
                            </li>
                            <li>
                                <div class="field-content">
                                    <div><?php echo $form->label($user, 'facebook_url'); ?></div>
                                    <div><?php echo $form->textField($user, 'facebook_url'); ?></div>
                                </div>
                                <?php echo $form->error($user, 'facebook_url'); ?>
                            </li>
                            <li>
                                <div class="field-content">
                                    <div><?php echo $form->label($user, 'twitter_url'); ?></div>
                                    <div><?php echo $form->textField($user, 'twitter_url'); ?></div>
                                </div>
                                <?php echo $form->error($user, 'twitter_url'); ?>
                            </li>
                            <li>
                                <div class="field-content">
                                    <div><?php echo $form->label($user, 'xing_url'); ?></div>
                                    <div><?php echo $form->textField($user, 'xing_url'); ?></div>
                                </div>
                                <?php echo $form->error($user, 'xing_url'); ?>
                            </li>
                            <li>
                                <?php $this->widget('AjaxFileLoader', array('attribute' => 'vcf', 'model' => $user)); ?>
                            </li>
                        </ul>
                    </fieldset>

                    <button class="button" type="submit">Save</button>
                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
</section>