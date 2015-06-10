<ul class="social-links">
    <?php if($facebook_url) { ?>
        <?php echo CHtml::link('&nbsp;', $facebook_url, array('class' => 'fa fa-facebook', 'target' => "_blank")); ?>
    <?php } ?>
    <?php if($twitter_url) { ?>
        <?php echo CHtml::link('&nbsp;', $twitter_url, array('class' => 'fa fa-twitter', 'target' => "_blank")); ?>
    <?php } ?>
    <?php if($linkedin_url) { ?>
        <?php echo CHtml::link('&nbsp;', $linkedin_url, array('class' => 'fa fa-linkedin')); ?>
    <?php } ?>
    <?php if($gp_url) { ?>
        <?php echo CHtml::link('&nbsp;', $gp_url, array('class' => 'fa fa-google-plus')); ?>
    <?php } ?>
</ul>