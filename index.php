<?php
date_default_timezone_set('Europe/Kiev');
// change the following paths if necessary
$yii=dirname(__FILE__).'/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

defined('LOCALHOST') or define('LOCALHOST', $_SERVER['SERVER_ADDR'] == '127.0.0.1' and $_SERVER['REMOTE_ADDR'] == '127.0.0.1');
if (LOCALHOST) {
    defined('YII_DEBUG') or define('YII_DEBUG', true);
} else {
    defined('YII_DEBUG') or define('YII_DEBUG', true); //false
}

// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require_once($yii);
Yii::createWebApplication($config)->run();
