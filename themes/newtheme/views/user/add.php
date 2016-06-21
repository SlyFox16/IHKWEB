<?php $form = new CActiveForm();
$form->id = 'cabinet-form';
$form->enableAjaxValidation = true;
$form->clientOptions = array(
    'validateOnSubmit' => true,
    'validateOnChange' => false,
    'inputContainer' => 'fieldset',
);
$form->htmlOptions = 'array("enctype"=>"multipart/form-data")';
?>

<div class="fields">
    <label>
        <span><?php echo $certificate->getAttributeLabel('certificate_id'); ?></span>
        <?php $this->widget(
            'booster.widgets.TbSelect2',
            [
                'model'=>$certificate,
                'attribute'=>"[$count]certificate_id",
                'data' => $certificate->allCertificates,
                'asDropDownList' => true,
                'options' => [
                    'placeholder' => 'Select product',
                    'width' => '100%',
                    'allowClear' => true,
                ],
                'htmlOptions' => [
                    'class' => 'form-control new'
                ],
            ]
        );?>
        <?php echo $form->error($certificate, "[$count]certificate_id"); ?>
    </label>
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
                    'endDate' => '+0d',
                ),

            )
        ); ?>
        <?php echo $form->error($certificate, "[$count]date"); ?>
    </label>
</div>

<script type="text/javascript">
    //$('select').fancySelect();
    //$('.datepicker').datepicker();
    $().ready(function () {
        var settings = $("#cabinet-form").data('settings');
        var new_settings = '<?php echo json_encode(array_values($form->attributes)); ?>';
        console.log(new_settings);

        if (new_settings != "") {
            new_settings = eval(new_settings);
            $.each(new_settings, function (i) {
                settings.attributes.push(
                    new_settings[i]
                );
            });

            $.each(settings.attributes, function (i) {
                settings.attributes[i] = $.extend({}, {
                    validationDelay: settings.validationDelay,
                    validateOnChange: settings.validateOnChange,
                    validateOnType: settings.validateOnType,
                    hideErrorMessage: settings.hideErrorMessage,
                    inputContainer: settings.inputContainer,
                    errorCssClass: settings.errorCssClass,
                    successCssClass: settings.successCssClass,
                    beforeValidateAttribute: settings.beforeValidateAttribute,
                    afterValidateAttribute: settings.afterValidateAttribute,
                    validatingCssClass: settings.validatingCssClass
                }, this);
            });
            $("#cabinet-form").data('settings', settings);
        }

    });

    $('label > select').select2();
    $('.ct-form-control').datepicker({
        format: 'dd/mm/yyyy',
        todayHighlight: true,
        endDate: '+1d',
        "setDate": new Date()
    });
</script>