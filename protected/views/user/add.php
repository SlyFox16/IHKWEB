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

<div class="field-row">
    <fieldset>
        <?php echo $form->dropDownList($certificate, "[$count]certificate_id", $certificate->allCertificates); ?>
        <?php echo $form->error($certificate, "[$count]certificate_id"); ?>
    </fieldset>
    <fieldset>
        <?php echo $form->label($certificate, "[$count]date"); ?>
        <?php echo $form->textField($certificate, "[$count]date", array('class' => 'datepicker')); ?>
        <?php echo $form->error($certificate, "[$count]date"); ?>
    </fieldset>
</div>

<script type="text/javascript">
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
</script>