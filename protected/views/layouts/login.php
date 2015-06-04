<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link rel="apple-touch-icon" href="<?php echo Yii::app()->request->baseUrl; ?>/static/pages/ico/60.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo Yii::app()->request->baseUrl; ?>/static/pages/ico/76.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo Yii::app()->request->baseUrl; ?>/static/pages/ico/120.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo Yii::app()->request->baseUrl; ?>/static/pages/ico/152.png">
    <link rel="icon" type="image/x-icon" href="favicon.ico" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta content="" name="description" />
    <meta content="" name="author" />

    <script src="<?php echo Yii::app()->request->baseUrl; ?>/static/assets/plugins/jquery/jquery-1.8.3.min.js" type="text/javascript"></script>
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/static/assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/static/assets/plugins/boostrapv3/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/static/assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/static/assets/plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/static/assets/plugins/bootstrap-select2/select2.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/static/assets/plugins/switchery/css/switchery.min.css" rel="stylesheet" type="text/css" media="screen" />
    <?php if(isFrontPage()) { ?>
    //============front page=====================
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/static/assets/plugins/nvd3/nv.d3.min.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/static/assets/plugins/mapplic/css/mapplic.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/static/assets/plugins/rickshaw/rickshaw.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/static/assets/plugins/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet" type="text/css" media="screen">
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/static/assets/plugins/jquery-metrojs/MetroJs.css" rel="stylesheet" type="text/css" media="screen" />
    <!--[if lt IE 9]>
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/static/assets/plugins/mapplic/css/mapplic-ie.css" rel="stylesheet" type="text/css" />
    <![endif]-->

    //============front page=====================
    <?php } ?>

    <link href="<?php echo Yii::app()->request->baseUrl; ?>/static/pages/css/pages-icons.css" rel="stylesheet" type="text/css">
    <link class="main-stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/static/pages/css/pages.css" rel="stylesheet" type="text/css" />
    <!--[if lte IE 9]>
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/static/pages/css/ie9.css" rel="stylesheet" type="text/css" />
    <![endif]-->
    <script type="text/javascript">
        window.onload = function()
        {
            // fix for windows 8
            if (navigator.appVersion.indexOf("Windows NT 6.2") != -1)
                document.head.innerHTML += '<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/static/pages/css/windows.chrome.fix.css" />'
        }
    </script>

    <?php
        Yii::app()->clientScript->scriptMap=array(
            'jquery.js'=>false,
            'jquery.min.js'=>false,
        );
    ?>
    <title>Pages - Admin Dashboard UI Kit</title>
</head>

<?php $class = isFrontPage() ? 'dashboard' : ''; ?>

<body class="fixed-header <?php echo $class;?>">
<?php echo $content; ?>

<!-- BEGIN VENDOR JS -->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/static/assets/plugins/pace/pace.min.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/static/assets/plugins/modernizr.custom.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/static/assets/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/static/assets/plugins/boostrapv3/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/static/assets/plugins/jquery/jquery-easy.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/static/assets/plugins/jquery-unveil/jquery.unveil.min.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/static/assets/plugins/jquery-bez/jquery.bez.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/static/assets/plugins/jquery-ios-list/jquery.ioslist.min.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/static/assets/plugins/jquery-actual/jquery.actual.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/static/assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/static/assets/plugins/bootstrap-select2/select2.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/static/assets/plugins/classie/classie.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/static/assets/plugins/switchery/js/switchery.min.js" type="text/javascript"></script>

<?php if(isFrontPage()) { ?>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/static/assets/plugins/nvd3/lib/d3.v3.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/static/assets/plugins/nvd3/nv.d3.min.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/static/assets/plugins/nvd3/src/utils.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/static/assets/plugins/nvd3/src/tooltip.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/static/assets/plugins/nvd3/src/interactiveLayer.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/static/assets/plugins/nvd3/src/models/axis.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/static/assets/plugins/nvd3/src/models/line.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/static/assets/plugins/nvd3/src/models/lineWithFocusChart.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/static/assets/plugins/mapplic/js/hammer.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/static/assets/plugins/mapplic/js/jquery.mousewheel.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/static/assets/plugins/mapplic/js/mapplic.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/static/assets/plugins/jquery-metrojs/MetroJs.min.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/static/assets/plugins/jquery-sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/static/assets/plugins/skycons/skycons.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/static/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>
<?php } ?>

<!-- END VENDOR JS -->
<!-- BEGIN CORE TEMPLATE JS -->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/static/pages/js/pages.min.js"></script>
<!-- END CORE TEMPLATE JS -->
<!-- BEGIN PAGE LEVEL JS -->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/static/assets/js/scripts.js" type="text/javascript"></script>
<!-- END PAGE LEVEL JS -->
</body>
</html>