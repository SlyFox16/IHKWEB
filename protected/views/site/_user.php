<div class="expert">
    <a href="<?php echo $this->createUrl('user/info', array('id' => $data->id)); ?>">
        <img src="<?php echo Yii::app()->iwi->load($data->UAvatar)->adaptive(280, 280)->cache(); ?>" alt="Expert">
    </a>
    <div class="expert-info">
        <h3>
            <a href="<?php echo $this->createUrl('user/info', array('id' => $data->id)); ?>">
                <b><?php echo $data->name; ?></b> <?php echo $data->surname; ?>
            </a>
        </h3>
        <ul class="expert-certification">
            <?php if(!empty($data->certificates)) { ?>
                <?php foreach($data->certificates as $cert) { ?>
                    <li><?php echo $cert->certificate->name; ?></li>
                <?php } ?>
            <?php } ?>
        </ul>
        <span class="expert-level">Level <?php echo $user->level; ?></span>
    </div>
</div>