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
        <div class="medium-6 large-9 columns">
            <div class="row">
                <div class="medium-12 large-8 columns">
                    <div class="logo">
                        <a href="<?php echo Yii::app()->homeUrl; ?>">
                            <h1><?php echo Yii::t("base", "Crowd");?></h1>
                            <p><?php echo Yii::t("base", "Innovation");?> / <?php echo Yii::t("base", "Funding");?> / <?php echo Yii::t("base", "Sourcing");?></p>
                        </a>
                    </div>  
                </div>
                <div class="small-8 medium-8 large-4 columns end">
                    <ul class="partners">
                        <li>
                            <span>präsentiert von</span>
                            <img src="<?php echo $this->assetsUrl?>/images/DCV-logo.png">
                        </li>
                        <li>
                            <span>gefördert durch</span>
                            <img src="<?php echo $this->assetsUrl?>/images/ihk-logo.png">
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="medium-6 large-3 columns">
            <div class="user-area">
                <?php if(!Yii::app()->user->isGuest && !Yii::app()->user->is_seeker) { ?>
                    <a data-tooltip href="<?php echo $this->createUrl('/user/info', array('id' => Yii::app()->user->id)); ?>" title="<?php echo Yii::t("base", "View Profile"); ?>"><b><?php echo Yii::app()->user->name; ?></b> <?php echo Yii::app()->user->surname; ?></a>
                    <a data-tooltip href="<?php echo $this->createUrl('/user/cabinet'); ?>" class="fa fa-sliders" title="<?php echo Yii::t("base", "Cabinet"); ?>"></a>
                    <?php if(Yii::app()->user->isStaff) { ?>
                        <a data-tooltip href="<?php echo $this->createUrl('/backend'); ?>" class="fa fa-bar-chart" title="<?php echo Yii::t("base", "Backend"); ?>"></a>
                    <?php } ?>
                    <a data-tooltip href="<?php echo $this->createUrl('/site/logout'); ?>" class="fa fa-sign-out" title="<?php echo Yii::t("base", "Logout"); ?>"></a>
                <?php } elseif(Yii::app()->user->is_seeker) { ?>
                    <a data-tooltip href="<?php echo $this->createUrl('/site/logout'); ?>" class="fa fa-sign-out" title="<?php echo Yii::t("base", "Logout"); ?>"></a>
                <?php } else {
                    echo CHtml::link(Yii::t("base", 'Login'), array('/site/login'), array('title' => 'Login', 'data-tooltip' => ''));
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
            <a href="<?php echo $this->createUrl('site/pages', array('id' => 1)); ?>"><?php echo Yii::t("base", "Impressum"); ?></a>
        </div>
        <div class="small-4 columns footer_contact">
            <a href="<?php echo $this->createUrl('site/feedback'); ?>" class="button"><i class="fa fa-envelope"></i> <?php echo Yii::t("base", "Get in touch"); ?></a>
        </div>
    </div>
</footer>


<?php if(!@Yii::app()->request->cookies['accept']->value) { ?>
    <div class="cookie visible">
        <div class="cookie_msg">
            <?php echo Yii::t("base", "This website uses cookies to help us give you the best experience when you visit."); ?>
        </div>
        <div class="cookie_controls"><?php echo CHtml::ajaxLink(
                $label = Yii::t("base", "Accept"),
                $url = 'site/accept',
                $ajaxOptions=array (
                    'type'=>'POST',
                    'dataType'=>'json',
                    'success'=>'function(date) {
                        if(date.result)
                            jQuery(".cookie").hide();
                    }',
                ),
                $htmlOptions=array('class' => 'accept')
                ); ?><a href="<?php echo $this->createUrl('site/pages', array('id' => 1)); ?>"><?php echo Yii::t("base", "Learn More"); ?></a></div>
    </div>
<?php } ?>
</body>
<?php $this->widget('Notifications'); ?>
</html>
