<div class="modal fade fill-in" id="ratingDescription" tabindex="-1" role="dialog" aria-hidden="true" <?php echo $model->description ? '' : 'data-backdrop="static"'; ?>>
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <?php if($model->description) { ?>
                    <button class="close" aria-hidden="true" data-dismiss="modal" type="button"></button>
                <?php } ?>
                <h5 class="text-left p-b-5"><span class="semi-bold">Work description</span></h5>
            </div>
            <div class="modal-body">
                <?php $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'rating-description',
                    'action' => array('user/ratingDescr', 'id' => $user->id),
                    'enableAjaxValidation' => true,
                    'clientOptions' => array(
                        'validateOnSubmit' => true,
                        'validateOnChange' => true
                    ),
                )); ?>
                <fieldset>
                    <ul class="fields">
                        <li>
                            <div class="field-content">
                                <div><?php echo $form->label($model, 'description'); ?></div>
                                <div><?php echo $form->textArea($model, 'description'); ?></div>
                            </div>
                            <?php echo $form->error($model, 'description'); ?>
                        </li>
                    </ul>
                </fieldset>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btn-block m-t-5"><?php echo Yii::t("base", "Send report"); ?></button>
                <?php $this->endWidget(); ?>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- Modal -->