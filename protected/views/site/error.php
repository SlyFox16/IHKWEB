<div class="page">
    <div class="page_header clearfix page_margin_top">
        <div class="page_header_left">
            <h1 class="page_title"><?php echo Yii::t("base", 'Ошибка 404'); ?></h1>
        </div>
        <div class="page_header_right">
            <ul class="bread_crumb">
                <li>
                    <a title="<?php echo Yii::t("base", 'Главная'); ?>" href="?page=home">
                        <?php echo Yii::t("base", 'Главная'); ?>
                    </a>
                </li>
                <li class="separator icon_small_arrow right_gray">
                    &nbsp;
                </li>
                <li>
                    <?php echo Yii::t("base", 'Ошибка 404'); ?>
                </li>
            </ul>
        </div>
    </div>
    <div class="page_layout clearfix">
        <div class="divider_block clearfix">
            <hr class="divider first">
            <hr class="divider subheader_arrow">
            <hr class="divider last">
        </div>
        <div class="row page_margin_top">
            <div class="column column_2_3">
                <div class="item_content clearfix">
                    <span class="features_icon not_found animated_element animation-scale scale" style="-webkit-animation-duration: 600ms; -webkit-animation-delay: 0ms; transition-delay: 0ms; -webkit-transition-delay: 0ms;"></span>
                    <div class="text">
                        <h1 class="about_title"><?php echo Yii::t("base", 'Страница'); ?></h1>
                        <h1 class="about_subtitle"><?php echo Yii::t("base", 'не существует'); ?></h1>
                    </div>
                </div>
                <h3 class="page_margin_top"><?php echo Yii::t("base", 'Приносим извинения, но данной страницы не существует, или она временно недоступна.'); ?>
                    <?php echo Yii::t("base", 'Возможно вы ввели некорректный адресс страницы.'); ?></h3>
            </div>
            <?php $this->widget('Sidebar'); ?>
        </div>
    </div>
</div>