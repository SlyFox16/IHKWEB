<?php

/**
 * Environment config on Djangoeurope
 */

return array(
    'components' => array(
        'db'=>array(
            'connectionString' => 'mysql:host=localhost;dbname=ihkidoli_main',
            'emulatePrepare' => true,
            'username' => 'ihkidoli_user',
            'password' => 'qazwsxedcrfv',
            'charset' => 'utf8',
            'tablePrefix' => '',
        ),
    )
);
