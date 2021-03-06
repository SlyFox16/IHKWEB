<?php if($this->open) {
    $url = array("user/updateMailPassword");
} else {
    $url = array("user/updatePassword");
}
?>

<div class="modal fade fill-in" id="passchange" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" aria-hidden="true" data-dismiss="modal" type="button"></button>
                <h5 class="text-left p-b-5"><span class="semi-bold">Change password</span></h5>
            </div>
            <div class="modal-body">
                <?php $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'changepass-form',
                    'action' => $url,
                    'enableAjaxValidation' => true,
                    'clientOptions' => array(
                        'validateOnSubmit' => true,
                        'validateOnChange' => false
                    ),
                )); ?>
                <fieldset>
                    <ul class="fields">
                        <li <?php echo $model->requiredClass('password'); ?>>
                            <div class="field-content">
                                <div><?php echo $form->label($model, 'password'); ?></div>
                                <div><?php echo $form->passwordField($model, 'password'); ?></div>
                            </div>
                            <?php echo $form->error($model, 'password'); ?>
                        </li>
                        <li <?php echo $model->requiredClass('password_repeat'); ?>>
                            <div class="field-content">
                                <div><?php echo $form->label($model, 'password_repeat'); ?></div>
                                <div><?php echo $form->passwordField($model, 'password_repeat'); ?></div>
                            </div>
                            <?php echo $form->error($model, 'password_repeat'); ?>
                        </li>
                    </ul>
                </fieldset>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btn-block m-t-5"><?php echo Yii::t("base", "Change pass"); ?></button>
                <?php $this->endWidget(); ?>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- Modal -->

<?php if($this->open) {
    Yii::app()->clientScript->registerScript('popoverActivate',"$('#passchange').modal('show');");
} ?>