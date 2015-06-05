<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

$packages = require_once(dirname(__FILE__).'/packages.php');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
require_once( dirname(__FILE__) . '/../components/Helpers.php');

$configDir = dirname(__FILE__);

$mainLocalFile = $configDir . DIRECTORY_SEPARATOR . 'main-local.php';
$mainLocalConfiguration = file_exists($mainLocalFile) ? require($mainLocalFile) : array();

$mainEnvFile = $configDir . DIRECTORY_SEPARATOR . 'main-env.php';
$mainEnvConfiguration = file_exists($mainEnvFile) ? require($mainEnvFile) : array();

return CMap::mergeArray(
     array(
        'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
        'name'=>'IHK',
        'language'=>'en',

        // preloading 'log' component
        'preload'=>array('log'), //, 'bootstrap', 'languages'

        // autoloading model and component classes
        'import'=>array(
            'application.models.*',
            'application.components.*',
            'application.extensions.*'
        ),

        'modules'=>array(
            // uncomment the following to enable the Gii tool

            'gii'=>array(
                'class'=>'system.gii.GiiModule',
                'password'=>'12345',
                // If removed, Gii defaults to localhost only. Edit carefully to taste.
                'ipFilters'=>array('127.0.0.1','::1'),
                'generatorPaths'=>array(
                    'bootstrap.gii',
                ),
            ),
            'backend',
        ),

        // application components
        'components'=>array(
            'bootstrap'=>array(
                'class'=>'ext.bootstrap.components.Bootstrap', // assuming you extracted bootstrap under extensions
                'responsiveCss'=>true,
            ),

            'booster'=>array(
                'class'=>'ext.booster.components.Booster', // assuming you extracted bootstrap under extensions
                'responsiveCss'=>true,
            ),

            'format' => array(
                'class' => 'backend.components.ExtendedFormatter'
            ),

            'clientScript' => array(
                'packages' => $packages,
                'coreScriptPosition' => CClientScript::POS_END,
                'scriptMap' => array(
                    'jquery.js' => '/static/js/jquery-1.11.2.min.js',
                ),
            ),

            'languages' => array(
                'class' => 'Languages',
                'useLanguage' => true,
                'autoDetect' => true,
                'languages' => array('ro', 'ru'),
            ),

            'iwi' => array(
                'class' => 'application.extensions.iwi.IwiComponent',
                // GD or ImageMagick
                'driver' => 'GD',
                // ImageMagick setup path
                //'params'=>array('directory'=>'C:/ImageMagick'),
            ),

            'assetManager' => array(
                'newDirMode' => 0755,
                'newFileMode' => 0644
            ),

            'user'=>array(
                // enable cookie-based authentication
                'allowAutoLogin' => true,
                'class' => 'WebUser',
            ),

            // uncomment the following to enable URLs in path-format

            'urlManager'=>array(
                'urlFormat'=>'path',
                'showScriptName'=>false,
                'rules'=>array(
                    'backend'=>'backend/default/index',
                    'registration' => 'site/register',
                    'login' => 'site/login',
                    '<controller:\w+>/<id:\d+>'=>'<controller>/view',
                    '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
                    '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
                    '<module:\w+>/<controller:\w+>/<action:\w+>/<id:\d+>'=>'<module>/<controller>/<action>',
                    '<module:\w+>/<controller:\w+>/<action:\w+>'=>'<module>/<controller>/<action>'
                ),
            ),

            /*'db'=>array(
                'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
            ),*/
            // uncomment the following to use a MySQL database

            'errorHandler'=>array(
                // use 'site/error' action to display errors
                'errorAction'=>'site/error',
            ),

            'log'=>array(
                'class'=>'CLogRouter',
                'routes'=>array(
                    array(
                        'class'=>'CFileLogRoute',
                        'levels'=>'error, warning',
                    ),
                    // uncomment the following to show log messages on web pages

                    /*array(
                        'class'=>'CWebLogRoute',
                    ),*/

                ),
            ),
        ),

        // application-level parameters that can be accessed
        // using Yii::app()->params['paramName']
        'params'=>array(
            'no-replyEmail' => 'no-reply@'.$_SERVER['SERVER_NAME'],
            'adminEmail' => 'jenya@idol-it.com',
            'defaultPageSize' => 9,
            'albumPageSize' => 18,
        ),
     ),
    CMap::mergeArray($mainEnvConfiguration, $mainLocalConfiguration)
);