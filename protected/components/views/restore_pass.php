<div class="modal fade fill-in" id="passrecover" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" aria-hidden="true" data-dismiss="modal" type="button"></button>
                <h5 class="text-left p-b-5"><span class="semi-bold">Добавить задачу</span></h5>
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
                <div class="row">
                    <div class="col-sm-8"></div>
                    <div class="col-sm-4 m-t-10 sm-m-t-10">
                        <button type="submit" class="btn btn-primary btn-block m-t-5"><?php echo Yii::t("base", "Change pass"); ?></button>
                    </div>
                </div>
                <?php $this->endWidget(); ?>
            </div>
            <div class="modal-footer">
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- Modal -->