<li>
    <div class="experts_photo">
        <a href="<?php echo $this->createUrl('user/info', array('id' => $data->id)); ?>"><img alt="Expert" src="<?php echo YHelper::getImagePath($data->avatar, 280, 280); ?>"></a>
    </div>
    <div class="experts_info">
        <h2><a href="<?php echo $this->createUrl('user/info', array('id' => $data->id)); ?>"><b><?php echo $data->name; ?></b> <?php echo $data->surname; ?></a></h2>
        <span><?php echo User::getCityCountry($data->country_id, 'country').', '.User::getCityCountry($data->city_id, 'city'); ?></span>
        <h3><?php echo $data->position; ?></h3>
<!--         <?php if($data->speciality) { ?>
            <ul class="expert_domain">
                <?php foreach($data->speciality as $speciality) { ?>
                    <li><?php echo $speciality->speciality; ?></li>
                <?php } ?>
            </ul>
        <?php } ?> -->
    </div>
    <div class="experts_meta">
        <ul class="stats">
            <li><b><?php echo $data->rating; ?></b> <?php echo Yii::t("base", "Rating"); ?></li>
            <li><b><?php echo $data->level; ?></b> <?php echo Yii::t("base", "Level"); ?></li>
        </ul>
    </div>
</li>