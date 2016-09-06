
    <?php $form=$this->beginWidget('CActiveForm',array(
        'id' => 'extended-search',
        'action'=>Yii::app()->createUrl($this->route),
        'method'=>'get',
    )); ?>
    <!--== Filters ==-->
        <div class="filters">
            <label>
                <span><?php echo $model->getAttributeLabel('name'); ?></span>
                 <?php echo $form->textField($model,'name',array('placeholder' => Yii::t("base", 'First Name'))); ?>
            </label>
            <label>
                <span><?php echo $model->getAttributeLabel('surname'); ?></span>
                <?php echo $form->textField($model,'surname',array('placeholder' => Yii::t("base", 'Second Name'))); ?>
            </label>
            <label>
                <span><?php echo $model->getAttributeLabel('city_id'); ?></span>
                <?php $this->widget(
                    'booster.widgets.TbSelect2',
                    [
                        'model'=>$model,
                        'attribute'=>'city_id',
                        'asDropDownList' => false,
                        'options' => [
                            'minimumInputLength' => 2,
                            'placeholder' => Yii::t("base", 'City'),
                            'width' => '100%',
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
                            'initSelection' => 'js:cityInitSelection',
                            'formatResult' => 'js:productFormatResult',
                            'formatSelection' => 'js:productFormatSelection',
                        ],
                        'htmlOptions' => [
                            'class' => 'form-control'
                        ],
                    ]
                ); ?>
            </label>
            <label>
                <span><?php echo $model->getAttributeLabel('level'); ?></span>
                <?php echo $form->textField($model,'level',array('class'=>'span5 small', 'placeholder' => Yii::t("base", 'Level'))); ?>
            </label>
            <label>
                <span><?php echo $model->getAttributeLabel('rating'); ?></span>
                <?php echo $form->textField($model,'rating',array('class'=>'span5 small', 'placeholder' => Yii::t("base", 'Rating'))); ?>
            </label>
            <?php echo CHtml::linkButton(Yii::t("base", 'Search'), array('class' => 'button')); ?>
        </div>
    <?php $this->endWidget(); ?>


<?php
    Yii::app()->clientScript->registerScript('searchUser', "
        $('.search-form form').submit(function(){
            var self = $(this);
            $.fn.yiiListView.update('rating-log-grid', {
                data: $(this).serialize(),
                complete:function() {
                    self.find('button').toggleClass('searching-class');
                }
            });
            self.find('button').toggleClass('searching-class');
            return false;
        });
    ");
?>

<script>
    function cityInitSelection(element, callback) {
        var ret = <?php echo $model->selectedCity; ?>;

        var data = {'id':ret.id , 'name': ret.value};
        callback(data);
    }

    function productFormatSelection(city) {
        return city.name;
    }

    function productFormatResult(city) {
        var markup = city.name;
        return markup;
    }
</script>