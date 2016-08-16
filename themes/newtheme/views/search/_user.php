<div class="expertcard">
    <div class="medium-2 columns">
        <a href="<?php echo $this->createUrl('user/info', array('id' => $data->id)); ?>"><img src="<?php echo YHelper::getImagePath($data->avatar, 280, 280); ?>" alt="<?php echo Yii::t("base", "Expert"); ?>"></a>
    </div>
    <div class="medium-8 columns">
        <div class="expert_name">
            <h2><b><?php echo $data->name; ?></b> <?php echo $data->surname; ?></h2>
        </div>
        <h3><?php echo $data->position; ?></h3>
        <a href="<?php echo $this->createUrl('user/info', array('id' => $data->id)); ?>" class="button"><?php echo Yii::t("base", "View Profile"); ?></a>
    </div>
    <div class="medium-2 columns">
        <ul class="stats">
            <li><?php echo Yii::t("base", "Rating"); ?> <b><?php echo $data->rating; ?></b></li>
            <li><?php echo Yii::t("base", "Level"); ?> <b><?php echo $data->level; ?></b></li>
        </ul>
    </div>
</div>