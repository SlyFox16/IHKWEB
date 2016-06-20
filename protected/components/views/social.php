<ul class="socials">
    <?php if($facebook_url) { ?>
        <?php echo CHtml::link('', $facebook_url, array('class' => 'fa fa-facebook', 'target' => "_blank")); ?>
    <?php } ?>
    <?php if($twitter_url) { ?>
        <?php echo CHtml::link('', $twitter_url, array('class' => 'fa fa-twitter', 'target' => "_blank")); ?>
    <?php } ?>
    <?php if($linkedin_url) { ?>
        <?php echo CHtml::link('', $linkedin_url, array('class' => 'fa fa-linkedin')); ?>
    <?php } ?>
    <?php if($gp_url) { ?>
        <?php echo CHtml::link('', $gp_url, array('class' => 'fa fa-google-plus')); ?>
    <?php } ?>
</ul>