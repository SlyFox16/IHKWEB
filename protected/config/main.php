<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

$packages = require_once(dirname(__FILE__) . '/packages.php');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
require_once(dirname(__FILE__) . '/../components/Helpers.php');

$configDir = dirname(__FILE__);

$mainLocalFile = $configDir . DIRECTORY_SEPARATOR . 'main-local.php';
$mainLocalConfiguration = file_exists($mainLocalFile) ? require($mainLocalFile) : array();

$mainEnvFile = $configDir . DIRECTORY_SEPARATOR . 'main-env.php';
$mainEnvConfiguration = file_exists($mainEnvFile) ? require($mainEnvFile) : array();

return CMap::mergeArray(
    array(
        'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
        'name' => 'IHK',
        'language' => 'en',
        'theme' => 'newtheme',

        // preloading 'log' component
        'preload' => array('log', 'booster'), //, 'bootstrap', 'languages'

        // autoloading model and component classes
        'import' => array(
            'application.models.*',
            'application.components.*',
            'application.widgets.*',
            'application.extensions.*',
            'application.components.helpers.*',

            'ext.eoauth.*',
            'ext.eoauth.lib.*',
            'ext.lightopenid.*',
            'ext.eauth.*',
            'ext.eauth.services.*',
        ),

        'modules' => array(
            // uncomment the following to enable the Gii tool

            'gii' => array(
                'class' => 'system.gii.GiiModule',
                'password' => '12345',
                // If removed, Gii defaults to localhost only. Edit carefully to taste.
                'ipFilters' => array('127.0.0.1', '::1'),
                'generatorPaths' => array(
                    'bootstrap.gii',
                ),
            ),
            'message' => array(
                'userModel' => 'User',
                'getNameMethod' => 'getFullName',
                'getSuggestMethod' => 'site/suggest',
            ),
            'backend',
        ),

        // application components
        'components' => array(
            'bootstrap' => array(
                'class' => 'ext.bootstrap.components.Bootstrap', // assuming you extracted bootstrap under extensions
                'responsiveCss' => true,
            ),

            'ajax' => array(
                'class' => 'application.components.AsyncResponse',
            ),

            'booster' => array(
                'class' => 'ext.booster.components.Booster', // assuming you extracted bootstrap under extensions
                'responsiveCss' => true,
            ),

            'format' => array(
                'class' => 'backend.components.ExtendedFormatter'
            ),

            'email' => array(
                'class' => 'application.components.Email',
            ),

            'clientScript' => array(
                'packages' => $packages,
                'coreScriptPosition' => CClientScript::POS_END,
                'scriptMap' => array(
                    'jquery.js' => '/static/javascripts/jquery-1.11.2.min.js',
                ),
            ),

            'loid' => array(
                'class' => 'ext.lightopenid.loid',
            ),

            'eauth' => array(
                'class' => 'ext.eauth.EAuth',
                'popup' => true, // Use the popup window instead of redirecting.
                'cache' => false, // Cache component name or false to disable cache. Defaults to 'cache'.
                'cacheExpire' => 0, // Cache lifetime. Defaults to 0 - means unlimited.
                'services' => array( // You can change the providers and their classes.
                    'facebook' => array(
                        // register your app here: https://developers.facebook.com/apps/
                        'class' => 'IhkFacebookService',
                        'client_id' => '804272606339674',
                        'client_secret' => 'ba58f0c19fda4de7a6f05ead0568dd0d',
                    ),
                    'linkedin' => array(
                        // register your app here: https://www.linkedin.com/secure/developer
                        'class' => 'LinkedinOAuthService',
                        'key' => '77dsflkn53iaj8',
                        'secret' => 'Nb2gl4xogWeKqMB0',
                    ),
                    'xing' => array(
                        'class' => 'XingOAuthService',
                        'key' => '8618cf6c084f5a4a700e',
                        'secret' => '81193b0d56e134f25d151d5240837387490fff6c',
                    ),
                ),
            ),

            /*'languages' => array(
                'class' => 'Languages',
                'useLanguage' => true,
                'autoDetect' => true,
                'languages' => array('ro', 'ru'),
            ),*/

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

            'user' => array(
                // enable cookie-based authentication
                'allowAutoLogin' => true,
                'class' => 'WebUser',
            ),

            // uncomment the following to enable URLs in path-format

            'urlManager' => array(
                'urlFormat' => 'path',
                'showScriptName' => false,
                'rules' => array(
                    array('class' => 'staticPagesRouter'),
                    array('class' => 'ihkUserRouter'),
                    array('class' => 'CertificateRouter'),
                    '' => 'site/index',
                    'xing' => 'site/xing',
                    'backend' => 'backend/default/index',
                    'registration' => 'site/register',
                    'seekerRegistration' => 'site/seekerRegister',
                    'seekerConfirmation/<id:\w+>' => 'site/seekerConfirmation',
                    'cabinet' => 'user/cabinet',
                    'login' => 'site/login',
                    'logout' => 'site/logout',
                    'search' => 'site/findexperts',
                    'feedback' => 'site/feedback',
                    'ratingtop' => 'site/ratingList',
                    'user/recover/<pass:\w+>' => 'user/recover',
                    '<controller:\w+>/<id:\d+>' => '<controller>/view',
                    '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                    '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                    '<module:\w+>/<controller:\w+>/<action:\w+>/<id:\d+>' => '<module>/<controller>/<action>',
                    '<module:\w+>/<controller:\w+>/<action:\w+>/<param:\w+>' => '<module>/<controller>/<action>',
                    '<module:\w+>/<controller:\w+>/<action:\w+>' => '<module>/<controller>/<action>'
                ),
            ),

            /*'db'=>array(
                'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
            ),*/
            // uncomment the following to use a MySQL database

            'errorHandler' => array(
                // use 'site/error' action to display errors
                'errorAction' => 'site/error',
            ),

            'log' => array(
                'class' => 'CLogRouter',
                'routes' => array(
                    array(
                        'class' => 'CFileLogRoute',
                        'levels' => 'error, warning',
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
        'params' => array(
            'noImage' => 'static/images/profile-no-photo.png',
            'no-replyEmail' => 'crowdexperts@' . $_SERVER['SERVER_NAME'],
            'adminEmail' => 'jenya@idol-it.com',
            'defaultPageSize' => 10,
            'albumPageSize' => 18,
        ),
    ),
    CMap::mergeArray($mainEnvConfiguration, $mainLocalConfiguration)
);
