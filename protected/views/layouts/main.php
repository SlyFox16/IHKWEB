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
        <div class="logo">
            <h1>Crowd</h1>
            <p>Innovation / Funding / Sourcing</p>
        </div>
    </div>
    <?php if(!Yii::app()->user->isGuest) {
        echo Chtml::link('Hello '.Yii::app()->user->getState('fullname'), '#');
        CHtml::tag('br');
        echo Chtml::link('Logout ', array('/site/logout'));
    } ?>
</header>

<?php echo $content; ?>

<footer>
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <p>Rue du Fossé-aux-Loups 47, 1000  Brussels, Belgium<br>
                    (123) 456-7890, contact@ihk.de</p>
            </div>
            <div class="col-sm-4 footer-contact">
                <a href="" class="angle">Get in touch</a>
            </div>
        </div>
    </div>
</footer>
</body>
</html>