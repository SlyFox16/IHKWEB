<div class="modal fade" id="completedProject<?php echo $model->id; ?>">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <?php $title = $model->id ? 'Update completed project' : 'Add completed project'; ?>
                <h4 class="modal-title"><?php echo Yii::t("base", $title);?></h4>
            </div>
            <div class="modal-body">
                <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                    'id' => 'completed-form'.$model->id,
                    'action' => array("completedProjects/completedProject", 'id' => $model->id),
                    'enableAjaxValidation' => false,
                    'type'=>'horizontal',
                    'clientOptions' => array(
                        'validateOnSubmit' => true,
                        'validateOnChange' => false
                    ),
                    'htmlOptions'=>array("enctype"=>"multipart/form-data"),
                )); ?>

                <?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>255)); ?>

                <?php echo $form->fileFieldRow($model, 'image',array('class'=>'span5','maxlength'=>255)); ?>

                <?php echo $form->textAreaRow($model,'description',array('class'=>'span5','row'=>5, 'col'=> 30)); ?>

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
                                'attribute'=>"date",
                                'options' => array(
                                    'format' => 'dd/mm/yyyy',
                                    'todayHighlight' => true,
                                    'endDate' => '+1d',
                                ),
                                'htmlOptions' => array(
                                    'id' => 'CompletedProjects_date'.$model->id,
                                )
                            )
                        ); ?>
                    </div>
                </div>

                <?php echo $form->dropDownListRow($model,'confirm', array('0' => 'Unconfirmed', '1' => 'Confirmed'),array('empty' => 'Please select','class'=>'span5')); ?>

                <?php echo $form->textFieldRow($model,'link',array('class'=>'span5','maxlength'=>255)); ?>

                <?php echo $form->hiddenField($model,'user_id',array('class'=>'span5','maxlength'=>255, 'value' => $renderPopUserId)); ?>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-key"></i> <?php echo Yii::t("base", "Sign in");?></button>
                </div>
                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
</div>