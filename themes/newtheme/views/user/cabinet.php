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
                <a href="" class="edit fa fa-pencil"></a>
                <img src="<?php echo YHelper::getImagePath($user->avatar, 200, 200); ?>" alt="<?php echo Yii::t("base", "Profile picture"); ?>">
            </div>
        </div>
        <div class="small-9 medium-7 columns end">
            <?php $form = $this->beginWidget('CActiveForm', array(
                'id' => 'cabinet-form',
                'enableAjaxValidation' => true,
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                    'validateOnChange' => true,
                    'inputContainer' => 'fieldset',
                    'beforeValidate' => 'js:function(form){$(form).find("button[type=\'submit\']").prop("disabled", true); return true;}',
                    'afterValidate' => 'js:function(form, data, hasError){$(form).find("button[type=\'submit\']").prop("disabled", false);return !hasError;}',
                ),
                'htmlOptions'=>array("enctype"=>"multipart/form-data"),
            )); ?>
                <div class="row">
                    <div class="small-12 columns">
                        <ul class="tabs" data-tabs id="example-tabs">
                            <li class="tabs-title is-active"><a href="#panel1" aria-selected="true"><?php echo Yii::t("base", "General"); ?></a></li>
                            <li class="tabs-title"><a href="#panel2" aria-selected="true"><?php echo Yii::t("base", "Contact info"); ?></a></li>
                            <li class="tabs-title"><a href="#panel3"><?php echo Yii::t("base", "Certificates"); ?></a></li>
                        </ul>
                        <div class="tabs-content" data-tabs-content="example-tabs">
                            <div class="tabs-panel is-active" id="panel1">
                                <h4 class="note"><?php echo Yii::t("base", "Please add an info about your certificates to to achieve new level."); ?></h4>
                                <fieldset class="input-multiple">
                                    <label>
                                        <span><?php echo $user->getAttributeLabel('title'); ?></span>
                                        <?php echo $form->textField($user, 'title'); ?>
                                    </label>
                                    <?php echo $form->error($user, 'title'); ?>
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
                                </fieldset>

                                <fieldset class="fieldset">
                                    <label>
                                        <span><?php echo $user->getAttributeLabel('username'); ?></span>
                                        <?php echo $form->textField($user, 'username'); ?>
                                    </label>
                                    <?php echo $form->error($user, 'username'); ?>

                                    <label>
                                        <span><?php echo $user->getAttributeLabel('email'); ?></span>
                                        <?php echo $form->textField($user, 'email', array('readonly'=>true)); ?>
                                    </label>
                                    <?php echo $form->error($user, 'email'); ?>

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

                                    <?php $this->renderPartial('application.widgets.views.user_association', array('user' => $user)); ?>

                                    <label>
                                        <span><?php echo $user->getAttributeLabel('avatar'); ?></span>
                                        <?php echo $form->fileField($user, 'avatar', array('extensions' => '"gif", "png", "jpg", "jpeg"')); ?>
                                    </label>
                                    <?php echo $form->error($user, 'avatar'); ?>

                                    <label>
                                        <span><?php echo $user->getAttributeLabel('vcf'); ?></span>
                                        <?php echo $form->fileField($user, 'vcf', array('extensions' => '"pdf"')); ?>
                                    </label>
                                    <?php echo $form->error($user, 'vcf'); ?>
                                </fieldset>

                                <fieldset class="fieldset">
                                    <legend><?php echo Yii::t("base", "Company"); ?></legend>

                                    <label>
                                        <span><?php echo $user->getAttributeLabel('companyname'); ?></span>
                                        <?php echo $form->textField($user, 'companyname'); ?>
                                    </label>
                                    <?php echo $form->error($user, 'companyname'); ?>

                                    <label>
                                        <span><?php echo $user->getAttributeLabel('web_url'); ?></span>
                                        <?php echo $form->textField($user, 'web_url'); ?>
                                    </label>
                                    <?php echo $form->error($user, 'web_url'); ?>

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
                                </fieldset>
                            </div>
                            <div class="tabs-panel" id="panel2">
                                <h4 class="note">Lorem ipsum dolor sit amet, consectetur adipisicing elit. </h4>
                                <fieldset class="fieldset">
                                    <label>
                                        <span><?php echo $user->getAttributeLabel('country_id'); ?></span>
                                        <?php $this->widget(
                                            'booster.widgets.TbSelect2',
                                            [
                                                'model'=>$user,
                                                'attribute'=>'country_id',
                                                'data' => User::model()->assocList,
                                                'asDropDownList' => true,
                                                'options' => [
                                                    'placeholder' => 'Select country',
                                                    'width' => '100%',
                                                    'allowClear' => true,
                                                ],
                                                'htmlOptions' => [
                                                    'class' => 'form-control'
                                                ],
                                            ]
                                        );?>
                                    </label>
                                    <?php echo $form->error($user, 'country_id'); ?>

                                    <label>
                                        <span><?php echo $user->getAttributeLabel('city_id'); ?></span>
                                        <?php $this->widget(
                                            'booster.widgets.TbSelect2',
                                            [
                                                'model'=>$user,
                                                'attribute'=>'city_id',
                                                'data' => User::model()->cityList,
                                                'asDropDownList' => false,
                                                'options' => [
                                                    'minimumInputLength' => 2,
                                                    'placeholder' => 'Select city',
                                                    'width' => '100%',
                                                    'allowClear' => true,
                                                    'ajax' => [
                                                        'url' => Yii::app()->controller->createUrl('/user/citySearch'),
                                                        'dataType' => 'json',
                                                        'data' => 'js:function(term, page) {
                                                            var country = $("#User_country_id").val();
                                                            return {q: term,  country: country};
                                                        }',
                                                        'results' => 'js:function(data) { return {results: data}; }',
                                                    ],
                                                    'initSelection' => 'js:cityInitSelection',
                                                    'formatResult' => 'js:productFormatResult',
                                                    'formatSelection' => 'js:productFormatSelection',
                                                ],
                                                'htmlOptions' => [
                                                    'class' => 'form-control'
                                                ],
                                            ]
                                        ); ?>
                                    </label>
                                    <?php echo $form->error($user, 'city_id'); ?>

                                    <label>
                                        <span><?php echo $user->getAttributeLabel('address'); ?></span>
                                        <?php echo $form->textField($user, 'address'); ?>
                                    </label>
                                    <?php echo $form->error($user, 'address'); ?>

                                    <label>
                                        <span><?php echo $user->getAttributeLabel('phone'); ?></span>
                                        <?php echo $form->textField($user, 'phone'); ?>
                                    </label>
                                    <?php echo $form->error($user, 'phone'); ?>
                                </fieldset>

                                <fieldset class="fieldset">
                                    <legend><?php echo Yii::t("base", "Social links"); ?></legend>

                                    <label>
                                        <span><?php echo $user->getAttributeLabel('facebook_url'); ?></span>
                                        <?php echo $form->textField($user, 'facebook_url'); ?>
                                    </label>
                                    <?php echo $form->error($user, 'facebook_url'); ?>

                                    <label>
                                        <span><?php echo $user->getAttributeLabel('linkedin_url'); ?></span>
                                        <?php echo $form->textField($user, 'linkedin_url'); ?>
                                    </label>
                                    <?php echo $form->error($user, 'linkedin_url'); ?>

                                    <label>
                                        <span><?php echo $user->getAttributeLabel('twitter_url'); ?></span>
                                        <?php echo $form->textField($user, 'twitter_url'); ?>
                                    </label>
                                    <?php echo $form->error($user, 'twitter_url'); ?>

                                    <label>
                                        <span><?php echo $user->getAttributeLabel('xing_url'); ?></span>
                                        <?php echo $form->textField($user, 'xing_url'); ?>
                                    </label>
                                    <?php echo $form->error($user, 'xing_url'); ?>
                                </fieldset>
                            </div>
                            <div class="tabs-panel" id="panel3">
                                <h4 class="note">Lorem ipsum dolor sit amet, consectetur adipisicing elit. </h4>
                                <fieldset class="fieldset">
                                    <legend><?php echo Yii::t("base", "Certifications"); ?></legend>
                                    <div class="fields">
                                        <label>
                                            <span><?php echo $certificate->getAttributeLabel('certificate_id'); ?></span>
                                            <?php $this->widget(
                                                'booster.widgets.TbSelect2',
                                                [
                                                    'model'=>$certificate,
                                                    'attribute'=>"certificate_id",
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
                                        <?php $form->error($certificate, "certificate_id"); ?>

                                        <label>
                                            <span><?php echo $certificate->getAttributeLabel('date'); ?></span>
                                            <?php $this->widget(
                                                'booster.widgets.TbDatePicker',
                                                array(
                                                    'model'=>$certificate,
                                                    'attribute'=>"uDate",
                                                    'options' => array(
                                                        'format' => 'dd/mm/yyyy',
                                                        'todayHighlight' => true,
                                                        'endDate' => '+1d',
                                                    ),
                                                )
                                            ); ?>
                                        </label>
                                    </div>
                                    <?php echo $form->error($certificate, "date"); ?>
                                    <?php echo CHtml::ajaxButton(
                                        'update',
                                        Yii::app()->createUrl('/user/saveCertificate'),
                                        array(
                                            'type'=>'POST',
                                            'data'=> 'js:{"UserCertificate[certificate_id]": $("#UserCertificate_certificate_id").val(), "UserCertificate[date]": $("#UserCertificate_uDate").val(), "ajax": "cabinet-form"}',
                                            'success'=>'function(data) {
                                                if(data == []) {
                                                    hideFormErrors(form="#cabinet-form");
                                                } else {
                                                    formErrors(data,form="#cabinet-form");
                                                }
                                            }',
                                        ),
                                        array(
                                            'class'=>'certifSend button',
                                        )
                                    ); ?>
                                </fieldset>
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
                    </div>
                </div>
                <div class="row bottom-edge">
                    <div class="small-12 columns">
                        <div class="button-group">
                            <?php echo $form->errorSummary($user); ?>
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

<script>
    function productFormatSelection(city) {
        return city.name;
    }

    function productFormatResult(city) {
        var markup = city.name;
        return markup;
    }
    function cityInitSelection(element, callback) {
        var ret = <?php echo $user->selectedCity; ?>;

        var data = {'id':ret.id , 'name': ret.value};
        callback(data);
    }
    function formErrors(data,form){
        console.log('error show');
        var summary = '';
        summary="<p>Please solve following errors:</p>";
console.log(data);
        $.each(data, function(key, val) {
            $(form+" #"+key+"_em_").html(val.toString());
            $(form+" #"+key+"_em_").show();

            $("#"+key).parent().addClass("row error");
            summary = summary + "<ul><li>" + val.toString() + "</li></ul>";
        });
        $(form+"_es_").html(summary.toString());
        $(form+"_es_").show();

        $("[id^='update-button']").show();
        $('#ajax-status').hide();//css({display:'none'});
        $('#ajax-status').text('');
    }
    function hideFormErrors(form){
        console.log('error hide');
        //alert (form+"_es_");
        $(form+"_es_").html('');
        $(form+"_es_").hide();
        $("[id$='_em_']").html('');
    }
</script>
