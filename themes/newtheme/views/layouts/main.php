<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <?php Yii::app()->getController()->widget(
        'application.vendor.chemezov.yii-seo.widgets.SeoHead',
        array(
            'defaultTitle' => 'IHK',
            'defaultDescription' => 'IHK Company',
            'defaultKeywords' => 'IHK Keywords',
            'defaultCanonical' => Yii::app()->createAbsoluteUrl(Yii::app()->request->requestUri),
            'app_id' => '804272606339674'
        )
    ); ?>

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
        <div class="medium-12 large-7 columns">
            <div class="row">
                <div class="medium-12 large-6 columns">
                    <div class="logo">
                        <a href="<?php echo Yii::app()->homeUrl; ?>">
                            <h1><?php echo Yii::t("base", "Crowd");?></h1>
                            <p><?php echo Yii::t("base", "Innovation");?> / <?php echo Yii::t("base", "Funding");?> / <?php echo Yii::t("base", "Sourcing");?></p>
                        </a>
                    </div>  
                </div>
                <div class="small-10 medium-6 large-6 columns end">
                    <ul class="partners">
                        <li>
                            <span>präsentiert von</span>
                            <a href="http://www.crowdsourcingverband.de/" target="_blank">
                                <img src="<?php echo $this->assetsUrl?>/images/DCV-logo.png">
                            </a>
                        </li>
                        <li>
                            <span>gefördert durch</span>
                            <a href="https://akademie.muenchen.ihk.de/bildung/details.jsp?pid=5076" target="_blank">
                                <img src="<?php echo $this->assetsUrl?>/images/ihk-logo.png">
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="large-5 columns">
            <div class="user-area">
                <?php if(!Yii::app()->user->isGuest && !Yii::app()->user->is_seeker) { ?>
                    <a data-tooltip href="<?php echo $this->createUrl('/user/info', array('id' => Yii::app()->user->id)); ?>" title="<?php echo Yii::t("base", "View Profile"); ?>"><b><?php echo Yii::app()->user->name; ?></b> <?php echo Yii::app()->user->surname; ?></a>
                    <!--//====messages====-->
                    <?php $messageCount = Yii::app()->getModule('message')->getCountUnreadedMessages(Yii::app()->user->getId()) ? : 0; ?>

                    <a data-tooltip href="<?php echo $this->createUrl('/message'); ?>" class="fa fa-envelope" title="<?php echo Yii::t("base", "Messages"); ?>">
                        <?php if($messageCount) { ?>
                            <span><?php echo $messageCount; ?></span>
                        <?php } ?>
                    </a>
                    <!--//====messages====-->
                    <a data-tooltip href="<?php echo $this->createUrl('/user/cabinet'); ?>" class="fa fa-sliders" title="<?php echo Yii::t("base", "Cabinet"); ?>"></a>
                    <?php if(Yii::app()->user->isStaff) { ?>
                        <a data-tooltip href="<?php echo $this->createUrl('/backend'); ?>" class="fa fa-bar-chart" title="<?php echo Yii::t("base", "Backend"); ?>"></a>
                    <?php } ?>
                    <a data-tooltip href="<?php echo $this->createUrl('/site/logout'); ?>" class="fa fa-sign-out" title="<?php echo Yii::t("base", "Logout"); ?>"></a>
                <?php } elseif(Yii::app()->user->is_seeker) { ?>
                    <a data-tooltip href="<?php echo $this->createUrl('/message'); ?>" class="fa fa-envelope" title="<?php echo Yii::t("base", "Messages"); ?>">
                    <a data-tooltip href="<?php echo $this->createUrl('/site/logout'); ?>" class="fa fa-sign-out" title="<?php echo Yii::t("base", "Logout"); ?>"></a>
                <?php } else {
                    echo CHtml::link(Yii::t("base", 'Login'), array('/site/login'), array('title' => Yii::t("base", 'Login')));
                    echo CHtml::link(Yii::t("base", 'Become Expert'), array('/registration'), array('title' => Yii::t("base", 'Become Expert')));
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
        <div class="small-12 medium-8 columns">
            <p><?php echo yiisetting('footer_info'); ?></p>
        </div>
        <div class="small-12 medium-4 columns footer_contact">
            <ul>
                <li>
                    <a href="<?php echo $this->createUrl('site/feedback'); ?>"><?php echo Yii::t("base", "Get in touch"); ?></a>   
                </li>
                <li>
                    <a href="<?php echo $this->createUrl('site/pages', array('id' => 1)); ?>"><?php echo Yii::t("base", "Impressum"); ?></a>
                </li>
                <li>
                    <?php if (Yii::app()->user->isGuest) { ?>
                        <a href="<?php echo $this->createUrl('/registration'); ?>"><?php echo Yii::t("base", "Become Expert"); ?></a>
                    <?php } else { ?>
                        <a href="<?php echo $this->createUrl('site/findexperts'); ?>"><?php echo Yii::t("base", "Find experts"); ?></a>
                    <?php } ?>
                </li>
            </ul>
        </div>
    </div>
</footer>

<?php if(!@Yii::app()->request->cookies['accept']->value || (!Yii::app()->user->isGuest && !Yii::app()->user->accept)) { ?>
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
<!-- Hotjar Tracking Code for http://www.crowdexperts.de -->
<script>
   (function(h,o,t,j,a,r){
       h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
       h._hjSettings={hjid:316812,hjsv:5};
       a=o.getElementsByTagName('head')[0];
       r=o.createElement('script');r.async=1;
       r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
       a.appendChild(r);
   })(window,document,'//static.hotjar.com/c/hotjar-','.js?sv=');
</script>
</body>
<?php $this->widget('Notifications'); ?>
</html>
