
    <?php $form=$this->beginWidget('CActiveForm',array(
        'id' => 'extended-search',
        'action'=>Yii::app()->createUrl($this->route),
        'method'=>'get',
    )); ?>
    <!--== Page Control ==-->
    <div class="small-12 medium-8 columns">
        <ul class="control wow bounceInRight animated" data-wow-duration="0.5s" data-wow-delay="0.5s">
            <li>
                <?php echo $form->textField($model,'name'); ?>
            </li>
            <li>
                <?php echo $form->textField($model,'surname'); ?>
            </li>
            <li>
                <?php $this->widget(
                    'booster.widgets.TbSelect2',
                    [
                        'model'=>$model,
                        'attribute'=>'city_id',
                        'asDropDownList' => false,
                        'options' => [
                            'minimumInputLength' => 2,
                            'placeholder' => 'Select City',
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
            </li>
            <li>
                <?php echo $form->textField($model,'level',array('class'=>'span5', 'placeholder' => 'Level')); ?>
            </li>
            <li>
                <?php echo $form->textField($model,'rating',array('class'=>'span5', 'placeholder' => 'Rating')); ?>
            </li>
            <li>
                <?php echo CHtml::linkButton('', array('class' => 'fa fa-search')); ?>
            </li>
        </ul>
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
        var markup = "<table class='result'><tr>";
        markup += "<td class='info'><div class='title'>" + city.name + "</div>";
        markup += "</td></tr></table>";
        return markup;
    }
</script>