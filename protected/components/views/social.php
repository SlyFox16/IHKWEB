<ul class="social_icons clearfix">
    <?php if($facebook_href) { ?>
        <li>
            <?php echo CHtml::link('&nbsp;', $facebook_href, array('class' => 'social_icon facebook', 'target' => "_blank")); ?>
        </li>
    <?php } ?>
    <?php if($odnoklass_href) { ?>
        <li>
            <?php echo CHtml::link('&nbsp;', $odnoklass_href, array('class' => 'social_icon twitter', 'target' => "_blank")); ?>
        </li>
    <?php } ?>
    <?php if($email) { ?>
        <li>
            <?php echo CHtml::mailto('&nbsp;', $email, array('class' => 'social_icon mail')); ?>
        </li>
    <?php } ?>
    <?php if($youtube_href) { ?>
        <li>
            <?php echo CHtml::link('&nbsp;', $youtube_href, array('class' => 'social_icon youtube')); ?>
        </li>
    <?php } ?>
</ul>