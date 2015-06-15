<div class="modal fade fill-in" id="passrecover" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" aria-hidden="true" data-dismiss="modal" type="button"></button>
                <h5>Restore password</h5>
            </div>
            <div class="modal-body">
                <?php $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'recover-form',
                    'action' => array("user/recover"),
                    'enableAjaxValidation' => true,
                    'clientOptions' => array(
                        'validateOnSubmit' => true,
                        'validateOnChange' => false
                    ),
                )); ?>
                <fieldset>
                    <ul class="fields">
                        <li <?php echo $model->requiredClass('email'); ?>>
                            <div class="field-content">
                                <div><?php echo $form->label($model, 'email'); ?></div>
                                <div><?php echo $form->textField($model, 'email'); ?></div>
                            </div>
                            <?php echo $form->error($model, 'email'); ?>
                        </li>
                    </ul>
                </fieldset>
            </div>
            <div class="modal-footer">
              <button type="submit" class="button"><?php echo Yii::t("base", "Reset password"); ?></button>
              <?php $this->endWidget(); ?>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- Modal -->