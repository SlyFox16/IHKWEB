<div class="expert">
    <a href="<?php echo $this->createUrl('user/info', array('id' => $data->id)); ?>">
        <img src="<?php echo YHelper::getImagePath($data->avatar, 280, 280); ?>" alt="<?php echo Yii::t("base", "Expert"); ?>">
    </a>
    <ul class="expert_cat">
        <?php if(!empty($data->certificates)) { ?>
            <?php foreach($data->certificates as $cert) { ?>
                <li data-tooltip aria-haspopup="true" class="left" title="<?php echo $cert->certificate->name; ?>"><?php echo $cert->certificate->name; ?></li>
            <?php } ?>
        <?php } ?>
    </ul>
    <div class="expert_info">
        <h3><a href="<?php echo $this->createUrl('user/info', array('id' => $data->id)); ?>"><b><?php echo $data->name; ?></b> <?php echo $data->surname; ?></a></h3>
        <span class="expert_level"><?php echo Yii::t("base", "Level"); ?> <?php echo $data->level; ?></span>
    </div>
</div>