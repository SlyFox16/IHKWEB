<?php $form = $this->beginWidget('backend.components.ActiveForm', array(
    'id' => 'user-form',
    'enableAjaxValidation' => false,
    'type'=>'horizontal',
    'htmlOptions'=>array("enctype"=>"multipart/form-data"),
)); ?>

<?php echo $model->requiredAlert(); ?>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldRow($model, 'username', array('class' => 'span5', 'maxlength' => 255)); ?>

<?php echo $form->textFieldRow($model, 'name', array('class' => 'span5', 'maxlength' => 255)); ?>

<?php echo $form->textFieldRow($model, 'surname', array('class' => 'span5', 'maxlength' => 255)); ?>

<?php echo $form->fileFieldRow($model,'avatar',array('class'=>'span5','maxlength'=>255,'hint'=>'The recommended size is <b>240x120</b>')); ?>

<?php echo $form->textFieldRow($model, 'email', array('class' => 'span5', 'maxlength' => 255)); ?>

<?php echo $form->textFieldRow($model, 'phone', array('class' => 'span5', 'maxlength' => 255)); ?>

<div class="control-group">
    <label class="control-label control-label required" for="User_username">
        <?php echo $model->getAttributeLabel('country_id'); ?>
        <span class="required">*</span>
    </label>
    <div class="controls">
        <?php $this->widget(
            'booster.widgets.TbSelect2',
            [
                'model'=>$model,
                'attribute'=>'country_id',
                'data' => User::model()->assocList,
                'asDropDownList' => true,
                'options' => [
                    'placeholder' => 'Select country',
                    'width' => '68%',
                    'allowClear' => true,
                ],
                'htmlOptions' => [
                    'class' => 'form-control'
                ],
            ]
        );?>
    </div>
</div>

<div class="control-group">
    <label class="control-label control-label required" for="User_username">
        <?php echo $model->getAttributeLabel('city_id'); ?>
        <span class="required">*</span>
    </label>
    <div class="controls">
        <?php $this->widget(
            'booster.widgets.TbSelect2',
            [
                'model'=>$model,
                'attribute'=>'city_id',
                'data' => User::model()->cityList,
                'asDropDownList' => false,
                'options' => [
                    'minimumInputLength' => 2,
                    'placeholder' => 'Select city',
                    'width' => '68%',
                    'allowClear' => true,
                    'ajax' => [
                        'url' => Yii::app()->controller->createUrl('/user/citySearch'),
                        'dataType' => 'json',
                        'data' => 'js:function(term, page) {
                                                        var country = $("#User_country_id").val();
                                                        return {q: term,  country: country};
                                                    }',
                        'results' => 'js:function(data) { return {results: data}; }',
                    ],
                    'formatResult' => 'js:productFormatResult',
                    'formatSelection' => 'js:productFormatSelection',
                ],
                'htmlOptions' => [
                    'class' => 'form-control'
                ],
            ]
        ); ?>
    </div>
</div>

<?php echo $form->textAreaRow($model, 'address', array('rows'=>6, 'cols'=>50, 'class'=>'span5')); ?>

<?php echo $form->textFieldRow($model, 'companyname', array('class' => 'span5', 'maxlength' => 255)); ?>

<?php echo $form->textAreaRow($model, 'position', array('rows'=>6, 'cols'=>50, 'class'=>'span5')); ?>

<?php echo $form->textAreaRow($model, 'description', array('rows'=>6, 'cols'=>50, 'class'=>'span5')); ?>

<?php echo $form->textFieldRow($model, 'facebook_url', array('class' => 'span5', 'maxlength' => 255)); ?>

<?php echo $form->textFieldRow($model, 'linkedin_url', array('class' => 'span5', 'maxlength' => 255)); ?>

<?php echo $form->textFieldRow($model, 'twitter_url', array('class' => 'span5', 'maxlength' => 255)); ?>

<?php echo $form->textFieldRow($model, 'xing_url', array('class' => 'span5', 'maxlength' => 255)); ?>

<?php echo $form->textFieldRow($model, 'web_url', array('class' => 'span5', 'maxlength' => 255)); ?>

<?php echo $form->textFieldRow($model, 'rating', array('class' => 'span5', 'maxlength' => 255)); ?>

<?php echo $form->textFieldRow($model, 'level', array('class' => 'span5', 'maxlength' => 255)); ?>

<?php if($model->isNewRecord) : ?>
    <?php echo $form->passwordFieldRow($model,'password',array('class'=>'span5','maxlength'=>64)); ?>
    <?php echo $form->passwordFieldRow($model,'password_repeat',array('class'=>'span5','maxlength'=>64)); ?>
<?php endif; ?>

<?php echo $form->checkBoxRow($model, 'is_active'); ?>

<?php echo $form->checkBoxRow($model, 'expert_confirm'); ?>

<?php echo $form->checkBoxRow($model, 'is_staff'); ?>

<?php $this->widget('ImageGallery', array('model' => $model, 'noUpload' => true)); ?>

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType' => 'submit',
        'type' => 'primary',
        'label' => $model->isNewRecord ? 'Create' : 'Save',
    )); ?>

    <?php /*if($model->level != $model->new_level) { */?><!--
        <?php /*echo CHtml::ajaxButton('Confirm level', $this->createUrl('/backend/user/confirmLevel/', array('id'=>$model->id)), array(
            'type'=>'POST',
            'success' => 'function(data){
                    if(data)
                        $("#yt1").remove();
            }',
        ), array('class' => "btn btn-success"));*/?>
    --><?php /*} */?>
</div>
<?php $this->endWidget(); ?>

<script>
    function productFormatSelection(city) {
        return city.name;
    }

    function productFormatResult(city) {
        var markup = city.name;
        return markup;
    }
</script>