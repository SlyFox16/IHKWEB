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
                        <?php echo $form->labelEx($user, 'username'); ?>
                        <?php echo $form->textField($user, 'username'); ?>
                        <?php echo $form->error($user, 'username'); ?>
                    </fieldset>
                    <fieldset>
                        <?php echo $form->labelEx($user, 'name'); ?>
                        <?php echo $form->textField($user, 'name'); ?>
                        <?php echo $form->error($user, 'name'); ?>
                    </fieldset>
                    <fieldset>
                        <?php echo $form->labelEx($user, 'surname'); ?>
                        <?php echo $form->textField($user, 'surname'); ?>
                        <?php echo $form->error($user, 'surname'); ?>
                    </fieldset>
                    <fieldset>
                        <?php echo $form->labelEx($user, 'email'); ?>
                        <?php echo $form->textField($user, 'email', array('readonly'=>true)); ?>
                        <?php echo $form->error($user, 'email'); ?>
                    </fieldset>
                    <fieldset>
                        <?php echo $form->labelEx($user, 'position'); ?>
                        <?php echo $form->textField($user, 'position'); ?>
                        <?php echo $form->error($user, 'position'); ?>
                    </fieldset>
                    <fieldset>
                        <?php echo $form->labelEx($user, 'description'); ?>
                        <?php echo $form->textArea($user, 'description'); ?>
                        <?php echo $form->error($user, 'description'); ?>
                    </fieldset>

                    <?php $this->widget('AjaxFileLoader', array('attribute' => 'avatar', 'model' => $user)); ?>

                    <div class="secondary">
                        <span>Certifications</span>
                    </div>
                    <fieldset>
                        <?php echo $form->dropDownList($user, "certificates0", $user->allCertificates,array('multiple'=>'multiple')); ?>
                    </fieldset>
                    <div class="secondary">
                        <span>References</span>
                    </div>
                    <fieldset>
                        <?php echo $form->labelEx($user, 'address'); ?>
                        <?php echo $form->textField($user, 'address'); ?>
                        <?php echo $form->error($user, 'address'); ?>
                    </fieldset>
                    <fieldset>
                        <?php echo $form->labelEx($user, 'phone'); ?>
                        <?php echo $form->textField($user, 'phone'); ?>
                        <?php echo $form->error($user, 'phone'); ?>
                    </fieldset>
                    <fieldset>
                        <?php echo $form->labelEx($user, 'facebook_url'); ?>
                        <?php echo $form->textField($user, 'facebook_url'); ?>
                        <?php echo $form->error($user, 'facebook_url'); ?>
                    </fieldset>
                    <fieldset>
                        <?php echo $form->labelEx($user, 'twitter_url'); ?>
                        <?php echo $form->textField($user, 'twitter_url'); ?>
                        <?php echo $form->error($user, 'twitter_url'); ?>
                    </fieldset>
                    <fieldset>
                        <?php echo $form->labelEx($user, 'xing_url'); ?>
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