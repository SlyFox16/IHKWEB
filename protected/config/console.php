<?php

$packages = require_once(dirname(__FILE__).'/packages.php');

$configDir = dirname(__FILE__);

$mainLocalFile = $configDir . DIRECTORY_SEPARATOR . 'main-local.php';
$mainLocalConfiguration = file_exists($mainLocalFile) ? require($mainLocalFile) : array();

$mainEnvFile = $configDir . DIRECTORY_SEPARATOR . 'main-env.php';
$mainEnvConfiguration = file_exists($mainEnvFile) ? require($mainEnvFile) : array();

return CMap::mergeArray(
    array(
        'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
        'name' => 'IHK',

// preloading 'log' component
        'preload' => array('log'),

        'import' => array(
            'application.models.*',
            'application.components.*',
            'application.widgets.*',
            'application.extensions.*',
            'application.components.helpers.*',
        ),

// application components
        'components' => array(
            'log' => array(
                'class' => 'CLogRouter',
                'routes'=>array(
                    array(
                        'class'=>'CFileLogRoute',
                        'logFile'=>'cron.log',
                        'levels'=>'error, warning',
                    ),
                    array(
                        'class'=>'CFileLogRoute',
                        'logFile'=>'cron_trace.log',
                        'levels'=>'trace',
                    ),
                ),
            ),

            'email' => array(
                'class' => 'application.components.Email',
            ),
        ),

        'params' => array(
            'noImage' => 'static/images/profile-no-photo.png',
            'no-replyEmail' => 'crowdexperts@crowdexperts.de',
            'adminEmail' => 'jenya@idol-it.com',
            'defaultPageSize' => 10,
            'albumPageSize' => 18,
            'googleMapKey' => 'AIzaSyDJVbJ6Hx1ujltysxHUZw0PXUakYihUcKA',
        ),
    ),
    CMap::mergeArray($mainEnvConfiguration, $mainLocalConfiguration)
);