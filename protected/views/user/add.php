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


<ul class="fields addfield">
    <li>
        <div class="field-content">
            <div>Certifications</div>
            <div><?php echo $form->dropDownList($certificate, "[$count]certificate_id", $certificate->allCertificates); ?></div>
        </div>
        <?php echo $form->error($certificate, "[$count]certificate_id"); ?>
    </li>
    <li>
        <div class="field-content">
            <div><?php echo $form->label($certificate, "[$count]date"); ?></div>
            <div class="input-group date">
                <?php echo $form->textField($certificate, "[$count]uDate", array('class' => 'form-control')); ?>
                <span class="input-group-addon">
                    <i class="glyphicon glyphicon-th"></i>
                </span>
            </div>
        </div>
        <?php echo $form->error($certificate, "[$count]date"); ?>
    </li>
</ul>

<script type="text/javascript">
    $('select').fancySelect();
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

    $('.input-group.date').datepicker({
        format: 'dd/mm/yyyy',
        todayHighlight: true,
        endDate: '+0d',
        "setDate": new Date()
    });
</script>