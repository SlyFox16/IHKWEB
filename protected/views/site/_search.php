<div class="search-form">
    <?php $form=$this->beginWidget('CActiveForm',array(
        'action'=>Yii::app()->createUrl($this->route),
        'method'=>'get',
    )); ?>

        <?php echo $form->textField($model,'name',array('class'=>'span5', 'placeholder' => 'Name')); ?>

        <?php echo $form->textField($model,'surname',array('class'=>'span5', 'placeholder' => 'Surname')); ?>

        <?php $this->widget(
            'booster.widgets.TbSelect2',
            [
                'model'=>$model,
                'attribute'=>'city_id',
                'data' => User::model()->cityList,
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
                    'formatResult' => 'js:productFormatResult',
                    'formatSelection' => 'js:productFormatSelection',
                ],
                'htmlOptions' => [
                    'class' => 'form-control'
                ],
            ]
        ); ?>

        <?php echo $form->textField($model,'level',array('class'=>'span5', 'placeholder' => 'Level')); ?>

        <?php echo $form->textField($model,'rating',array('class'=>'span5', 'placeholder' => 'Rating')); ?>

        <button class="button" type="submit">Save <i class="fa fa-circle-o-notch"></i></button>

    <?php $this->endWidget(); ?>
</div>

<?php
    Yii::app()->clientScript->registerScript('searchUser', "
    $('.search-form form').submit(function(){
        $.fn.yiiListView.update('rating-log-grid', {
            data: $(this).serialize()
        });
        return false;
    });
    ");
?>

<script>
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