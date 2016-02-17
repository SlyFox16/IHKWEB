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
            <div class="col-sm-3 col-md-3">
                <div class="cabinet-photo">
                    <img src="<?php echo Yii::app()->iwi->load(Yii::app()->user->avater)->adaptive(280, 280)->cache(); ?>" alt="John Doe">
                </div>
            </div>
            <div class="col-sm-8 col-md-6">
                <?php $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'cabinet-form',
                    'enableAjaxValidation' => true,
                    'clientOptions' => array(
                        'validateOnSubmit' => true,
                        'validateOnChange' => true,
                        'inputContainer' => 'fieldset',
                        'afterValidate'=>'js:function(form, data, hasError)
                        {
                            if(!hasError) {
                               $("#cabinet-form [type=submit]").off();
                               return true;
                            }
                        }',
                    ),
                    'htmlOptions'=>array("enctype"=>"multipart/form-data"),
                )); ?>

                    <fieldset>
                        <ul class="fields">
                            <?php $this->renderPartial('application.widgets.views.user_relation', array('user' => $user)); ?>
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
                                    <div><?php echo $form->textField($user, 'name', array('readonly'=>true)); ?></div>
                                </div>
                                <?php echo $form->error($user, 'name'); ?>
                            </li>
                            <li <?php echo $user->requiredClass('email'); ?>>
                                <div class="field-content">
                                    <div><?php echo $form->label($user, 'surname'); ?></div>
                                    <div><?php echo $form->textField($user, 'surname', array('readonly'=>true)); ?></div>
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
                                <?php $this->widget('AjaxFileLoader', array('attribute' => 'avatar', 'model' => $user, 'form' => $form)); ?>
                            </li>
                            <li>
                                <div class="field-content">
                                    <div><?php echo $form->label($user, 'speciality'); ?></div>
                                    <div>
                                        <?php $this->widget(
                                            'booster.widgets.TbSelect2',
                                            [
                                                'model'=>$user,
                                                'attribute'=>"speciality",
                                                'data' => $user->specialityList,
                                                'asDropDownList' => true,
                                                'options' => [
                                                    'placeholder' => 'Select product',
                                                    'width' => '100%',
                                                    'allowClear' => true,
                                                ],
                                                'htmlOptions' => [
                                                    'multiple' => true,
                                                    'class' => 'form-control'
                                                ],
                                            ]
                                        );?>
                                    </div>
                                    <!--<div><?php /*echo $form->dropDownList($user, 'speciality', $user->specialityList, array('class'=>'form-control', 'multiple'=>'multiple','style'=>'height:140px;')); */?></div>-->
                                </div>
                            </li>
                        </ul>
                    </fieldset>

                    <fieldset>
                        <legend><span>Certifications</span></legend>
                        <div class="wheretoadd">
                            <?php foreach ($certificates as $key => $certificate) { ?>
                                <?php if(!$certificate->isNewRecord) { ?>
                                    <ul class="fields addfield" data-id="<?php echo $certificate->id; ?>">
                                        <li>
                                            <div class="field-content">
                                                <div>Certification</div>
                                                <div><?php $this->widget(
                                                        'booster.widgets.TbSelect2',
                                                        [
                                                            'model'=>$certificate,
                                                            'attribute'=>"[$key]certificate_id",
                                                            'data' => $certificate->allCertificates,
                                                            'asDropDownList' => true,
                                                            'options' => [
                                                                'placeholder' => 'Select product',
                                                                'width' => '100%',
                                                                'allowClear' => true,
                                                            ],
                                                            'htmlOptions' => [
                                                                'class' => 'form-control'
                                                            ],
                                                        ]
                                                    );?></div>
                                                <!--<div><?php /*echo $form->dropDownList($certificate, "[$key]certificate_id", $certificate->allCertificates); */?></div>-->
                                            </div>
                                            <?php $form->error($certificate, "[$key]certificate_id"); ?>
                                        </li>
                                        <li>
                                            <div class="field-content">
                                                <div><?php echo $form->label($certificate, "[$key]date"); ?></div>
                                                <div class="input-group date">
                                                    <?php echo $form->textField($certificate, "[$key]uDate", array('class' => 'form-control')); ?>
                                                    <span class="input-group-addon">
                                                        <i class="glyphicon glyphicon-th"></i>
                                                    </span>
                                                </div>
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
                                <?php $this->widget('ImageGallery', array('model' => $user)); ?>                                <div                                              <div class="input-content">
                                    <div>
                                        Pdf Files
                                    </div>
                                    <div>
                                        <?php $this->widget('ext.dropzone.EDropzone', array(
                                            'model' => $user,
                                            'attribute' => 'pdf',
                                            'url' => $this->createUrl('user/upload'),
                                            'mimeTypes' => array('application/pdf'),
                                            'options' => array('addRemoveLinks' =>true,),
                                        )); ?>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="field-content">
                                    <div><?php echo $form->label($user, 'address'); ?></div>
                                    <div><?php echo $form->textField($user, 'address', array('readonly'=>true)); ?></div>
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
                                <?php $this->widget('AjaxFileLoader', array('attribute' => 'vcf', 'model' => $user, 'form' => $form)); ?>
                            </li>
                        </ul>
                    </fieldset>
                    <div class="button-group">
                        <button class="button" type="submit">Save <i class="fa fa-circle-o-notch"></i></button>
                        <button class="button" type="button" data-toggle="modal" data-target="#passchange">Recover password</button>
                    </div>
                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
</section>
<?php Yii::app()->clientScript->registerScript('popoverActivate',"
        $('#cabinet-form .input-group.date').datepicker({
            format: 'dd/mm/yyyy',
            todayHighlight: true,
            endDate: '+0d',
            'setDate': new Date(),
        });
    ");?>
<?php $this->widget('PassChange', array('change' => true)); ?>