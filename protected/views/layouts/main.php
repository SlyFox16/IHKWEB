<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>IHK - Homepage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Google Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700,800,600' rel='stylesheet' type='text/css'>

</head>
<body>
<!--===============================-->
<!--== Header =====================-->
<!--===============================-->
<header data-stellar-ratio="1.4">
    <div class="container">
        <a href="<?php echo Yii::app()->homeUrl; ?>">
            <div class="logo">
                <h1>Crowd</h1>
                <p>Innovation / Funding / Sourcing</p>
            </div>
        </a>
    </div>
    <?php if(!Yii::app()->user->isGuest) { ?>
        <div class="user-area">
            <a href="<?php echo $this->createUrl('/user/info', array('id' => Yii::app()->user->id)); ?>"><b><?php echo Yii::app()->user->name; ?></b> <?php echo Yii::app()->user->surname; ?></a>
            <a href="<?php echo $this->createUrl('/user/cabinet'); ?>" class="fa fa-sliders"></a>
            <a href="<?php echo $this->createUrl('/site/logout'); ?>" class="fa fa-sign-out"></a>
            <?php if(Yii::app()->user->isStaff) { ?>
                <a href="<?php echo $this->createUrl('/backend'); ?>" class="fa fa-sign-out"></a>
            <?php } ?>
        </div>
    <? } else {
        echo CHtml::link('Login', array('/site/login'));
    } ?>
</header>

<?php echo $content; ?>

<footer>
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <p><?php echo yiisetting('footer_info'); ?></p>
            </div>
            <div class="col-sm-4 footer-contact">
                <a href="<?php echo yiisetting('get_in_touch_url', null); ?>" class="angle">Get in touch</a>
            </div>
        </div>
    </div>
</footer>
</body>
</html>