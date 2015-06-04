<div class="column column_1_3 <?php echo isFrontPage() ? '' : 'page_margin_top'; ?>">

<?php if(!empty($video)) { ?>
    <h4 class="box_header"><?php echo Yii::t("base", "Видеожурнал"); ?></h4>
    <div class="horizontal_carousel_container big page_margin_top">
        <ul class="blog horizontal_carousel visible-1 autoplay-0 scroll-1 navigation-1 easing-easeInOutQuint duration-750">
            <li class="post">
                <a title="<?php echo $video->title; ?>" href="<?php echo Yii::app()->createUrl('article/view', array('id' => $video->id)); ?>">
                    <span class="icon video"></span>
                    <?php echo CHtml::image(Yii::app()->iwi->load($video->image)->adaptive(330, 242)->cache(), $video->title); ?>
                </a>
                <h5 class="with_number">
                    <a href="<?php echo Yii::app()->createUrl('article/view', array('id' => $video->id)); ?>" title="Struggling Nuremberg Sack Coach Verbeek"><?php echo $video->title; ?></a>
                </h5>
                <ul class="post_details simple">
                    <li class="date">
                        <?php echo Yii::app()->format->sliderDate($video->created); ?>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
<?php } ?>

<?php if(!empty($events)) { ?>
    <h4 class="box_header page_margin_top_section"><?php echo Yii::t("base", 'События'); ?></h4>
    <div class="vertical_carousel_container clearfix">
        <ul class="blog small vertical_carousel autoplay-1 scroll-1 navigation-1 easing-easeInOutQuint duration-750">
            <?php foreach($events as $event) { ?>
                <li class="post">
                    <a href="<?php echo Yii::app()->createUrl('article/view', array('id' => $event->id)); ?>">
                        <span class="icon small gallery"></span>
                        <?php echo CHtml::image(Yii::app()->iwi->load($event->eventImage)->adaptive(100, 100)->cache(), $event->title); ?>
                    </a>
                    <div class="post_content">
                        <h5>
                            <a href="<?php echo Yii::app()->createUrl('article/view', array('id' => $event->id)); ?>">
                                <?php echo $event->title; ?>
                            </a>
                        </h5>
                    </div>
                </li>
            <?php } ?>
        </ul>
    </div>
<?php } ?>

<?php if(!empty($infographic)) { ?>
    <h4 class="box_header page_margin_top_section"><?php echo Yii::t("base", 'Инфографика'); ?></h4>
    <ul class="blog small_margin clearfix">
        <li class="post">
            <a href="<?php echo Yii::app()->createUrl('article/view', array('id' => $infographic->id)); ?>" title="">
                    <img src="<?php echo Yii::app()->iwi->load($infographic->image)->resize(330,0,Image::AUTO)->crop(330, 242, "top")->cache(); ?>" width="330" alt="img" style="display: block;">
            </a>
        </li>
    </ul>
<?php } ?>

<?php if(!empty($photoes)) { ?>
    <h4 class="box_header page_margin_top_section"><?php echo Yii::t("base", "Фотоконкурс"); ?></h4>
    <?php $this->widget('SliderWidget', array('sidebar' => true)); ?>
<?php } ?>

<?php if(!empty($countBanners)) { ?>
    <!--<h4 class="box_header page_margin_top_section"><?php /*echo Yii::t("base", 'Баннеры'); */?></h4>-->
    <ul class="blog small_margin clearfix">
        <?php $this->widget("Banners", array('position' => 'right_top', 'limit' => 1)); ?>
        <?php $this->widget("Banners", array('position' => 'right_center', 'limit' => 1)); ?>
        <?php $this->widget("Banners", array('position' => 'right_bottom', 'limit' => 1)); ?>
    </ul>
<?php } ?>

<div class="social_block">
    <h4 class="box_header page_margin_top_section"><?php echo Yii::t("base", 'Социальные сети'); ?></h4>
    <ul class="blog small_margin clearfix">
        <li style="margin-top: 30px;">
            <div class="fb-page" data-href="https://www.facebook.com/pages/Moldova-%C3%AEn-pas-cu-Europa/294954980628197" data-hide-cover="false" data-show-facepile="true" data-show-posts="false"></div>
        </li>
        <li class="post">
            <div id="ok_group_widget"></div>
        </li>
    </ul>
</div>



<script>
    !function (d, id, did, st) {
        var js = d.createElement("script");
        js.src = "http://connect.ok.ru/connect.js";
        js.onload = js.onreadystatechange = function () {
            if (!this.readyState || this.readyState == "loaded" || this.readyState == "complete") {
                if (!this.executed) {
                    this.executed = true;
                    setTimeout(function () {
                        OK.CONNECT.insertGroupWidget(id,did,st);
                    }, 0);
                }
            }}
        d.documentElement.appendChild(js);
    }(document,"ok_group_widget","52473034899651","{width:332,height:300}");
</script>

