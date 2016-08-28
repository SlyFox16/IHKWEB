<li>
    <div><?php echo ++$index; ?></div>
    <div class="experts_photo">
        <a href="<?php echo $this->createUrl('user/info', array('id' => $data->id)); ?>"><img src="<?php echo YHelper::getImagePath($data->avatar, 280, 280); ?>" alt="Expert"></a>
    </div>
    <div class="experts_info">
        <h2><b><?php echo $data->name; ?></b> <?php echo $data->surname; ?></h2>
        <span><?php echo User::getCityCountry($data->country_id, 'country').', '.User::getCityCountry($data->city_id, 'city'); ?></span>
    </div>
    <div class="experts_meta">
        <ul class="stats">
            <li><b><?php echo $data->rating; ?></b> <?php echo Yii::t("base", "Rating"); ?></li>
            <li><b><?php echo $data->level; ?></b> <?php echo Yii::t("base", "Level"); ?></li>
        </ul>
    </div>
    <div class="experts_view">
        <a href="<?php echo $this->createUrl('user/info', array('id' => $data->id)); ?>" class="button"><?php echo Yii::t("base", "View Profile"); ?></a>
    </div>
</li>