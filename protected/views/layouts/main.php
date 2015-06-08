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
    <?php echo CHtml::link('Login', array('/site/login')); ?>
    <?php if(!Yii::app()->user->isGuest) {
        echo Chtml::link('Hello '.Yii::app()->user->full_Name, array('/user/info', 'id' => Yii::app()->user->id));
        echo CHtml::tag('br');
        echo Chtml::link('Logout ', array('/site/logout'));
        echo CHtml::tag('br');
        echo CHtml::link('Cabinet', array('/user/cabinet', 'id' => Yii::app()->user->id));
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