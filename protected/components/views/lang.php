<div class="latest_news_scrolling_list_container">
    <ul>
        <li class="left" style="display: list-item;">
            <?php echo CHtml::link('RU', Yii::app()->createUrl('site/change', array('lang' => 'ru'))); ?>
        </li>
        <li class="right" style="display: list-item;">
            <?php echo CHtml::link('RO', Yii::app()->createUrl('site/change', array('lang' => 'ro'))); ?>
        </li>
    </ul>
</div>