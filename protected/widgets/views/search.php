<div class="container relative no-padding">

    <?php echo CHtml::script("
        function split(val) {
            return val.split(/,\s*/);
        }
        function extractLast(term) {
            return split(term).pop();
        }
    ")?>

    <!--== Page Control ==-->
    <ul class="page-control wow bounceInRight" data-wow-duration="0.5s" data-wow-delay="0.5s">
        <li class="search">
            <?php $form = $this->beginWidget('CActiveForm', array(
                'id'=>'search-form',
                'action' => array('/search/search'),
                'enableAjaxValidation'=>true,
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                    'validateOnChange' => true,
                ),
                'htmlOptions'=>array(
                    'class'=>'search',
                ),
            )); ?>
                <?php
                    $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                        'model'=>$model,
                        'attribute'=>'searchfield',
                        'source'=>"js:function(request, response) {
                            $.getJSON('".Yii::app()->createUrl('site/suggest')."', {
                            term: extractLast(request.term)
                            }, response);
                        }",
                        'options'=>array(
                            'delay'=>300,
                            'minLength'=>2,
                            'showAnim'=>'fold',
                            'multiple'=>true,
                            'select'=>"js:function(event, ui) {
                                var terms = split(this.value);
                                // remove the current input
                                terms.pop();
                                // add the selected item
                                terms.push( ui.item.value );
                                $('#search-form').submit();
                                return false;
                            }",
                        ),
                        'htmlOptions'=>array(
                            'size'=>'40',
                            'placeholder' => 'Search',
                        ),
                    ));
                ?>
                <?php echo $form->error($model, 'searchfield'); ?>
                <?php echo CHtml::linkButton('', array('class' => 'fa fa-search')); ?>
            <?php $this->endWidget(); ?>
        </li>
        <li>
            <a href="<?php echo Yii::app()->createUrl('site/findexperts'); ?>" class="fa fa-chevron-right"></a>
        </li>
    </ul>
</div>

<?php
    Yii::app()->clientScript->registerScript('unique.script.identifier', "
        $('#SearchModel_searchfield').data('autocomplete')._renderItem = function( ul, item ) {
            var re = new RegExp( '(' + $.ui.autocomplete.escapeRegex(this.term) + ')', 'gi' );
            var highlightedResult = item.label.replace( re, '<b>$1</b>' );
            return $( '<li></li>' )
                .data( 'item.autocomplete', item )
                .append( '<a>' + highlightedResult + '</a>' )
                .appendTo( ul );
        };
    ");
?>