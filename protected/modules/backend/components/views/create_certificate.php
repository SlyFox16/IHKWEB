<div class="modal fade" id="newCertificate">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php echo Yii::t("base", "Add certificate");?></h4>
            </div>
            <div class="modal-body">
                <?php $form = $this->beginWidget('backend.components.ActiveForm', array(
                    'id' => 'login-form',
                    'action' => array("certificates/uCCreate", 'id' => $user),
                    'type'=>'horizontal',
                    'enableAjaxValidation' => true,
                    'clientOptions' => array(
                        'validateOnSubmit' => true,
                        'validateOnChange' => false
                    ),
                    'htmlOptions' => array('class' => 'form-horizontal')
                )); ?>
                <div class="control-group">
                    <label class="control-label control-label required" for="User_username">
                        <?php echo $model->getAttributeLabel('certificate_id'); ?>
                        <span class="required">*</span>
                    </label>
                    <div class="controls">
                        <?php $this->widget(
                            'booster.widgets.TbSelect2',
                            [
                                'model'=>$model,
                                'attribute'=>"certificate_id",
                                'data' => $model->allCertificates,
                                'asDropDownList' => true,
                                'options' => [
                                    'placeholder' => 'Select product',
                                    'width' => '100%',
                                    'allowClear' => true,
                                ],
                            ]
                        );?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label control-label required" for="User_username">
                        <?php echo $model->getAttributeLabel('date'); ?>
                        <span class="required">*</span>
                    </label>
                    <div class="controls">
                        <?php $this->widget(
                            'booster.widgets.TbDatePicker',
                            array(
                                'model'=>$model,
                                'attribute'=>"uDate",
                                'options' => array(
                                    'format' => 'dd/mm/yyyy',
                                    'todayHighlight' => true,
                                    'endDate' => '+1d',
                                ),
                            )
                        ); ?>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-key"></i> <?php echo Yii::t("base", "Add");?></button>
                </div>
                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
</div>