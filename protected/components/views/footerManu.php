<div class="column">
    <ul class="footer_menu" style="font-size: 12px;">
        <?php foreach($categories as $category) { ?>
            <li>
                <?php echo CHtml::link($category->name, Yii::app()->createUrl('article/category', array('id' => $category->id))); ?>
            </li>
        <?php } ?>
    </ul>
</div>