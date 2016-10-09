<div class="small-12 medium-8 columns">

    <?php echo CHtml::script("
        function split(val) {
            return val.split(/,\s*/);
        }
        function extractLast(term) {
            return split(term).pop();
        }
    ")?>

    <ul class="control wow bounceInRight animated" data-wow-duration="0.5s" data-wow-delay="0.5s">
        <?php $form = $this->beginWidget('CActiveForm', array(
            'id'=>'search-form',
            'method' => 'get',
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

        <li class="search">
            <?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                'name'=>'searchfield',
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
                        // add the selected item
                        this.value = ui.item.value;
                        $('#search-form').submit();
                        return false;
                    }",
                ),
                'htmlOptions'=>array(
                    'placeholder' => Yii::t("base", 'Search'),
                ),
            )); ?>
            <?php echo CHtml::linkButton('', array('class' => 'fa fa-search')); ?>
        </li>
        <li>
            <a href="<?php echo Yii::app()->createUrl('site/findexperts'); ?>"><?php echo Yii::t("base", "Experts"); ?></a>
            <a href="<?php echo Yii::app()->createUrl('event/eventList'); ?>"><?php echo Yii::t("base", "Events"); ?></a>
        </li>
        <?php $this->endWidget(); ?>
    </ul>
</div>

<?php
Yii::app()->clientScript->registerScript('unique.script.identifier', "
        $('#searchfield').data('autocomplete')._renderItem = function( ul, item ) {
            var re = new RegExp( '(' + $.ui.autocomplete.escapeRegex(this.term) + ')', 'gi' );
            var highlightedResult = item.label.replace( re, '<b>$1</b>' );
            return $( '<li></li>' )
                .data( 'item.autocomplete', item )
                .append( '<a>' + highlightedResult + '</a>' )
                .appendTo( ul );
        };
    ");
?>