<?php $this->pageTitle = Yii::app()->name . ' - Главная'; ?>

<!--<div class="row-fluid">
    <div class="span12">
        <ul class="dshb_icoNav tac">
            <li><a href="<?php /*echo Yii::app()->createUrl("backend/order/admin"); */?>" style="background-image: url(<?php /*echo $this->module->assetsUrl; */?>/img/gCons/bar-chart.png)">Заказы</a></li>
            <li><a href="<?php /*echo Yii::app()->createUrl("backend/user/admin"); */?>" style="background-image: url(<?php /*echo $this->module->assetsUrl; */?>/img/gCons/agent.png)">Пользователь</a></li>
            <?php /*if(!$user->is_operator) : */?>
                <li><a href="<?php /*echo Yii::app()->createUrl("backend/page/admin"); */?>" style="background-image: url(<?php /*echo $this->module->assetsUrl; */?>/img/gCons/copy-item.png)">Страницы</a></li>
                <li><a href="<?php /*echo Yii::app()->createUrl("backend/settings/admin"); */?>" style="background-image: url(<?php /*echo $this->module->assetsUrl; */?>/img/gCons/processing-02.png)">Конфигурация</a></li>
                <li><a href="<?php /*echo Yii::app()->createUrl("backend/category/admin"); */?>" style="background-image: url(<?php /*echo $this->module->assetsUrl; */?>/img/gCons/tree.png)">Категории</a></li>
                <li><a href="<?php /*echo Yii::app()->createUrl("backend/faq/admin"); */?>" style="background-image: url(<?php /*echo $this->module->assetsUrl; */?>/img/gCons/happy-face.png)">FAQ</a></li>
                <li><a href="<?php /*echo Yii::app()->createUrl("backend/slider/admin"); */?>" style="background-image: url(<?php /*echo $this->module->assetsUrl; */?>/img/gCons/full-screen.png)">Слайдер</a></li>
                <li><a href="<?php /*echo Yii::app()->createUrl("backend/news/admin"); */?>" style="background-image: url(<?php /*echo $this->module->assetsUrl; */?>/img/gCons/chat-02.png)">Новости</a></li>
            <?php /*endif; */?>
        </ul>
    </div>
</div>-->

<div class="row-fluid">
    <?php $this->widget('LastUsers'); ?>
</div>