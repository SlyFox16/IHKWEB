<!--===============================-->
<!--== Popup ======================-->
<!--===============================-->
<div class="reveal" id="complete<?php echo $model->id; ?>" data-reveal data-close-on-click="true" data-animation-in="slide-in-down" data-animation-out="slide-out-up">
    <button class="close-button" data-close aria-label="Close reveal" type="button">
        <span aria-hidden="true">&times;</span>
    </button>
    <h1>
        <?php echo $model->id ? Yii::t("base", "Change project info") : Yii::t("base", "Add project info"); ?>
    </h1>
    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'completed-form'.$model->id,
        'action' => array("user/completedProject", 'id' => $model->id),
        'enableAjaxValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
            'validateOnChange' => true
        ),
        'htmlOptions'=>array("enctype"=>"multipart/form-data"),
    )); ?>

        <label>
            <span><?php echo $model->getAttributeLabel('name'); ?></span>
            <?php echo $form->textField($model, 'name'); ?>
        </label>
        <?php echo $form->error($model, 'name'); ?>

        <label>
            <?php if(!empty($model->image)) { ?>
                <image src="<?php echo YHelper::getImagePath($model->image, 120); ?>">
            <?php } ?>
            <span><?php echo $model->getAttributeLabel('image'); ?></span>
            <?php echo $form->fileField($model, 'image', array('extensions' => '"gif", "png", "jpg", "jpeg"')); ?>
        </label>
        <?php echo $form->error($model, 'image'); ?>

        <label>
            <span><?php echo $model->getAttributeLabel('description'); ?></span>
            <?php echo $form->textArea($model, 'description', array('rows' => 5, 'cols' => 30)); ?>
        </label>
        <?php echo $form->error($model, 'description'); ?>

        <label>
            <span><?php echo $model->getAttributeLabel('date'); ?></span>
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
        </label>

        <label>
            <span><?php echo $model->getAttributeLabel('link'); ?></span>
            <?php echo $form->textField($model, 'link'); ?>
        </label>
        <?php echo $form->error($model, 'link'); ?>

        <button class="button"><?php echo Yii::t("base", "Send info"); ?></button>
    <?php $this->endWidget(); ?>
</div>