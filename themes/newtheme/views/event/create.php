<?php $this->title=Yii::app()->name . ' - '. Yii::t("base", "Compose Message"); ?>
<?php $temp_id = $model->getTempId(); ?>
<!-- Breadcrumbs -->
<div class="row">
    <div class="small-12 medium-6 columns">
        <?php $this->widget('Breadcrumbs', array(
            'links' => array(
                Yii::t("base", 'Events') => array('/event/eventList'),
                Yii::t("base", "Create"),
            ),
        )); ?>
    </div>
</div>

<section class="separated separated--edge">
    <div class="row">
        <div class="medium-4 large-3 columns right-50 ">
            <ul class="messages_menu">
                <li class="<?php echo $this->_curNav == 'inbox' ? 'selected' : ''; ?>"><a href="<?php echo $this->createUrl('/event/eventList') ?>"><?php echo Yii::t("base", "Event List"); ?></a></li>
            </ul>
        </div>

        <div class="medium-8 large-9 columns separator separator--left left-50">
            <?php $form = $this->beginWidget('CActiveForm', array(
                'id' => 'event-form',
                'enableAjaxValidation' => true,
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                    'validateOnChange' => true,
                    'inputContainer' => 'fieldset',
                    'beforeValidate' => 'js:function(form){$(form).find("button[type=\'submit\']").prop("disabled", true); return true;}',
                    'afterValidate' => 'js:function(form, data, hasError){$(form).find("button[type=\'submit\']").prop("disabled", false);return !hasError;}',
                ),
                'htmlOptions'=>array("enctype"=>"multipart/form-data"),
            )); ?>
                <div class="row">
                    <div class="small-12 columns">
                        <div class="row">
                            <div class="small-12 columns">
                                <h2><?php echo Yii::t("base", 'Create New Event'); ?></h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="small-12 medium-6 columns">
                                <label>
                                    <span><?php echo $model->getAttributeLabel('title'); ?></span>
                                    <?php echo $form->textField($model,'title'); ?>
                                    <?php echo $form->error($model,'title'); ?>
                                </label>
                                <label>
                                    <span><?php echo $model->getAttributeLabel('description'); ?></span>
                                    <?php echo $form->textArea($model,'description', array('cols' => 30, 'rows' => 10)); ?>
                                    <?php echo $form->error($model,'description'); ?>
                                </label>
                                <label>
                                    <span><?php echo $model->getAttributeLabel('facebook_url'); ?></span>
                                    <?php echo $form->textField($model,'facebook_url'); ?>
                                    <?php echo $form->error($model,'facebook_url'); ?>
                                </label>
                                <label>
                                    <span><?php echo $model->getAttributeLabel('twitter_url'); ?></span>
                                    <?php echo $form->textField($model,'twitter_url'); ?>
                                    <?php echo $form->error($model,'twitter_url'); ?>
                                </label>
                                <label>
                                    <span><?php echo $model->getAttributeLabel('xing_url'); ?></span>
                                    <?php echo $form->textField($model,'xing_url'); ?>
                                    <?php echo $form->error($model,'xing_url'); ?>
                                </label>
                                <label>
                                    <span><?php echo $model->getAttributeLabel('site_url'); ?></span>
                                    <?php echo $form->textField($model,'site_url'); ?>
                                    <?php echo $form->error($model,'site_url'); ?>
                                </label>
                                <label>
                                    <span><?php echo $certificate->getAttributeLabel('date'); ?></span>
                                    <?php $this->widget(
                                        'booster.widgets.TbDatePicker',
                                        array(
                                            'model'=>$certificate,
                                            'attribute'=>"[$count]uDate",
                                            'options' => array(
                                                'format' => 'dd/mm/yyyy',
                                                'todayHighlight' => true,
                                                'endDate' => '+0d',
                                            ),
                                            'htmlOptions' => array(
                                                'placeholder' => false
                                            ),
                                        )
                                    ); ?>
                                    <?php echo $form->error($certificate, "[$count]date"); ?>
                                </label>
                                <?php $this->renderPartial('application.widgets.views.event_relation', array('model' => $model, 'temp_id' => $temp_id)); ?>
                                <?php echo $form->hiddenField($model, 'temp_id', array('value' => $temp_id)); ?>
                                <label>
                                    <span><?php echo $model->getAttributeLabel('country_id'); ?></span>
                                    <?php $this->widget(
                                        'booster.widgets.TbSelect2',
                                        [
                                            'model'=>$model,
                                            'attribute'=>'country_id',
                                            'data' => User::model()->assocList,
                                            'asDropDownList' => true,
                                            'options' => [
                                                'placeholder' => Yii::t("base", 'Select country'),
                                                'width' => '100%',
                                                'allowClear' => true,
                                            ],
                                            'htmlOptions' => [
                                                'class' => 'form-control'
                                            ],
                                        ]
                                    );?>
                                    <?php echo $form->error($model, 'country_id'); ?>
                                </label>

                                <label>
                                    <span><?php echo $model->getAttributeLabel('city_id'); ?></span>
                                    <?php $this->widget(
                                        'booster.widgets.TbSelect2',
                                        [
                                            'model'=>$model,
                                            'attribute'=>'city_id',
                                            'data' => User::model()->cityList,
                                            'asDropDownList' => false,
                                            'options' => [
                                                'minimumInputLength' => 2,
                                                'placeholder' => Yii::t("base", 'Select city'),
                                                'width' => '100%',
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
                                    <?php echo $form->error($model, 'city_id'); ?>
                                </label>
                                <label>
                                    <span><?php echo $model->getAttributeLabel('image'); ?></span>
                                    <?php echo $form->fileField($model, 'image', array('extensions' => '"gif", "png", "jpg", "jpeg"')); ?>
                                    <?php echo $form->error($model,'image'); ?>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row bottom-edge">
                    <div class="small-12 columns">
                        <div class="button-group">
                            <?php echo
                                CHtml::linkButton(
                                $model->isNewRecord ? Yii::t("base", 'Create event') : Yii::t("base", 'Update event'),
                                array('class' => 'button large'));
                            ?>
                        </div>
                    </div>
                </div>
            <?php $this->endWidget(); ?>
        </div>
    </div>
</section>

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