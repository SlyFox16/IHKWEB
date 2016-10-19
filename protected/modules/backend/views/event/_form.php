<?php $form=$this->beginWidget('backend.components.ActiveForm',array(
	'id'=>'event-form',
	'enableAjaxValidation'=>false,
	'type'=>'horizontal',
    'htmlOptions'=>array("enctype"=>"multipart/form-data"),
)); ?>

    <?php echo $model->requiredAlert(); ?>	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'title',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->tinyMceRow($model,'description',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textFieldRow($model,'facebook_url',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'twitter_url',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'xing_url',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'site_url',array('class'=>'span5','maxlength'=>255)); ?>

    <?php echo $form->fileFieldRow($model,'image',array('class'=>'span5','maxlength'=>255)); ?>

    <div class="control-group">
        <label class="control-label control-label required" for="User_username">
            <?php echo $model->getAttributeLabel('country_id'); ?>
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
                        'width' => '55%',
                        'allowClear' => true,
                    ],
                    'htmlOptions' => [
                        'class' => 'form-control'
                    ],
                ]
            );?>
        </div>
        <?php echo $form->error($model, 'country_id'); ?>
    </div>

    <div class="control-group">
        <label class="control-label control-label required" for="User_username">
            <?php echo $model->getAttributeLabel('city_id'); ?>
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
                        'width' => '55%',
                        'allowClear' => true,
                        'ajax' => [
                            'url' => Yii::app()->controller->createUrl('/user/citySearch'),
                            'dataType' => 'json',
                            'data' => 'js:function(term, page) {
                                var country = $("#Event_country_id").val();
                                return {q: term,  country: country};
                            }',
                            'results' => 'js:function(data) { return {results: data}; }',
                        ],
                        'initSelection' => 'js:cityInitSelection',
                        'formatResult' => 'js:productFormatResult',
                        'formatSelection' => 'js:productFormatSelection',
                    ],
                    'htmlOptions' => [
                        'class' => 'form-control'
                    ],
                ]
            ); ?>
        </div>
        <?php echo $form->error($model, 'city_id'); ?>
    </div>

	<?php echo $form->textFieldRow($model,'address',array('class'=>'span5','maxlength'=>255)); ?>

    <?php echo $form->dateRangeFieldRow($model, 'date_range', 'DD/MM/YYYY', array('class'=>'span5','maxlength'=>255, 'value' => $model->dateRange)); ?>

    <?php echo $form->checkBoxRow($model, 'active'); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
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

    function cityInitSelection(element, callback) {
        var ret = <?php echo $model->selectedCity; ?>;

        var data = {'id':ret.id , 'name': ret.value};
        callback(data);
    }
</script>