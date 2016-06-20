<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,300' rel='stylesheet' type='text/css'/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/motion-ui/1.1.1/motion-ui.min.css" />
</head>
<body>

<!--===============================-->
<!--== Header =====================-->
<!--===============================-->
<header data-stellar-ratio="1.4">
    <div class="row">
        <div class="medium-6 columns">
            <div class="logo">
                <h1>Crowd</h1>
                <p>Innovation / Funding / Sourcing</p>
            </div>
        </div>
        <div class="medium-6 columns">
            <div class="user-area">
                <?php if(!Yii::app()->user->isGuest) { ?>
                    <a href="<?php echo $this->createUrl('/user/info', array('id' => Yii::app()->user->id)); ?>" title="<?php echo Yii::t("base", "View Profile"); ?>"><b><?php echo Yii::app()->user->name; ?></b> <?php echo Yii::app()->user->surname; ?></a>
                    <a href="<?php echo $this->createUrl('/user/cabinet'); ?>" class="fa fa-sliders" title="<?php echo Yii::t("base", "Cabinet"); ?>"></a>
                    <?php if(Yii::app()->user->isStaff) { ?>
                        <a href="<?php echo $this->createUrl('/backend'); ?>" class="fa fa-bar-chart" title="<?php echo Yii::t("base", "Backend"); ?>"></a>
                    <?php } ?>
                    <a href="<?php echo $this->createUrl('/site/logout'); ?>" class="fa fa-sign-out" title="<?php echo Yii::t("base", "Logout"); ?>"></a>
                <?php } elseif(Yii::app()->user->is_seeker) { ?>
                    <a href="<?php echo $this->createUrl('/site/logout'); ?>" class="fa fa-sign-out" title="<?php echo Yii::t("base", "Logout"); ?>"></a>
                <?php } else {
                    echo CHtml::link('Login', array('/site/login'), array('title' => 'Login'));
                } ?>
            </div>
        </div>
    </div>
</header>

<?php echo $content; ?>

<!--===============================-->
<!--== Footer =====================-->
<!--===============================-->
<footer>
    <div class="row">
        <div class="small-8 columns">
            <p><?php echo yiisetting('footer_info'); ?></p>
        </div>
        <div class="small-4 columns footer_contact">
            <a href="<?php echo $this->createUrl('site/feedback'); ?>" class="button"><i class="fa fa-envelope"></i> <?php echo Yii::t("base", "Get in touch"); ?></a>
        </div>
    </div>
</footer>


<!--<div class="cookie show">
    <div class="cookie_msg">
        This website uses cookies to help us give you the best experience when you visit.
    </div>
    <div class="cookie_controls"><a class='accept'>Accept</a><a href="policy.html">Learn More</a></div>
</div>-->

</body>
</html>