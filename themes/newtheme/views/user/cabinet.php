<!-- Breadcrumbs -->
<div class="row">
    <div class="small-12 medium-6 columns">
        <?php $this->widget('Breadcrumbs', array(
            'links' => array(
                Yii::t("base", 'My account')
            ),
        )); ?>
    </div>
</div>

<section class="separated separated--edge">
    <div class="row">
        <div class="small-3 medium-3 columns">
            <div class="expert_photo">
                <img src="<?php echo YHelper::getImagePath($user->avatar, 200, 200); ?>" alt="<?php echo Yii::t("base", "Profile picture"); ?>">
            </div>
        </div>
        <div class="small-9 medium-6 columns end">
            <?php $form = $this->beginWidget('CActiveForm', array(
                'id' => 'cabinet-form',
                'enableAjaxValidation' => true,
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                    'validateOnChange' => true,
                    'inputContainer' => 'fieldset',
                    'beforeValidate' => 'js:function(form){$(form).find("button[type=\'submit\']").prop("disabled", true); return true;}',
                    'afterValidate' => 'js:function(form, data, hasError){$(form).find("button[type=\'submit\']").prop("disabled", false); return !hasError;}',
                ),
                'htmlOptions'=>array("enctype"=>"multipart/form-data"),
            )); ?>
                <div class="row">
                    <div class="small-12 columns">
                        <div class="user_level">
                            <h2>Level <?php echo $user->level; ?></h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="small-12 columns">
                        <label>
                            <span><?php echo $user->getAttributeLabel('username'); ?></span>
                            <?php echo $form->textField($user, 'username'); ?>
                        </label>
                        <?php echo $form->error($user, 'username'); ?>

                        <?php $this->renderPartial('application.widgets.views.user_relation', array('user' => $user)); ?>

                        <?php $this->renderPartial('application.widgets.views.user_association', array('user' => $user)); ?>

                        <label>
                            <span><?php echo $user->getAttributeLabel('name'); ?></span>
                            <?php echo $form->textField($user, 'name', array('readonly'=>true)); ?>
                        </label>
                        <?php echo $form->error($user, 'name'); ?>

                        <label>
                            <span><?php echo $user->getAttributeLabel('surname'); ?></span>
                            <?php echo $form->textField($user, 'surname', array('readonly'=>true)); ?>
                        </label>
                        <?php echo $form->error($user, 'surname'); ?>

                        <label>
                            <span><?php echo $user->getAttributeLabel('title'); ?></span>
                            <?php echo $form->textField($user, 'title'); ?>
                        </label>
                        <?php echo $form->error($user, 'title'); ?>

                        <label>
                            <span><?php echo $user->getAttributeLabel('zip'); ?></span>
                            <?php echo $form->textField($user, 'zip'); ?>
                        </label>
                        <?php echo $form->error($user, 'zip'); ?>

                        <label>
                            <span><?php echo $user->getAttributeLabel('email'); ?></span>
                            <?php echo $form->textField($user, 'email', array('readonly'=>true)); ?>
                        </label>
                        <?php echo $form->error($user, 'email'); ?>

                        <label>
                            <span><?php echo $user->getAttributeLabel('position'); ?></span>
                            <?php echo $form->textField($user, 'position'); ?>
                        </label>
                        <?php echo $form->error($user, 'position'); ?>

                        <label>
                            <span><?php echo $user->getAttributeLabel('description'); ?></span>
                            <?php echo $form->textArea($user, 'description', array('cols' => 30, 'rows' => 5)); ?>
                        </label>
                        <?php echo $form->error($user, 'description'); ?>

                        <label>
                            <span><?php echo $user->getAttributeLabel('avatar'); ?></span>
                            <?php echo $form->fileField($user, 'avatar', array('extensions' => '"gif", "png", "jpg", "jpeg"')); ?>
                        </label>
                        <?php echo $form->error($user, 'avatar'); ?>

                        <label>
                            <span><?php echo $user->getAttributeLabel('speciality'); ?></span>
                            <?php $this->widget(
                                'booster.widgets.TbSelect2',
                                [
                                    'model'=>$user,
                                    'attribute'=>"speciality",
                                    'data' => $user->specialityList,
                                    'asDropDownList' => true,
                                    'options' => [
                                        'placeholder' => 'Select speciality',
                                        'width' => '100%',
                                        'allowClear' => true,
                                    ],
                                    'htmlOptions' => [
                                        'multiple' => true,
                                        'class' => 'form-control'
                                    ],
                                ]
                            );?>
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="small-12 columns">
                        <fieldset class="fieldset">
                            <legend><?php echo Yii::t("base", "Certifications"); ?></legend>
                            <div class="wheretoadd">
                                <?php foreach ($certificates as $key => $certificate) { ?>
                                    <?php if(!$certificate->isNewRecord) { ?>
                                        <div class="fields">
                                            <label>
                                                <span><?php echo $certificate->getAttributeLabel('certificate_id'); ?></span>
                                                <?php $this->widget(
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
                                                );?>
                                            </label>
                                            <?php $form->error($certificate, "[$key]certificate_id"); ?>

                                            <label>
                                                <span><?php echo $certificate->getAttributeLabel('date'); ?></span>
                                                <?php $this->widget(
                                                    'booster.widgets.TbDatePicker',
                                                    array(
                                                        'model'=>$certificate,
                                                        'attribute'=>"[$key]uDate",
                                                        'options' => array(
                                                            'format' => 'dd/mm/yyyy',
                                                            'todayHighlight' => true,
                                                            'endDate' => '+1d',
                                                        ),
                                                    )
                                                ); ?>
                                            </label>
                                        </div>
                                        <?php echo $form->error($certificate, "[$key]date"); ?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                            <?php echo CHtml::link(Yii::t("base", 'ADD'), '#', array('class' => 'addButton button')); ?>
                            <?php echo CHtml::link(Yii::t("base", 'REMOVE'), '#', array('class' => 'removeButton button transparent')); ?>
                        </fieldset>
                    </div>
                </div>
                <div class="row">
                    <div class="small-12 columns">
                        <fieldset class="fieldset">
                            <legend><?php echo Yii::t("base", "Completed projects"); ?></legend>
                            <?php if($completed = $user->completed) { ?>
                                <ul class="attached attached-complete">
                                    <?php foreach($completed as $complete) { ?>
                                        <li class="relateduser">
                                            <a data-toggle="complete<?php echo $complete->id; ?>"><?php echo $complete->name; ?></a>
                                            <a href="javascript:void(0)" title="<?php echo Yii::t("base", "Remove"); ?>" class="delete fa fa-times" data-id="<?php echo $complete->id; ?>">
                                            </a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            <?php } ?>
                            <a data-toggle="complete" class="button"><?php echo Yii::t("base", 'ADD'); ?></a>
                        </fieldset>
                    </div>
                </div>
                <div class="row">
                    <div class="small-12 columns">
                        <fieldset class="fieldset">
                            <legend><?php echo Yii::t("base", "References"); ?></legend>
                            <label>
                                <span><?php echo Yii::t("base", "PDF Files"); ?></span>
                                <?php $this->widget('ext.dropzone.EDropzone', array(
                                    'model' => $user,
                                    'attribute' => 'pdf',
                                    'url' => $this->createUrl('user/upload'),
                                    'mimeTypes' => array('application/pdf'),
                                    'options' => array('addRemoveLinks' =>true),
                                )); ?>
                            </label>
                            <?php $this->widget('ImageGallery', array('model' => $user)); ?>

                            <label>
                                <span><?php echo $user->getAttributeLabel('address'); ?></span>
                                <?php echo $form->textField($user, 'address', array('readonly'=>true)); ?>
                            </label>
                            <?php echo $form->error($user, 'address'); ?>

                            <label>
                                <span><?php echo $user->getAttributeLabel('phone'); ?></span>
                                <?php echo $form->textField($user, 'phone'); ?>
                            </label>
                            <?php echo $form->error($user, 'phone'); ?>

                            <label>
                                <span><?php echo $user->getAttributeLabel('facebook_url'); ?></span>
                                <?php echo $form->textField($user, 'facebook_url'); ?>
                            </label>
                            <?php echo $form->error($user, 'facebook_url'); ?>

                            <label>
                                <span><?php echo $user->getAttributeLabel('xing_url'); ?></span>
                                <?php echo $form->textField($user, 'xing_url'); ?>
                            </label>
                            <?php echo $form->error($user, 'xing_url'); ?>

                            <label>
                                <span><?php echo $user->getAttributeLabel('vcf'); ?></span>
                                <?php echo $form->fileField($user, 'vcf', array('extensions' => '"pdf"')); ?>
                            </label>
                            <?php echo $form->error($user, 'vcf'); ?>
                        </fieldset>
                    </div>
                </div>
                <div class="row bottom-edge">
                    <div class="small-12 columns">
                        <div class="button-group">
                            <?php echo CHtml::linkButton(Yii::t("base", 'Save').' <i class="fa fa-circle-o-notch"></i>', array('class' => 'button large')); ?>
                            <a class="button large" data-toggle="passchange"><?php echo Yii::t("base", "Recover Password"); ?></a>
                        </div>
                    </div>
                </div>
            <?php $this->endWidget(); ?>
        </div>
    </div>
</section>
<?php $this->widget('PassChange', array('change' => true)); ?>
<?php if($completed = $user->completed) { ?>
    <?php foreach($completed as $complete) { ?>
        <?php $this->widget("CompletedWidget", array('project_id' => $complete->id)); ?>
    <?php } ?>
<?php } ?>
<?php $this->widget("CompletedWidget"); ?>
<?php Yii::app()->clientScript->registerScript('remove-completed', "
    $('.attached-complete').on('click', '.delete', function () {
        var self = $(this);
        $.ajax({
            type:'POST',
            data:{id:self.data('id')},
            url: '".Yii::app()->controller->createUrl('/user/deleteComplete')."',
            success:function (msg) {
                self.closest('li').fadeOut();
            }
        });
    });
", CClientScript::POS_END); ?>