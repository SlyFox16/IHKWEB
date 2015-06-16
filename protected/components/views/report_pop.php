<div class="modal fade fill-in" id="report" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" aria-hidden="true" data-dismiss="modal" type="button"></button>
                <h5 class="text-left p-b-5"><span class="semi-bold">Report</span></h5>
            </div>
            <div class="modal-body">
                <?php $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'report-form',
                    'action' => array('user/report'),
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
                                <div><?php echo $form->label($model, 'text'); ?></div>
                                <div><?php echo $form->textArea($model, 'text'); ?></div>
                            </div>
                            <?php echo $form->error($model, 'text'); ?>
                        </li>
                    </ul>
                    <?php echo $form->hiddenField($model, 'receiver'); ?>
                </fieldset>
                <div class="row">
                    <div class="col-sm-8"></div>
                    <div class="col-sm-4 m-t-10 sm-m-t-10">
                        <button type="submit" class="btn btn-primary btn-block m-t-5"><?php echo Yii::t("base", "Send report"); ?></button>
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