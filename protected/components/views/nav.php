<div class="menu_container clearfix">
    <nav>
        <ul class="sf-menu" style="<?php if (Yii::app()->language == 'ru') { echo 'width:740px';} ?>">
            <?php foreach($categories as $category) { ?>
                <li <?php echo (Yii::app()->controller->_curNav == $category->id) ? 'class="selected"' : ''; ?>>
                    <?php echo CHtml::link($category->menuname, Yii::app()->createUrl('article/category', array('id' => $category->id))); ?>
                </li>
            <?php } ?>
        </ul>
    </nav>


<!--//=====================mobile===================-->
<div class="mobile_menu_container">
    <a href="#" class="mobile-menu-switch">
        <span class="line"></span>
        <span class="line"></span>
        <span class="line"></span>
    </a>
    <div class="mobile-menu-divider"></div>
        <nav>
        <ul class="mobile-menu">
            <?php foreach($categories as $category) { ?>
                <li class="submenu">
                    <?php echo CHtml::link($category->name, Yii::app()->createUrl('article/category', array('id' => $category->id))); ?>
                </li>
            <?php } ?>
        </ul>
        </nav>
    </div>
</div>